@extends('layouts.app')

@section('content')
<div class="myCard">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

  <div class="row mt-4 mb-5 mx-4 d-flex justify-content-between">
    <div class="card" style="width: 18rem; background-color: rgb(119,171,89); color: white; border-radius:0px;">
      <div class="card-body">
        <h5 class="card-title text-center">Sales</h5>
        <p class="card-text text-center">{{ $sales }}</p>
      </div>
      <a href="{{ route('logs.index') }}" class="stretched-link"></a>
    </div>
    <div class="card" style="width: 18rem; background-color: rgb(249,201,3); color: white; border-radius:0px;">
      <div class="card-body text-center">
        <h5 class="card-title">Pending Request</h5>
        <p class="card-text text-center">{{ $pendingRequest }}</p>
      </div>
      <a href="{{ route('quotations.index') }}" class="stretched-link"></a>
    </div>
    <div class="card" style="width: 18rem; background-color: rgb(249,109,108); color: white; border-radius:0px;">
      <div class="card-body text-center">
        <h5 class="card-title">Pending Customer</h5>
        <p class="card-text text-center">{{ $pendingCustomer }}</p>
      </div>
      @if(Auth::user()->role=='admin')
      <a href="{{ route('customer') }}" class="stretched-link"></a>
      @endif
    </div>
  </div>
</div>

<div class="myCard">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Current Listing Products</h1>
      </div>
      <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>Product ID</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Tenure</th>
                  <th>Category</th>
              </tr>
          </thead>
          <tbody>
              @foreach($products as $product)
                  <tr>
                      <td>{{ $product->product_id }}</td>
                      <td>{{ $product->title }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->tenure }}</td>
                      <td>{{ $product->category->name }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

<script>
    $(document).ready(function() {
          $('#productTable').DataTable();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endsection