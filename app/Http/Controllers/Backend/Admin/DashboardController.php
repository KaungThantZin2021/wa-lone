<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->guard('admin_user'));
        return view('backend.admin.dashboard');
    }
}