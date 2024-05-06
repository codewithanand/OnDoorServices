@extends('layouts.client.master')
@section('content')
    <div class="container-fluid bg-primary hero-header mb-0">
        <div class="container-fluid px-lg-5">
            {{-- Register  --}}
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('client/img/register.png') }}" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 text-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="text-center text-white mb-3">Sign Up</h2>

                        {{-- Name Input  --}}
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Your Name" name="name" value="{{ old('name') }}" required
                                autocomplete="name" autofocus />
                            <label class="form-label" for="name">{{ __('Name') }}</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter a valid email address" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus />
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Enter password" />
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Confirm Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required
                                autocomplete="new-password" placeholder="Enter password" />
                            <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="user-type">Select User Type</label>
                            <select class="form-select" name="role">
                                <option value="3">JOB Seeker</option>
                                <option value="2">JOB Provider</option>
                            </select>
                        </div>
                        
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Register') }}</button>

                            <p class="small fw-bold mt-2 pt-1 mb-0">If an account? <a href="{{ route('login') }}"
                                    class="link-danger">Login</a>
                            </p>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Register end  --}}
@endsection
