<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\ChangeUserPasswordRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::query())
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->addColumn('action', function ($each) {

                    $edit_btn = '<a href="' . route('admin.user.edit', $each->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>';
                    $change_password_btn = '<a href="' . route('admin.user.change-password', $each->id) . '" class="btn btn-sm btn-success" title="Change Password"><i class="fas fa-key"></i></a>';

                    return $edit_btn . ' ' . $change_password_btn;
                })
                ->editColumn('login_at', function ($each) {
                    return $each->login_at;
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

        return view('backend.admin.users.index');
    }

    public function create()
    {
        return view('backend.admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        try {
            if ($request->password != $request->confirm_password) {
                throw new Exception('Password and Confirm Password must be the same!');
            }

            $requests = array_replace($request->all(), ['password' => Hash::make($request->password)]);

            User::create($requests);

            return $this->redirectBackToIndex('User created successfully.');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            $user->update($request->all());

            return $this->redirectBackToIndex('User updated successfully.');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    public function changePassword(User $user)
    {
        return view('backend.admin.users.change_password', compact('user'));
    }

    public function updatePassword(User $user, ChangeUserPasswordRequest $request)
    {
        try {
            if ($request->password != $request->confirm_password) {
                throw new Exception('Password and Confirm Password must be the same!');
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return $this->redirectBackToIndex('User (' . $user->name . ')\'s password changed successfully.');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    private function redirectBackToIndex(string $message)
    {
        return redirect()->route('admin.user.index')->with('success', $message);
    }
}
