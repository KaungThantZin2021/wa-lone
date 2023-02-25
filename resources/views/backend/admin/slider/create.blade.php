@extends('backend.admin.layouts.app')
@section('title', 'Create Slider | ' . config('app.name'))
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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create Slider</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Slider</a></li>
                            <li class="breadcrumb-item">Create</li>
                        </ol>
                    </nav>
                </div>
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
                {!! Form::open(['route' => 'admin.slider.store', 'files' => true, 'id' => 'sliderForm']) !!}

                @include('backend.admin.slider.partials._form', ['form_type' => 'create'])

                {!! Form::close() !!}
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
{!! JsValidator::formRequest('App\Http\Requests\CreateSliderRequest', '#sliderForm') !!}
@endsection
