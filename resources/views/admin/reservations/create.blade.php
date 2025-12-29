@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr-themes.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
        <link rel="stylesheet"
            href="{{ asset('dashboard') }}/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr-themes.css" />
    @endpush
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('reservations/create') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">

                    <div class="mb-3">
                        <label for="customer" class="form-label">{{ trans('admin.Customer') }}</label>
                        <select id="customer" name="customer" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Customer') }}</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->mobile }}
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
                                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="doctor" class="form-label">{{ trans('admin.Doctor') }}</label>
                        <select id="doctor" name="doctor" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option selected disabled>{{ trans('admin.Select Doctor') }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bs-rangepicker-single" class="form-label">{{ trans('admin.Date') }}</label>
                        <input type="text" id="bs-rangepicker-single" name="date" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="timepicker-basic" class="form-label">{{ trans('admin.Time') }}</label>
                        <input type="text" id="timepicker-basic" name="time" placeholder="{{ trans('admin.Time') }}" class="form-control" />
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
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/moment/moment.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js">
        </script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
        <script src="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/forms-pickers.js"></script>

        <script>
            $(document).ready(function() {
                $("#specialization").change(function() {
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
            });
        </script>
    @endpush
@endsection
