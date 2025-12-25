<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordermcount = [];
        $orderArr = [];
        return view('admin.dashboard.index', [
            'title' => trans('admin.Dashboard'),
            'ordermcount' => $ordermcount,
            'orderArr' => $orderArr,
        ]);
    }
}
