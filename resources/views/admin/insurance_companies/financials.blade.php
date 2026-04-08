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
                            <h4 class="ms-1 mb-0">{{ number_format($entitlements, 2) }} {{ trans('admin.EGP') }}</h4>
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
                <h5>{{ $title }}
                    @ability('super_admin', 'debts-collection')
                        @if ($entitlements > 0)
                            <button id="collection" class="btn btn-pill btn-outline-success btn-air-success pull-right"><i
                                    class="fas fa-plus"></i>
                                {{ trans('admin.Collection') }}</button>
                        @endif
                    @endability

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
                                @foreach ($debts as $debt)
                                    <tr>
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
        id="collectionModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Collection') }} -
                        {{ $company->name }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('debts/create') }}" method="POST">
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
                            <label class="floating-label" for="payment_method_id">{{ trans('admin.Receiving Process') }}
                                <span class="redStar">*</span></label>
                            <select name="payment_method_id" class="form-control" id="payment_method_id">
                                @foreach ($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
                        <input type="hidden" id="debtable_type" name="debtable_type" value="App\Models\InsuranceCompany">
                        <input type="hidden" id="operation" name="operation" value="collected">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>

                        <button type="submit"
                            class="btn btn-pill btn-outline-success btn-air-success">{{ trans('admin.Collection') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#collection").click(function() {
                    $("#collectionModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
