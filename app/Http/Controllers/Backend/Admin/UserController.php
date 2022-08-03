<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.admin.users.index');
    }
}