<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(AdminUser::query())
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->addColumn('role', function ($each) {
                    return $each->role;
                })
                ->addColumn('action', function ($each) {

                    $edit_btn = '<a href="' . route('admin.admin-user.edit', $each->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>';

                    return $edit_btn;
                })
                ->make(true);
        }
        return view('backend.admin.admin_users.index');
    }

    public function create(Request $request, AdminUser $admin_user)
    {
        $roles = Role::get();

        return view('backend.admin.admin_users.create', compact('admin_user', 'roles'));
    }
}
