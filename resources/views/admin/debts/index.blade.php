@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('debts/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Debt') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Amount') }}</th>
                                    <th>{{ trans('admin.Description') }}</th>
                                    <th>{{ trans('admin.Note') }}</th>
                                    <th>{{ trans('admin.Collection') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debts as $debt)
                                    <tr>
                                        <td>{{ $debt->name }}</td>
                                        <td>{{ number_format($debt->amount, 2) }}</td>
                                        <td>{{ $debt->note }}</td>
                                        <td>
                                            @if ($debt->is_collection == 1)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($debt->is_collection == 0)
                                                <a href="{{ aurl('debts/collection/' . $debt->id) }}"
                                                    class="btn btn-pill btn-outline-success btn-air-success"><i
                                                        class="fas fa-money-bill-alt"></i>&nbsp;{{ trans('admin.Collection') }}</a>
                                            @endif
                                            <button data-id="{{ $debt->id }}" data-name="{{ $debt->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                {{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $debts->links('admin.pagination.index') }}
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
                <form action="{{ aurl('debts/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="debtName"></p>
                        </div>
                        <input type="hidden" id="debt_id" name="debt_id" value="">
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
                    var debtName = $(this).attr('data-name');
                    var debtId = $(this).attr('data-id');
                    $("#debtName").text(debtName);
                    $("#debt_id").val(debtId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
