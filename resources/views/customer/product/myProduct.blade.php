@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Product</h1>
    </div>

    @foreach($logs as $log)
    <div class="card m-4">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('/storage/'.$log->product->image) }}" class="card-img-top" alt="...">
            </div>
            <div class="col-md-9">
                <div class="mt-2">
                    <p class="card-text font-weight-bold">Product Name: {{ $log->product->title }}</p>
                    <p class="card-text font-weight-bold">Purchase at: {{ $log->created_at }}</p>
                    <p class="card-text font-weight-bold">Tenure: {{ $log->product->tenure }} months</p>
                </div>
            </div>
        </div>
        <a href=" {{ route('logs.show', $log->id) }}" class="stretched-link"></a>
    </div>
</div>
    @endforeach
@endsection