@extends('layouts.app')

@section('content')

<div class = "myClass">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
    </div>

    @foreach($categories as $category)
    <h1 class="h4">{{ $category->name }}</h1>
    <div class="row">
        @foreach($products as $product)
        @if($product->category_id == $category->id)
        <div class="card m-5" style="width: 18rem;">
            <img src="{{ asset('/storage/'.$product->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $product->title }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">Learn More</a>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endforeach
    
</div>
@endsection