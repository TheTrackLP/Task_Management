@extends('admin.body.header')
@section('admin')

<style>
tr,
td {
    text-transform: capitalize;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mt-3">
                <form action="{{ route('add.permissions') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h5>Add Permission</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Add Permission</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Group Name</label>
                            <select name="group_name" id="" class="form-select">
                                <option value="" selected disabled>Please Select Here</option>
                                <option value="employee">Employees</option>
                                <option value="project">Projects</option>
                                <option value="task">Tasks</option>
                                <option value="leave">Leave Management</option>
                                <option value="role">Roles</option>
                                <option value="account">Account</option>
                                <option value="setting">Settings</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Add Permission</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h5>Permissions</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hovered table-bordered" id="RolePermissionTable">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Permission Name</th>
                                <th class="text-center">Group Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($permissions as $permi)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $permi->name }}</td>
                                <td class="text-center">{{ $permi->group_name }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning text-white">Edit</button>
                                    <a href="{{ route('delete.permissions', $permi->id) }}" id="delete"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<script>
$(document).ready(function() {
    $(document).on('click', '#EditBtn', function() {
        var role_id = $(this).val();

        $.ajax({
            type: "GET",
            url: "/admin/roles/edit/" + role_id,
            success: function(response) {
                $("#name").val(response.role.name);
            }
        })
    });
});
</script> -->
@endsection