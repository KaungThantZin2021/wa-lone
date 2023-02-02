<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionGroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permission_groups = PermissionGroup::query();

            return DataTables::of($permission_groups)
                ->filterColumn('permissions', function ($query, $keyword) {
                    $query->whereHas('permissions', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->addColumn('permissions', function ($each) {
                    $permissions = $each->permissions;
                    $permissions_table = '<ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-1 dark:tw-border-gray-500 dark:tw-bg-slate-700">
                                                <a href="" class="btn btn-sm btn-outline-success rounded m-1 add-permission" data-permission-group-id="' . $each->id . '" title="Add Permission"><i class="fas fa-plus-circle"></i> Create Permission</a>
                                            </li>';

                    if (count($permissions) > 0) {
                        foreach ($permissions as $permission) {
                            $permissions_table .= '<li class="list-group-item d-flex justify-content-between align-items-center py-1 dark:tw-border-gray-500 dark:tw-bg-slate-900">
                                                        ' . $permission->name . '
                                                        <div>
                                                            <a href="" class="btn btn-sm btn-outline-primary rounded m-1 edit-permission" data-permission-group-id="' . $each->id . '" data-permission-id="' . $permission->id . '" data-permission-name="' . $permission->name . '" title="Edit Permission"><i class="fas fa-edit"></i></a>
                                                            <a href="" class="btn btn-sm btn-outline-danger rounded m-1 delete-permission" data-permission-group-id="' . $each->id . '" data-permission-id="' . $permission->id . '" data-permission-name="' . $permission->name . '" title="Delete Permission"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </li>';
                        }
                    } else {
                        $permissions_table .= '<li class="list-group-item d-flex justify-content-between align-items-center dark:tw-border-gray-500 dark:tw-bg-slate-900">
                                                    <span>There is no permission.</span>
                                                </li>';
                    }

                    $permissions_table .= '</ul>';

                    return $permissions_table;
                })
                ->editColumn('created_at', function ($each) {
                    return $each->created_at->format('Y-m-d H:i:s') . '<br> (' . $each->created_at->diffForHumans() . ')';
                })
                ->editColumn('updated_at', function ($each) {
                    return $each->updated_at->format('Y-m-d H:i:s') . '<br> (' . $each->updated_at->diffForHumans() . ')';
                })
                ->addColumn('action', function ($each) {
                    return '<div class="d-flex justify-content-center">
                        <a href="' . route('admin.permission-group.edit', $each->id) . '" class="btn btn-sm btn-primary rounded m-1" title="Edit Permission Group"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn btn-sm btn-danger rounded m-1 delete-permission-group" data-delete-url="' . route('admin.permission-group.destroy', $each->id) . '" title="Delete Permission Group"><i class="fas fa-trash"></i></a>
                    </div>';
                })
                ->rawColumns(['permissions', 'created_at', 'updated_at', 'action'])
                ->make(true);
        }

        return view('backend.admin.permission_group.index');
    }

    public function create()
    {
        return view('backend.admin.permission_group.create');
    }

    public function store(Request $request)
    {
        PermissionGroup::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        return redirect()->route('admin.permission-group.index')->with('success', 'Permission Group created successfully.');
    }

    public function edit(PermissionGroup $permission_group)
    {
        return view('backend.admin.permission_group.edit', compact('permission_group'));
    }

    public function update(PermissionGroup $permission_group, Request $request)
    {
        $permission_group->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        return redirect()->route('admin.permission-group.index')->with('success', 'Permission Group updated successfully.');
    }

    public function destroy(PermissionGroup $permission_group, Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            if (is_null($permission_group)) throw new Exception('Permission group doesn\'t exist!');

            $permission_group->permissions()->delete();
            $permission_group->delete();

            return successMessage('Permission Group deleted successfully');

        } catch (Exception $e) {
            Log::error($e);
            return failMessage($e->getMessage());
        }
    }

    public function createPermission(Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $permission_group = PermissionGroup::find($request->permission_group_id);

            if (is_null($permission_group)) throw new Exception('Permission group doesn\'t exist!');

            Permission::create([
                'permission_group_id' => $permission_group->id,
                'name' => str_replace(' ', '_', strtolower($request->permission_name)),
                'guard_name' => $permission_group->guard_name
            ]);

            return successMessage('Permission created successfully');

        } catch (Exception $e) {
            Log::error($e);
            return failMessage($e->getMessage());
        }
    }

    public function editPermission(Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $permission_group = PermissionGroup::find($request->permission_group_id);

            if (is_null($permission_group)) throw new Exception('Permission group doesn\'t exist!');

            $permission = $permission_group->permissions()->find($request->permission_id);

            if (is_null($permission)) throw new Exception('Permission doesn\'t exist!');

            $permission->update([
                'name' => str_replace(' ', '_', strtolower($request->permission_name)),
            ]);

            return successMessage('Permission updated successfully');

        } catch (Exception $e) {
            Log::error($e);
            return failMessage($e->getMessage());
        }
    }

    public function deletePermission(Request $request)
    {
        try {
            if (!$request->ajax()) throw new Exception('Invalid Request!');

            $permission_group = PermissionGroup::find($request->permission_group_id);

            if (is_null($permission_group)) throw new Exception('Permission group doesn\'t exist!');

            $permission = $permission_group->permissions()->find($request->permission_id);

            if (is_null($permission)) throw new Exception('Permission doesn\'t exist!');

            $permission->delete();

            return successMessage('Permission deleted successfully');

        } catch (Exception $e) {
            Log::error($e);
            return failMessage($e->getMessage());
        }
    }
}
