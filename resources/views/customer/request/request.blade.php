@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Requests</h1>
    </div>

    @foreach($quotations as $request)
    <div class="card m-4">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('/storage/'.$request->product->image) }}" class="card-img-top" alt="...">
            </div>
            <div class="col-md-9">
                <div class="m-4">
                    <p class="card-text font-weight-bold">Product Name: {{ $request->product->title }}</p>
                    <p class="card-text font-weight-bold">Status: {{ $request->status }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('quotations.show', $request->id) }}" class="stretched-link"></a>
    </div>
</div>
    @endforeach
@endsection