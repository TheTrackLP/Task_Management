@extends('admin.header')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="mb-5 font-weight-bold text-primary">Leave Management</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Employee Details</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allLeave as $key => $leave)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <p>{{ $leave->name }}</p>
                                <p><small>{{ $leave->leave_name}}</small></p>
                                <p><small>{{ $leave->leave_reason}}</small></p>
                            </td>
                            <td class="text-center">
                                asdasd
                            </td>
                            <td class="text-center">
                                @if($leave->status == 0)
                                <span class="badge badge-secondary">Pending</span>
                                @elseif($leave->status == 1)
                                <span class="badge badge-success">Approve</span>
                                @elseif($leave->status == 2)
                                <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
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
@endsection