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
                        @if($staff->id != 1)
                                <button type="button" class="btn btn-outline-danger btn-sm mr-2" onclick="handleDelete({{ $staff }})">Delete</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="handleEdit({{ $staff }})">
                                    @if($staff->role == 'admin')
                                    Remove Admin
                                    @else 
                                    Make Admin
                                    @endif
                                </button>
                            @endif
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

    <div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="staffModalForm" method="POST" action="">
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
                        <button type="submit" class="btn btn-primary" id="staffModalButton"></button>
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
    function handleEdit(user) {
      var form = document.getElementById('staffModalForm')
      form.action = '/staff/' + user.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'PUT'

      var title = document.getElementById('staffModalLabel')
      user.role === 'admin' ? title.innerHTML = 'Remove Admin' : title.innerHTML = 'Make Admin'

      var label = document.getElementById('modalContent')
      user.role === 'admin' ? label.innerHTML = `Remove <b>${user.name} - ${user.email}</b> from admin?` 
      : label.innerHTML = `Make <b>${user.name} - ${user.email}</b> admin?`
      
      var value = document.getElementById('input_content')
      value.name = 'role'
      user.role === 'admin' ? value.value = 'staff' : value.value = 'admin'

      var button = document.getElementById('staffModalButton')
      button.className = "btn btn-outline-primary"
      button.innerHTML = "Update"

      $('#staffModal').modal('show')
    }
</script>

<script>
    function handleDelete(user) {
      var form = document.getElementById('staffModalForm')
      form.action = '/staff/' + user.id

      var formMethod = document.getElementById('form-method')
      formMethod.value = 'DELETE'

      var title = document.getElementById('staffModalLabel')
      title.innerHTML = 'Delete User'

      var label = document.getElementById('modalContent')
      label.innerHTML = `Delete <b>${user.name} - ${user.email}</b>?`

      var button = document.getElementById('staffModalButton')
      button.className = "btn btn-outline-danger"
      button.innerHTML = "Delete"

      $('#staffModal').modal('show')
    }
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