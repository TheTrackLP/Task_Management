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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-info text-white float-end btn-lg" data-bs-target="#AddRnP"
                        data-bs-toggle="modal">Add
                        Permission to Roles</button>
                    <h2 class="card-title">Permission</h2>
                    <div class="table-responsive">
                        <table class="table table-hovered table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach($item->permissions as $prem)
                                        <span class="badge bg-primary">{{ $prem->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.role.permissions', $item->id) }}"
                                            class="btn btn-inverse-warning">Edit</button>
                                            <a href="" class="btn btn-inverse-danger" id="delete">Delete</a>
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
</div>
@include('backend.rolesetup.add_roles_permission')
@endsection