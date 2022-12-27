@extends('backend.admin.layouts.app')
@section('title', 'Blog | ' . config('app.name'))
@section('blog-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Good Morning Jason!</h3>
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
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Blog</a>


            <div class="d-inline-block">
                <div class="custom-control custom-switch p-2 ml-5">
                    <input type="checkbox" class="custom-control-input p-3 trash-switch" id="trash">
                    <label class="custom-control-label" for="trash">Trash</label>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body dark:tw-bg-slate-800">
                <table class="table table-bordered" id="blogs-table">
                    <thead>
                        <tr class="bg-primary">
                            <th class="text-light">Title</th>
                            <th class="text-light">Thumbnail</th>
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
        var table = $('#blogs-table').DataTable({
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
                url: "{{ route('admin.blog.index') }}",
                data: (d) => {
                    d.trash = $('.trash-switch').attr('checked') ? 1 : 0;
                }
            },
            columns: [
                { data: 'title', name: 'title' },
                { data: 'thumbnail', name: 'thumbnail' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action' }
            ]
        });

        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            DeleteAlert.fire({
                text: "Are you sure to delete?",
            }).then((result) => {
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
