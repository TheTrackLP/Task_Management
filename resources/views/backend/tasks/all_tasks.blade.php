@extends('admin.header')
@section('admin')

<style>
.min {
    display: block;
    width: 100px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="mb-5 font-weight-bold text-primary">Tasks List</h4>
            <a href="{{ route('add.tasks') }}" class="btn btn-primary float-right" data-toggle="modal"
                data-target="#addTask">Add New Task</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Project</th>
                            <th>Date Started</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"></td>
                            <td>
                                <p></p>
                                <small class="min"></small>
                            </td>
                            <td></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <span class="badge badge-secondary">Pending</span>
                                <span class="badge badge-info">In Progress</span>
                                <span class="badge badge-success">Complete</span>

                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success"> <i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="#" id="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('backend.tasks.add_tasks')
@endsection