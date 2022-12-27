<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
// use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
                ->rawColumns(['thumbnail', 'action'])
                ->make(true);
        }

        return view('backend.admin.blogs.index');
    }

    public function create()
    {
        return view('backend.admin.blogs.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $thumbnail = null;

        if ($request->thumbnail_file) {
            $file_name = time() . '_' .$request->file('thumbnail_file')->getClientOriginalName();

            $request->thumbnail_file->move(public_path('thumbnails'), $file_name);

            $thumbnail = $file_name;
        }

        if ($request->thumbnail_url) {

            // dd(file_get_contents($request->thumbnail_url));
            $file_name = time().'-'.rand(11111, 99999).'.'.pathinfo($request->thumnnail_url, PATHINFO_EXTENSION);
            $file = file_get_contents($request->thumbnail_url);
            // dd($file);
            // Storage::put(public_path('thumbnails').'/'.$file_name, file_get_contents($request->thumbnail_url));
            file_put_contents(public_path('thumbnails/'.$file_name), $file);

            $thumbnail = $file_name;
        }

        Blog::create([
            'title' => $request->title,
            'thumbnail' => $thumbnail,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index');
    }

    public function edit(Blog $blog)
    {
        return view('backend.admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $file_name =  $request->thumbnail ? time() . '_' .$request->file('thumbnail')->getClientOriginalName() : $blog->thumbnailPath();

        $request->thumbnail->move(public_path('thumbnails'), $file_name);

        $blog::update([
            'title' => $request->title,
            'thumbnail' => $file_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index');
    }

    public function show(Blog $blog)
    {
        return view('backend.admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'result' => 1,
            'message' => 'Deleted in successfully'
        ]);
    }

    public function restore($id)
    {
        Blog::onlyTrashed()->find($id)->restore();

        return response()->json([
            'result' => 1,
            'message' => 'Restored in successfully'
        ]);
    }

    public function forceDelete($id)
    {
        Blog::onlyTrashed()->find($id)->forceDelete();

        return response()->json([
            'result' => 1,
            'message' => 'Permanently Deleted in successfully'
        ]);
    }
}
