<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('backend.admin.users.index', compact('users'));
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