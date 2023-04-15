<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use Throwable;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::latest();

            if ($request->trash) {
                $categories = $categories->onlyTrashed();
            }

            return DataTables::of($categories)
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->addColumn('action', function ($category) use ($request) {

                    $edit_btn = '';
                    $trash_btn = '';
                    $restore_btn = '';
                    $delete_btn = '';

                    if ($this->getAuthAdminUser()->can('edit_category')) {
                        $edit_btn = '<a href="#" class="btn btn-sm btn-warning rounded m-1 edit-category" data-url="' . route('admin.category.update', $category->id) . '" data-category-name="' . $category->name . '" title="Edit Category"><i class="fas fa-edit"></i></a>';
                    }

                    if ($this->getAuthAdminUser()->can('delete_category')) {
                        $trash_btn = '<a href="" class="btn btn-sm btn-danger rounded m-1 trash" data-trash-url="' . route('admin.category.destroy', $category->id) . '" title="Trash"><i class="fas fa-trash"></i></a>';
                        $restore_btn = '<a href="" class="btn btn-sm btn-secondary rounded m-1 restore" data-restore-url="' . route('admin.category.restore', $category->id) . '" title="Restore"><i class="fas fa-undo"></i></a>';
                        $delete_btn = '<a href="" class="btn btn-sm btn-danger rounded m-1 delete" data-delete-url="' . route('admin.category.force-delete', $category->id) . '" title="Delete Permanently"><i class="fas fa-trash"></i></a>';
                    }

                    if ($request->trash) {
                        return '<div class="d-flex justify-content-center">
                            ' . $restore_btn . '
                            ' . $delete_btn . '
                        </div>';
                    }

                    return '<div class="d-flex justify-content-center">
                        ' . $edit_btn . '
                        ' . $trash_btn . '
                    </div>';
                })
                ->editColumn('created_at', function ($category) {
                    return $category->created_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $category->created_at->diffForHumans() . '</span>';
                })
                ->editColumn('updated_at', function ($category) {
                    return $category->updated_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $category->updated_at->diffForHumans() . '</span>';
                })
                ->rawColumns(['created_at', 'updated_at', 'action'])
                ->make(true);
        }

        return view('backend.admin.category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $category = Category::create([
                'key' => str_replace(' ', '_', strtolower($request->category_name)),
                'name' => $request->category_name,
            ]);

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($category)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Category is created by ' . $auth_user->name . '.');

            return successMessage('Created in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failMessage($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $category->update([
                'key' => str_replace(' ', '_', strtolower($request->category_name)),
                'name' => $request->category_name,
            ]);

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($category)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Category is edited by ' . $auth_user->name . '.');

            return successMessage('Edited in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failMessage($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $category->delete();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($category)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Category is trashed by ' . $auth_user->name . '.');

            return successJson('Deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $category = Category::onlyTrashed()->find($id);
            $category->restore();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($category)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Category is restored by ' . $auth_user->name . '.');

            return successJson('Restored in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $category = Category::onlyTrashed()->findOrFail($id);

            $category->forceDelete();

            $auth_user = auth()->guard('admin_user')->user();

            activity()
                ->causedBy($auth_user)
                ->performedOn($category)
                ->withProperties(['source' => 'Admin Panel'])
                ->log('Category is permanently deleted by ' . $auth_user->name . '.');

            return successJson('Permanently deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }
}
