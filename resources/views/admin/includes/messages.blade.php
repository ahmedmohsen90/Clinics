@if ($errors->any())
    <div class="alert alert-danger alert-dismissible d-flex align-items-baseline" role="alert">
        <span class="alert-icon alert-icon-lg text-primary me-2">
            <i class="ti ti-user ti-sm"></i>
        </span>
        <div class="d-flex flex-column ps-1">
            <h5 class="alert-heading mb-2">{{ trans('admin.sorry_some_errors') }}!</h5>
            <p class="mb-0">
                @foreach ($errors->all() as $error)
                    <p>* {{ $error }}</p>
                @endforeach
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
<div class="col-md-12">
    @if (session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <span class="alert-icon text-success me-2">
                <i class="ti ti-check ti-xs"></i>
            </span>
            {{ trans('admin.' . session('success')) }}
        </div>
    @endif
    @if (session()->has('faild'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <span class="alert-icon text-danger me-2">
                <i class="ti ti-ban ti-xs"></i>
            </span>
            {{ trans('admin.' . session('faild')) }}
        </div>
    @endif
</div>
