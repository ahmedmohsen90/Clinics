@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="row">

            <div class="col-sm-6 col-lg-6 mb-4">
                <div class="card card-border-shadow-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class="fas fa-arrow-circle-down"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ number_format($collected, 2) }} {{ trans('admin.EGP') }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Total Collected') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-6 mb-4">
                <div class="card card-border-shadow-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="fas fa-clock"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ number_format($entitlements, 2) }}
                                {{ trans('admin.EGP') }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Total Entitlements') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    {{ $title }}
                    <a class="btn btn-pill btn-outline-success btn-air-success pull-right" href="{{ url('exports/debts') }}"><i class="far fa-file-excel"></i></a>&nbsp;
                    <a class="btn btn-pill btn-outline-danger btn-air-danger pull-right" href="{{ url('exports/pdf/debts') }}"><i class="fas fa-file-pdf"></i></a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Amount') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Description') }}</th>
                                    <th>{{ trans('admin.Created At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debts as $debt)
                                    <tr>
                                        <td>{{ $debt->debtable->name }}</td>
                                        <td>{{ number_format($debt->amount, 2) }} {{ trans('admin.EGP') }}</td>
                                        <td>
                                            @if ($debt->operation == 'collected')
                                                <i class="fas fa-arrow-circle-down text-success"></i>
                                            @else
                                                <i class="fas fa-clock text-danger"></i>
                                            @endif
                                        </td>
                                        <td>{{ $debt->description }}</td>
                                        <td>{{ $debt->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $debts->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
