@extends('layouts.app')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Product</h1>
    </div>

    <div class="container">
    @include('partials.errors')
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id='title' value="">
            </div>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id='price' value="">
            </div>

            <div class="form-group">
                <label for="tenure">Tenure</label>
                <select name="tenure" id="tenure" class="form-control">
                    <option value=""></option>
                    <option value="6">6 months</option>
                    <option value="12">1 year</option>
                    <option value="24">2 years</option>
                    <option value="60">5 years</option>
                    <option value="120">10 years</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id='image'>
            </div>

            <div class="form-group mb-4">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                <option value=""></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                    {{ $category->name }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-outline-primary">Create Product</button>
            </div>
        </form>
    </div>
</main>

@endsection
