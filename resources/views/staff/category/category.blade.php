@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="handleCreate()">Add Category</button>
        </div>
    </div>

    <div>
        <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="ml-auto">
                            <button type="button" class="btn btn-outline-danger btn-sm mr-2" onclick="handleDelete({{ $category }})">Delete</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="handleEdit({{ $category }})">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
                <label id="modal-label" for="name" class="col-form-label"></label>
                <input type="text" class="form-control" id="input_name" name="name">
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
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
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
      value.hidden = false
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
      form.action = '/categories'

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'POST'

      var title = document.getElementById('categoryModalLabel')
      title.innerHTML = 'Create New Category'

      var label = document.getElementById('modal-label')
      label.innerHTML = `Category Name`

      var value = document.getElementById('input_name')
      value.hidden = false
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
      value.hidden = true

      var button = document.getElementById('modal-button')
      button.className = "btn btn-outline-danger"
      button.innerHTML = "Delete"

      $('#categoryModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
<style>
.btn {
        color: #FFFFFF;
}
</style>
@endsection