@extends('layouts.app')

@section('content')
<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('customer.product') }}" class="btn btn-sm btn-outline-secondary" >Preview Product</a>
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-secondary ml-2" >Add Product</a>
        </div>
    </div>

    <div>
        <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Tenure</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->tenure }}</td>
                        <td
                        @if($product->status === 'Active')
                        class="text-success"
                        @else
                        class="text-danger"
                        @endif
                        >{{ $product->status }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="ml-auto">
                            @if($product->status === 'Active')
                            <button type="button" class="btn btn-outline-danger btn-sm mr-2" onclick="handleDelete({{ $product }})">Deactivate</button>
                            @else
                            <button type="button" class="btn btn-outline-primary btn-sm mr-2" onclick="handleDelete({{ $product }})">Activate</button>
                            @endif 
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary" >Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteModalForm" method="POST" action="">
      @csrf
      @method('PUT')
        <div class="modal-body">
            <div class="form-group">
                <p id="description">Are you sure you want to delete this product?</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="modal-button"></button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

<script>
    $(document).ready(function() {
          $('#productTable').DataTable();
    });
</script>

<script>
    function handleDelete(product) {
      var form = document.getElementById('deleteModalForm')
      form.action = '/products/' + product.id + '/status'

      var label = document.getElementById('deleteModalLabel')
      product.status == 'Active' ? label.innerHTML = 'Deactivate Product' : label.innerHTML = 'Activate Product'

      var des = document.getElementById('description')
      product.status == 'Active' ? 
      des.innerHTML = 'Are you sure you want to deactivate this product' : 
      des.innerHTML = 'Are you sure you want to activate this product'

      var button = document.getElementById('modal-button')
      product.status == 'Active' ? button.className = 'btn btn-danger' : button.className = 'btn btn-primary'
      product.status == 'Active' ? button.innerHTML = 'Deactivate' : button.innerHTML = 'Activate'

      $('#deleteModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endsection