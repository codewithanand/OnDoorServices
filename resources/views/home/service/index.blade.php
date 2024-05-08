@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container">
            <div class="row mb-3">
                <h1 class="h1 text-primary">{{$service->title}}</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{session('error')}}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('uploads/service/'.$service->image)}}" alt="" class="img-fluid mb-3">
                    <p>
                        <span class="text-muted">{{$category->title}}</span>
                    </p>
                    @if ($service->service == 1)
                        <p>
                            {{$service->description}}
                        </p>
                    @endif
                    <p>
                        Post by: <strong>{{$service_partner->company_name}}</strong>
                    </p>
                </div>
                <div class="col-md-6">

                    @if ($service->service == 0)
                        <p class="mb-3">
                            {{$service->description}}
                        </p>
                        <p class="lead mb-3">
                            Expected salary: <span class="text-danger">{{$service->price}}</span>
                        </p>
                        <a href="{{url('/job/apply/id')}}" class="btn btn-primary px-4 py-3">Apply Now</a>
                    @endif

                    @if ($service->service == 1)
                        <form action="{{url('/service/request/'.$service->id)}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="service_name">
                                <label for="">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="service_contact">
                                <label for="">Contact</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" style="height: 100px;" name="service_address"></textarea>
                                <label for="">Address</label>
                            </div>
                            <div class="mb-3">
                                <h3 class="h3 text-danger">{{$service->price}}</h3>
                            </div>
                            <button class="btn btn-primary px-4 py-3">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection