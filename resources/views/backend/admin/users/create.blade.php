@extends('backend.admin.layouts.app')
@section('title', 'Create User | ' . config('app.name'))
@section('user-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Create User</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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
                {!! Form::open(['route' => 'admin.user.store', 'files' => true, 'id' => 'createUserForm']) !!}

                @include('backend.admin.users.partials._form', ['form_type' => 'create'])

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
{!! JsValidator::formRequest('App\Http\Requests\Admin\CreateUserRequest', '#createUserForm') !!}

<script>
    $(() => {
        $('input[name="dob"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            locale: {
                format: 'YYYY-MM-DD'
            },
            drops: 'up'
        });

        $('#profilePhotoInput').change(function () {
            var $input = $(this);

            if ($input.val()) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#profilePhoto').attr("src", reader.result);

                }
                reader.readAsDataURL($input[0].files[0]);
            };
        });

        $('#coverPhotoInput').change(function () {
            var $input = $(this);

            if ($input.val()) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#coverPhoto').attr("src", reader.result);

                }
                reader.readAsDataURL($input[0].files[0]);
            };
        });

        // var myImage = $('#myImage').cropme({
        //     container: {
        //         width: 500,
        //         height: 500
        //     },
        //     viewport: {
        //         width: 300,
        //         height: 300,
        //         type: 'circle',
        //         border: {
        //             enable: true,
        //             width: 2,
        //             color: '#fff'
        //         }
        //     },
        //     zoom: {
        //         min: 0.01,
        //         max: 3,
        //         enable: true,
        //         mouseWheel: true,
        //         slider: true
        //     },
        //     rotation: {
        //         enable: true,
        //         slider: true,
        //         position: 'right'
        //     },
        //     transformOrigin: 'image'
        // });

        // $('.crop').click(function (e) {
        //     e.preventDefault();

        //     var position = myImage.cropme('position');

        //     console.log(position);

        //     $('#xCoordinate').val(position.x);
        //     $('#yCoordinate').val(position.y);

        //     // myImage.cropme('crop')
        //     // .then(function (output) {
        //     //     console.log(output);
        //     // });
        // });
    });
</script>
@endsection
