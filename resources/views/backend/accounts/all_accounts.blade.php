@extends('admin.body.header')
@section('admin')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title my-3">
                Accounts
            </h2>
            <button type="button" class="btn btn-info btn-lg text-white float-end mb-3 px-5" data-bs-toggle="modal"
                data-bs-target="#addAccount"><i class="fas fa-plus"></i>
                Add
                Account</button>
        </div>
        <div class="card-body">
            <table class="table table-hovered table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID #</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">User Type</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accts as $acct)
                    <tr>
                        <td class="text-center">
                            {{ $acct->emp_id}}
                        </td>
                        <td>
                            {{ $acct->username}}
                        </td>
                        <td>
                            {{ $acct->email }}
                        </td>
                        <td class="text-center">
                            @foreach($acct->roles as $roles)
                            <span class="badge bg-primary">{{$roles->name}}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if($acct->role == 'admin')
                            <span class="badge text-bg-primary">Admin</span>
                            @elseif($acct->role == 'user')
                            <span class="badge text-bg-secondary">User</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($acct->status == 'inactive')
                            <span class="badge text-bg-danger">In Active</span>
                            @elseif($acct->status == 'active')
                            <span class="badge text-bg-success">Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info text-white dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item" id="editBtn" value="{{ $acct->id }}"><i
                                                class="fas fa-edit"></i>
                                            Edit</button>
                                    </li>
                                    <li><a class="dropdown-item" id="delete"
                                            href="{{ route('delete.account', $acct->id) }}"><i
                                                class="fas fa-trash-alt"></i> Delete</a>
                                    </li>
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
@include('backend.accounts.add_accounts')
@include('backend.accounts.edit_accounts')

<script>
const getData = () => {
    var empId = $('#empId').val();

    $.ajax({
        type: "GET",
        url: "/admin/edit/" + empId,
        success: function(res) {
            $('#email').val(res.employee.email);
            $('#emp_id').val(res.employee.emp_id);
        }
    });
}

$(document).ready(function() {
    $(document).on('click', '#editBtn', function() {
        var acct_id = $(this).val();
        alert(acct_id)
        $('#editAcct').modal('show');

        $.ajax({
            type: "GET",
            url: "/admin/account/edit/" + acct_id,
            success: function(res) {
                console.log(res)
                $('#role').val(res.acct.role);
                $('#username').val(res.acct.username);
                $('#empiI').val(res.acct.emp_id);
                $('#empIid').val(res.acct.empp_id)
                $('#roles').val(res.acct.role_id);
                $('#mail').val(res.acct.email);
                $('#id').val(acct_id);
            }
        });
    });
});
</script>
@endsection