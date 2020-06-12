@extends('layouts.app')

@section('content')

<div class="myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Requests</h1>
    </div>

    <div>
        <table class="table table-bordered" id="requestTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>User Email</th>
                    <th>Product Title</th>
                    <th>status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $quotation)
                    <tr>
                        <td>{{ $quotation->user->email }}</td>
                        <td>{{ $quotation->product->title }}</td>
                        <td 
                        @if($quotation->status === 'Rejected')
                        class="text-danger"
                        @elseif($quotation->status === 'Approved')
                        class="text-success"
                        @endif
                         >{{ $quotation->status }}</td>
                        <td>{{ $quotation->created_at }}</td>
                        <td>{{ $quotation->updated_at }}</td>
                        <td class="ml-auto">
                            <a href="{{ route('quotations.edit', $quotation) }}" class="btn btn-sm btn-outline-secondary" >View</a>
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
          $('#requestTable').DataTable();
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
