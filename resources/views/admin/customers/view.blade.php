@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-user"></i></span>
                        </div>
                        <h5 class="ms-1 mb-0 text-white">{{ $customer->name }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card text-bg-info">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="fas fa-mobile-alt"></i></span>
                        </div>
                        <h5 class="ms-1 mb-0 text-white">{{ $customer->mobile }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="fas fa-briefcase"></i></span>
                        </div>
                        <h5 class="ms-1 mb-0 text-white">{{ $customer->job }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class="fas fa-building"></i></span>
                        </div>
                        @if (isset($customer->company->company))
                            <h5 class="ms-1 mb-0 text-white">{{ $customer->company->company->name }}</h5>
                        @else
                            <h5 class="ms-1 mb-0 text-white">{{ trans('admin.Does not belong') }}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('admin.Sessions') }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Specialization') }}</th>
                                    <th>{{ trans('admin.Doctor') }}</th>
                                    <th>{{ trans('admin.Created At') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->specialization->name }}</td>
                                        <td>{{ $case->doctor->name }}</td>
                                        <td>{{ $case->created_at }}</td>
                                        <td></td>
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
