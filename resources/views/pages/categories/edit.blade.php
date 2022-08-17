@extends('layouts.app')
@include('layouts.components.sidebar')
@include('layouts.components.header')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit category - {{ $category->title }}</h1>
            <a href="{{ route('admin.categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i>
                Create new
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                    method="POST" enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input
                            value="{{ $category->title }}" type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            name="title" placeholder="Title" required
                        />
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div style="width: 600px; max-height: 600px" class="form-group">
                        <img src="{{ Storage::url($category->image) }}" class="img-thumbnail" alt="...">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop

@include('layouts.components.footer')
