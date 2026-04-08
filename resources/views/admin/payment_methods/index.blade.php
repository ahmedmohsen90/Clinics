@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    @ability('super_admin', 'payment_methods-create')
                        <a href="{{ aurl('payment_methods/create') }}"
                            class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                            {{ trans('admin.Add New Payment Method') }}</a>
                    @endability
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($methods as $method)
                                    <tr>
                                        <td>{{ $method->name }}</td>
                                        <td>
                                            @if ($method->status == 1)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @ability('super_admin', 'payment_methods-financials')
                                                <a href="{{ aurl('payment_methods/financials/' . $method->id) }}"
                                                    class="btn btn-pill btn-outline-primary btn-air-primary">
                                                    <i class="fas fa-money-check"></i>&nbsp;{{ trans('admin.Financials') }}
                                                </a>
                                            @endability
                                            @ability('super_admin', 'payment_methods-update')
                                                <a href="{{ aurl('payment_methods/edit/' . $method->id) }}"
                                                    class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                        class="fas fa-edit"></i>
                                                    {{ trans('admin.Edit') }}</a>
                                                @if ($method->status == 1)
                                                    <a href="{{ aurl('payment_methods/status/0/' . $method->id) }}"
                                                        class="btn btn-pill btn-outline-info btn-air-info"><i
                                                            class="fas fa-times"></i>
                                                        &nbsp;{{ trans('admin.Stop') }}</a>
                                                @else
                                                    <a href="{{ aurl('payment_methods/status/1/' . $method->id) }}"
                                                        class="btn btn-pill btn-outline-success btn-air-success"><i
                                                            class="fas fa-check"></i>
                                                        &nbsp;{{ trans('admin.Start') }}</a>
                                                @endif
                                            @endability

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
