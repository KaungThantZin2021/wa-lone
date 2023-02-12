<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;

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

                    return $edit_btn;
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
            User::create($reuest->all());
            return $this->redirectBackToIndex('User created successfully.');
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
