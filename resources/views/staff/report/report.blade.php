@extends('layouts.app')

@section('content')
<div class="myCard">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reports</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="handleExport()">Export</button>
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
        <h1 class="h3 mb-4 pb-4 border-bottom">Approved Customer</h1>
        <table class="table table-bordered" id="pendingRequestTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Identification No.</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($customerRequests as $customerRequest)
                    <tr>
                        <td>{{ $customerRequest->name }}</td>
                        <td>{{ $customerRequest->email }}</td>
                        <td>{{ $customerRequest->id_no }}</td>
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

    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="exportModalForm" method="GET" action="/report/export">
                @csrf
                <input id="form-method" type="hidden" name="_method" value="">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-right">Export </label>
                            <div class="col-md-6">
                                <select name="report" id="report" class="form-control">
                                    <option value="sales">Sales</option>
                                    <option value="customer">Approved Customer</option>
                                    <option value="request">Approved Request</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="modal-button">Export</button>
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

<script>
    function handleExport(product) {
      $('#exportModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endsection
