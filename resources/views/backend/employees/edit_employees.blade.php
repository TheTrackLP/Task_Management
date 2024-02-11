<div class="modal fade" id="editEmployee" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.employee') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <input type="hidden" name="id" id="id">
                            <label for="">Employee ID#:</label>
                            <input type="text" name="emp_id" id="emp_id" class="form-control"
                                placeholder="Employee ID...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="">First Name:</label>
                            <input type="text" name="firstname" id="firstname" class="form-control"
                                placeholder="First Name...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Middle Name:</label>
                            <input type="text" name="middlename" id="middlename" class="form-control"
                                placeholder="Middle Name...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Last Name:</label>
                            <input type="text" name="lastname" id="lastname" class="form-control"
                                placeholder="Last Name...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="">Contact#:</label>
                            <input type="text" name="contact" id="contact" class="form-control"
                                placeholder="Phone Number...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Position:</label>
                            <select name="position" id="position" class="form-select">
                                <option value="" selected disabled>Select Position</option>
                                <option value="pdo">PDO</option>
                                <option value="pdo1">PODI</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Address:</label>
                            <textarea name="address" id="address" class="form-control" cols="30" rows="4"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Star Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                            <label for="">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                            <small><span class="badge text-bg-secondary">Note:</span> Leave the Date Blank if the
                                Employee is Regular</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" disabled selected>Select option</option>
                                <option value="inactive">Inactive</option>
                                <option value="active">Active</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>