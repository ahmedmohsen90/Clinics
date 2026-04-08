@extends('admin.layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/assets/css/vendors/select2.css">
    @endpush
    <form action="{{ aurl('roles/update/' . $role->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="floating-label" for="name">{{ trans('admin.Role Name') }}</label>
                        <input disabled type="text" value="{{ $role->name }}" name="name" class="form-control"
                            id="name">
                        {{-- <small
                            class="text-danger">{{ trans('admin.The name must be lowercase and without spaces') }}</small> --}}
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="display_name">{{ trans('admin.Name') }}</label>
                        <input type="text" value="{{ $role->display_name }}" name="display_name" class="form-control"
                            id="display_name">
                    </div>

                    <div class="mb-3">
                        <label class="floating-label" for="description">{{ trans('admin.Description') }}</label>
                        <input type="text" value="{{ $role->description }}" name="description" class="form-control"
                            id="description">
                    </div>




                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i
                            class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <h5>{{ trans('admin.Permissions') }}</h5>
            <hr>
            <div class="row">
                @foreach ($tables as $table)
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header" style="padding: 20px 20px 0px 20px !important;">
                                <h5>
                                    {{ $table->display_name }}
                                    <div id="table-{{ $table->id }}" class="pull-right">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="table[]" type="checkbox"
                                                id="table{{ $table->id }}"
                                                {{ in_array($table->id, $tableIds->toArray()) ? 'checked' : '' }} />
                                            <label class="form-check-label"
                                                for="table{{ $table->id }}">{{ trans('admin.Select All') }}</label>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                            <hr>
                            <div class="card-body row switch-showcase">
                                <div class="row">
                                    @foreach ($table->permissions as $permission)
                                        <div class="col-md-6 col-xl-6">
                                            <div class="form-check form-switch mb-2">
                                                <input name="permissions[]" value="{{ $permission->id }}"
                                                    {{ in_array($permission->id, $permissionsId->toArray()) ? 'checked' : '' }}
                                                    data-parentid="table{{ $table->id }}"
                                                    data-id="{{ $permission->id }}" data-name="{{ $permission->name }}"
                                                    type="checkbox" id="permission{{ $permission->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label"
                                                    for="permission{{ $permission->id }}">{{ $permission->display_name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </form>

    @push('script')
        <script>
            $(document).ready(function() {
                $('[name="table[]"]').on('click', function() {
                    var attr = $(this).attr('id');
                    if ($(this).prop('checked')) {
                        $('*[data-parentid="' + attr + '"]').prop('checked', true);
                    } else {
                        $('*[data-parentid="' + attr + '"]').prop('checked', false);
                    }
                })
                $('[name="permissions[]"]').on('click', function() {
                    var per_attr = $(this).attr('data-parentid');
                    if ($("input:checkbox[data-parentid='" + per_attr + "']").is(":checked")) {
                        $('#' + per_attr).prop('checked', true);
                    } else {
                        $('#' + per_attr).prop('checked', false);
                    }
                })
            });
        </script>
    @endpush
@endsection
