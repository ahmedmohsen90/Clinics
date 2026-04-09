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
                    <a class="btn btn-pill btn-outline-success btn-air-success pull-right"
                        href="{{ url('exports/debts') }}"><i class="far fa-file-excel"></i></a>&nbsp;
                    <a class="btn btn-pill btn-outline-danger btn-air-danger pull-right"
                        href="{{ url('exports/pdf/debts') }}"><i class="fas fa-file-pdf"></i></a>
                    <button id="create" class="btn btn-pill btn-outline-warning btn-air-warning pull-right"><i
                            class="fas fa-plus"></i> {{ trans('admin.Add New Debt') }}</button>
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


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true"
        id="createModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Delete') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('debts/doctors/create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="operation" value="minus" class="form-control" id="operation">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="model" class="form-label">{{ trans('admin.Doctors') }}<span
                                    class="redStar">*</span></label>
                            <select id="doctor_id" name="doctor_id" class="select2 form-select form-select-lg">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="amount">{{ trans('admin.Amount') }} <span
                                    class="redStar">*</span></label>
                            <input type="text" name="amount" value="{{ old('amount') }}" class="form-control"
                                id="amount">
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">{{ trans('admin.Payment Method') }}<span
                                    class="redStar">*</span></label>
                            <select id="payment_method_id" name="payment_method_id"
                                class="select2 form-select form-select-lg">
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="description">{{ trans('admin.Description') }} <span
                                    class="redStar">*</span></label>
                            <input type="text" name="description" value="{{ old('description') }}" class="form-control"
                                id="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>
                        <button type="submit"
                            class="btn btn-pill btn-outline-success btn-air-success">{{ trans('admin.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#create").click(function() {
                    $("#createModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
