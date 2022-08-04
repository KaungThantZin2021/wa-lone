<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::query())->make();
        }
        return view('backend.admin.users.index');
    }

    public function create()
    {
        return view('backend.admin.users.create');
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return $this->redirectBack();
    }

    private function redirectBack()
    {
        return redirect()->route('admin.user.index');
    }
}