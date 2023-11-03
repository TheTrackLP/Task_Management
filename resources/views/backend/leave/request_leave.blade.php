@extends('users.header')
@section('user')

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
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-2 font-weight-bold text-info">Tasks List</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.myleave') }}" method="post">
                        @csrf
                        <input type="hidden" name="emp_id" value="{{ $userId->emp_id }}">
                        <div class="form-group">
                            <label for="leave_name">Title Leave</label>
                            <input type="text" name="leave_name" placeholder="Leave Title..." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="leave_reason">Reason to leave</label>
                            <textarea name="leave_reason" class="form-control" rows="13"
                                placeholder="Reason(s) to Leave"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" name="date_start" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="date_end" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="status" value="0">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-3 px-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-2 font-weight-bold text-primary">My Leave List(s)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="45%">
                                <col width="25%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead class="text-center">
                                <tr>
                                    <th>Leave Details</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myLeave as $leave)
                                <tr>
                                    <td>
                                        <p>
                                            {{ $leave->leave_name}}
                                        </p>
                                        <p><small>{{ $leave->leave_reason}}</small></p>
                                    </td>
                                    <td class="text-center">
                                        <p><small>{{ date('M d, Y', strtotime($leave->date_start)) }}</small></p>
                                        <p><small>{{ date('M d, Y', strtotime($leave->date_end)) }}</small></p>
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
                                        <a href="{{ route('delete.myleave', $leave->id) }}" id="delete"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
@endsection