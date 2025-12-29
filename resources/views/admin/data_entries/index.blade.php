@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('data_entries/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Data Entry') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Mobile') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_entries as $data_entry)
                                    <tr>
                                        <td>{{ $data_entry->name }}</td>
                                        <td>{{ $data_entry->mobile }}</td>
                                        <td>
                                            <a href="{{ aurl('data_entries/edit/' . $data_entry->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>

                                            <button data-id="{{ $data_entry->id }}" data-name="{{ $data_entry->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                {{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true"
        id="deleteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('admin.Delete') }}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ aurl('data_entries/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="data_entryName"></p>
                        </div>
                        <input type="hidden" id="data_entry_id" name="data_entry_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{ trans('admin.Close') }}</button>
                        <button type="submit"
                            class="btn btn-pill btn-outline-danger btn-air-danger">{{ trans('admin.Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $("#delete ").click(function() {
                    var data_entryName = $(this).attr('data-name');
                    var data_entryId = $(this).attr('data-id');
                    $("#data_entryName").text(data_entryName);
                    $("#data_entry_id").val(data_entryId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
