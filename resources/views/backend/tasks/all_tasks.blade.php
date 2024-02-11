@extends('admin.body.header')
@section('admin')

<style>
p {
    padding: 0;
    margin: 0;
}

.min {
    display: block;
    width: 150px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    height: 25px;
}
</style>
<div class="container-fluid">
    <div class="mb-4"></div>
    <div class="card shadow mb-4">
        <div class="card-header mb-4">
            <h3>Tasks</h3>
            <button class="btn btn-info text-white btn-lg float-end mb-4 px-5" data-bs-toggle="modal"
                data-bs-target="#addTask"><i class="fa-solid fa-plus"></i> Add Task</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Task Name</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($tasks as $task)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                @if(is_null($task->prj_id))
                                <span class="badge text-bg-danger">No Project</span>
                                @else
                                <b>{{ $task->project }}</b>
                                @endif
                            </td>
                            <td>
                                <b>{{ $task->task_name}}</b>
                            </td>
                            <td class="text-center">
                                {{ date("M j, Y, g:i a", strtotime($task->start_date)) }}
                            </td>
                            <td class="text-center">
                                {{ date("M j, Y, g:i a", strtotime($task->due_date)) }}
                            </td>
                            <td class="text-center">
                                @if($task->status === 0)
                                <span class="badge text-bg-secondary">Pending</span>
                                @elseif($task->status === 1)
                                <span class="badge text-bg-primary">Active</span>
                                @elseif($task->status === 2)
                                <span class="badge text-bg-success">Complete</span>
                                @endif
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
                                        <li><button class="dropdown-item" value="{{ $task->id }}" id="editBtn"><i
                                                    class="fas fa-edit"></i>
                                                Edit</button></li>
                                        <li> <a class="dropdown-item" id="delete"
                                                href="{{ route('delete.tasks', $task->id) }}"><i
                                                    class="fas fa-trash"></i>
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
$(document).ready(function() {
    $(document).on('click', '#editBtn', function() {
        var task_id = $(this).val();

        $('#editTask').modal('show');

        $.ajax({
            type: "GET",
            url: "/admin/edit/tasks/" + task_id,
            success: function(response) {
                $('#task_name').val(response.tasks.task_name);
                $('#prj_name').text(response.tasks.project);
                $('#emp_id').val(response.tasks.emp_id);
                $('#sm2').summernote('code', response.tasks.task_desc);
                $('#start_date').val(response.tasks.start_date);
                $('#due_date').val(response.tasks.due_date);
                $('#status').val(response.tasks.status);
                $('#id').val(task_id);
            }
        });
    });
});
</script>

@include('backend.tasks.add_tasks')
@include('backend.tasks.edit_tasks')
@endsection