@extends('admin.header')
@section('admin')

<form action="{{ route('update.tasks') }}" method="post">
    @csrf
    <div class="col-md-6 offset-md-3 grid-margin stretch-card">
        <div class="row">
            <div class="form-group col-lg-7">
                <input type="hidden" name="id" value="{{ $taskData->id }}">
                <label>Task Assigned to:</label>
                <select name="emp_id" class="form-control">
                    <option value="{{ $taskData->emp_id }}">{{ $taskData->name }} | {{ $taskData->position }}</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->emp_id }}">{{ $employee->name }} | {{ $employee->position}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Start Date:</label>
                <input type="date" name="start_date" value="{{ $taskData->start_date }}" class="form-control">
            </div>
            <div class="form-group col-lg-6">
                <label>End Date</label>
                <input type="date" name="due_date" value="{{ $taskData->due_date }}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Status:</label>
                <select class="form-control" name="status">
                    <option value="0" {{ $taskData->status == 0 ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $taskData->status == 1 ? 'selected' : '' }}>On Progress</option>
                    <option value="2" {{ $taskData->status == 2 ? 'selected' : '' }}>Complete</option>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Task Name:</label>
                <input type="text" name="task_name" value="{{ $taskData->task_name }}" class="form-control">
            </div>
            <div class="form-group col-lg-12">
                <label>Tasks Description</label>
                <textarea class="form-control" name="task_desc" rows="10">{{ $taskData->task_desc }}</textarea>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-info">Update Task</button>
        <a href="{{ route('all.tasks') }}" class="btn btn-danger">Close</a>
    </div>
</form>
@endsection