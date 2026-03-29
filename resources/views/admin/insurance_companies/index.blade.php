@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('insurance_companies/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Company') }}</a>
                </h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin.Name') }}</th>
                                    <th>{{ trans('admin.Status') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurance_companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>
                                            @if ($company->status == 1)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ aurl('insurance_companies/financials/' . $company->id) }}"
                                                class="btn btn-pill btn-outline-primary btn-air-primary">
                                                <i class="fas fa-money-check"></i>&nbsp;{{ trans('admin.Financials') }}
                                            </a>

                                            <a href="{{ aurl('insurance_companies/edit/' . $company->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>

                                            @if ($company->status == 1)
                                                <a href="{{ aurl('insurance_companies/status/0/' . $company->id) }}"
                                                    class="btn btn-pill btn-outline-info btn-air-info"><i
                                                        class="fas fa-times"></i>
                                                    &nbsp;{{ trans('admin.Stop') }}</a>
                                            @else
                                                <a href="{{ aurl('insurance_companies/status/1/' . $company->id) }}"
                                                    class="btn btn-pill btn-outline-success btn-air-success"><i
                                                        class="fas fa-check"></i>
                                                    &nbsp;{{ trans('admin.Start') }}</a>
                                            @endif

                                            <button data-id="{{ $company->id }}" data-name="{{ $company->name }}"
                                                id="delete" class="btn btn-pill btn-outline-danger btn-air-danger"><i
                                                    class="fas fa-trash"></i>
                                                &nbsp;{{ trans('admin.Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $insurance_companies->links('admin.pagination.index') }}
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
                <form action="{{ aurl('insurance_companies/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="companyName"></p>
                        </div>
                        <input type="hidden" id="company_id" name="company_id" value="">
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
                    var companyName = $(this).attr('data-name');
                    var companyId = $(this).attr('data-id');
                    $("#companyName").text(companyName);
                    $("#company_id").val(companyId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
