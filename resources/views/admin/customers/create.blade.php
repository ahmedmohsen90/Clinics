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
            <form action="{{ aurl('customers/create') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="floating-label" for="name">{{ trans('admin.Name') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            id="name">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="mobile">{{ trans('admin.Mobile') }} <span
                                class="redStar">*</span></label>
                        <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control"
                            id="mobile">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="job">{{ trans('admin.Job') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="job" value="{{ old('job') }}" class="form-control"
                            id="job">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label">{{ trans('admin.Birthdate') }}</label>
                        <div class="row">
                            <!-- Day -->
                            <div class="col">
                                <select name="day" class="form-control">
                                    <option value="">{{ trans('admin.Day') }}</option>
                                    @for ($d = 1; $d <= 31; $d++)
                                        <option value="{{ $d }}">{{ $d }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Month -->
                            <div class="col">
                                <select name="month" class="form-control">
                                    <option value="">{{ trans('admin.Month') }}</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}">{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Year -->
                            <div class="col">
                                <select name="year" class="form-control">
                                    <option value="">{{ trans('admin.Year') }}</option>
                                    @for ($y = date('Y'); $y >= 1950; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
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

                    <div id="insuranceArea" style="display: none">
                        <div class="mb-3">
                            <label class="floating-label" for="insurance_number">{{ trans('admin.Insurance Number') }}
                                <span class="redStar">*</span></label>
                            <input type="number" name="insurance_number" value="{{ old('insurance_number') }}"
                                class="form-control" id="insurance_number">
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="percentage">{{ trans('admin.Customer Percent') }} <span
                                    class="redStar">*</span></label>
                            <input type="number" name="percentage" value="{{ old('percentage') }}" class="form-control"
                                id="percentage">
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="national_id">{{ trans('admin.National Id') }}</label>
                            <input type="number" name="national_id" value="{{ old('national_id') }}" class="form-control"
                                id="national_id">
                        </div>
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
        <script src="{{ asset('dashboard') }}/assets/js/forms-pickers.js"></script>

        <script>
            $(document).ready(function() {
                $("#company").change(function() {
                    var percent = $(this).find(':selected').val();
                    if (percent != 0) {
                        $("#insuranceArea").show('fast')
                    } else {
                        $("#insuranceArea").hide('fast')
                    }
                })
            });
        </script>
    @endpush
@endsection
