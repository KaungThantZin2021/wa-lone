@extends('backend.admin.layouts.app')
@section('title', 'Edit Blog | ' . config('app.name'))
@section('blog-selected', 'selected')
@section('css')
<link href="https://www.jquery-az.com/boots/css/bootstrap-imageupload/bootstrap-imageupload.css" rel="stylesheet">
<style>
    .note-editor {
        background: white
    }

    .note-editor > .panel-heading.note-toolbar{
        background: whitesmoke
    }
</style>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Edit Blog</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Blog</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="mb-3">
            @include('backend.components.buttons.back_button')
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="createUserForm">
                    @csrf

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" id="" class="form-control dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('title') is-invalid @enderror" placeholder="Title"
                            aria-describedby="helpId" value="{{ old('title', $blog->title) }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <!-- bootstrap-imageupload. -->
                        <div class="imageupload panel panel-default border p-3">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title pull-left">Select Image file</h3>
                                <div class="btn-group pull-right mb-2">
                                    <button type="button" class="btn btn-light active">File</button>
                                    <button type="button" class="btn btn-light">URL</button>
                                </div>
                            </div>
                            <div class="file-tab panel-body">
                                <label class="btn btn-primary btn-file">
                                    <i class="fas fa-upload"></i>
                                    <span> Browse</span>
                                    <!-- The file is stored here. -->
                                    <input type="file" name="thumbnail">
                                </label>
                                <button type="button" class="btn btn-danger mb-2">Delete image</button>
                            </div>
                            <div class="url-tab panel-body">
                                <div class="input-group">
                                    <input type="text" class="form-control hasclear" placeholder="Image URL">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger">Remove</button>
                                <!-- The URL is stored here. -->
                                <input type="hidden" name="thumbnail">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea id="summernote" name="description">{{ old('description', $blog->description) }}</textarea>
                    </div>

                    <br>
                    <button class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
@endsection

@section('script')
<script src="https://www.jquery-az.com/boots/js/bootstrap-imageupload/bootstrap-imageupload.js"></script>

<script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload({
        maxWidth: 500,
        maxHeight: 500,
        maxFileSizeKb: 3048
    });

    $(document).ready(function() {
        $('#summernote').summernote({
            height: 500,
            placeholder: "Let's make a blog here ..."
        });
    });
</script>

@endsection
