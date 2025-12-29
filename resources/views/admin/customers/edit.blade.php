@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('customers/update/'.$customer->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="name">{{ trans('admin.Name') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control"
                            id="name">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="mobile">{{ trans('admin.Mobile') }} <span
                                class="redStar">*</span></label>
                        <input type="number" name="mobile" value="{{ $customer->mobile }}" class="form-control"
                            id="mobile">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="job">{{ trans('admin.Job') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="job" value="{{ $customer->job }}" class="form-control"
                            id="job">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="age">{{ trans('admin.Age') }} <span
                                class="redStar">*</span></label>
                        <input type="number" name="age" value="{{ $customer->age }}" class="form-control"
                            id="age">
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
