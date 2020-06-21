@extends('layouts.app')

@section('content')

<div class="myCard">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

  <div class="row d-flex justify-content-between">
    <h1 class="h2 ml-4">New Product</h1>
        <a href="{{ route('customer.product') }}" class="btn btn-outline-secondary mr-4">view more >></a>
  </div>
  <div style= "padding: 0 0 0 0.75rem; margin-bottom:1.5rem;">
    <div class="row d-flex justify-content-around">
    @foreach($products as $product)
      <div class="myCard5 col-2">
        <div style = "text-align:center;">
        <img src="{{ asset('/storage/'.$product->image) }}" class="card-img-top" alt="...">
        </div>
          <div class="card-body">
              <h5 class="card-title">{{ $product->title }}</h5>
              <p class="card-text">Tenure: {{ $product->tenure }} months</p>
              <div style = "text-align:center;">
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">Learn More</a>
              </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
  <hr>

  @if(Auth::user()->status == 'Approved')
  <div class="row d-flex justify-content-between">
    <h1 class="h2 ml-4">My Product</h1>
    @if($logs->count() > 0)
      <a href="{{ route('customer.log') }}" class="btn btn-outline-secondary mr-4">view more >></a>
    @endif
  </div>
    <div class="row d-flex justify-content-around">
    @if($logs->count() < 1)
      <div class="card myCard5 col-10" style="border-radius:0;">
          <div class="card-body">
            <p class="text-center">Nothing to show</p>
          </div>
      </div>
    @else
    @foreach($logs as $log)
      <div class="card myCard5 col-5">
          <img src="{{ asset('/storage/'.$log->product->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{ $log->product->title }}</h5>
              <p class="card-text">Purchased on: {{ $log->created_at }}</p>
          </div>
          <a href="{{ route('logs.show', $log->id) }}" class="stretched-link"></a>
      </div>      
      @endforeach
      @endif
    </div>
  <hr>
    
  <div class="row d-flex justify-content-between">
    <h1 class="h2 ml-4">My Request</h1>
    @if($quotations->count() > 0)
        <a href="{{ route('customer.request') }}" class="btn btn-outline-secondary mr-4">view more >></a>
    @endif
  </div>
    <div class="row d-flex justify-content-around">
    @if($quotations->count() < 1)
      <div class="card myCard5 col-10" style="border-radius:0;">
          <div class="card-body">
            <p class="text-center">Nothing to show</p>
          </div>
      </div>
    @else
    @foreach($quotations as $request)
      <div class="card myCard5 col-5" style="width: 18rem; border-radius:0;">
          <img src="{{ asset('/storage/'.$request->product->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{ $request->product->title }}</h5>
              <p class="card-text">Status: {{ $request->status }}</p>
          </div>
          <a href="{{ route('quotations.show', $request->id) }}" class="stretched-link"></a>
      </div>
      @endforeach
      @endif
      </div>
  @endif

</div>

@endsection

@section('css')
<style>
</style>
@endsection