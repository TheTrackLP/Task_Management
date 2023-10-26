@extends('users.header')
@section('user')
<div class="container-fluid">
    <h2>View Project</h2>
    <hr>
    <div class="card-group">
        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title "><strong><u>Project Name:</u></strong></h5>
                <p>{{ $prjData->name }}</p>
                <h5 class="card-title "><strong><u>Project Description:</u></strong></h5>
                <p>{{ $prjData->description }}</p>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title "><strong><u>Start Date:</u></strong></h5>
                <p>{{ date('M d, Y', strtotime($prjData->start_date)) }}</p>
                <h5 class="card-title "><strong><u>Due Date:</u></strong></h5>
                <p>{{ date('M d, Y', strtotime($prjData->end_date)) }}</p>
                <h5 class="card-title "><strong><u>Status:</u></strong></h5>
                @if($prjData->status == 0)
                <p><span class="badge badge-secondary">Pending</span></p>
                @elseif($prjData->status == 1)
                <p><span class="badge badge-info">In Progress</span></p>
                @elseif($prjData->status == 2)
                <p><span class="badge badge-success">Complete</span></p>
                @endif
                <br>
                <h5 class="card-title "><strong><u>Project Manager:</u></strong></h5>
                <p>{{ $prjData->manager }}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold">Team Members</h4>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addMember">Add
                        Member</button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td>{{$member->name}}</td>
                                <td>{{$member->position}}</td>
                                <td class="text-center">
                                    <a href="{{ route('delete.member', $member->id) }}" class="btn btn-danger"
                                        id="delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold">Tasks</h4>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addprjTask">Add new
                        Task</button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"> Task Name </th>
                                <th class="text-center"> Task Assigned </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($taskData as $data)
                            @if($prjData->id == $data->prj_id)
                            <tr>
                                <td>{{ $data->task_name}}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <p>{{ date('M d, Y', strtotime($data->start_date)) }}</p>
                                    <p>{{ date('M d, Y', strtotime($data->due_date)) }}</p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection