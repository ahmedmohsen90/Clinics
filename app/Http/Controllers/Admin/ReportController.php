<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCase;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        Carbon::now()->startOfWeek(Carbon::SATURDAY);
        Carbon::now()->endOfWeek(Carbon::FRIDAY);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $filter)
    {
        $reports = Report::with([
            'reportable' => function ($morph) {
                $morph->morphWith([
                    CustomerCase::class => ['customer','specialization'],
                ]);
            }
        ])
            ->when($filter == "today", function ($query) {
                $query->whereDate('created_at', date('Y-m-d'));
            })
            ->when($filter == "week", function ($query) {
                $query->whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()]);
            })
            ->when($filter == "month", function ($query) {
                $query->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()]);
            })
            ->latest()
            ->paginate(50);

        return view('admin.reports.index', [
            'title' => trans('admin.Reports'),
            'reports' => $reports
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
