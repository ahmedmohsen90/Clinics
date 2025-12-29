@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                {{ trans('admin.Details') }}
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>{{ trans('admin.Customer') }}</td>
                                <td>{{ $case->customer->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('admin.Mobile') }}</td>
                                <td>{{ $case->customer->mobile }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('admin.Doctor') }}</td>
                                <td>{{ $case->doctor->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('admin.Specialization') }}</td>
                                <td>{{ $case->specialization->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('admin.Amount') }}</td>
                                <td>{{ number_format($case->amount, 2) }}</td>
                            </tr>
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
                {{ trans('admin.Session Duration') }} : {{ round($durationMinutes) }} {{ trans('admin.Minute') }}
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($case->statuses as $status)
                                    <tr>
                                        <td>
                                            @if ($status->status == 'pending')
                                                <span
                                                    class="badge text-bg-warning text-lg">{{ trans('admin.' . $status->status) }}</span>
                                            @elseif ($status->status == 'start')
                                                <span
                                                    class="badge text-bg-success text-lg">{{ trans('admin.' . $status->status) }}</span>
                                            @elseif ($status->status == 'end')
                                                <span
                                                    class="badge text-bg-primary text-lg">{{ trans('admin.' . $status->status) }}</span>
                                            @else
                                                <span
                                                    class="badge text-bg-danger text-lg">{{ trans('admin.' . $status->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $status->created_at }}
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
