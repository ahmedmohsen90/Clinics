@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('packages/create') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">

                    <div class="mb-3">
                        <label for="customer" class="form-label">{{ trans('admin.Customer') }}<span
                                class="redStar">*</span></label>
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
                        <label class="floating-label" for="cases_number">{{ trans('admin.Sessions Number') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="cases_number" value="{{ old('cases_number') }}" class="form-control"
                            id="cases_number">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="price">{{ trans('admin.Price') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control"
                            id="price">
                    </div>

                    <div class="mb-3">
                        <label for="specializations" class="form-label">{{ trans('admin.Specializations') }}</label>
                        <div class="select2-primary">
                            <select id="specializations" name="specializations[]" class="select2 form-select" multiple>
                                @foreach ($specializations as $specialization)
                                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                @endforeach
                            </select>
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
@endsection
