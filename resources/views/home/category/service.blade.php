@extends('layouts.client.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('client/lib/datatables/datatables.css')}}">
@endsection

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid py-5 mb-0 text-dark">
        <div class="container">
            <div class="row mb-5">
                <h1 class="h1 text-primary">{{$service->title}}</h1>
                <hr />
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
                <div class="col-md-4">
                    <img src="{{asset('uploads/service/'.$service->image)}}" alt="" class="img-fluid w-100 mb-3">
                    <p>
                        <span class="bg-secondary rounded-pill py-1 px-2 text-small">{{$category->title}}</span>
                    </p>
                </div>
                <div class="col-md-8">
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="freelancerDataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Stars</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($freelancer_services)
                                        @foreach ($freelancer_services->freelancers as $freelancer)
                                            <tr>
                                                <td>{{$freelancer->name}}</td>
                                                <td>{{$freelancer->mobile}}</td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $freelancer->reviews->stars)
                                                            <i class="fas fa-star text-secondary"></i> <!-- Full star icon -->
                                                        @else
                                                            <i class="far fa-star text-secondary"></i> <!-- Empty star icon -->
                                                        @endif
                                                    @endfor
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('client/lib/datatables/datatables.js')}}"></script>
    <script>
        new DataTable("#freelancerDataTable");
    </script>
@endsection