@extends('backend.admin.layouts.app')
@section('title', 'Blog Detail| ' . config('app.name'))
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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Blog Detail</h3>
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
                <div class="">
                    <div class="tw-relative">
                        <img class="tw-w-full tw-h-96 tw-object-cover tw-rounded" src="{{ $blog->thumbnail }}" alt="">
                        <span class="tw-absolute tw-top-2 tw-right-2 text-light tw-text-sm bg-primary bg-opacity-50 tw-rounded px-1">{{ $blog->created_at->diffForHumans() }}</span>
                        <h2 class="card-title tw-absolute tw-bottom-0 tw-left-0 m-2 tw-break-all text-light bg-primary bg-opacity-50 tw-leading-normal tw-rounded p-2">{{ $blog->title }}</h2>
                    </div>
                    <div class="my-4">
                        {!! $blog->description !!}
                    </div>
                </div>
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
