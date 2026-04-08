@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-chart-pie"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $casestoday }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Cases Today') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="fas fa-chart-line"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $casesweek }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Cases Week') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="fas fa-chart-bar"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $casesmonth }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Cases Month') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('admin.Doctor') }} {{ $title }} -
                    @foreach ($doctor->specializations as $index => $specialization)
                        <span class="badge text-bg-success">{{ $specialization->specialization->name }}</span>
                    @endforeach
                </h5>
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
                                    <th>{{ trans('admin.Total') }}</th>
                                    <th>{{ trans('admin.Created At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->customer->name }}</td>
                                        <td>{{ $case->customer->mobile }}</td>
                                        <td>{{ $case->specialization->name }}</td>
                                        <td>{{ number_format($case->customer_amount + $case->company_amount, 2) }}
                                            {{ trans('admin.EGP') }}</td>
                                        <td>{{ $case->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $cases->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
