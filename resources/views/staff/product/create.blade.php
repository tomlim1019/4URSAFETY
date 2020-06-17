@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
        </h1>
    </div>

    <div class="container">
    @include('partials.errors')
        <form action="{{ isset($product) ? route ('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id='title' value="{{ isset($product) ? $product->title : '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control" >{{ isset($product) ? $product->description : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id='price' value="{{ isset($product) ? $product->price : '' }}">
            </div>

            <div class="form-group">
                <label for="tenure">Tenure</label>
                <select name="tenure" id="tenure" class="form-control">
                    <option value=""></option>
                    <option value="6" 
                    @if(isset($product))
                        @if($product->tenure === 6)
                            selected
                        @endif
                    @endif
                    >6 months</option>
                    <option value="12"
                    @if(isset($product))
                        @if($product->tenure === 12)
                            selected
                        @endif
                    @endif
                    >1 year</option>
                    <option value="24"
                    @if(isset($product))
                        @if($product->tenure === 24)
                            selected
                        @endif
                    @endif
                    >2 years</option>
                    <option value="60"
                    @if(isset($product))
                        @if($product->tenure === 60)
                            selected
                        @endif
                    @endif
                    >5 years</option>
                    <option value="120"
                    @if(isset($product))
                        @if($product->tenure === 120)
                            selected
                        @endif
                    @endif
                    >10 years</option>
                </select>
            </div>

            @if(isset($product))
                <div class="form-group">
                    <img src="{{ asset('/storage/'.$product->image) }}" alt="" style="width: 100%">
                </div>
            @endif

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id='image'>
            </div>

            <div class="form-group mb-4">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                <option value=""></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    @if(isset($product))
                        @if($category->id === $product->category_id)
                            selected
                        @endif
                    @endif
                    >
                    {{ $category->name }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-outline-primary">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
            </div>
        </form>
    </div>

@endsection
