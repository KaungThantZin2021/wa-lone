<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query();

            return DataTables::of($roles)
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->editColumn('created_at', function ($each) {
                    return $each->created_at->format('Y-m-d H:i:s') . '<br> (' . $each->created_at->diffForHumans() . ')';
                })
                ->editColumn('updated_at', function ($each) {
                    return $each->updated_at->format('Y-m-d H:i:s') . '<br> (' . $each->updated_at->diffForHumans() . ')';
                })
                ->addColumn('action', function ($each) {
                    return '<div class="d-flex justify-content-center">
                        <a href="' . route('admin.give-permission-to-role-form', $each->id) . '" class="btn btn-sm btn-success rounded m-1" title="Detail"><i class="fas fa-shield-alt"></i></a>
                        <a href="" class="btn btn-sm btn-info rounded m-1" title="Detail"><i class="fas fa-info-circle"></i></a>
                    </div>';
                })
                ->rawColumns(['created_at', 'updated_at', 'action'])
                ->make(true);
        }

        return view('backend.admin.role.index');
    }

    public function create()
    {
        return view('backend.admin.role.create');
    }

    public function store(Request $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role created successfully.');
    }

    public function givePermissionToRoleForm(Request $request, Role $role)
    {
        $permission_groups = PermissionGroup::get();

        return view('backend.admin.role.give_permission_to_role', compact('role', 'permission_groups'));
    }

    public function givePermissionToRole(Request $request, Role $role)
    {
        $role->givePermissionTo($request->permissions ?? []);

        return redirect()->route('admin.role.index')->with('success', 'Give permission to role successfully.');
    }
}
