@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    @ability('super_admin', 'doctors-create')
                        <a href="{{ aurl('doctors/create') }}"
                            class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                            {{ trans('admin.Add New Doctor') }}</a>
                    @endability

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
                                    <th>{{ trans('admin.Specializations') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->mobile }}</td>
                                        <td>
                                            @foreach ($doctor->specializations as $index => $specialization)
                                                <span
                                                    class="badge text-bg-success">{{ $specialization->specialization->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ trans('admin.List') }}
                                                </button>
                                                <ul class="dropdown-menu">

                                                    @ability('super_admin', 'doctors-view')
                                                        <a href="{{ aurl('doctors/view/' . $doctor->id) }}"
                                                            class="dropdown-item"><i class="fas fa-eye"></i>
                                                            {{ trans('admin.Actions') }}</a>
                                                    @endability

                                                    @role('super_admin')
                                                        <a href="{{ aurl('doctors/financials/' . $doctor->id) }}"
                                                            class="dropdown-item"><i
                                                                class="fas fa-money-check"></i>&nbsp;{{ trans('admin.Financials') }}</a>
                                                    @endrole

                                                    @role('super_admin')
                                                        <a href="{{ aurl('doctors/salaries/' . $doctor->id) }}"
                                                            class="dropdown-item"><i
                                                                class="fas fa-money-bill-alt"></i>&nbsp;{{ trans('admin.Salaries') }}</a>
                                                    @endrole

                                                    @ability('super_admin', 'doctors-update')
                                                        <a href="{{ aurl('doctors/edit/' . $doctor->id) }}"
                                                            class="dropdown-item"><i class="fas fa-edit"></i>
                                                            {{ trans('admin.Edit') }}</a>
                                                    @endability

                                                    @ability('super_admin', 'doctors-delete')
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" id="delete" href="#"><i
                                                                    class="fas fa-trash"></i>
                                                                {{ trans('admin.Delete') }}</a>
                                                        </li>
                                                    @endability

                                                </ul>
                                            </div>
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
                <form action="{{ aurl('doctors/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="doctorName"></p>
                        </div>
                        <input type="hidden" id="doctor_id" name="doctor_id" value="">
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
                    var doctorName = $(this).attr('data-name');
                    var doctorId = $(this).attr('data-id');
                    $("#doctorName").text(doctorName);
                    $("#doctor_id").val(doctorId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
