@extends('layouts.client.master')

@section('content')
    <div class="container py-md-5"></div>
    <div class="container-fluid bg-primary pt-5">
        <div class="container py-5 mb-5">
            <h1 class="text-white">Dashboard</h1>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6 p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="h3 text-primary">Services</h3>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#serviceModal"><i
                            class="fas fa-plus"></i></button>
                </div>
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-12 border rounded-pill p-3 d-flex align-items-center justify-content-between mb-3">
                            <span class="">{{ $service->title }}</span>
                            <a class="text-danger" href="{{ url('/partner/service/' . $service->id . '/delete') }}"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    @endforeach
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
