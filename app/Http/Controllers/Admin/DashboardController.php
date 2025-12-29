<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Reservation;
use App\Models\Specialization;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $doctors = Doctor::count();
        $specializations = Specialization::count();
        $customers = Customer::count();
        $reservations = Reservation::count();
        $reservationsToday = Reservation::whereDate('date', Carbon::today())->count();

        $ordermcount = [];
        $orderArr = [];
        return view('admin.dashboard.index', [
            'title' => trans('admin.Dashboard'),
            'ordermcount' => $ordermcount,
            'orderArr' => $orderArr,
            'doctors' => $doctors,
            'specializations' => $specializations,
            'customers' => $customers,
            'reservations' => $reservations,
            'reservationsToday' => $reservationsToday,
        ]);
    }
}
