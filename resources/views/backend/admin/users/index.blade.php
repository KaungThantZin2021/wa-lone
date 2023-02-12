@extends('backend.admin.layouts.app')
@section('title', 'User | ' . config('app.name'))
@section('user-selected', 'selected')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">User</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create User</a>
        </div>
        <div class="card">
            <div class="card-body table-responsive dark:tw-bg-slate-800">
                <div class="table-responsive">
                    <table class="table table-bordered" id="userTable" style="width: 100%; !important">
                        <thead>
                            <tr class="bg-primary">
                                <th></th>
                                <th class="text-light">Profile Photo</th>
                                <th class="text-light">Name</th>
                                <th class="text-light">Phone</th>
                                <th class="text-light">Email</th>
                                <th class="text-light">Gender</th>
                                <th class="text-light">Provider</th>
                                <th class="text-light">IP</th>
                                <th class="text-light">User Agent</th>
                                <th class="text-light">Login At</th>
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
        var table = $('#userTable').DataTable({
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
            ajax: "{{ route('admin.user.index') }}",
            columns: [
                {
                    data: 'plus-icon',
                    name: 'plus-icon',
                    orderable: false,
                    defaultContent: null
                },
                {
                    data: 'profile_photo',
                    name: 'profile_photo',
                    class: 'text-secondary'
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'text-secondary'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    class: 'text-secondary',
                    defaultContent: null
                },
                {
                    data: 'email',
                    name: 'email',
                    class: 'text-secondary'
                },
                {
                    data: 'gender',
                    name: 'gender',
                    class: 'text-secondary'
                },
                {
                    data: 'provider',
                    name: 'provider',
                    class: 'text-secondary'
                },
                {
                    data: 'ip',
                    name: 'ip',
                    class: 'text-secondary'
                },
                {
                    data: 'user_agent',
                    name: 'user_agent',
                    class: 'text-secondary'
                },
                {
                    data: 'login_at',
                    name: 'login_at',
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
                [8, 'desc']
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
    });
</script>

@endsection
