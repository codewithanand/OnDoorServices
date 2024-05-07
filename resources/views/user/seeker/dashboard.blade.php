@extends('layouts.client.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('client/css/select2.css') }}">
@endsection

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Congratulations!</strong> {{ session('success') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> {{ session('error') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img src="{{ asset('uploads/seeker/' . $seeker->image) }}" alt=""
                            class="img-fluid rounded-pill mb-3">
                        <h3 class="h3 text-primary text-center">{{ $user->name }}</h3>
                        <p class="lead mb-3 text-center">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-body mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="city" class="form-control" id="cityDropDown">

                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-control" id="categoryDropDown">
                                    <option value="0">Select a category</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="service" class="form-control" id="serviceDropDown">
                                    <option value="0">Select a service</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div id="customerDataTable">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="h3 text-primary mb-3">Booked Appointments</h3>
                                @foreach ($booked_appointments as $ba)
                                    <div class="border-bottom p-3 d-flex justify-content-between align-items-center">
                                        <span>{{ $ba->appointment->name }}</span>
                                        <span><strong>Booking Date: </strong>{{ $ba->booking_date }}</span>
                                        @if ($ba->status == '1')
                                            <span>
                                                <strong>Completed Date: </strong>{{ $ba->completed_date }}
                                            </span>
                                        @endif
                                        @if ($ba->status == '0')
                                            <a href="{{url('/seeker/booking/'.$ba->id.'/complete')}}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        @else
                                            <span class="badge bg-success">Complete</span>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    {{ $booked_appointments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn btn-danger rounded" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <span class="form-control" id="modalCustomerName">Customer Name</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Mobile</label>
                        <span class="form-control" id="modalCustomerMobile">9898989898</span>
                    </div>
                    <div class="form-group">
                        <label for="">Problem</label>
                        <span class="form-control" id="modalCustomerProblem">Many problems</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('client/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#cityDropDown").change(function() {
                $.ajax({
                    url: "http://localhost:8000/api/appointments/city/" + $(this).val(),
                    dataType: 'json',
                    success: function(data) {
                        populateCustomerDataTable(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                    }
                });
            });

            $("#categoryDropDown").select2();
            $("#serviceDropDown").select2();

            $("#cityDropDown").select2({
                placeholder: "Select a city",
                ajax: {
                    url: "http://localhost:8000/api/city",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            cityName: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.city_code,
                                    text: item.city_name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            function populateCustomerDataTable(data) {
                $('#customerDataTable').html('');
                $.each(data, function() {
                    $('#customerDataTable').append(`
                        <div class="d-flex align-items-center justify-content-between border p-3 mb-3">
                            <span>${this.name}</span>
                            <span>${this.mobile}</span>
                            <div>
                                <button type="button" class="btn btn-info view-btn" data-customer-id="${this.id}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-eye"></i> View</button>
                                <a href="{{ url('/seeker/appointment/${this.id}/book') }}" class="btn btn-success"><i class="fas fa-check"></i> Book</a>
                            </div>
                        </div>
                    `);
                });
                $('.view-btn').each(function() {
                    $(this).click(function() {
                        populateAppointmentDetails($(this).data('customer-id'));
                    });
                });
            }

            function populateAppointmentDetails(appointmentId) {
                $('#modalCustomerName').text('');
                $('#modalCustomerMobile').text('');
                $('#modalCustomerProblem').text('');

                $.ajax({
                    url: "http://localhost:8000/api/appointments/" + appointmentId,
                    dataType: 'json',
                    success: function(data) {
                        $('#modalCustomerName').text(data.name);
                        $('#modalCustomerMobile').text(data.mobile);
                        $('#modalCustomerProblem').text(data.problem);
                        $('#exampleModal').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                    }
                });
            }
        });
    </script>
@endsection
