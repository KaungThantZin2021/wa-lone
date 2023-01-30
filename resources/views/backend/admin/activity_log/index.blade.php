@extends('backend.admin.layouts.app')
@section('title', 'Activity Log | ' . config('app.name'))
@section('activity-log-selected', 'selected')
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
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Activity Log</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Admin</a>
                            </li>
                            <li class="breadcrumb-item"><a href="index.html">Activity Log</a>
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
            @include('backend.components.buttons.back_button')
        </div>
        <div class="card">
            <div class="card-body dark:tw-bg-slate-800">
                <div class="table-responsive">
                    <table class="table table-bordered" id="activity-logs-table" style="width: 100%; !important">
                        <thead>
                            <tr class="bg-primary">
                                <th></th>
                                <th class="text-light">Source</th>
                                <th class="text-light">Description</th>
                                <th class="text-light">Causer</th>
                                <th class="text-light">Subject</th>
                                <th class="text-light">Date</th>
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
        var table = $('#activity-logs-table').DataTable({
            processing: true,
            serverSide: true,
            mark: true,
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
            ajax: "{{ route('admin.activity-log.index') }}",
            columns: [
                {
                    data: 'plus-icon',
                    name: 'plus-icon',
                    orderable: false,
                    defaultContent: null
                },
                {
                    data: 'source',
                    name: 'source',
                    class: 'text-secondary'
                },
                {
                    data: 'description',
                    name: 'description',
                    class: 'text-secondary'
                },
                {
                    data: 'causer',
                    name: 'causer',
                    class: 'text-secondary'
                },
                {
                    data: 'subject',
                    name: 'subject',
                    class: 'text-secondary'
                },
                {
                    data: 'date',
                    name: 'date',
                    class: 'text-secondary'
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-secondary'
                }
            ],
            order: [
                [5, 'desc']
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
