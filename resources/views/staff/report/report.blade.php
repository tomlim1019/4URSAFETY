@extends('layouts.app')

@section('content')
<div class="myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reports</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <h1 class="h3 mb-4 pb-4 border-bottom">Product</h1>
        <table class="table table-bordered" id="logTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Created at</th>
                    <th>Sales</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->product->title }}</td>
                        <td>{{ $log->product->created_at }}</td>
                        <td>{{ $log->number }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="card p-4 mb-4">
        <h1 class="h3 mb-4 pb-4 border-bottom">Pending Request</h1>
        <table class="table table-bordered" id="pendingRequestTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Created at</th>
                    <th>Pending Request</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($pendingRequests as $pendingRequest)
                    <tr>
                        <td>{{ $pendingRequest->product->title }}</td>
                        <td>{{ $pendingRequest->product->created_at }}</td>
                        <td>{{ $pendingRequest->number }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="card p-4">
        <h1 class="h3 mb-4 pb-4 border-bottom">Approved Request</h1>
        <table class="table table-bordered" id="approvedRequestTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Created at</th>
                    <th>Approved Request</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($approvedRequests as $approvedRequest)
                    <tr>
                        <td>{{ $approvedRequest->product->title }}</td>
                        <td>{{ $approvedRequest->product->created_at }}</td>
                        <td>{{ $approvedRequest->number }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

<script>
    $(document).ready(function() {
          $('#pendingRequestTable').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
          $('#approvedRequestTable').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
          $('#logTable').DataTable();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endsection
