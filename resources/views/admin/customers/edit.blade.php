@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('customers/update/' . $customer->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="floating-label" for="name">{{ trans('admin.Name') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control"
                            id="name">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="mobile">{{ trans('admin.Mobile') }} <span
                                class="redStar">*</span></label>
                        <input type="number" name="mobile" value="{{ $customer->mobile }}" class="form-control"
                            id="mobile">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="job">{{ trans('admin.Job') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="job" value="{{ $customer->job }}" class="form-control"
                            id="job">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="age">{{ trans('admin.Age') }} <span
                                class="redStar">*</span></label>
                        <input type="number" name="age" value="{{ $customer->age }}" class="form-control"
                            id="age">
                    </div>

                    <div class="mb-3">
                        <label for="company" class="form-label">{{ trans('admin.Insurance Companies') }}<span
                                class="redStar">*</span></label>
                        <select id="company" name="company" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="0">{{ trans('admin.Does not belong') }}</option>
                            @foreach ($companies as $company)
                                <option
                                    {{ isset($customer->company) && $customer->company->insurance_company_id == $company->id ? 'selected' : '' }}
                                    value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="insuranceArea" style="{{ isset($customer->company) && $customer->company->insurance_company_id == $company->id ? '' : 'display: none' }}">
                        <div class="mb-3">
                            <label class="floating-label" for="insurance_number">{{ trans('admin.Insurance Number') }}
                                <span class="redStar">*</span></label>
                            <input type="number" name="insurance_number"
                                value="{{ isset($customer->company)?$customer->company->insurance_number:"" }}" class="form-control"
                                id="insurance_number">
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="percentage">{{ trans('admin.Customer Percent') }} <span
                                    class="redStar">*</span></label>
                            <input type="number" name="percentage" value="{{ isset($customer->company)?$customer->company->company_percentage:"" }}"
                                class="form-control" id="percentage">
                        </div>

                        <div class="mb-3">
                            <label class="floating-label" for="national_id">{{ trans('admin.National Id') }}</label>
                            <input type="number" name="national_id" value="{{ isset($customer->company)?$customer->company->national_id:"" }}"
                                class="form-control" id="national_id">
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
