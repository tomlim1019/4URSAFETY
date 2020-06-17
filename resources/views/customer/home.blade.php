@extends('layouts.app')

@section('content')

<div class="myCard">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

  <div class="card mb-4">
  <h1 class="h2 ml-4 mt-4">New Product</h1>
    <div class="row">
    @foreach($products as $product)
      <div class="card mx-5 my-4" style="width: 18rem;">
      <img src="{{ asset('/storage/'.$product->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{ $product->title }}</h5>
              <p class="card-text">{{ $product->description }}</p>
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">Learn More</a>
          </div>
      </div>
      @endforeach
    </div>
  </div>

  @if(Auth::user()->status == 'Approved')
  <div class="card mb-4">
  <h1 class="h2 ml-4 mt-4">My Product</h1>
    <div class="row">
    @foreach($logs as $log)
      <div class="card mx-5 my-4" style="width: 18rem;">
          <img src="{{ asset('/storage/'.$log->product->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{ $log->product->title }}</h5>
              <p class="card-text">Purchased on: {{ $log->created_at }}</p>
          </div>
          <a href="{{ route('logs.show', $log->id) }}" class="stretched-link"></a>
      </div>
      @endforeach
    </div>
  </div>

  <div class="card mb-2">
  <h1 class="h2 ml-4 mt-4">My Request</h1>
    <div class="row">
    @foreach($quotations as $request)
      <div class="card ml-5 my-4" style="width: 18rem;">
          <img src="{{ asset('/storage/'.$request->product->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{ $request->product->title }}</h5>
              <p class="card-text">Status: {{ $request->status }}</p>
          </div>
          <a href="{{ route('quotations.show', $request->id) }}" class="stretched-link"></a>
      </div>
      @endforeach
  </div>
  @endif

</div>

@endsection

@section('css')
<style>
</style>
@endsection