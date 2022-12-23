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
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="createUserForm">
                    @csrf

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" id="" class="form-control dark:tw-bg-slate-700 dark:focus:tw-border-gray-500 @error('title') is-invalid @enderror" placeholder="Title"
                            aria-describedby="helpId" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <input type="text" name="thumbnail_type" class="thumbnail-type">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a href="#file" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">File</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#url" data-toggle="tab" aria-expanded="true"
                                    class="nav-link">
                                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">URL</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="file">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail_file" class="custom-file-input thumbnail-file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <img id="thumbnail-file-image-container" class="tw-object-cover" src="{{ asset('images/upload.png') }}" style="width: 200px; height: 200px;"/>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-danger cancel-thumbnail-file" >Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="url">
                                <div class="input-group mb-3">
                                    <input type="text" name="thumbnail_url" class="form-control thumbnail-url" placeholder="URL" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success thumbnail-url-submit" type="button" id="button-addon2">Submit</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <img id="thumbnail-url-image-container" class="tw-object-cover" src="{{ asset('images/upload.png') }}" style="width: 200px; height: 200px;"/>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-danger cancel-thumbnail-url" >Cancel</button>
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
<script>
    $(document).ready(function() {
        var default_img = "{{ asset('images/upload.png') }}";

        $(".thumbnail-file").on("change", function(){
            var $input = $(this);
            var reader = new FileReader();
            reader.onload = function(){
                $("#thumbnail-file-image-container").attr("src", reader.result);
                console.log(reader.result);

                $("#thumbnail-url-image-container").attr("src", default_img);
            }
            reader.readAsDataURL($input[0].files[0]);
        });

        $('.cancel-thumbnail-file').on('click', function (e) {
            e.preventDefault();

            $("#thumbnail-file-image-container").attr("src", default_img);
            $('.thumbnail-file').val("");
        });

        $('.thumbnail-url-submit').on('click', function (e) {
            e.preventDefault();

            var thumbnail_url = $('.thumbnail-url').val();
            $("#thumbnail-url-image-container").attr("src", thumbnail_url);
            if (thumbnail_url) {
                $('.thumbnail-type').val(1);
            }

            $("#thumbnail-file-image-container").attr("src", default_img);
            $('.thumbnail-file').val("");
        });

        $('.cancel-thumbnail-url').on('click', function (e) {
            e.preventDefault();

            $("#thumbnail-url-image-container").attr("src", default_img);
            $('.thumbnail-url').val("");

            $('.thumbnail-type').val("");
        });


        $('#summernote').summernote({
            height: 500,
            placeholder: "Let's make a blog here ..."
        });
    });
</script>

@endsection
