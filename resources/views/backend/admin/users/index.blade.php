@extends('backend.admin.layouts.app')
@section('title', 'Users')
@section('user-active', 'active')

@section('content')
    <div>
        <div class="page-header">
            <h3 class="page-title"> Basic Tables </h3>
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
                        <h4 class="card-title">Basic Table</h4>
                        <p class="card-description"> Add class <code>.table</code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-light">Profile</th>
                                        <th class="text-light">VatNo.</th>
                                        <th class="text-light">Created</th>
                                        <th class="text-light">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-light">Jacob</td>
                                        <td class="text-light">53275531</td>
                                        <td class="text-light">12 May 2017</td>
                                        <td class="text-light"><label class="badge badge-danger">Pending</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-light">Messsy</td>
                                        <td class="text-light">53275532</td>
                                        <td class="text-light">15 May 2017</td>
                                        <td class="text-light"><label class="badge badge-warning">In progress</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-light">John</td>
                                        <td class="text-light">53275533</td>
                                        <td class="text-light">14 May 2017</td>
                                        <td class="text-light"><label class="badge badge-info">Fixed</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-light">Peter</td>
                                        <td class="text-light">53275534</td>
                                        <td class="text-light">16 May 2017</td>
                                        <td class="text-light"><label class="badge badge-success">Completed</label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-light">Dave</td>
                                        <td class="text-light">53275535</td>
                                        <td class="text-light">20 May 2017</td>
                                        <td class="text-light"><label class="badge badge-warning">In progress</label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
