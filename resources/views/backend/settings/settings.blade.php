@extends('admin.body.header')
@section('admin')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Add Position</h3>
                </div>
                <form action="" method="post">
                    <div class="card-body">
                        <label for="" class="mb-3"><b>Position:</b></label>
                        <input type="text" name="position" id="" class="form-control">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-end px-5">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Positions</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Position</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Position</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection