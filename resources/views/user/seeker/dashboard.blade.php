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
                    <div class="card card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="city" class="form-control" id="cityDropDown">

                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="category" class="form-control" id="categoryDropDown">
                                    <option value="0">Select a category</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
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
                    url: "http://localhost:8000/api/cities",
                    dataType: 'json',
                    delay: 250,
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

            $('.view-btn').each(function() {
                $(this).click(function() {
                    populateAppointmentDetails($(this).data('customer-id'));

                });
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
                                <a href="#" class="btn btn-success"><i class="fas fa-check"></i> Book</a>
                            </div>
                        </div>
                    `);
                });
            }


            function populateAppointmentDetails($appointmentId) {
                console.log($appointmentId)
                $('#modalCustomerName').html('');
                $('#modalCustomerMobile').html('');
                $('#modalCustomerProblem').html('');
                $.ajax({
                    url: "http://localhost:8000/api/appointments/" + $appointmentId,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        $('#modalCustomerName').append(data.name);
                        $('#modalCustomerMobile').append(data.mobile);
                        $('#modalCustomerProblem').append(data.problem);
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
