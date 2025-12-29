<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerCase;
use App\Models\Doctor;
use App\Models\Reservation;
use App\Models\Specialization;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        Carbon::now()->startOfWeek(Carbon::SATURDAY);
        Carbon::now()->endOfWeek(Carbon::FRIDAY);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $reportToday = $this->reportTotal(today(), today()->endOfDay());
        $reportWeek  = $this->reportTotal(now()->startOfWeek(), now()->endOfWeek());
        $reportMonth = $this->reportTotal(now()->startOfMonth(), now()->endOfMonth());
        $allReport   = $this->reportTotal();

        $casestoday = DB::table('customer_cases')->select('id')->whereDate('created_at', date('Y-m-d'))->count();
        $casesweek = DB::table('customer_cases')->select('id')->whereBetween('created_at', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])->count();
        $casesmonth = DB::table('customer_cases')->select('id')->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])->count();
        $casesAll = DB::table('customer_cases')->select('id')->count();

        $doctors = Doctor::count();
        $specializations = Specialization::count();
        $customers = Customer::count();
        $reservations = Reservation::count();
        $reservationsToday = Reservation::whereDate('date', Carbon::today())->count();

        $ordersSum = CustomerCase::whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->month;
            })->map(function ($item) {
                return $item->sum('amount');
            });

        $ordersChart = DB::table('customer_cases')->whereYear('created_at', date('Y'))->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $ordermcount = [];
        $orderArr = [];
        foreach ($ordersChart as $key => $value) {
            $ordermcount[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($ordermcount[$i])) {
                $orderArr[$i] = $ordermcount[$i];
            } else {
                $orderArr[$i] = 0;
            }
        }

        return view('admin.dashboard.index', [
            'title' => trans('admin.Dashboard'),
            'ordermcount' => $ordermcount,
            'orderArr' => $orderArr,
            'doctors' => $doctors,
            'specializations' => $specializations,
            'customers' => $customers,
            'reservations' => $reservations,
            'reservationsToday' => $reservationsToday,
            'casestoday' => $casestoday,
            'casesweek' => $casesweek,
            'casesmonth' => $casesmonth,
            'casesAll' => $casesAll,
            'ordersSum' => $ordersSum,
            'reportToday' => $reportToday,
            'reportWeek' => $reportWeek,
            'reportMonth' => $reportMonth,
            'allReport' => $allReport,
        ]);
    }

    private function reportTotal($from = null, $to = null)
    {
        $query = DB::table('reports');

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query->selectRaw("
            SUM(CASE WHEN operation = 'plus' THEN amount ELSE 0 END) -
            SUM(CASE WHEN operation = 'minus' THEN amount ELSE 0 END)
        ")->value('total');
    }
}
