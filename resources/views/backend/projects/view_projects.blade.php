@extends('admin.body.header')
@section('admin')

<style>
.bold {
    font-weight: bold;
    text-decoration: underline;
    text-decoration-color: green;
}
</style>

<div class="container-fluid">
    <h3 class="mb-3 mt-3">View Project</h3>
    <hr class>
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="bold">Project Name</label>
                    <p>{{$projects->prj_name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="bold">Status</label>
                    @if($projects->status === '0')
                    <p><span class="badge text-bg-secondary">Pending</span></p>
                    @elseif($projects->status === '1')
                    <p><span class="badge text-bg-primary">Active</span></p>
                    @elseif($projects->status === 2)
                    <p><span class="badge text-bg-success">Complete</span></p>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="" class="bold">Start Date</label>
                    <p>{{ date('F d, Y', strtotime($projects->start_date)) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="bold">Project Manager</label>
                    <p>{{ $projects->manager }}</p>
                </div>
                <div class="col-md-6">
                    <label for="" class="bold">End Date</label>
                    <p>{{ date('F d, Y', strtotime($projects->end_date)) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="bold">Description</label>
                    <p>{!! $projects->prj_description !!}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">Team Member/s:</h5>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Name</td>
                                <td>Delete</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <button class="btn btn-primary text-white btn-lg float-end" data-bs-toggle="modal"
                        data-bs-target="#addprjTask"><i class="fas fa-plus"></i> New
                        Task</button>
                    <h3>Task Lists:</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
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
                                @foreach($taskPrj as $prj)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>
                                        {{ $prj->task_name }}
                                    </td>
                                    <td class="text-center">
                                        {{ date("M j, Y, g:i a", strtotime($prj->start_date)) }}
                                    </td>
                                    <td class="text-center">
                                        {{ date("M j, Y, g:i a", strtotime($prj->due_date)) }}
                                    </td>
                                    <td class="text-center">
                                        @if($prj->status == 0)
                                        <span class="badge text-bg-secondary">Pending</span>
                                        @elseif($prj->status == 1)
                                        <span class="badge text-bg-primary">Active</span>
                                        @elseif($prj->status == 2)
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
                                                <li><a href="#" class="dropdown-item"><i class="fas fa-eye"></i>
                                                        View</a>
                                                </li>
                                                <li><button class="dropdown-item" value="{{ $prj->id }}" id="editBtn"><i
                                                            class="fas fa-edit"></i>
                                                        Edit</button></li>
                                                <li> <a class="dropdown-item" id="delete"
                                                        href="{{ route('delete.tasks', $prj->id) }}"><i
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
    </div>
</div>
@include('backend.projects.tasks_projects.addprj_tasks')
@endsection