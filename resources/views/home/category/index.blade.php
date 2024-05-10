@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="row mb-5 mx-4">
            <h1 class="h1 text-primary">{{ $category->title }}</h1>
            <hr />
        </div>

        @if (session('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row d-flex align-items-center justify-content-center flex-wrap gap-2 mb-3">
                @foreach ($services as $item)
                    <div class="col-md-2 card">
                        <img src="{{ asset('uploads/service/' . $item->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="height: 50px; overflow-y: hidden;">{{ $item->title }}</h5>
                            <a href="{{ url('/services/'.$category->slug.'/' . $item->slug) }}" class="btn btn-primary px-4">View</a>
                        </div>
                    </div>
                @endforeach
            <div class="d-flex align-items-center justify-content-center mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection
