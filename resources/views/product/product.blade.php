@extends('layouts.app')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-secondary" >Add Product</a>
        </div>
    </div>

    <div class="container">
        <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Tenure</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->tenure }}</td>
                        <td>
                          <img src="{{ asset($product->image) }}" width="120px" height="60px" alt="">
                        </td>
                        <td>{{ $product->category }}</td>
                        <td class="ml-auto">
                            <button type="button" class="btn btn-danger btn-sm mr-2" onclick="handleDelete({{ $product }})">Delete</button>
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-secondary" >Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="categoryModalForm" method="POST" action="">
      @csrf
      <input id="form-method" type="hidden" name="_method" value="">
        <div class="modal-body">
            <div class="form-group">
                <label id="modal-label" for="title" class="col-form-label">Product Title</label>
                <input type="text" class="form-control" id="input_name" name="title">

                <label id="modal-label" for="description" class="col-form-label">Product Description</label>
                <textarea cols="5" rows="5" class="form-control" id="input_description" name="description"></textarea>

                <label id="modal-label" for="price" class="col-form-label">Product Price</label>
                <input type="text" class="form-control" id="input_price" name="price">

                <label id="modal-label" for="tenure" class="col-form-label">Product Tenure</label>
                <input type="text" class="form-control" id="input_tenure" name="tenure">

                <label id="modal-label" for="image" class="col-form-label">Product Image</label>
                <input type="file" class="form-control" id="input_image" name="image">

                <label id="modal-label" for="category" class="col-form-label">Product Category</label>
                <select type="text" class="form-control" id="input_category" name="category">
                  <option value="a">asd</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="modal-button"></button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
          $('#categoryTable').DataTable();
    });
</script>

<script>
    function handleEdit(category) {
      var form = document.getElementById('categoryModalForm')
      form.action = '/categories/' + category.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'PUT'

      var title = document.getElementById('categoryModalLabel')
      title.innerHTML = 'Edit Category'

      var label = document.getElementById('modal-label')
      label.innerHTML = `Category Name`

      var value = document.getElementById('input_name')
      value.value = `${category.name}`

      var button = document.getElementById('modal-button')
      button.className = "btn btn-outline-primary"
      button.innerHTML = "Update"

      $('#categoryModal').modal('show')
    }
</script>

<script>
    function handleCreate() {
      var form = document.getElementById('categoryModalForm')
      form.action = '/product'

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'POST'

      var title = document.getElementById('categoryModalLabel')
      title.innerHTML = 'Create New Product'

      var value = document.getElementById('input_name')
      value.value = ""

      var button = document.getElementById('modal-button')
      button.className = "btn btn-outline-primary"
      button.innerHTML = "Create"

      $('#categoryModal').modal('show')
    }
</script>

<script>
    function handleDelete(category) {
      var form = document.getElementById('categoryModalForm')
      form.action = '/categories/' + category.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'DELETE'

      var title = document.getElementById('categoryModalLabel')
      title.innerHTML = 'Delete Category'

      var label = document.getElementById('modal-label')
      label.innerHTML = `Please enter DELETE to delete category <b>${category.name}</b>`

      var value = document.getElementById('input_name')
      value.value = ""

      var button = document.getElementById('modal-button')
      button.className = "btn btn-outline-danger"
      button.innerHTML = "Delete"

      $('#categoryModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></style>
@endsection