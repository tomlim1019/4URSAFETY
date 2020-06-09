@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $log->product->title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$log->product->image) }}" class="card-img-top" width="300">
        </div>
        <div class="col-md-8">
            <div class="ml-4">
                <p>Name: {{ $log->user->name }}</p>
                <p>Email: {{ $log->user->email }}</p>
                <p>Identification No: {{ $log->user->id_no }}</p>
                <p>Birthdate: {{ $log->user->birthdate }}</p>
                <p>Gender: {{ $log->user->gender }}</p>
                <p>Product Name: {{ $log->product->title }}</p>
                <p>Product Description: {{ $log->product->description }}</p>
                <p>Category: {{ $log->product->category->name }}</p>
                <p>Product Price: {{ $log->product->price }}</p>
                <p>Product Tenure: {{ $log->product->tenure }} months</p>
                <p>Purchase at: {{ $log->created_at }}</p>
            </div>
        </div>
    </div>
@endsection