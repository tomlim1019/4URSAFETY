@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $product->title }}</h1>
        @if(Auth::user()->role == 'customer' && Auth::user()->status == 'Approved')
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="handleButton({{ $product }})">Request for Purchasing</button>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$product->image) }}" class="card-img-top" width="300">
        </div>
        <div class="col-md-8">
            <div class="ml-4">
                <p>Product Name: {{ $product->title }}</p>
                <p>Product Description: {{ $product->description }}</p>
                <p>Category: {{ $product->category->name }}</p>
                <p>Product Price: {{ $product->price }}</p>
                <p>Product Tenure: {{ $product->tenure }} months</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Request for Purchasing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="requestModalForm" method="POST" action="{{ route('quotations.store') }}">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p id="modalContent"></p>
                            <input type="text" class="form-control" id="input_content" name="product_id" value="" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="requestModalButton">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleButton(product) {

      var label = document.getElementById('modalContent')
      label.innerHTML = `Request for purchasing <b>${product.title}</b>?` 
      
      var value = document.getElementById('input_content')
      value.value = product.id

      $('#requestModal').modal('show')
    }
</script>
@endsection