<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activity_logs = Activity::all();

            return DataTables::of($activity_logs)
                ->addColumn('plus-icon', function () {
                    return null;
                })
                ->addColumn('source', function ($each) {
                    return $each->getExtraProperty('source');
                })
                ->addColumn('causer', function ($each) {
                    return optional($each->causer)->name;
                })
                ->addColumn('subject', function ($each) {
                    if ($each->subject) {
                        return '<table class="table table-bordered dark:tw-bg-slate-900 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="p-1">ID</th>
                                            <th class="p-1">Model</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-1">' . optional($each->subject)->id . '</td>
                                            <td class="p-1">' . class_basename($each->subject) . '</td>
                                        </tr>
                                    </tbody>
                                </table>';
                    }
                    return '';
                })
                ->addColumn('action', function ($each) {
                    return '<div class="d-flex justify-content-center">
                        <a href="' . route('admin.activity-log.show', ['activity_log' => $each]) . '" class="btn btn-sm btn-info rounded m-1" title="Detail"><i class="fas fa-info-circle"></i></a>
                    </div>';
                })
                ->addColumn('date', function ($each) {
                    return $each->created_at->format('Y-m-d H:i:s') . '<br> (' . $each->created_at->diffForHumans() . ')';
                })
                ->rawColumns(['subject', 'date', 'action'])
                ->make(true);
        }

        return view('backend.admin.activity_log.index');
    }

    public function show(Activity $activity_log)
    {
        return view('backend.admin.activity_log.show', compact('activity_log'));
    }
}
