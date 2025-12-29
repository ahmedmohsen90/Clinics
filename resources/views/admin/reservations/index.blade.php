@extends('admin.layouts.app')
@section('content')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}
                    <a href="{{ aurl('reservations/create') }}"
                        class="btn btn-pill btn-outline-primary btn-air-primary pull-right"><i class="fas fa-plus"></i>
                        {{ trans('admin.Add New Reservation') }}</a>
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
                                    <th>{{ trans('admin.Specialization') }}</th>
                                    <th>{{ trans('admin.Doctor') }}</th>
                                    <th>{{ trans('admin.Date') }}</th>
                                    <th>{{ trans('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->customer->name }}</td>
                                        <td>{{ $reservation->customer->mobile }}</td>
                                        <td>{{ $reservation->specialization->name }}</td>
                                        <td>{{ $reservation->doctor->name }}</td>
                                        <td><i class="fas fa-calendar-alt"></i> {{ $reservation->date }} <br>
                                            <i class="fas fa-clock"></i> {{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->time)->format('g:ia') }}
                                        </td>

                                        <td>
                                            <a href="{{ aurl('reservations/view/' . $reservation->id) }}"
                                                class="btn btn-pill btn-outline-primary btn-air-primary"><i
                                                    class="fas fa-eye"></i>
                                                {{ trans('admin.Details') }}</a>

                                            <a href="{{ aurl('reservations/edit/' . $reservation->id) }}"
                                                class="btn btn-pill btn-outline-warning btn-air-warning"><i
                                                    class="fas fa-edit"></i>
                                                {{ trans('admin.Edit') }}</a>

                                            <button data-id="{{ $reservation->id }}" data-name="{{ $reservation->name }}"
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
                <form action="{{ aurl('reservations/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p style="margin-top: 10px;font-size: x-large" class="text-info" id="reservationName"></p>
                        </div>
                        <input type="hidden" id="reservation_id" name="reservation_id" value="">
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
                    var reservationName = $(this).attr('data-name');
                    var reservationId = $(this).attr('data-id');
                    $("#reservationName").text(reservationName);
                    $("#reservation_id").val(reservationId);
                    $("#deleteModal").modal('show');
                });

            });
        </script>
    @endpush
@endsection
