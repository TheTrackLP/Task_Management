<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<style>
body {
    background: linear-gradient(90deg, rgba(33, 33, 48, 1) 0%, rgba(57, 48, 74, 1) 35%);
}

.center {
    margin: auto;
}

.bold {
    font-weight: bold;
}
</style>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right center">
                <div class="d-flex flex-column align-items-center text-center my-3">
                    <h2 class="font-weight-bold">{{ $profileData->username }}</h2>
                    <h4>{{ $profileData->emp_id }}</h4>
                </div>
                <hr>
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Email:</h6>
                            <span class="text-dark">{{ $profileData->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Phone</h6>
                            <span class="text-dark">{{ $profileData->contact }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Position</h6>
                            <span class="text-dark">{{ $profileData->occu }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Status:</h6>
                            @if($profileData->status == 'inactive')
                            <span class="badge text-bg-danger">Inactive</span>
                            @elseif($profileData->status == 'active')
                            <span class="badge text-bg-success">Active</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Address:</h6>
                            <span class="text-dark">{{ $profileData->address }}</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="text-center my-5">
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-lg"><i class="fas fa-power-off"></i>
                        Logout</a>
                </div>
            </div>
            <div class="col-md-9 border-right">
                <div class="card mb-3 mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="bold">Project Name</label>
                                <p>{{ $partProject->prj_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" class="bold">Status</label>
                                @if($partProject->status === '0')
                                <p><span class="badge text-bg-secondary">Pending</span></p>
                                @elseif($partProject->status === '1')
                                <p><span class="badge text-bg-primary">Active</span></p>
                                @elseif($partProject->status === 2)
                                <p><span class="badge text-bg-success">Complete</span></p>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="bold">Start Date</label>
                                <p>{{ date('M d, Y', strtotime($partProject->start_date)) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" class="bold">Project Manager</label>
                                <p>{{ $partProject->manager }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="bold">End Date</label>
                                <p>{{ date('M d, Y', strtotime($partProject->end_date)) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" data-bs-target="#prjDesc" data-bs-toggle="modal">View
                                    Description</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card">
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
                                    @foreach($myTask as $task)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $task->task_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ date("M j, Y, g:i a", strtotime($task->start_date)) }}
                                        </td>
                                        <td class="text-center">
                                            {{ date("M j, Y, g:i a", strtotime($task->due_date)) }}
                                        </td>
                                        <td class="text-center">
                                            @if($task->status == 0)
                                            <span class="badge text-bg-secondary">Pending</span>
                                            @elseif($task->status == 1)
                                            <span class="badge text-bg-primary">Active</span>
                                            @elseif($task->status == 2)
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
                                                    <li><button class="dropdown-item" value="{{ $task->id }}"
                                                            id="editBtn"><i class="fas fa-edit"></i>
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
        </div>
    </div>
</body>
<div class="modal fade" role="document" id="prjDesc" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Project Description</h3>
            </div>
            <div class="modal-body">
                {!! $partProject->prj_description !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>