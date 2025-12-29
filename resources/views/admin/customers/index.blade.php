@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('customers/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Customer') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Mobile') }}</th>
                                    <th>{{ trans('admin.Job') }}</th>
                                    <th>{{ trans('admin.Age') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->mobile }}</td>
                                        <td>{{ $customer->job }}</td>
                                        <td>{{ $customer->age }}</td>

                                        <td>
                                            <a href="{{ aurl('customers/view/' . $customer->id) }}"
                                                class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                                    class="fas fa-eye"></i>
                                                {{ trans('admin.View') }}</a>

                                            <a href="{{ aurl('customers/edit/' . $customer->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>

                                            <button data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                {{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true"
        id="deleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Delete') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('customers/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="customerName"></p>
                        </div>
                        <input type="hidden" id="customer_id" name="customer_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>
                        <button type="submit"
                            class="btn btn-pill btn-outline-danger btn-air-danger">{{ trans('admin.Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#delete ").click(function() {
                    var customerName = $(this).attr('data-name');
                    var customerId = $(this).attr('data-id');
                    $("#customerName").text(customerName);
                    $("#customer_id").val(customerId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
