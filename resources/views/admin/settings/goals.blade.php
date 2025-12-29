@extends('admin.layouts.app')
@section('content')
    <form action="{{ aurl('settings/update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <h5 class="card-header">{{ $title }}</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="floating-label" for="goals">{{ trans('admin.Goals') }}</label>
                            <input type="number" value="{{ $setting->goals }}" name="goals" class="form-control"
                                id="goals">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
