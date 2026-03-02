@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr-themes.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
        <link rel="stylesheet"
            href="{{ asset('dashboard') }}/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr-themes.css" />
    @endpush

    <form action="{{ aurl('reports/filter') }}">
        @csrf
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('admin.Filter') }}</h5>
                </div>
                <div class="card-block row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="bs-rangepicker-single" class="form-label">{{ trans('admin.From') }}</label>
                                    <input type="text" id="bs-rangepicker-single" name="from" class="form-control" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="bs-rangepicker-single"
                                            class="form-label">{{ trans('admin.To') }}</label>
                                        <input type="text" id="bs-rangepicker-single" name="to"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">{{ trans('admin.Filter') }}</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Description') }}</th>
                                    <th>{{ trans('admin.Amount') }}</th>
                                    <th>{{ trans('admin.Date') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr class="table-{{ $report->operation == 'plus' ? 'success' : 'danger' }}">
                                        <td>
                                            @if ($report->reportable_type == 'App\Models\CustomerCase')
                                                <i
                                                    class="fas fa-list"></i>&nbsp;{{ trans('admin.Case') }}&nbsp;&nbsp;&nbsp;<i
                                                    class="fas fa-user-injured"></i>&nbsp;{{ $report->reportable->customer->name }}&nbsp;&nbsp;&nbsp;<i
                                                    class="fas fa-clinic-medical"></i>{{ $report->reportable->specialization->name }}
                                            @elseif ($report->reportable_type == 'App\Models\Debt')
                                                <i class="fas fa-coins"></i> {{ trans('admin.Debts') }} -
                                                {{ $report->reportable->note }}
                                            @elseif ($report->reportable_type == 'App\Models\Expenses')
                                                <i class="fas fa-money-bill-alt"></i> {{ trans('admin.Expenses') }} -
                                                {{ $report->reportable->description }}
                                            @else
                                                {{ $report->reportable->description }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($report->amount, 2) }}</td>
                                        <td>{{ $report->created_at }}</td>
                                        <td>
                                            <a href="{{ aurl('reports/view/' . $report->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-eye"></i>
                                                {{ trans('admin.Details') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $reports->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/moment/moment.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js">
        </script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/forms-pickers.js"></script>
    @endpush
@endsection
