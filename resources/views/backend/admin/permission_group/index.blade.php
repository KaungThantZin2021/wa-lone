@extends('backend.admin.layouts.app')
@section('title', 'Permission Group | ' . config('app.name'))
@section('permission-selected', 'selected')
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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Permission Group</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.permission-group.index') }}">Permission Group</a></li>
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
            <a href="{{ route('admin.permission-group.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Permission Group</a>
        </div>
        <div class="card">
            <div class="card-body dark:tw-bg-slate-800">
                <div class="table-responsive">
                    <table class="table table-bordered" id="permissionGroupTable" style="width: 100%; !important">
                        <thead>
                            <tr class="bg-primary">
                                <th></th>
                                <th class="text-light">Name</th>
                                <th class="text-light">Permissions</th>
                                <th class="text-light">Guard Name</th>
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
    $(() => {
        var table = $('#permissionGroupTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'refresh'
                },
                {
                    extend: 'pageLength',
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                ['10 rows', '25 rows', '50 rows', '100 rows']
            ],
            ajax: "{{ route('admin.permission-group.index') }}",
            columns: [
                {
                    data: 'plus-icon',
                    name: 'plus-icon',
                    orderable: false,
                    defaultContent: null
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'text-secondary'
                },
                {
                    data: 'permissions',
                    name: 'permissions',
                    class: 'text-secondary'
                },
                {
                    data: 'guard_name',
                    name: 'guard_name',
                    class: 'text-secondary'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    class: 'text-secondary'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    class: 'text-secondary'
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-secondary'
                }
            ],
            order: [
                [3, 'desc']
            ],
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            columnDefs: [{
                    targets: "no-sort",
                    orderable: false
                },
                {
                    className: "control",
                    orderable: false,
                    targets: 0
                },
                {
                    targets: "hidden",
                    visible: false
                }
            ]
        });

        $(document).on('click', '.add-permission', function (e) {
            e.preventDefault();

            let permission_group_id = $(this).data('permission-group-id');

            HtmlAlert.fire({
                html: `<div class="form-group">
                            <label class="col-form-label" for="permissionName">Create Permission</label>
                            <input type="text" name="permission_name" class="form-control text-center dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-400" placeholder="Permission name" id="permissionName">
                        </div>`,
                confirmButtonText: 'Create',
            }).then((result) => {
                if (result.isConfirmed) {

                    let permission_name = $('input[name="permission_name"]').val();

                    $.post('/admin/create-permission', { permission_group_id ,permission_name })
                    .done((res) => {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                        } else if (res.result == 0) {
                            ErrorAlert.fire({
                                'text': res.message
                            });
                        }
                    })
                    .fail((error) => {
                        ErrorAlert.fire({
                            'title': error.status,
                            'text': error.statusText
                        });
                    })
                }
            })
        });

        $(document).on('click', '.edit-permission', function (e) {
            e.preventDefault();

            let permission_group_id = $(this).data('permission-group-id');
            let permission_id = $(this).data('permission-id');
            let permission_name = $(this).data('permission-name');

            HtmlAlert.fire({
                html: `<div class="form-group">
                            <label class="col-form-label" for="permissionName">Edit Permission</label>
                            <input type="text" name="permission_name" class="form-control text-center dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-400" placeholder="Permission name" id="permissionName">
                        </div>`,
                confirmButtonText: 'Update',
                didOpen: () => {
                    $('input[name="permission_name"]').val(permission_name).focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    let permission_name = $('input[name="permission_name"]').val();

                    $.post('/admin/edit-permission', { permission_group_id, permission_id, permission_name })
                    .done((res) => {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                        } else if (res.result == 0) {
                            ErrorAlert.fire({
                                'text': res.message
                            });
                        }
                    })
                    .fail((error) => {
                        ErrorAlert.fire({
                            'title': error.status,
                            'text': error.statusText
                        });
                    })
                }
            })
        });

        $(document).on('click', '.delete-permission', function (e) {
            e.preventDefault();

            let permission_group_id = $(this).data('permission-group-id');
            let permission_id = $(this).data('permission-id');
            let permission_name = $(this).data('permission-name');

            DeleteAlert.fire({
                html: `Are you sure to delete "<b>${permission_name}</b>" permission permanently?`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('/admin/delete-permission', { '_method': 'delete', permission_group_id, permission_id })
                    .done((res) => {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                        } else if (res.result == 0) {
                            ErrorAlert.fire({
                                'text': res.message
                            });
                        }
                    })
                    .fail((error) => {
                        ErrorAlert.fire({
                            'title': error.status,
                            'text': error.statusText
                        });
                    })
                }
            })
        });

        $(document).on('click', '.delete-permission-group', function (e) {
            e.preventDefault();

            DeleteAlert.fire().then((result) => {
                if (result.isConfirmed) {
                    $.post($(this).data('delete-url'), { '_method': 'delete' })
                    .done((res) => {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
                        } else if (res.result == 0) {
                            ErrorAlert.fire({
                                'text': res.message
                            });
                        }
                    })
                    .fail((error) => {
                        ErrorAlert.fire({
                            'title': error.status,
                            'text': error.statusText
                        });
                    })
                }
            })
        });
    });
</script>

@endsection
