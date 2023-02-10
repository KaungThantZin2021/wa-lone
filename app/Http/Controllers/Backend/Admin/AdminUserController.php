<?php
namespace App\Http\Controllers\Backend\Admin;

use Exception;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
                    $roles = '';
                    foreach ($each->roles as $role) {
                        $roles .= '<span class="badge badge-pill badge-primary">' . $role->name . '</span> ';
                    }

                    return $roles;
                })
                ->addColumn('action', function ($each) {

                    $edit_btn = '<a href="' . route('admin.admin-user.edit', $each->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>';

                    return $edit_btn;
                })
                ->editColumn('created_at', function ($each) {
                    return $each->created_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $each->created_at->diffForHumans() . '</span>';
                })
                ->editColumn('updated_at', function ($each) {
                    return $each->updated_at->format('Y-m-d H:i:s') . ' <span class="badge badge-pill badge-primary">' . $each->updated_at->diffForHumans() . '</span>';
                })
                ->rawColumns(['role', 'created_at', 'updated_at', 'action'])
                ->make(true);
        }
        return view('backend.admin.admin_users.index');
    }

    public function create(Request $request)
    {
        $roles = Role::get();

        return view('backend.admin.admin_users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->password == $request->confirm_password) {
                $password = Hash::make($request->password);
            }

            $admin_user = AdminUser::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $password,
            ]);

            $admin_user->assignRole($request->roles ?? []);

            DB::commit();
            return redirect()->route('admin.admin-user.index')->with('success', 'Admin user created successfully.');

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Request $request, AdminUser $admin_user)
    {
        $roles = Role::get();

        return view('backend.admin.admin_users.edit', compact('admin_user', 'roles'));
    }

    public function update(Request $request, AdminUser $admin_user)
    {
        // return back()->withErrors(['fail' => 'error'])->withInput();
        DB::beginTransaction();
        try {
            $admin_user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            $admin_user->syncRoles($request->roles ?? []);

            DB::commit();
            return redirect()->route('admin.admin-user.index')->with('success', 'Admin user updated successfully.');

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    public function show()
    {
        return 'success';
    }
}
