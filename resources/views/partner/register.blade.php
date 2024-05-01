@extends('layouts.client.master')
@section('content')
    <div class="container-fluid hero-header bg-primary mb-0 text-dark">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mt-5 mb-4 pb-0 pb-md-0 mb-md-1 text-center">Service Partner</h3>
                        <h5 class="mb-4 pb-0 pb-md-0 mb-md-1 text-center">Are you interested in becoming a service partner
                            with us?</h5>
                        <p class="pb-md-5 justify-content-center align-items-center text-center">Take advantage of this
                            exceptional opportunity to become a partner in your local area.</p>
                        <form class="px-md-2 text-dark" action={{url('/partner/register')}} method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="firstName">Full Name</label>
                                        <input type="text" id="full_name" class="form-control form-control-lg"
                                            name="full_name" placeholder="Enter Your Name"/>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="lastName">Father Name</label>
                                        <input type="text" id="father_name" class="form-control form-control-lg"
                                            name="father_name" placeholder="Enter Your Father Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="firstName">Company Name</label>
                                        <input type="text" id="company_name" class="form-control form-control-lg"
                                            name="company_name" placeholder="Company or Agency Name "/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">
                                    <div class="form-group w-100">
                                        <label for="dob">DOB</label>
                                        <input type="date" class="form-control form-control-lg" id="dob"
                                            name="dob" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                                        <label class="mb-0 me-4">Gender:</label>
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="partnerGender"
                                                id="maleGender" value="male" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="partnerGender"
                                                 value="female" />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="radio" name="partnerGender"
                                                id="otherGender" value="other" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="emailAddress">Email</label>
                                        <input type="email" id="emailAddress" class="form-control form-control-lg"
                                            name="email" placeholder="Ex: companyname@gmail.com" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="tel" id="phoneNumber" class="form-control form-control-lg"
                                            name="phone_number" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 mb-4 pb-1">
                                    <select class="select form-control" name="country">
                                        <option value="1">Country</option>
                                        <option value="2">Option 1</option>
                                        <option value="3">Option 2</option>
                                        <option value="4">Option 3</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4 pb-1">
                                    <select class="select form-control" name="state">
                                        <option value="1">State</option>
                                        <option value="2">Option 1</option>
                                        <option value="3">Option 2</option>
                                        <option value="4">Option 3</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4 pb-1">
                                    <select class="select form-control" name="city">
                                        <option value="1">City</option>
                                        <option value="2">Option 1</option>
                                        <option value="3">Option 2</option>
                                        <option value="4">Option 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <input type="text" class="form-control form-control-lg" name="address" placeholder="Address"></input>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="experience">Experience year</label>
                                        <input type="int" id="" class="form-control form-control-lg"
                                            name="experience_year" placeholder="Enter Your Experience Year." />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="formFileLg">Upload Id Proof</label>
                                        <input class="form-control form-control-lg" name="image" type="file" />
                                        <div class="small text-muted mt-2">Upload your Id or any other relevant file. Max
                                            file size 50 MB</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-2 d-flex justify-content-center align-items-center">
                                <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                    type="submit" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
