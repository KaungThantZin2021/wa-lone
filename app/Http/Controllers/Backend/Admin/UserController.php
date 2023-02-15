<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
// use Intervention\Image\Image;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
                ->editColumn('profile_photo', function ($each) {

                    if (is_null($each->profile_photo)) return '-';

                    // $width = Image::make($each->profilePhotoPath())->width();

                    // return $width;

                    // // create an image
                    // $img = Image::make('https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg');

                    // // get file size
                    // return $img->filesize();

                    return '<img class="tw-object-cover tw-w-20" src="' . $each->profilePhotoPath() . '"/><hr><img class="tw-object-cover tw-w-20" src="' . $each->originalProfilePhotoPath() . '"/>';
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
                ->addColumn('action', function ($each) {

                    $edit_btn = '<a href="' . route('admin.user.edit', $each->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>';
                    $change_password_btn = '<a href="' . route('admin.user.change-password', $each->id) . '" class="btn btn-sm btn-success" title="Change Password"><i class="fas fa-key"></i></a>';

                    return $edit_btn . ' ' . $change_password_btn;
                })
                ->rawColumns(['profile_photo', 'created_at', 'updated_at', 'action'])
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
        // dd($request->all());
        DB::beginTransaction();
        try {
            if ($request->password != $request->confirm_password) {
                throw new Exception('Password and Confirm Password must be the same!');
            }

            if ($request->file('profile_photo')) {
                $profile_photo_file_name = 'profile' . '-' . time() . '-' . rand(11111, 99999) . '.' . $request->file('profile_photo')->getClientOriginalName();
                $request->profile_photo->storeAs('user_files', $profile_photo_file_name);

                // $original_image = public_path('storage/user_files/' . $file_name);

                // $img = Image::make($original_image)->width();

                // return $img;


                // $crop_image = public_path('storage/crop/' . $file_name);

                // $img = Image::make($original_image)->crop(100, 100, 1000, 1000);
                // $img = Image::make($original_image)->crop(300, 300, intval($request->x), intval($request->y));
                // $img = Image::make($original_image)->fit(200);
                // $img->save($crop_image);
            }

            if ($request->file('cover_photo')) {
                $cover_photo_file_name = 'cover' . '-' . time() . '-' . rand(11111, 99999) . '.' . $request->file('cover_photo')->getClientOriginalName();
                $request->cover_photo->storeAs('user_files', $cover_photo_file_name);
            }

            $requests = array_replace($request->all(), [
                'password' => Hash::make($request->password),
                'profile_photo' =>  $profile_photo_file_name ?? null,
                'cover_photo' =>  $cover_photo_file_name ?? null,
            ]);

            User::create($requests);

            DB::commit();
            return $this->redirectBackToIndex('User created successfully.');
        } catch (Exception $e) {
            DB::rollback();
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
