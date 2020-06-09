@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $request->product->title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="handleDelete({{ $request }}, {{ $request->product }})">Delete</button>
            @if($request->status=='Approved')
            <button type="button" class="btn btn-sm btn-outline-secondary ml-2" onclick="handlePurchase({{ $request }}, {{ $request->product }})">Purchase</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$request->product->image) }}" class="card-img-top" width="300">
        </div>
        <div class="col-md-8">
            <div class="ml-4">
                <p>Name: {{ $request->user->name }}</p>
                <p>Email: {{ $request->user->email }}</p>
                <p>Identification No: {{ $request->user->id_no }}</p>
                <p>Birthdate: {{ $request->user->birthdate }}</p>
                <p>Gender: {{ $request->user->gender }}</p>
                <p>Product Name: {{ $request->product->title }}</p>
                <p>Product Description: {{ $request->product->description }}</p>
                <p>Category: {{ $request->product->category->name }}</p>
                <p>Product Price: {{ $request->product->price }}</p>
                <p>Product Tenure: {{ $request->product->tenure }} months</p>
                <p>Request Status: {{ $request->status }}</p>
            </div>
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
                    <input id="form-method" type="hidden" name="_method" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <p id="modalContent"></p>
                            <input type="text" class="form-control" id="input_content" name="" value="" hidden>
                            <input type="text" class="form-control" id="input_content_2" name="" value="" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="requestModalButton"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function handleDelete(request, product) {
        var form = document.getElementById('requestModalForm')
        form.action = '/quotations/' + request.id

        var formMethod = document.getElementById('form-method')
        formMethod.value = 'DELETE'

        var formLabel = document.getElementById('requestModalLabel')
        formLabel.innerHTML = 'Delete Request'

        var label = document.getElementById('modalContent')
        label.innerHTML = `Delete <b>${product.title}</b>?` 

        var button = document.getElementById('requestModalButton')
        button.class = 'btn btn-danger'
        button.innerHTML = 'Delete'

        $('#requestModal').modal('show')
    }
</script>

<script>
    function handlePurchase(request, product) {
        var form = document.getElementById('requestModalForm')
        form.action = '/logs/'

        var formMethod = document.getElementById('form-method')
        formMethod.value = 'POST'

        var formLabel = document.getElementById('requestModalLabel')
        formLabel.innerHTML = 'Purchase product'

        var label = document.getElementById('modalContent')
        label.innerHTML = `Purchase <b>${product.title}</b>?` 

        var value = document.getElementById('input_content')
        value.name = 'product_id'
        value.value = product.id

        var value = document.getElementById('input_content_2')
        value.name = 'request_id'
        value.value = request.id

        var button = document.getElementById('requestModalButton')
        button.class = 'btn btn-primary'
        button.innerHTML = 'Purchase'

        $('#requestModal').modal('show')
    }
</script>
@endsection