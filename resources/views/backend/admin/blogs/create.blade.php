@extends('backend.admin.layouts.app')
@section('title', 'Create Blog | ' . config('app.name'))
@section('blog-selected', 'selected')
@section('css')
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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create Blog</h3>
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
        <div class="card dark:tw-bg-slate-800">
            <div class="card-body">
                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="createBlogForm">
                    @csrf

                    @include('backend.layouts.flash')

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" id="" class="form-control dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 dark:tw-text-gray-300 @error('title') is-invalid @enderror" placeholder="Title"
                            aria-describedby="helpId" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <input type="hidden" name="thumbnail_type" class="thumbnail-type" value="{{ old('thumbnail_type', App\Models\Blog::THUMBNAIL_FILE) }}">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a href="#file" data-toggle="tab" aria-expanded="false" class="nav-link file-tag {{ old('thumbnail_type', App\Models\Blog::THUMBNAIL_FILE) === App\Models\Blog::THUMBNAIL_FILE ? 'active' : '' }}" data-type="{{ App\Models\Blog::THUMBNAIL_FILE }}">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">File</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#url" data-toggle="tab" aria-expanded="true" class="nav-link url-tag {{ old('thumbnail_type') === App\Models\Blog::THUMBNAIL_URL ? 'active' : '' }}" data-type="{{ App\Models\Blog::THUMBNAIL_URL }}">
                                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">URL</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane {{ old('thumbnail_type', App\Models\Blog::THUMBNAIL_FILE) === App\Models\Blog::THUMBNAIL_FILE ? 'show active' : '' }}" id="file">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                      <input type="file" name="thumbnail_file" class="custom-file-input thumbnail-file" value="{{ old('thumbnail_file') }}" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                      <label class="custom-file-label dark:tw-text-gray-300 dark:tw-bg-slate-700" for="inputGroupFile04">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                      <button class="btn btn-danger cancel-thumbnail-file" type="button" id="inputGroupFileAddon04" style="display: none">Cancel</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body bg-light dark:tw-bg-gray-900">
                                        <img id="thumbnail-file-image-container" class="tw-object-scale-down tw-rounded-lg" src="{{ asset('images/upload.png') }}" style="width: 100%; height: 200px;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ old('thumbnail_type') === App\Models\Blog::THUMBNAIL_URL ? 'show active' : '' }}" id="url">
                                <div class="input-group mb-3">
                                    <input type="text" name="thumbnail_url" class="form-control thumbnail-url dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 dark:tw-text-gray-300" value="{{ old('thumbnail_url') }}" placeholder="URL" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success thumbnail-url-submit" type="button" id="button-addon2">Submit</button>
                                        <button class="btn btn-danger cancel-thumbnail-url" type="button" style="display: none">Cancel</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body bg-light dark:tw-bg-gray-900">
                                        <img id="thumbnail-url-image-container" class="tw-object-scale-down" src="{{ asset('images/upload.png') }}" style="width: 100%; height: 200px;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                    </div>

                    <br>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                    <button class="btn btn-primary">Submit</button>
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
{!! JsValidator::formRequest('App\Http\Requests\CreateBlogRequest', '#createBlogForm') !!}
<script>
    $(document).ready(function() {
        var thumbnail_file_type = $('.file-tag').data('type');
        var thumbnail_url_type = $('.url-tag').data('type');

        var thumbnail_type = $('.thumbnail-type');

        var thumbnail_file = $('.thumbnail-file');
        var cancel_thumbnail_file = $('.cancel-thumbnail-file');
        var thumbnail_file_label = $('.custom-file-label');
        var thumbnail_file_image_container = $("#thumbnail-file-image-container");

        var thumbnail_url = $('.thumbnail-url');
        var cancel_thumbnail_url = $('.cancel-thumbnail-url');
        var thumbnail_url_image_container = $("#thumbnail-url-image-container");

        var default_img = "{{ asset('images/upload.png') }}";

        $(document).on('click', '.file-tag', function () {
            if (!thumbnail_url.val()) {
                thumbnail_type.val(thumbnail_file_type);
            }
        });

        $(document).on('click', '.url-tag', function () {
            if (!thumbnail_file.val()) {
                thumbnail_type.val(thumbnail_url_type);
            }
        });

        $(".thumbnail-file").on("change", function(){
            var $input = $(this);

            if ($input.val()) {
                var reader = new FileReader();
                reader.onload = function () {
                    cancel_thumbnail_file.show()
                    thumbnail_file_image_container.attr("src", reader.result);

                    thumbnail_type.val(thumbnail_file_type);

                    thumbnail_url.val("");
                    thumbnail_url_image_container.attr("src", default_img);
                    cancel_thumbnail_url.hide();
                }
                reader.readAsDataURL($input[0].files[0]);
            };

        });

        $('.cancel-thumbnail-file').on('click', function (e) {
            e.preventDefault();

            $(this).hide();
            thumbnail_file.val("");
            thumbnail_file_label.text('Choose file')
            thumbnail_file_image_container.attr("src", default_img);
        });

        $('.thumbnail-url-submit').on('click', function (e) {
            e.preventDefault();

            if (thumbnail_url.val()) {
                cancel_thumbnail_url.show();
                thumbnail_url_image_container.attr("src", thumbnail_url.val());

                thumbnail_type.val(thumbnail_url_type);

                thumbnail_file.val("");
                thumbnail_file_label.text('Choose file');
                thumbnail_file_image_container.attr("src", default_img);
                cancel_thumbnail_file.hide();

            }
        });

        $('.cancel-thumbnail-url').on('click', function (e) {
            e.preventDefault();

            $(this).hide();
            thumbnail_url.val("");
            thumbnail_url_image_container.attr("src", default_img);
        });


        $('#summernote').summernote({
            height: 500,
            placeholder: "Let's make a blog here ..."
        });
    });
</script>

@endsection
