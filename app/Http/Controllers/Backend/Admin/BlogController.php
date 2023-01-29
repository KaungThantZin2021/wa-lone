<?php
namespace App\Http\Controllers\Backend\Admin;

use Exception;
// use Yajra\Datatables\Datatables;
use Throwable;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Notifications\BlogNotification;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\ReceiverNotificationToken;
use Illuminate\Support\Facades\Notification;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::orderBy('created_at', 'DESC');

            if ($request->trash) {
                $blogs = $blogs->onlyTrashed();
            }

            return DataTables::of($blogs)
                ->editColumn('title', function ($blog) {
                    return Str::limit($blog->title, 50);
                })
                ->editColumn('thumbnail', function ($blog) {
                    return '<img class="tw-object-cover tw-w-20" src="'. $blog->thumbnailPath() .'">';
                })
                ->addColumn('action', function ($blog) use ($request) {

                    if ($request->trash) {
                        return '<div class="d-flex justify-content-center">
                            <a href="' . route('admin.blog.show', $blog->id) . '" class="btn btn-sm btn-info rounded m-1" title="Detail"><i class="fas fa-info-circle"></i></a>
                            <a href="" class="btn btn-sm btn-secondary rounded m-1 restore" data-restore-url="' . route('admin.blog.restore', $blog->id) . '" title="Restore"><i class="fas fa-undo"></i></a>
                            <a href="" class="btn btn-sm btn-danger rounded m-1 delete" data-delete-url="' . route('admin.blog.force-delete', $blog->id) . '" title="Delete Permanently"><i class="fas fa-trash"></i></a>
                        </div>';
                    }

                    return '<div class="d-flex justify-content-center">
                        <a href="' . route('admin.blog.show', $blog->id) . '" class="btn btn-sm btn-info rounded m-1" title="Detail"><i class="fas fa-info-circle"></i></a>
                        <a href="' . route('admin.blog.edit', $blog->id) . '" class="btn btn-sm btn-warning rounded m-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn btn-sm btn-danger rounded m-1 trash" data-trash-url="' . route('admin.blog.destroy', $blog->id) . '" title="Trash"><i class="fas fa-trash"></i></a>
                    </div>';
                })
                ->editColumn('created_at', function ($blog) {
                    return $blog->created_at->format('Y-m-d H:i:s') . '<br> (' . $blog->created_at->diffForHumans() . ')';
                })
                ->editColumn('updated_at', function ($blog) {
                    return $blog->updated_at->format('Y-m-d H:i:s') . '<br> (' . $blog->updated_at->diffForHumans() . ')';
                })
                ->rawColumns(['thumbnail', 'created_at', 'updated_at', 'action'])
                ->make(true);
        }

        return view('backend.admin.blogs.index');
    }

    public function create()
    {
        return view('backend.admin.blogs.create');
    }

    public function store(CreateBlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $thumbnail = null;

            if ($request->thumbnail_type === Blog::THUMBNAIL_FILE) {
                if ($request->file('thumbnail_file')) {
                    $file_name = Blog::THUMBNAIL_FILE . '_' . time() . '-' . rand(11111, 99999) . '.' . $request->file('thumbnail_file')->getClientOriginalName();
                    $request->thumbnail_file->storeAs('thumbnails', $file_name);

                    $thumbnail = $file_name;
                }
            }

            if ($request->thumbnail_type === Blog::THUMBNAIL_URL) {
                if ($request->thumbnail_url) {
                    $file_name = Blog::THUMBNAIL_URL . '_' . time() . '-' . rand(11111, 99999) . '.' . pathinfo($request->thumbnail_url, PATHINFO_BASENAME);
                    $file = file_get_contents($request->thumbnail_url);
                    file_put_contents(storage_path('app/public/thumbnails/'. $file_name), $file);

                    $thumbnail = $file_name;
                }
            }

            $blog = Blog::create([
                'title' => $request->title,
                'thumbnail_type' => $request->thumbnail_type,
                'thumbnail' => $thumbnail,
                'description' => $request->description,
            ]);

            $users = User::get();

            $noti_data = [
                'title' => 'There is a new blog!',
                'description' => $blog->title,
                'typeable' => get_class($blog),
                'typeable_id' => $blog->id,
                'link' => '',
            ];

            Notification::send($users, new BlogNotification($noti_data));

            $fields['include_player_ids'] = ['152b9b51-1e9a-48b8-9a55-cff3f11d2500'];
            $message = 'hey!! this is test push.!';
            OneSignal::sendPush($fields, $message);

            DB::commit();
            return $this->redirectToIndex('success', 'Created in successfully');

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th);
            return $this->redirectBackWithErrors($th->getMessage());
        }
    }

    public function edit(Blog $blog)
    {
        return view('backend.admin.blogs.edit', compact('blog'));
    }

    // public function update(UpdateBlogRequest $request, Blog $blog)
    public function update(Request $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $thumbnail = null;

            if ($request->thumbnail_type === Blog::THUMBNAIL_FILE) {
                if ($request->file('thumbnail_file')) {
                    if ($blog->thumbnail) {
                        $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
                        if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
                        File::delete($thumbnail_file_path);
                    }

                    $file_name = Blog::THUMBNAIL_FILE . '_' . time() . '-' . rand(11111, 99999) . '.' . $request->file('thumbnail_file')->getClientOriginalName();
                    $request->thumbnail_file->storeAs('thumbnails', $file_name);

                    $thumbnail = $file_name;
                }
            }

            if ($request->thumbnail_type === Blog::THUMBNAIL_URL) {
                if ($request->thumbnail_url) {
                    if ($blog->thumbnail) {
                        $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
                        if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
                        File::delete($thumbnail_file_path);
                    }

                    $file_name = Blog::THUMBNAIL_URL . '_' . time() . '-' . rand(11111, 99999) . '.' . pathinfo($request->thumbnail_url, PATHINFO_BASENAME);
                    $file = file_get_contents($request->thumbnail_url);
                    file_put_contents(storage_path('app/public/thumbnails/'. $file_name), $file);

                    $thumbnail = $file_name;
                }
            }

            if (!is_null($thumbnail)) {
                $blog->update([
                    'thumbnail_type' => $request->thumbnail_type,
                    'thumbnail' => $thumbnail,
                ]);
            }

            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $users = User::get();

            $noti_data = [
                'title' => 'Blog is edited!',
                'description' => $blog->title,
                'typeable' => get_class($blog),
                'typeable_id' => $blog->id,
                'link' => '',
            ];

            Notification::send($users, new BlogNotification($noti_data));

            // $receiver_notification_tokens = ReceiverNotificationToken::pluck('token');
            // $token_array = $receiver_notification_tokens->toArray();

            // $fields['include_player_ids'] = $token_array;
            // $message = 'Blog is edited!';
            // OneSignal::sendPush($fields, $message);

            //-----

            // $fields['include_player_ids'] = ['7421c9cc-b020-4652-a0bf-01173bc761a7'];
            // $message = 'Blog is edited!';
            // OneSignal::sendPush($fields, $message);

            DB::commit();
            return $this->redirectToIndex('success', 'Updated in successfully');

        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th);
            return $this->redirectBackWithErrors($th->getMessage());
        }
    }

    public function show(Blog $blog)
    {
        return view('backend.admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();

            return successJson('Deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }

    }

    public function restore($id)
    {
        try {
            Blog::onlyTrashed()->find($id)->restore();

            return successJson('Restored in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            $blog = Blog::onlyTrashed()->find($id);

            $thumbnail_file_path = storage_path('app/public/thumbnails/' . $blog->thumbnail);
            if (!File::exists($thumbnail_file_path)) throw new Exception('Thumbnail image file not found to delete!');
            File::delete($thumbnail_file_path);

            $blog->forceDelete();

            return successJson('Permanently Deleted in successfully');
        } catch (Throwable $th) {
            Log::error($th);
            return failJson($th->getMessage());
        }
    }

    private function redirectToIndex(string $session_key, string $message)
    {
        return redirect()->route('admin.blog.index')->with($session_key, $message);
    }

    private function redirectBackWithErrors(string $error_message)
    {
        return redirect()->back()->withErrors(['fail' => $error_message])->withInput();
    }
}
