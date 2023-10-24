<div class="modal fade" id="addprjTask" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.tasks') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="emp_id">Give this taks to:</label>
                            <input type="hidden" class="form-control" name="prj_id" value="{{ $prjData->id }}">
                            <select name="emp_id" class="form-control">
                                <option value="" disable>Select Employee to assign task to</option>
                                @foreach($employees as $emp)
                                <option value="{{$emp->emp_id}}">{{ $emp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="name">Task Name:</label>
                            <input type="text" name="task_name" class="form-control">
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <label for="task_desc">Task Description:</label>
                            <textarea name="task_desc" rows="7" class="form-control"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="end_date">Due Date:</label>
                            <input type="date" name="due_date" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="status" value="0">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add New Task</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>