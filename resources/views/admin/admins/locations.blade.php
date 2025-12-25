@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <style>
            .badge {
                font-size: 16px;
                font-weight: bold
            }
        </style>
    @endpush
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.URL') }}</th>
                                    <th>{{ trans('admin.Operation') }}</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td><a href="{{ $log->url }}" target="_blank">{{ Str::limit($log->url, 30) }}</a>
                                        </td>
                                        <td>
                                            <p><b>{{ $log->operation }}</b></p>
                                            <p>{{ $log->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <p>{{ isset($log->user) ? $log->user->name : trans('admin.Guest') }}</p>
                                            <p><i class="fas fa-globe-africa"></i> {{ $log->country_name }}</p>
                                            <p><i class="fas fa-map-marked-alt"></i> {{ $log->region_name }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $logs->links('admin.pagination.index') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
