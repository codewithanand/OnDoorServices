@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container">
            <div class="row mb-3">
                <h1 class="h1 text-primary">Call Request Form</h1>
            </div>

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

            <div class="container-fluid">
                <form action="{{url('/service/request/call')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h3 text-secondary mb-3">Primary Details</h3>
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="name" placeholder="Full Name">
                                        <label for="name">Full Name</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="category">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="service">Service</label>
                                        <select name="service_id" id="service" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" type="text" name="problem" placeholder="Describe Problem" style="height: 100px;"></textarea>
                                        <label for="problem">Describe Problem</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h3 text-secondary mb-3">Contact Details</h3>
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="mobile"
                                            placeholder="Mobile Number">
                                        <label for="contact">Mobile Number</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="state">State</label>
                                                <select name="state_code" id="state" class="form-control">
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->state_code }}">{{ $state->state_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="district">District</label>
                                                <select name="district_code" id="district" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="city">City</label>
                                                <select name="city_code" id="city" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="village">Village</label>
                                                <select name="village_code" id="village" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" type="text" name="address" placeholder="Address" style="height: 100px;"></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var category = $('#category');
            var service = $('#service');

            populateServices(category.val())

            category.change(function() {
                var categoryId = $(this).val();
                populateServices(categoryId);
            });

            function populateServices(categoryId){
                $.ajax({
                    url: 'http://localhost:8000/api/service/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        var options = '<option value="">Select a Service</option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.title + '</option>';
                            service.html(options);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load ' + type + 's. Error: ' + error);
                    }
                });
            }

            var state = $('#state');
            var district = $('#district');
            var city = $('#city');
            var village = $('#village');

            populateDropdown('district', state.val(), district);
            resetDropdowns('city', 'village');

            state.change(function() {
                var stateCode = $(this).val();
                populateDropdown('district', stateCode, district);
                resetDropdowns('city', 'village');
            });

            district.change(function() {
                var districtCode = $(this).val();
                populateDropdown('city', districtCode, city);
                resetDropdowns('village');
            });

            city.change(function() {
                var cityCode = $(this).val();
                populateDropdown('village', cityCode, village);
            });

            function populateDropdown(type, code, dropdown) {
                $.ajax({
                    url: 'http://localhost:8000/api/address/' + type + '/' + code,
                    type: 'GET',
                    success: function(response) {
                        var options = '<option value="">Select ' + type.charAt(0).toUpperCase() + type
                            .slice(1) + '</option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value[type + '_code'] + '">' + value[
                                type + '_name'] + '</option>';
                        });
                        dropdown.html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load ' + type + 's. Error: ' + error);
                    }
                });
            }

            function resetDropdowns(...dropdownIds) {
                dropdownIds.forEach(function(id) {
                    $('#' + id).html('<option value="">Select ' + id.charAt(0).toUpperCase() + id.slice(1) +
                        '</option>');
                });
            }
        });
    </script>
@endsection
