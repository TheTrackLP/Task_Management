@extends('admin.body.header')
@section('admin')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mt-3">
                <form action="{{ route('add.roles') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h5>Add Role</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Add Role</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer float-end">
                        <button type="submit" class="btn btn-success px-5">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h5>Roles</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hovered table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Role Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($roles as $role)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">
                                    <button type="button" id="EditBtn" value="{{ $role->id }}"
                                        class="btn btn-warning text-white">Edit</button>
                                    <a href="{{ route('delete.roles', $role->id) }}" id="delete"
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
</script>

@endsection