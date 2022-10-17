@extends('backend.admin.layouts.app')
@section('title', 'Admin Users')
@section('admin-user-active', 'nav-active')

@section('content')
<div>
    <div class="page-header">
        <div>
            @include('backend.components.buttons.back_button')
            <a href="{{ route('admin.admin-user.create') }}" class="btn btn-outline-success"><i class="fas fa-user-plus"></i> Create User</a>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">user</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        {{-- <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Admin Users</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="admin-users-table" style="width:100%;">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-light"></th>
                                    <th class="text-light">Name</th>
                                    <th class="text-light">Phone</th>
                                    <th class="text-light">Email</th>
                                    <th class="text-light">NRC Number</th>
                                    <th class="text-light">Gender</th>
                                    <th class="text-light">Profile Photo</th>
                                    <th class="text-light">IP</th>
                                    <th class="text-light">Device</th>
                                    <th class="text-light">Browser</th>
                                    <th class="text-light">Platform</th>
                                    <th class="text-light">Login At</th>
                                    <th class="text-light">Created At</th>
                                    <th class="text-light">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-body">
                <h4>Admin Users</h4>
                <table class="table table-bordered table-responsive" id="admin-users-table" style="width:100%; !important">
                    <thead>
                        <tr class="bg-primary">
                            <th class="text-light"></th>
                            <th class="text-light">Name</th>
                            <th class="text-light">Phone</th>
                            <th class="text-light">Email</th>
                            <th class="text-light">NRC Number</th>
                            <th class="text-light">Gender</th>
                            <th class="text-light">Profile Photo</th>
                            <th class="text-light">IP</th>
                            <th class="text-light">Device</th>
                            <th class="text-light">Browser</th>
                            <th class="text-light">Platform</th>
                            <th class="text-light">Login At</th>
                            <th class="text-light">Created At</th>
                            <th class="text-light">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(() => {
        var table = $('#admin-users-table').DataTable({
            processing: true,
            serverSide: true,
            mark: true,
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
                    className: 'btn btn-outline-success bg-dark border border-success',
                    filename: 'Users Report',
                },
                {
                    extend: 'pageLength',               
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                ['10 rows', '25 rows', '50 rows', '100 rows']
            ],
            ajax: "{{ route('admin.admin-user.index') }}",
            columns: [
                { 
                    data: 'plus-icon', 
                    name: 'plus-icon',
                    defaultContent: null
                },
                { 
                    data: 'name', 
                    name: 'name',
                    class: 'text-secondary'
                },
                { 
                    data: 'email',
                    name: 'email',
                    class: 'text-secondary'
                },
                { 
                    data: 'phone',
                    name: 'phone',
                    class: 'text-secondary'
                },
                { 
                    data: 'nrc_no',
                    name: 'nrc_no',
                    class: 'text-secondary'
                },
                { 
                    data: 'gender',
                    name: 'gender',
                    class: 'text-secondary'
                },
                { 
                    data: 'profile_photo',
                    name: 'profile_photo',
                    class: 'text-secondary'
                },
                { 
                    data: 'ip',
                    name: 'ip',
                    class: 'text-secondary'
                },
                { 
                    data: 'device',
                    name: 'device',
                    class: 'text-secondary'
                },
                { 
                    data: 'browser',
                    name: 'browser',
                    class: 'text-secondary'
                },
                { 
                    data: 'platform',
                    name: 'platform',
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
                }
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
