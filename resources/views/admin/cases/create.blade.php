@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('cases/create') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">

                    <div class="mb-3">
                        <label for="customer" class="form-label">{{ trans('admin.Customer') }}<span
                                class="redStar">*</span></label>
                        <select id="customer" name="customer" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Customer') }}</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    data-company_id="{{ isset($customer->company) ? $customer->company->insurance_company_id : '' }}"
                                    data-company_name="{{ isset($customer->company) ? $customer->company->company->name : '' }}"
                                    data-percentag="{{ isset($customer->company) ? $customer->company->company_percentage : '' }}">
                                    {{ $customer->name }} - {{ $customer->mobile }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="specialization" class="form-label">{{ trans('admin.Specialization') }}<span
                                class="redStar">*</span></label>
                        <select id="specialization" name="specialization" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Specialization') }}</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}" data-price="{{ $specialization->price }}">
                                    {{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="doctor" class="form-label">{{ trans('admin.Doctor') }}<span
                                class="redStar">*</span></label>
                        <select id="doctor" name="doctor" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Doctor') }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="company" class="form-label">{{ trans('admin.Insurance Companies') }}<span
                                class="redStar">*</span></label>
                        <select id="company" name="company" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="0">{{ trans('admin.Does not belong') }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="amount">{{ trans('admin.Customer Amount') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="amount" value="{{ old('amount') }}" class="form-control"
                            id="amount">
                    </div>

                    <div id="company_percent_area" style="display: none">
                        <div class="mb-3">
                            <label class="floating-label" for="company_amount">{{ trans('admin.Company Amount') }} <span
                                    class="redStar">*</span></label>
                            <input type="text" name="company_amount" value="{{ old('company_amount') }}"
                                class="form-control" id="company_amount">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label">{{ trans('admin.Payment Method') }}<span
                                class="redStar">*</span></label>
                        <select id="payment_method" name="payment_method" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            @foreach ($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="note">{{ trans('admin.Note') }}</label>
                        <textarea name="note" class="form-control" rows="4" id="note">{{ old('note') }}</textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                            class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                let price = 0;
                let percentage = 0;

                $("#specialization").change(function() {
                    price = $(this).find(':selected').attr('data-price');

                    var customerAmount = (price * percentage) / 100;

                    $("#amount").val(customerAmount);

                    $("#company_amount").val(price - customerAmount);

                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "{{ aurl('doctors/by_specialization') }}/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(msg) {
                            $("#doctor").empty();
                            for (i = 0; i < msg.data.length; i++) {
                                $("#doctor").append("<option value='" + msg.data[i].id +
                                    "'>" + msg
                                    .data[i].name + "</option>")
                            }
                        },
                    });
                });

                $("#company").change(function() {
                    var percent = $(this).find(':selected').val();
                    if (percent != 0) {
                        $("#company_percent_area").show('slow')
                    } else {
                        $("#company_percent_area").hide('slow')
                    }
                })

                $("#customer").change(function() {
                    var company_name = $(this).find(':selected').attr('data-company_name');
                    var company_id = $(this).find(':selected').attr('data-company_id');
                    percentage = $(this).find(':selected').attr('data-percentag');

                    if (company_id != "") {
                        $("#company").empty();
                        $("#company").append("<option value='0'>{{ trans('admin.Does not belong') }}</option>")
                        $("#company").append("<option selected value='" + company_id + "'>" + company_name +
                            "</option>")
                        $("#company_percent_area").show('slow')
                    }

                })
            });
        </script>
    @endpush
@endsection
