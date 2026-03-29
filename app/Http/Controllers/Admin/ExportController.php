<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\DebtsExport;
use App\Models\Debt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function debts()
    {
        $debts = Debt::where([
            'debtable_type' => "App\Models\InsuranceCompany",
        ])->with('debtable')->latest()->get();

        return Excel::download(new DebtsExport($debts), trans('admin.Debts') . '_' . now()->toDateString() . '.xlsx');
    }
}
