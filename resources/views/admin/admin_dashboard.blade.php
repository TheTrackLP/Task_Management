@extends('admin.body.header')
@section('admin')

@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
@endphp

<style>
.icon {
    font-size: 50px;
}
</style>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard, Welcome {{ $profileData->username }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-light mb-4">
                    <h3 class="card-body">Employees</h3>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="card-text">{{ $emp_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light mb-4">
                    <h3 class="card-body">Total Projects</h3>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="card-text">{{ $prj_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light mb-4">
                    <h3 class="card-body">Total Tasks</h3>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3 class="card-text">{{ $task_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-bars"></i> Projects Progression</h4>
                    </div>
                    <div class="card-body">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Project</th>
                                    <th>Progress</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($prjs as $prj)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td><b>{{ $prj->prj_name }}</b></td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ ($prj->doneTask / ($prj->doneTask + $prj->leftTask)) * 100 }}%;"
                                                aria-valuenow="{{ ($prj->doneTask / ($prj->doneTask + $prj->leftTask)) * 100 }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ ($prj->doneTask / ($prj->doneTask + $prj->leftTask)) * 100 }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($prj->status === '0')
                                        <span class="badge text-bg-secondary">Pending</span>
                                        @elseif($prj->status === '1')
                                        <span class="badge text-bg-primary">Active</span>
                                        @elseif($prj->status === 2)
                                        <span class="badge text-bg-success">Complete</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary"><i class="fas fa-folder-open"></i> View</button>
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
</main>

@endsection