@extends('admin.header')
@section('admin')

<div class="container-fluid">
    <h2>View Task</h2>
    <hr>
    <div class="card-group">
        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title "><strong><u>Task Name:</u></strong></h5>
                <p>{{ $taskData->task_name }}</p>
                <h5 class="card-title "><strong><u>Task Description:</u></strong></h5>
                <p>{{ $taskData->task_desc }}</p>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title "><strong><u>Start Date:</u></strong></h5>
                <p>{{ date('M d, Y', strtotime($taskData->start_date)) }}</p>
                <h5 class="card-title "><strong><u>Due Date:</u></strong></h5>
                <p>{{ date('M d, Y', strtotime($taskData->due_date)) }}</p>
                <h5 class="card-title "><strong><u>Status:</u></strong></h5>
                @if($taskData->status == 0)
                <p><span class="badge badge-secondary">Pending</span></p>
                @elseif($taskData->status == 1)
                <p><span class="badge badge-info">In Progress</span></p>
                @elseif($taskData->status == 2)
                <p><span class="badge badge-success">Complete</span></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection