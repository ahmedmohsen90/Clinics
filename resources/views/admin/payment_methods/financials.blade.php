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
                            <h4 class="ms-1 mb-0">{{ number_format($total, 2) }} {{ trans('admin.EGP') }}</h4>
                        </div>
                        <p class="mb-1">{{ trans('admin.Total') }}</p>
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
                    @if ($total > 0)
                        <a class="btn btn-pill btn-outline-success btn-air-success pull-right" href="#"><i
                                class="far fa-file-excel"></i></a>&nbsp;
                        <a class="btn btn-pill btn-outline-danger btn-air-danger pull-right" href="#"><i
                                class="fas fa-file-pdf"></i></a>
                        <button id="transfer" class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i
                                class="fas fa-exchange-alt"></i> {{ trans('admin.Transfer') }}</a>
                    @endif

                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Amount') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Description') }}</th>
                                    <th>{{ trans('admin.Created At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ number_format($log->amount, 2) }} {{ trans('admin.EGP') }}</td>
                                        <td>
                                            @if ($log->operation == 'plus')
                                                <i class="fas fa-arrow-circle-down text-success"></i>
                                            @else
                                                <i class="fas fa-arrow-circle-up text-danger"></i>
                                            @endif
                                        </td>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $logs->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true"
        id="transferModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Transfer') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('payment_methods/transfer') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="debtName"></p>
                        </div>
                        <div class="mb-3">
                            <label class="floating-label" for="amount">{{ trans('admin.Amount') }} <span
                                    class="redStar">*</span></label>
                            <input type="text" name="amount" value="" class="form-control" id="amount">
                        </div>
                        <div class="mb-3">
                            <label class="floating-label" for="description">{{ trans('admin.Description') }} <span
                                    class="redStar">*</span></label>
                            <input type="text" name="description" value="" class="form-control" id="description">
                        </div>
                        <div class="mb-3">
                            <label class="floating-label" for="payment_method_id">{{ trans('admin.Transfer To') }}
                                <span class="redStar">*</span></label>
                            <select name="payment_method_id" class="form-control" id="payment_method_id">
                                @foreach ($paymentMethods as $pMethod)
                                    <option value="{{ $pMethod->id }}">{{ $pMethod->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="current_payment_method_id" name="current_payment_method_id"
                            value="{{ $method->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>

                        <button type="submit"
                            class="btn btn-pill btn-outline-primary btn-air-primary">{{ trans('admin.Transfer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#transfer").click(function() {
                    $("#transferModal").modal('show');
                });
            });
        </script>
    @endpush
@endsection
