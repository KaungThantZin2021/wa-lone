<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::query())->make();
        }
        return view('backend.admin.admin_users.index');
    }
}