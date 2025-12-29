@extends('admin.layouts.app')
@section('content')
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
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr class="table-{{ $report->operation == 'plus' ? 'success' : 'danger' }}">
                                        <td>
                                            @if ($report->reportable_type == 'App\Models\CustomerCase')
                                                <i class="fas fa-list"></i>&nbsp;{{ trans('admin.Case') }}&nbsp;&nbsp;&nbsp;<i class="fas fa-user-injured"></i>&nbsp;{{ $report->reportable->customer->name }}&nbsp;&nbsp;&nbsp;<i class="fas fa-clinic-medical"></i>{{ $report->reportable->specialization->name }}
                                            @else
                                                {{ $report->reportable->description }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($report->amount, 2) }}</td>
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
@endsection
