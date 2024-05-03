@extends('layouts.client.master')

@section('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid bg-primary pt-5">
        <div class="container py-5 mb-5">
            <h1 class="text-white">Dashboard</h1>
        </div>
    </div>
    <div class="container py-5">
        <div class="row mb-3">
            <div class="col-md-6 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="h3 text-primary mb-3">{{$service_partner->full_name}}</h3>
                        <p>
                            <strong>Company: </strong>{{$service_partner->company_name}}
                        </p>
                        <p>
                            <strong>Email: </strong>{{$service_partner->email}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="h3 text-primary">Services</h3>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#serviceModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <hr />

                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-12 p-3 d-flex align-items-center justify-content-between gap-2">
                                    <span class="">{{ $service->title }}</span>
                                    <a class="text-danger"
                                        href="{{ url('/partner/service/' . $service->id . '/delete') }}"><i class="fas fa-trash"></i></a>
                                </div>
                            @endforeach
                            <div class="mt-3 d-flex align-items-center justify-content-center">
                                {{$services->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <h3 class="h3 text-primary mb-3">Service Requests</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="serviceRequestTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service_requests as $sr)
                                        <tr>
                                            <td>{{ $sr->id }}</td>
                                            <td>{{ $sr->name }}</td>
                                            <td>{{ $sr->contact }}</td>
                                            <td>{{ $sr->address }}</td>
                                            <td>
                                                @if ($sr->status == '1')
                                                    <span class="badge bg-success">Complete</span>
                                                @else
                                                    <a href="{{ url('/partner/service/request/check/' . $sr->id) }}"
                                                        class="btn btn-success"><i class="fas fa-check"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3 class="h3 text-primary mb-3">Job Requests</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="jobRequestTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_requests as $jr)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ url('/partner/' . $service_partner->id . '/services/add') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="serviceModalLabel">Add new service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Title</label>
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Description</label>
                        <input class="form-control" type="text" name="description">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <input class="form-control" type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#serviceRequestTable').DataTable();
            $('#jobRequestTable').DataTable();
        });
    </script>
@endsection
