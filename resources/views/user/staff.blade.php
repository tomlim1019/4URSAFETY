@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Staff List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="handleCreate()">Add New Staff</button>
        </div>
    </div>

    <div>
        <table class="table table-bordered" id="requestTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Identification No.</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->id_no }}</td>
                        <td>{{ $staff->gender }}</td>
                        <td 
                        @if($staff->role === 'admin')
                        class="text-primary"
                        @elseif($staff->role === 'staff')
                        class="text-secondary"
                        @endif
                         >{{ $staff->role }}</td>
                        <td>{{ $staff->created_at }}</td>
                        <td>{{ $staff->updated_at }}</td>
                        <td>
                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-sm btn-outline-primary mr-2" >Delete</a>
                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-sm btn-outline-primary" >Make Admin</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createModalForm" method="POST" action="{{ route('register.staff') }}">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="id_no" class="col-form-label">Identification Number</label>
                            <input type="text" class="form-control" name="id_no">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label">Birhtdate</label>
                            <input id="birth_date" type="text" class="form-control" name="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender</label>
                            <select id="gender" type="text" class="form-control" name="gender">
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='others'>Others..</option>
                            </select>
                        </div>
                        <input name="password" value="" hidden>
                        <input name="status" value="Approved" hidden>
                        <input name="role" value="staff" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modal-button">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $(document).ready(function() {
          $('#requestTable').DataTable();
    });
</script>


<script>
    flatpickr('#birth_date', {
        maxDate: "today",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    })
</script>

<script>
    function handleCreate() {
      $('#createModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
@endsection