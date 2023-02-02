<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
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
}
