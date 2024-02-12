<div class="modal fade" id="addEmployee" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Employee</h1>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.employee') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="">Employee ID#:</label>
                            <input type="text" name="emp_id" class="form-control" placeholder="Employee ID...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="">First Name:</label>
                            <input type="text" name="firstname" class="form-control" placeholder="First Name...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Middle Name:</label>
                            <input type="text" name="middlename" class="form-control" placeholder="Middle Name...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Last Name:</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="">Contact#:</label>
                            <input type="text" name="contact" class="form-control" placeholder="Phone Number...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Email:</label>
                            <input type="text" name="email" class="form-control" placeholder="Email...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Position:</label>
                            <select name="position_id" class="select2">
                                <option value=""></option>
                                @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->position }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Address:</label>
                            <textarea name="address" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Star Date:</label>
                            <input type="date" name="start_date" class="form-control">
                            <label for="">End Date:</label>
                            <input type="date" name="end_date" class="form-control">
                            <small><span class="badge text-bg-secondary">Note:</span> Leave the Date Blank if the
                                Employee is Regular</small>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$('.select2').select2({
    placeholder: "Please Select Here",
    width: "100%",
    dropdownParent: $('#addEmployee')
});
</script>