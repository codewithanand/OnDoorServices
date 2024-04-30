@extends('layouts.client.master')
@section('content')
    <div class="container-fluid hero-header bg-primary mb-0 text-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow p-3">
                        <h3 class="h3 text-center mb-3">Add a service</h3>
                        <form action="{{ url('/partner/' . $service_partner->id . '/services/add') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
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
                            <div class="form-group mb-3">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow p-3">
                        @if (count($services) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="h4 text-secondary">Services</h4>
                                    <hr>
                                </div>
                                <div class="form-group col-md-12">
                                    @foreach ($services as $service)
                                        <label class="form-control">{{ $service->title }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ url('/') }}" class="btn btn-success">Finish</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
