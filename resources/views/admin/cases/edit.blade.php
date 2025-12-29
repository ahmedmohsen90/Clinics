@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('cases/update/' . $case->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">

                    <div class="mb-3">
                        <label for="customer" class="form-label">{{ trans('admin.Customer') }}</label>
                        <select id="customer" name="customer" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Customer') }}</option>
                            @foreach ($customers as $customer)
                                <option {{ $case->customer_id == $customer->id ? 'selected' : '' }}
                                    value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->mobile }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="specialization" class="form-label">{{ trans('admin.Specialization') }}</label>
                        <select id="specialization" name="specialization" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Specialization') }}</option>
                            @foreach ($specializations as $specialization)
                                <option {{ $case->specialization_id == $specialization->id ? 'selected' : '' }}
                                    value="{{ $specialization->id }}" data-price="{{ $specialization->price }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="doctor" class="form-label">{{ trans('admin.Doctor') }}</label>
                        <select id="doctor" name="doctor" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Doctor') }}</option>
                            @foreach ($doctors as $doctor)
                                <option {{ $case->doctor_id == $doctor->id ? 'selected' : '' }}
                                    value="{{ $doctor->id }}">
                                    {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="amount">{{ trans('admin.Amount') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="amount" value="{{ $case->amount }}" class="form-control"
                            id="amount">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="note">{{ trans('admin.Note') }}</label>
                        <textarea name="note" class="form-control" rows="4" id="note">{{ $case->note }}</textarea>
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
                $("#specialization").change(function() {
                    var id = $(this).val();
                    var price = $(this).find(':selected').attr('data-price');
                    $("#amount").val(price);

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
            });
        </script>
    @endpush
@endsection
