@extends('backend.admin.layouts.app')
@section('title', 'Category | ' . config('app.name'))
@section('category-selected', 'selected')
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
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Category</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a></li>
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

            @can('view_category')
            <a href="#" class="btn btn-primary create-category"><i class="fas fa-plus-circle"></i> Create Category</a>
            @endcan

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
                    <table class="table table-bordered" id="categoriesTable">
                        <thead>
                            <tr class="bg-primary">
                                <th></th>
                                <th class="text-light">Key</th>
                                <th class="text-light">Name</th>
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
        var table = $('#categoriesTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'refresh'
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
                url: "{{ route('admin.category.index') }}",
                data: (d) => {
                    d.trash = $('.trash-switch').attr('checked') ? 1 : 0;
                }
            },
            columns: [
                {
                    data: 'plus-icon',
                    name: 'plus-icon',
                    orderable: false,
                    defaultContent: null
                },
                {
                    data: 'key',
                    name: 'key'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            order: [
                [4, 'desc']
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

        $(document).on('click', '.create-category', function (e) {
            e.preventDefault();

            HtmlAlert.fire({
                html: `<div class="form-group">
                            <label class="col-form-label" for="categoryName">Create Category</label>
                            <input type="text" name="category_name" class="form-control text-center dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-400" placeholder="Category name" id="categoryName">
                        </div>`,
                confirmButtonText: 'Create',
            }).then((result) => {
                if (result.isConfirmed) {

                    let category_name = $('input[name="category_name"]').val();
                    let url = "{{ route('admin.category.store') }}";

                    $.post(url, { category_name })
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

        $(document).on('click', '.edit-category', function (e) {
            e.preventDefault();

            let url = $(this).data('url');
            let category_name = $(this).data('category-name');

            HtmlAlert.fire({
                html: `<div class="form-group">
                            <label class="col-form-label" for="categoryName">Create Category</label>
                            <input type="text" name="category_name" class="form-control text-center dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-400" placeholder="Category name" id="categoryName">
                        </div>`,
                confirmButtonText: 'Update',
                didOpen: () => {
                    $('input[name="category_name"]').val(category_name);
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    let category_name = $('input[name="category_name"]').val();

                    $.post(url, { '_method': 'patch', category_name })
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

        $(document).on('click', '.trash', function (e) {
            e.preventDefault();
            TrashAlert.fire().then((result) => {
                if (result.isConfirmed) {
                    $.post($(this).data('trash-url'), {
                        '_method': 'delete',
                    })
                    .done(function (res) {
                        if (res.result == 1) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
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
