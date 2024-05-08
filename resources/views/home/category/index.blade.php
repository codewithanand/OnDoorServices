@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container">
            <div class="row mb-3">
                <h1 class="h1 text-primary">{{$category->title}}</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row mb-3">
                @foreach ($services as $item)
                    <div class="col-md-3 card mx-2">
                            <img src="{{asset('uploads/service/'.$item->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="height: 50px; overflow-y: hidden;">{{$item->title}}</h5>
                                <p class="card-text text-danger">{{$item->price}}</p>
                                <a href="{{url('/service/'.$item->id)}}" class="btn btn-primary px-4">View</a>
                            </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex align-items-center justify-content-center">
                {{$services->links()}}
            </div>
        </div>
    </div>
@endsection