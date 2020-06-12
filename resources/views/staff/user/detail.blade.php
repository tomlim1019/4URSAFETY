@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ 'Customer Details'}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-primary mr-2" onclick="handleEdit({{ $customer }}, true)">Approve</button>
            <button type="button" class="btn btn-sm btn-outline-danger mr-2" onclick="handleEdit({{ $customer }}, false)">Reject</button>
            <button type="button" class="btn btn-sm btn-outline-secondary mr-2">Reset Password</button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="handleDelete({{ $customer }})">Delete</button>
        </div>
    </div>

    
    <img src="https://via.placeholder.com/150" class="mx-auto d-block pb-4">

    <div class="row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->email }}</p>
        </div>
    </div>

    <div class="row">
        <label for="id_no" class="col-md-4 col-form-label text-md-right">{{ __('Identification No. (Mykad/Passport)') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->id_no }}</p>
        </div>
    </div>

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->name }}</p>
        </div>
    </div>

    <div class="row">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->gender }}</p>
        </div>
    </div>

    <div class="row">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->birthdate }}</p>
        </div>
    </div>

    <div class="row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $customer->status }}</p>
        </div>
    </div>

    <div class="row">
        <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>

        <div class="col-md-6">
            <a href="{{ asset('/storage/'.$customer->document) }}" target="_blank" class="form-control">View Document</a>
        </div>
    </div>

    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="customerModalForm" method="POST" action="">
                @csrf
                <input id="form-method" type="hidden" name="_method" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <p id="modalContent"></p>
                            <input type="text" class="form-control" id="input_content" name="" value="" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="customerModalButton"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleEdit(user, x) {
      var form = document.getElementById('customerModalForm')
      form.action = '/customer/' + user.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'PUT'

      var title = document.getElementById('customerModalLabel')
      x === true ? title.innerHTML = 'Approve Customer' : title.innerHTML = 'Reject Customer'

      var label = document.getElementById('modalContent')
      x === true ? label.innerHTML = `Approve customer <b>${user.name} - ${user.email}</b>?` 
      : label.innerHTML = `Reject customer <b>${user.name} - ${user.email}</b>?` 
      
      var value = document.getElementById('input_content')
      value.name = 'status'
      x === true ? value.value = 'Approved' : value.value = 'Rejected'

      var button = document.getElementById('customerModalButton')
      x === true ? button.className = "btn btn-outline-primary" : button.className = "btn btn-outline-danger"
      x === true ? button.innerHTML = 'Approve' : button.innerHTML = 'Reject'

      $('#customerModal').modal('show')
    }
</script>

<script>
    function handleDelete(user) {
      var form = document.getElementById('customerModalForm')
      form.action = '/customer/' + user.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'DELETE'

      var title = document.getElementById('customerModalLabel')
      title.innerHTML = 'Delete Customer'

      var label = document.getElementById('modalContent')
      label.innerHTML = `Delete <b>${user.name} - ${user.email}</b>?`

      var button = document.getElementById('customerModalButton')
      button.className = "btn btn-outline-danger"
      button.innerHTML = "Delete"

      $('#customerModal').modal('show')
    }
</script>
@endsection