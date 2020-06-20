@extends('layouts.app')

@section('content')

<div class = "myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Purchase Log for {{ $user->name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    @if($user->image)
    <img src="{{ asset('/storage/'.$user->image) }}" class="mx-auto d-block pb-4" style="width: 150px">
    @else
    <img src="https://www.pngitem.com/pimgs/m/99-998739_dale-engen-person-placeholder-hd-png-download.png" class="mx-auto d-block pb-4" style="width: 150px">
    @endif

    <div class="row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $user->email }}</p>
        </div>
    </div>

    <div class="row">
        <label for="id_no" class="col-md-4 col-form-label text-md-right">{{ __('Identification No. (Mykad/Passport)') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $user->id_no }}</p>
        </div>
    </div>

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $user->name }}</p>
        </div>
    </div>

    <div class="row">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $user->gender }}</p>
        </div>
    </div>

    <div class="row">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $user->birthdate }}</p>
        </div>
    </div>

    <div class="row">
        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Product Title') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $product->title }}</p>
        </div>
    </div>

    <div class="row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $product->description }}</p>
        </div>
    </div>

    <div class="row">
        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Product Price') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $product->price }}</p>
        </div>
    </div>

    <div class="row">
        <label for="tenure" class="col-md-4 col-form-label text-md-right">{{ __('Product Tenure') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $product->tenure }}</p>
        </div>
    </div>

    <div class="row">
        <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $product->category->name }}</p>
        </div>
    </div>

    <div class="row">
        <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Purchase at') }}</label>

        <div class="col-md-6">
            <p class="form-control">{{ $log->created_at }}</p>
        </div>
    </div>

<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="requestModalForm" method="POST" action="">
      @csrf
      @method('PUT')
        <div class="modal-body">
            <div class="form-group">
                <p id="textLabel"></p>
                <input id="form-input" value="" name="status" hidden>
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
<script>
    function handleApprove(quotation) {
      var form = document.getElementById('requestModalForm')
      form.action = '/quotations/' + quotation.id

      var title = document.getElementById('requestModalLabel')
      title.innerHTML = 'Approve Request'

      var label = document.getElementById('textLabel')
      label.innerHTML = `Approve this Request?`

      var data = document.getElementById('form-input')
      data.value='Approved'

      var button = document.getElementById('modal-button')
      button.className = 'btn btn-outline-primary'
      button.innerHTML = 'Approve'

      $('#requestModal').modal('show')
    }
</script>

<script>
    function handleReject(quotation) {
      var form = document.getElementById('requestModalForm')
      form.action = '/quotations/' + quotation.id

      var title = document.getElementById('requestModalLabel')
      title.innerHTML = 'Reject Request'

      var label = document.getElementById('textLabel')
      label.innerHTML = `Reject this Request?`

      var data = document.getElementById('form-input')
      data.value='Rejected'

      var button = document.getElementById('modal-button')
      button.className = "btn btn-outline-danger"
      button.innerHTML = "Reject"

      $('#requestModal').modal('show')
    }
</script>
@endsection