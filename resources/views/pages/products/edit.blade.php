@extends('layouts.app')
@include('layouts.components.sidebar')
@include('layouts.components.header')

@section('container')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit product - {{ $product->title }}</h1>
            <a href="{{ route('admin.products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                    action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                    method="POST" enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input
                                value="{{ $product->title }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                            />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Price</label>
                            <input
                                value="{{ $product->price }}" type="text"
                                class="form-control @error('price') is-invalid @enderror" name="price"
                            />
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                @foreach($categories as $category)
                                    <option
                                        @selected($product->category_id == $category->id)
                                        value="{{ $category->id }}"
                                    >
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div style="width: 600px; max-height: 600px" class="form-group">
                        <img src="{{ Storage::url($product->image) }}" class="img-thumbnail" alt="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label>
                        <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Preview description</label>
                            <textarea name="preview_desc" class="ckeditor" required>
                                {{ $product->preview_desc }}
                            </textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Body text</label>
                            <textarea name="body" class="ckeditor" required>
                                {{ $product->body }}
                            </textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop

@include('layouts.components.footer')
