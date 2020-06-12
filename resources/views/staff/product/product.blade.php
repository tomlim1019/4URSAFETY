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
                        <td>{{ $product->category->name }}</td>
                        <td class="ml-auto">
                            <button type="button" class="btn btn-danger btn-sm mr-2" onclick="handleDelete({{ $product }})">Deactivate</button>
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
      @method('DELETE')
      <input id="form-method" type="hidden" name="_method" value="">
        <div class="modal-body">
            <div class="form-group">
                <p>Are you sure you want to delete this product?</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="modal-button">Delete</button>
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
      form.action = '/products/' + product.id

      $('#deleteModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endsection