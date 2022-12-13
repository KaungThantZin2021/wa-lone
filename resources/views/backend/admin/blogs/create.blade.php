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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create User</h3>
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
                <form action="{{ route('admin.blog.store') }}" method="POST" id="createUserForm">
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
        $('#summernote').summernote({
            height: 500
        });
    });
</script>

@endsection
