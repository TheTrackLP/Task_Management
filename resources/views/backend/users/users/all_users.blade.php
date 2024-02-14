@extends('admin.body.header');
@section('admin')


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header mb-4">
            <h3>Users</h3>
            <button class="btn btn-info text-white btn-lg float-end mb-2 px-5" data-bs-toggle="modal"
                data-bs-target="#addUser"><i class="fa-solid fa-plus"></i> Add User Account</button>
        </div>
        <div class="card-body">
            <div class="table table-responsive table-bordered">
                <table id="dataTable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">PHONE</th>
                            <th class="text-center">ROLE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>Phone</td>
                            <td>
                                Role
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle text-white"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item"><i class="fas fa-eye"></i> View</a>
                                        </li>
                                        <li><button class="dropdown-item" value="#" id="editBtn"><i
                                                    class="fas fa-edit"></i>
                                                Edit</button></li>
                                        <li> <a class="dropdown-item" id="delete" href="#"><i class="fas fa-trash"></i>
                                                Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
const getvalue = () => {
    var user_id = $('#user_id').val();
    $.ajax({
        type: "GET",
        url: "/admins/users/" + user_id,
        success: function(response) {
            $('#email').val(response.data.email);
            $('#emp_id').val(response.data.emp_id);
            $('#status').val(response.data.status);
        }
    });
}
</script>
@include('backend.users.users.add_users')
@endsection