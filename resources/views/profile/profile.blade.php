@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        @if($profile->status == 'Rejected')
        <button class="btn btn-sm btn-outline-secondary mr-2" onclick="handleRequest({{ $profile }})">Request Approval</button>
        @endif
        <button class="btn btn-sm btn-outline-secondary mr-2" onclick="handleUpload({{ $profile }}, 'picture')">Upload Image</button>
        <button class="btn btn-sm btn-outline-secondary" onclick="resetPassword({{ $profile }})">Change Password</button>
        </div>
    </div>

    <div>
    <img src="{{ asset('/storage/'.$profile->image) }}" class="mx-auto d-block pb-4" style="width: 150px">

    <div class="row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->email }}</p>
        </div>
    </div>

    <div class="row">
        <label for="id_no" class="col-md-4 col-form-label text-md-right">{{ __('Identification No. (Mykad/Passport)') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->id_no }}</p>
        </div>
    </div>

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->name }}</p>
        </div>
    </div>

    <div class="row">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->gender }}</p>
        </div>
    </div>

    <div class="row">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->birthdate }}</p>
        </div>
    </div>

    <div class="row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $profile->status }}</p>
        </div>
    </div>

    <div class="row">
        <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>

        <div class="col-md-3">
            <a href="{{ asset('/storage/'.$profile->document) }}" target="_blank" class="form-control">View Document</a>
        </div>
        @if($profile->status != 'Approved')
        <div class="col-md-3">
            <button class="btn btn-sm btn-outline-secondary mr-2" onclick="handleUpload({{ $profile }}, 'document')">Upload Document</button>
        </div>
        @endif
    </div>
</div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="uploadModalForm" method="POST" action="" enctype="multipart/form-data">
      @csrf
      <input id="form-method" type="hidden" name="_method" value="">
        <div class="modal-body">
            <div class="form-group">
                <label id="modal-label" for="name" class="col-form-label">Image: </label>
                <input type="file" class="form-control" id="input_name" name="image" required>
            </div>
        </div>
        <div class="modal-footer">            
            <button type="submit" class="btn btn-outline-primary" id="modal-button">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="passwordResetForm" method="POST" action="" enctype="multipart/form-data">
      @csrf
      <input id="form-method-1" type="hidden" name="_method" value="">
        <div class="modal-body">
            <div class="form-group">
                <label id="modal-label-1" for="name" class="col-form-label">Current Password: </label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label id="modal-label-2" for="name" class="col-form-label">New Password: </label>
                <input type="password" class="form-control" id="new-password" name="newPassword" required>
            </div>
            <div class="form-group">
                <label id="modal-label-3" for="name" class="col-form-label">Confirm Password: </label>
                <input type="password" class="form-control" id="confirm-password" name="confirmPassword" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary" id="modal-button">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Request Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="requestForm" method="POST" action="">
      @csrf
      @method('PUT')
        <div class="modal-body">
            <div class="form-group">
                <label id="modal-label" for="name" class="col-form-label">Request for Account Approval?</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-primary" id="modal-button">Request</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    function handleUpload(profile, x) {
      console.log(x)
      var form = document.getElementById('uploadModalForm')
      form.action = `/profile/${x}/` + profile.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'PUT'

      var title = document.getElementById('uploadModalLabel')
      title.innerHTML = `Upload ${x}`

      var label = document.getElementById('modal-label')
      label.innerHTML = `${x}:`

      var input = document.getElementById('input_name')
      input.name = x

      $('#uploadModal').modal('show')
    }
</script>

<script>
    function resetPassword(profile) {
      var form = document.getElementById('passwordResetForm')
      form.action = '/password/' + profile.id

      var formMethod = document.getElementById('form-method-1')
      formMethod.value = 'PUT'

      $('#resetModal').modal('show')
    }
</script>

<script>
    function handleRequest(profile) {
      var form = document.getElementById('requestForm')
      form.action = '/profile/request/' + profile.id

      $('#requestModal').modal('show')
    }
</script>
@endsection

@section('css')
<style>
   a {
        color:#0C2340;
   } 

   a:hover{ 
       text-decoration:none; 
    }
</style>
@endsection