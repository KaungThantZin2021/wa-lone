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
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Admin Users</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-light">ID</th>
                                    <th class="text-light">Name</th>
                                    <th class="text-light">Email</th>
                                    <th class="text-light">Created At</th>
                                    <th class="text-light">Updated At</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

{{-- <script>
    $(() => {
        var table = $('#users-table').DataTable({
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
            ajax: "{{ route('admin.user.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script> --}}

@endsection