@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('specializations/update/'.$specialization->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="floating-label" for="name">{{ trans('admin.Name') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="name" value="{{ $specialization->name }}" class="form-control"
                            id="name">
                    </div>
                    <div class="mb-3">
                        <label class="floating-label" for="price">{{ trans('admin.Price') }} <span
                                class="redStar">*</span></label>
                        <input type="text" name="price" value="{{ $specialization->price }}" class="form-control"
                            id="price">
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
