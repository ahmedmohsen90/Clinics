@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('admin.Actions') }}</h5>
            </div>
            <div class="card-body row">
                <div class="d-grid gap-2 col-lg-4 mx-auto">
                    <a style="padding: 30px;" href="{{ url('customers/create') }}"
                        class="btn btn-xl btn-primary waves-effect waves-light"><i class="fas fa-users"></i>
                        &nbsp;{{ trans('admin.Add New Customer') }}</a>
                </div>
                <div class="d-grid gap-2 col-lg-4 mx-auto">
                    <a style="padding: 30px;" href="{{ url('cases/create') }}"
                        class="btn btn-xl btn-success waves-effect waves-light"><i class="fas fa-user-injured"></i>
                        &nbsp;{{ trans('admin.Add New Case') }}</a>
                </div>
                <div class="d-grid gap-2 col-lg-4 mx-auto">
                    <a style="padding: 30px;" href="{{ url('reservations/create') }}"
                        class="btn btn-xl btn-warning waves-effect waves-light"><i class="fas fa-calendar-alt"></i>
                        &nbsp;{{ trans('admin.Add New Reservation') }}</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-user-injured"></i> {{ trans('admin.Cases') }} - {{ date('Y-m-d') }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Mobile') }}</th>
                                    <th>{{ trans('admin.Specialization') }}</th>
                                    <th>{{ trans('admin.Doctor') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->customer->name }}</td>
                                        <td>{{ $case->customer->mobile }}</td>
                                        <td>{{ $case->specialization->name }}</td>
                                        <td>{{ $case->doctor->name }}</td>
                                        <td>
                                            @if ($case->status->status == 'pending')
                                                <span
                                                    class="badge text-bg-warning text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @elseif ($case->status->status == 'start')
                                                <span
                                                    class="badge text-bg-success text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @elseif ($case->status->status == 'end')
                                                <span
                                                    class="badge text-bg-primary text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @else
                                                <span
                                                    class="badge text-bg-danger text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @endif

                                        </td>

                                        <td>
                                            @if ($case->status->status != 'end')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ trans('admin.Status') }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if ($case->status->status == 'pending')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ aurl('cases/status/start/' . $case->id) }}"><i
                                                                        class="fas fa-stopwatch"></i>
                                                                    {{ trans('admin.Start') }}</a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider" />
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ aurl('cases/status/end/' . $case->id) }}"><i
                                                                    class="fas fa-user-clock"></i>
                                                                {{ trans('admin.End') }}</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ aurl('cases/status/cancel/' . $case->id) }}"><i
                                                                    class="fas fa-times"></i>
                                                                {{ trans('admin.Cancel') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ trans('admin.Actions') }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ aurl('cases/view/' . $case->id) }}"><i
                                                                class="fas fa-eye"></i>
                                                            {{ trans('admin.Details') }}</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ aurl('cases/edit/' . $case->id) }}"><i
                                                                class="fas fa-edit"></i>
                                                            {{ trans('admin.Edit') }}</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                        <a data-id="{{ $case->id }}"
                                                            data-name="{{ $case->customer->name }}" id="delete"
                                                            class="dropdown-item" href="#"><i
                                                                class="fas fa-trash"></i>
                                                            {{ trans('admin.Delete') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>


    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-calendar-alt"></i> {{ trans('admin.Reservations') }} - {{ date('Y-m-d') }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Mobile') }}</th>
                                    <th>{{ trans('admin.Specialization') }}</th>
                                    <th>{{ trans('admin.Doctor') }}</th>
                                    <th>{{ trans('admin.Date') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->customer->name }}</td>
                                        <td>{{ $reservation->customer->mobile }}</td>
                                        <td>{{ $reservation->specialization->name }}</td>
                                        <td>{{ $reservation->doctor->name }}</td>
                                        <td><i class="fas fa-calendar-alt"></i> {{ $reservation->date }} <br>
                                            <i class="fas fa-clock"></i>
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->time)->format('g:ia') }}
                                        </td>
                                        <td>
                                            <a href="{{ aurl('reservations/view/' . $reservation->id) }}"
                                                class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                                    class="fas fa-eye"></i>
                                                {{ trans('admin.Details') }}</a>
                                            <a href="{{ aurl('reservations/edit/' . $reservation->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>
                                            <button data-id="{{ $reservation->id }}" data-name="{{ $reservation->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                {{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
