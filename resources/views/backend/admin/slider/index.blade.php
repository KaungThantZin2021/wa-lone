@extends('backend.admin.layouts.app')
@section('title', 'Slider | ' . config('app.name'))
@section('slider-selected', 'selected')
@section('css')

<style>
    div.dataTables_wrapper > div.dataTables_filter {
        text-align: right;
        float: right !important;
    }

    /* div.dataTables_wrapper div.dataTables_filter input {
        background: #334154;
    } */
</style>

@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Slider</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Slider</a></li>
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

            {{-- @can('create_slider') --}}
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Slider</a>
            {{-- @endcan --}}

            <div class="d-inline-block">
                <div class="custom-control custom-switch p-2 ml-5">
                    <input type="checkbox" class="custom-control-input p-3 trash-switch" id="trash">
                    <label class="custom-control-label" for="trash">Trash</label>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body dark:tw-bg-slate-800">
                <div class="table-responsive">
                    <table class="table table-bordered" id="sliderTable">
                        <thead>
                            <tr class="bg-primary">
                                <th class="text-light">Title</th>
                                <th class="text-light">Description</th>
                                <th class="text-light">Type</th>
                                <th class="text-light">Image</th>
                                <th class="text-light">Created At</th>
                                <th class="text-light">Updated At</th>
                                <th class="text-light">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ======================================================== ====== -->
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
    $(document).ready(function () {
        var table = $('#sliderTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'refresh'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-secondary',
                    filename: 'Users Report',
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success',
                    filename: 'Users Report',
                },
                {
                    extend: 'pageLength',
                },
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                ['10 rows', '25 rows', '50 rows', '100 rows']
            ],
            ajax: {
                url: "{{ route('admin.slider.index') }}",
                data: (d) => {
                    d.trash = $('.trash-switch').attr('checked') ? 1 : 0;
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'type', name: 'type' },
                { data: 'image', name: 'image' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action' }
            ]
        });

        $(document).on('click', '.trash', function (e) {
            e.preventDefault();
            TrashAlert.fire().then((result) => {
                if (result.isConfirmed) {
                    $.post($(this).data('trash-url'), {
                        '_method': 'delete',
                    }).done(function (res) {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    })
                }
            })
        });

        $(document).on('click', '.restore', function (e) {
            e.preventDefault();
            RestoreAlert.fire().then((result) => {
                if (result.isConfirmed) {
                    $.post($(this).data('restore-url'))
                    .done(function (res) {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    })
                }
            })
        });

        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            DeleteAlert.fire().then((result) => {
                if (result.isConfirmed) {
                    $.post($(this).data('delete-url'), {
                        '_method': 'delete',
                    }).done(function (res) {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    })
                }
            })
        });

        $(document).on('change', '.trash-switch', () => {
            const trashSwitch = $('.trash-switch');
            if (trashSwitch.attr('checked')) {
                trashSwitch.attr('checked', false);
            } else {
                trashSwitch.attr('checked', true);
            }
            table.draw();
        });
    });
</script>

@endsection
