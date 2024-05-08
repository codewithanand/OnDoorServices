@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container">
            <div class="row mb-3">
                <h1 class="h1 text-primary">Registration Form</h1>
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
                <form action="{{url('/freelancer/register')}}" method="post" enctype="multipart/form-data">
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
                                    <div class="form-floating mt-3">
                                        <input class="form-control" type="text" name="qualification" placeholder="Highest Qualification">
                                        <label for="qualification">Highest Qualification</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="gender">Gender</label>
                                        <div>
                                            <input type="radio" name="gender" value="male"> <span>Male</span>
                                            <input type="radio" name="gender" value="female"> <span>Female</span>
                                            <input type="radio" name="gender" value="other"> <span>Other</span>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-3">
                                        <input class="form-control" type="date" name="date_of_birth" placeholder="Date of Birth">
                                        <label for="date_of_birth">Date of Birth</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="">Working?</label>
                                        <select class="form-control" name="working" id="working">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div id="form_company" class="form-floating mt-3">
                                        <input class="form-control" type="text" name="company" placeholder="Company Name">
                                        <label for="company">Company Name</label>
                                    </div>
                                    <div id="form_position" class="form-floating mt-3">
                                        <input class="form-control" type="text" name="position" placeholder="Position">
                                        <label for="position">Position</label>
                                    </div>
                                    <div id="form_experience" class="form-floating mt-3">
                                        <input class="form-control" type="number" name="experience" placeholder="Experience">
                                        <label for="experience">Experience</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="image">Photo (<span class="text-danger">Passport size photo</span>)</label>
                                        <input class="form-control" type="file" name="image" placeholder="Photo">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="id_proof">Id Proof (<span class="text-danger">Any goverment id</span>)</label>
                                        <input class="form-control" type="file" name="id_proof" placeholder="Id Proof">
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
                                    <div class="form-floating mt-3">
                                        <input class="form-control" type="text" name="altphone" placeholder="Alternate Phone Number">
                                        <label for="altphone">Alternate Phone Number</label>
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
                        <div class="col-12 mb-3">
                            <input type="checkbox" name="agree"> <span>By checking, you are confirming that you have read, understood and agree to OnDoorService <a href="#">terms and conditions</a></span>
                        </div>
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
            var isWorking = $('#working');
            var company = $('#form_company');
            var position = $('#form_position');
            var experience = $('#form_experience');

            toggleFormGroups();
            isWorking.change(function(){
                toggleFormGroups();
            });

            function toggleFormGroups(){
                if(isWorking.val() == "0"){
                    company.hide();
                    position.hide();
                    experience.hide();
                }
                else{
                    company.show();
                    position.show();
                    experience.show();
                }
            }

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
