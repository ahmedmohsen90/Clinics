<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Specialization;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('customer', 'specialization', 'doctor')->paginate(50);
        return view('admin.reservations.index', [
            'title' => trans('admin.All Reservations'),
            'reservations' => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::get();
        $customers = Customer::get();
        return view('admin.reservations.create', [
            'title' => trans('admin.Add New Reservation'),
            'specializations' => $specializations,
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer'          => 'required',
            'specialization'          => 'required',
            'doctor'          => 'required',
            'date'          => 'required',
            'time'          => 'required',
        ], [], [
            'customer'          => trans('admin.Customer'),
            'specialization'          => trans('admin.Specialization'),
            'doctor'          => trans('admin.Doctor'),
            'date'          => trans('admin.Date'),
            'time'          => trans('admin.Time'),
        ]);

        $time = Carbon::createFromFormat('g:ia', $request->time)
              ->format('H:i:s');

        $reservation = new Reservation();
        $reservation->customer_id = $request->customer;
        $reservation->specialization_id = $request->specialization;
        $reservation->doctor_id = $request->doctor;
        $reservation->date = Carbon::parse($request->date);
        $reservation->time = $time;
        $reservation->save();

        userLogs([
            'model' => '\App\Models\Reservation',
            'model_id' => $reservation->id,
            'description_ar' => 'اضافة حجز جديد',
            'description_en' => 'Add New Reservation',
            'status' => 'create'
        ]);
        return redirect(aurl('reservations'))->with('success', 'operation success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
