        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Fill Employee Details</b></h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="ibox-tools">
                                        <a href="<?=site_url('Employee/view_employee')?>"><button class="btn btn-xs btn-primary">View Employee</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee" action="<?=site_url('Employee/add_employee_registration')?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employee Type<span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control"  name="employee_type" required>
                                            <option value="0">Select Employee Type</option>
                                            <?php if($functionality[0]['school_CRM'] == 1){?>
                                                <option value="5">Teacher</option>
                                            <?php } ?>
                                            <?php if($functionality[0]['school_tracking'] == 1){?>
                                                <option value="6">Driver</option>
                                            <?php } ?>
                                            <?php if($functionality[0]['school_CRM'] == 1){?>
                                                <!-- <option value="9">Accountant</option>
                                                <option value="10">Non Teaching</option>
                                                <option value="11">Clerk</option>
                                                <option value="12">Peon</option> -->
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employee Name <span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                         <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control employee_first_name" name="employee_first_name" placeholder="First Name" id="employee_first_name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="employee_middle_name" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="employee_last_name" placeholder="Last Name">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Employee Birth Date <span style="color:red;">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" readonly="" Placeholder="Employee Birth Date" name="employee_DOB" class="form-control datepicker">
                                    </div>
                                    <label class="col-lg-2 control-label">Gender <span style="color:red;">*</span></label>
                                    <div class="col-lg-3">
                                        <label class="radio-inline"> 
                                            <input type="radio" name="employee_gender" value="male">&nbsp  Male 
                                        </label> 
                                        <label class="radio-inline">
                                            <input type="radio" name="employee_gender" value="female">  &nbsp Female
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="employee_gender" value="other">  &nbsp Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Employee Address <span style="color:red;">*</span></label>
                                    <div class="col-lg-3">
                                        <textarea type="text" placeholder=" Employee Address" name="employee_address" class="form-control"></textarea>
                                    </div>
                            
                                    <label class="col-sm-2 control-label">Employee Photo</label>
                                    <div class="col-sm-3">
                                        <input type="file" placeholder="placeholder" name="employee_photo" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employee Mobile No. <span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control mobile" id="mobile" name="employee_pri_mobile_number" Placeholder="Employee Mobile No.">
                                        <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                    </div>
                                    <label class="col-sm-2 control-label">Employee Email ID. <span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="email" class="form-control email_id" id="email_id" name="employee_email_id" Placeholder="Employee Email Address">
                                        <label class="email_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Higher Education <span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  name="employee_higher_education" Placeholder="Employee Higher Education">
                                    </div>
                                    <label class="col-sm-2 control-label">Total Experience<span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="employee_experiance" Placeholder="Employee Experiance">
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>
    
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?=site_url('Teacher/view_teacher')?>"><span class="btn btn-white" type="reset">Cancel</span></a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>