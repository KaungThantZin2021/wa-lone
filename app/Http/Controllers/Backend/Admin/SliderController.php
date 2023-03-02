<?php
namespace App\Http\Controllers\Backend\Admin;

use Exception;
use Throwable;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view_slider', ['only' => ['index']]);
    // }

    public function index(Request $request)
    {
        abort_if(!currentAdminUser()->can('view_slider'), 403);

        if ($request->ajax()) {
            $sliders = Slider::orderBy('created_at', 'DESC');

            if ($request->trash) {
                $sliders = $sliders->onlyTrashed();
            }

            return DataTables::of($sliders)
                ->editColumn('title', function ($slider) {
                    return Str::limit($slider->title, 50);
                })
                ->editColumn('description', function ($slider) {
                    return Str::limit($slider->description, 100);
                })
                ->editColumn('image', function ($slider) {
                    return '<img class="tw-object-cover tw-w-20" src="'. $slider->sliderPath() .'">';
                })
                ->addColumn('action', function ($slider) use ($request) {

                    $detail_btn = '<a href="' . route('admin.slider.show', $slider->id) . '" class="btn btn-sm btn-info rounded m-1" title="Detail"><i class="fas fa-info-circle"></i></a>';
                    $edit_btn = '';
                    $trash_btn = '';
                    $restore_btn = '';
                    $delete_btn = '';

                    if ($this->getAuthAdminUser()->can('edit_slider')) {
                        $edit_btn = '<a href="' . route('admin.slider.edit', $slider->id) . '" class="btn btn-sm btn-warning rounded m-1" title="Edit"><i class="fas fa-edit"></i></a>';
                    }

                    if ($this->getAuthAdminUser()->can('delete_slider')) {
                        $trash_btn = '<a href="" class="btn btn-sm btn-danger rounded m-1 trash" data-trash-url="' . route('admin.slider.destroy', $slider->id) . '" title="Trash"><i class="fas fa-trash"></i></a>';
                        $restore_btn = '<a href="" class="btn btn-sm btn-secondary rounded m-1 restore" data-restore-url="' . route('admin.slider.restore', $slider->id) . '" title="Restore"><i class="fas fa-undo"></i></a>';
                        $delete_btn = '<a href="" class="btn btn-sm btn-danger rounded m-1 delete" data-delete-url="' . route('admin.slider.force-delete', $slider->id) . '" title="Delete Permanently"><i class="fas fa-trash"></i></a>';
                    }

                    if ($request->trash) {
                        return '<div class="d-flex justify-content-center">
                            ' . $detail_btn . '
                            ' . $restore_btn . '
                            ' . $delete_btn . '
                        </div>';
                    }

                    return '<div class="d-flex justify-content-center">
                        ' . $detail_btn . '
                        ' . $edit_btn . '
                        ' . $trash_btn . '
                    </div>';
                })
                ->editColumn('created_at', function ($each) {
                    return $each->created_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $each->created_at->diffForHumans() . '</span>';
                })
                ->editColumn('updated_at', function ($each) {
                    return $each->updated_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $each->updated_at->diffForHumans() . '</span>';
                })
                ->rawColumns(['image', 'created_at', 'updated_at', 'action'])
                ->make(true);
        }

        return view('backend.admin.slider.index');
    }

    public function create()
    {
        return view('backend.admin.slider.create');
    }

    public function store(SliderRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!$request->file('slider_image')) throw new Exception("There is no slider image file.");

            $file_name = $request->type . '_' . time() . '-' . rand(11111, 99999) . '.' . $request->file('slider_image')->getClientOriginalName();
            $request->slider_image->storeAs('sliders', $file_name);

            $slider = Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'image' => $file_name,
            ]);

            $auth_user = currentAdminUser();

            activity()
                ->causedBy($auth_user)
                ->performedOn($slider)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Slider is created by ' . $auth_user->name . '.');

            DB::commit();
            return $this->redirectToIndex('success', 'Created in successfully');

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th);
            return $this->redirectBackWithErrors($th->getMessage());
        }
    }

    public function edit(Slider $slider)
    {
        return view('backend.admin.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        DB::beginTransaction();
        try {
            if ($request->slider_image && $request->slider_image_exist == 1) {
                if (!$request->file('slider_image')) throw new Exception("There is no slider image file.");

                $slider_image_path = storage_path('app/public/sliders/' . $slider->image);
                if (!File::exists($slider_image_path)) throw new Exception('Old slider image file not found to delete!');
                File::delete($slider_image_path);

                $file_name = $request->type . '_' . time() . '-' . rand(11111, 99999) . '.' . $request->file('slider_image')->getClientOriginalName();
                $request->slider_image->storeAs('sliders', $file_name);

                $slider->update([
                    'image' => $file_name,
                ]);
            }

            $slider->update([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
            ]);

            $auth_user = currentAdminUser();

            activity()
                ->causedBy($auth_user)
                ->performedOn($slider)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Slider is updated by ' . $auth_user->name . '.');

            DB::commit();
            return $this->redirectToIndex('success', 'Updated in successfully');

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th);
            return $this->redirectBackWithErrors($th->getMessage());
        }
    }

    public function show(Slider $slider)
    {
        return view('backend.admin.slider.show', compact('slider'));
    }

    public function destroy(Slider $slider)
    {
        try {
            $slider->delete();

            $auth_user = currentAdminUser();

            activity()
                ->causedBy($auth_user)
                ->performedOn($slider)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Slider is trashed by ' . $auth_user->name . '.');

            return successJson('Deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }

    }

    public function restore($id)
    {
        try {
            $slider = Slider::onlyTrashed()->find($id);
            $slider->restore();

            $auth_user = currentAdminUser();

            activity()
                ->causedBy($auth_user)
                ->performedOn($slider)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Slider is restored by ' . $auth_user->name . '.');

            return successJson('Restored in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $slider = Slider::onlyTrashed()->find($id);

            $slider_image_path = storage_path('app/public/slider/' . $slider->thumbnail);
            if (!File::exists($slider_image_path)) throw new Exception('Slider image file not found to delete!');
            File::delete($slider_image_path);

            $slider->forceDelete();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($slider)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Slider is permanently deleted by ' . $auth_user->name . '.');

            return successJson('Permanently deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    private function redirectToIndex(string $session_key, string $message)
    {
        return redirect()->route('admin.slider.index')->with($session_key, $message);
    }

    private function redirectBackWithErrors(string $error_message)
    {
        return redirect()->back()->withErrors(['fail' => $error_message])->withInput();
    }
}
