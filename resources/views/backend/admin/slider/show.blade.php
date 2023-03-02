@extends('backend.admin.layouts.app')
@section('title', 'Slider Detail| ' . config('app.name'))
@section('slider-selected', 'selected')
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
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Slider Detail</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Slider</a></li>
                            <li class="breadcrumb-item">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="mb-3">
            @include('backend.components.buttons.back_button')
        </div>
        <div class="card dark:tw-shadow-none">
            <div class="card-body dark:tw-bg-slate-800">
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Title</label>
                    <p>{{ $slider->title }}</p>
                </div>
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Description</label>
                    <p>{{ $slider->description }}</p>
                </div>
                <div class="mb-3">
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Causer</label>
                    <div class="py-2">
                        <img class="tw-w-full tw-rounded" src="{{ $slider->sliderPath() }}" id="sliderImage">
                    </div>
                </div>
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Created At</label>
                    <p>{{ $slider->created_at }}</p>
                </div>
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Updated At</label>
                    <p>{{ $slider->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
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
    new Viewer(document.getElementById('sliderImage'), {
        title: false,
        navbar: false,
        toolbar: false
    });
</script>
@endsection
