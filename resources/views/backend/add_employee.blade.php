<div class="modal fade" id="addEmployee" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    New Employee
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.employee') }}" method="post">
                    @csrf
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Employee ID#:</label>
                                <input type="text" name="emp_id" class="form-control" placeholder="Employee ID#...">
                                <small class="font-weight-bold">Note: Leave if Employee has ID# Already</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>First Name:</label>
                                <input type="text" name="firstname"
                                    class="form-control @error('firstname') is-invalid @enderror"
                                    placeholder="First Name...">
                                @error('firstname')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Middle Name:</label>
                                <input type="text" name="middlename"
                                    class="form-control @error('middlename') is-invalid @enderror"
                                    placeholder="Middle Name...">
                                @error('middlename')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Last Name:</label>
                                <input type="text" name="lastname"
                                    class="form-control @error('lastname') is-invalid @enderror"
                                    placeholder="Last Name...">
                                @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Contact #:</label>
                                <input type="text" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    placeholder="Contact #...">
                                @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email:</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email...">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Position:</label>
                                <input type="text" name="position"
                                    class="form-control @error('position') is-invalid @enderror"
                                    placeholder="Position...">
                                @error('position')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <small class="font-weight-bold">Note: Leave Dates Blank if employee is regular</small>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>Start Date:</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                    rows="3" placeholder="Village/Street Name/Brgy./City/Province"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Add New Employee</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>