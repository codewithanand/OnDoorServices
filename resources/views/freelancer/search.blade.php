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
                
                <div class="col-md-12">
                    <div class="card card-body mb-3">
                        <div class="row">
                            <h3 class="h3 text-primary mb-3">Search Appointment</h3>
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
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                    <button type="button" class="btn btn-danger rounded" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span class="form-control" name="name" id="modalCustomerName"></span>
                                <label for="name">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span name="mobile" class="form-control" id="modalCustomerMobile"></span>
                                <label for="mobile">Mobile</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <span name="service" class="form-control" id="modalServiceType"></span>
                        <label for="service">Service Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <span name="problem" class="form-control" id="modalCustomerProblem"></span>
                        <label for="problem">Problem</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span class="form-control" name="state" id="modalCustomerState"></span>
                                <label for="state">State</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span class="form-control" name="district" id="modalCustomerDistrict"></span>
                                <label for="district">District</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span class="form-control" name="city" id="modalCustomerCity"></span>
                                <label for="city">City</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <span class="form-control" name="village" id="modalCustomerVillage"></span>
                                <label for="village">Village</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <span name="address" class="form-control" id="modalCustomerAddress"></span>
                        <label for="address">Address</label>
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
                            <span>${this.service.title}</span>
                            <div>
                                <button type="button" class="btn btn-info view-btn" data-customer-id="${this.id}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-eye"></i> View</button>
                                <a href="{{ url('/freelancer/appointment/${this.id}/book') }}" class="btn btn-success"><i class="fas fa-check"></i> Book</a>
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
                $('#modalServiceType').text('');

                $.ajax({
                    url: "http://localhost:8000/api/appointments/" + appointmentId,
                    dataType: 'json',
                    success: function(data) {
                        $('#modalCustomerName').text(data.name);
                        $('#modalCustomerMobile').text(data.mobile);
                        $('#modalCustomerProblem').text(data.problem);
                        $('#modalServiceType').text(data.service.title);
                        $('#modalCustomerState').text(data.state.state_name);
                        $('#modalCustomerDistrict').text(data.district.district_name);
                        $('#modalCustomerCity').text(data.city.city_name);
                        $('#modalCustomerVillage').text(data.village.village_name);
                        $('#modalCustomerAddress').text(data.address);
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
