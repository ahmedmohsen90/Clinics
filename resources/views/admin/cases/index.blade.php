@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('cases/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Case') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Mobile') }}</th>
                                    <th>{{ trans('admin.Specialization') }}</th>
                                    <th>{{ trans('admin.Doctor') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->customer->name }}</td>
                                        <td>{{ $case->customer->mobile }}</td>
                                        <td>{{ $case->specialization->name }}</td>
                                        <td>{{ $case->doctor->name }}</td>
                                        <td>
                                            @if ($case->status->status == 'pending')
                                                <span
                                                    class="badge text-bg-warning text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @elseif ($case->status->status == 'start')
                                                <span
                                                    class="badge text-bg-success text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @elseif ($case->status->status == 'end')
                                                <span
                                                    class="badge text-bg-primary text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @else
                                                <span
                                                    class="badge text-bg-danger text-lg">{{ trans('admin.' . $case->status->status) }}</span>
                                            @endif

                                        </td>

                                        <td>
                                            @if ($case->status->status != 'end')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ trans('admin.Status') }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if ($case->status->status == 'pending')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ aurl('cases/status/start/' . $case->id) }}"><i
                                                                        class="fas fa-stopwatch"></i>
                                                                    {{ trans('admin.Start') }}</a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider" />
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ aurl('cases/status/end/' . $case->id) }}"><i
                                                                    class="fas fa-user-clock"></i>
                                                                {{ trans('admin.End') }}</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ aurl('cases/status/cancel/' . $case->id) }}"><i
                                                                    class="fas fa-times"></i>
                                                                {{ trans('admin.Cancel') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ trans('admin.Actions') }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ aurl('cases/view/' . $case->id) }}"><i
                                                                class="fas fa-eye"></i>
                                                            {{ trans('admin.Details') }}</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ aurl('cases/edit/' . $case->id) }}"><i
                                                                class="fas fa-edit"></i>
                                                            {{ trans('admin.Edit') }}</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                        <a data-id="{{ $case->id }}"
                                                            data-name="{{ $case->customer->name }}" id="delete"
                                                            class="dropdown-item" href="#"><i
                                                                class="fas fa-trash"></i>
                                                            {{ trans('admin.Delete') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $cases->links('admin.pagination.index') }}
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
                <form action="{{ aurl('cases/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="caseName"></p>
                        </div>
                        <input type="hidden" id="case_id" name="case_id" value="">
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
                    var caseName = $(this).attr('data-name');
                    var caseId = $(this).attr('data-id');
                    $("#caseName").text(caseName);
                    $("#case_id").val(caseId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
