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
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addTask">Add New Task</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Task</th>
                            <th>Project</th>
                            <th>Date Started</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTasks as $data)
                        <tr>
                            <td>
                                <p>{{ $data->task_name }}</p>
                            </td>
                            <td>
                                <p>{{ $data->prj_name }}</p>
                            </td>
                            <td class="text-center">{{ date('M d, y', strtotime($data->start_date)) }}</td>
                            <td class="text-center">{{ date('M d, y', strtotime($data->due_date)) }}</td>
                            <td class="text-center">
                                @if($data->status == 0)
                                <span class="badge badge-secondary">Pending</span>
                                @elseif($data->status == 1)
                                <span class="badge badge-info">In Progress</span>
                                @elseif($data->status == 2)
                                <span class="badge badge-success">Complete</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('view.tasks', $data->id) }}" class="btn btn-success"> <i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('edit.tasks', $data->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <a href="#" id="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('backend.tasks.add_tasks')
@endsection