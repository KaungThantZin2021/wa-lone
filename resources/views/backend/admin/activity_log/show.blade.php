@extends('backend.admin.layouts.app')
@section('title', 'Activity Log Detail | ' . config('app.name'))
@section('activity-log-selected', 'selected')
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
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate font-weight-medium mb-1 tw-text-black dark:tw-text-gray-300">Blog Detail</h3>
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
            @include('backend.components.buttons.back_button')
        </div>
        <div class="card">
            <div class="card-body dark:tw-bg-slate-800">
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Source</label>
                    <p>{{ $activity_log->getExtraProperty('source') }}</p>
                </div>
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Description</label>
                    <p>{{ $activity_log->description }}</p>
                </div>
                <div class="mb-3">
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Causer</label>
                    <div class="border border-1 py-2 px-3 tw-rounded-lg">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="tw-font-medium m-0">Name</label>
                                <p>{{ optional($activity_log->causer)->name }}</p>
                                <label class="tw-font-medium m-0">Email</label>
                                <p>{{ optional($activity_log->causer)->email }}</p>
                                <label class="tw-font-medium m-0">Phone</label>
                                <p>{{ optional($activity_log->causer)->phone }}</p>
                                <label class="tw-font-medium m-0">Email</label>
                                <p>{{ optional($activity_log->causer)->email }}</p>
                                <label class="tw-font-medium m-0">Gender</label>
                                <p>{{ optional($activity_log->causer)->gender }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="tw-font-medium m-0">IP</label>
                                <p>{{ optional($activity_log->causer)->ip }}</p>
                                <label class="tw-font-medium m-0">Device</label>
                                <p>{{ optional($activity_log->causer)->device }}</p>
                                <label class="tw-font-medium m-0">Platform</label>
                                <p>{{ optional($activity_log->causer)->platform }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Subject</label>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="p-1">ID</th>
                                <th class="p-1">Model</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-1">{{ optional($activity_log->subject)->id }}</td>
                                <td class="p-1">{{ class_basename($activity_log->subject) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <label class="tw-text-slate-800 dark:tw-text-gray-200">Date</label>
                    <p>{{ $activity_log->created_at }}</p>
                </div>
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
