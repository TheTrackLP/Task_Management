@extends('admin.header')
@section('admin')
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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection