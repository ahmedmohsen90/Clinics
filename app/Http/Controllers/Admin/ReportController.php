<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCase;
use App\Models\Debt;
use App\Models\Expenses;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                    CustomerCase::class => ['customer', 'specialization'],
                    Debt::class         => [],
                    Expenses::class      => [],
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

    public function filter(Request $request)
    {
        $reports = Report::with([
            'reportable' => function ($morph) {
                $morph->morphWith([
                    CustomerCase::class => ['customer', 'specialization'],
                    Debt::class         => [],
                    Expenses::class      => [],
                ]);
            }
        ])
            ->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)])
            ->latest()
            ->paginate(50);

        return view('admin.reports.index', [
            'title' => trans('admin.Reports') . ' ' . trans("admin.From") . ' ' . $request->from . ' ' . trans('admin.To') . ' ' . $request->to,
            'reports' => $reports
        ]);
    }
}
