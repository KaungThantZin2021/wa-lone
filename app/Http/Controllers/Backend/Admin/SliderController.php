<?php
namespace App\Http\Controllers\Backend\Admin;

use Exception;
use Throwable;
use App\Models\Blog;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use App\Notifications\BlogNotification;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\ReceiverNotificationToken;
use App\Http\Requests\CreateSliderRequest;
use Illuminate\Support\Facades\Notification;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sliders = Slider::orderBy('created_at', 'DESC');

            if ($request->trash) {
                $sliders = $sliders->onlyTrashed();
            }

            return DataTables::of($sliders)
                ->editColumn('title', function ($slider) {
                    return Str::limit($slider->title, 50);
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
                ->editColumn('created_at', function ($slider) {
                    return $slider->created_at->format('Y-m-d H:i:s') . '<br> (' . $slider->created_at->diffForHumans() . ')';
                })
                ->editColumn('updated_at', function ($slider) {
                    return $slider->updated_at->format('Y-m-d H:i:s') . '<br> (' . $slider->updated_at->diffForHumans() . ')';
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

    public function store(CreateSliderRequest $request)
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

    public function edit(Blog $blog)
    {
        return view('backend.admin.blogs.edit', compact('blog'));
    }

    // public function update(UpdateBlogRequest $request, Blog $blog)
    public function update(Request $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $thumbnail = null;

            if ($request->thumbnail_type === Blog::THUMBNAIL_FILE) {
                if ($request->file('thumbnail_file')) {
                    if ($blog->thumbnail) {
                        $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
                        if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
                        File::delete($thumbnail_file_path);
                    }

                    $file_name = Blog::THUMBNAIL_FILE . '_' . time() . '-' . rand(11111, 99999) . '.' . $request->file('thumbnail_file')->getClientOriginalName();
                    $request->thumbnail_file->storeAs('thumbnails', $file_name);

                    $thumbnail = $file_name;
                }
            }

            if ($request->thumbnail_type === Blog::THUMBNAIL_URL) {
                if ($request->thumbnail_url) {
                    if ($blog->thumbnail) {
                        $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
                        if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
                        File::delete($thumbnail_file_path);
                    }

                    $file_name = Blog::THUMBNAIL_URL . '_' . time() . '-' . rand(11111, 99999) . '.' . pathinfo($request->thumbnail_url, PATHINFO_BASENAME);
                    $file = file_get_contents($request->thumbnail_url);
                    file_put_contents(storage_path('app/public/thumbnails/'. $file_name), $file);

                    $thumbnail = $file_name;
                }
            }

            if (!is_null($thumbnail)) {
                $blog->update([
                    'thumbnail_type' => $request->thumbnail_type,
                    'thumbnail' => $thumbnail,
                ]);
            }

            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $users = User::get();

            $noti_data = [
                'title' => 'Blog is edited!',
                'description' => $blog->title,
                'typeable' => get_class($blog),
                'typeable_id' => $blog->id,
                'link' => '',
            ];

            Notification::send($users, new BlogNotification($noti_data));

            // $receiver_notification_tokens = ReceiverNotificationToken::pluck('token');
            // $token_array = $receiver_notification_tokens->toArray();

            // $fields['include_player_ids'] = $token_array;
            // $message = 'Blog is edited!';
            // OneSignal::sendPush($fields, $message);

            //-----

            // $fields['include_player_ids'] = ['7421c9cc-b020-4652-a0bf-01173bc761a7'];
            // $message = 'Blog is edited!';
            // OneSignal::sendPush($fields, $message);

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($blog)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Blog is edited by ' . $auth_user->name . '.');

            DB::commit();
            return $this->redirectToIndex('success', 'Updated in successfully');

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th);
            return $this->redirectBackWithErrors($th->getMessage());
        }
    }

    public function show(Blog $blog)
    {
        return view('backend.admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($blog)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Blog is trashed by ' . $auth_user->name . '.');

            return successJson('Deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }

    }

    public function restore($id)
    {
        try {
            $blog = Blog::onlyTrashed()->find($id);
            $blog->restore();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($blog)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Blog is restored by ' . $auth_user->name . '.');

            return successJson('Restored in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $blog = Blog::onlyTrashed()->find($id);

            $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
            if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
            File::delete($thumbnail_file_path);

            $blog->forceDelete();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($blog)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Blog is permanently deleted by ' . $auth_user->name . '.');

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
