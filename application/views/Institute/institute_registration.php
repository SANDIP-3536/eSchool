        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Institute Registration</b></h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="ibox-tools">
                                        <a href="<?=site_url('Institute/institute_Details')?>"><button class="btn btn-primary">View Institute</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" id="addInstitute" action="<?=site_url('Institute/new_institute_registration')?>" enctype="multipart/form-data">
                                <div class="form-group" hidden>
                                    <label class="col-sm-2 control-label">User Type</label>   
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="user_type" value="2">
                                    </div>
                                </div>
                                <div class="form-group" hidden >
                                    <label class="col-sm-2 control-label">User Created By</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="user_created_by" value = "<?php echo $user ?>" >
                                    </div>
                                </div>
                                 <div class="form-group"  hidden>
                                    <label class="col-sm-2 control-label">User Created Date</label>   
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="date" value = "<?php echo date('Y/m/d');?>" >
                                    </div>
                                </div>

                                <!--  -->
                                <div class="form-group" hidden>
                                    <label class="col-sm-2 control-label">institute_User Type</label>   
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="institute_type" value="1">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Institute Name <span style="color:red;">*</span></label>   
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="institute_name" placeholder="Institute Name"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Name'" >
                                    </div>
                                    <label class="col-sm-2 control-label">Institute Address <span style="color:red;">*</span></label>   
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder="Institute Address" name="institute_address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Address'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Institute Logo <span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control logo" name="institute_logo" accept="image/gif,image/png,image/jpeg" style="border:none;padding:0px;">
                                    </div>
                                    <label class="col-sm-2 control-label">Mobile Number <span style="color:red;">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" row="2" name="institute_mobile_number" placeholder="Institute Mobile Number" class="form-control" 
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Mobile Number'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone Number</label>
                                    <div class="col-sm-3">
                                        <input type="text" row="2" name="institute_phone_number" placeholder="Institute Phone Number" class="form-control"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Phone Number'" >
                                    </div>
                                    <label class="col-sm-2 control-label">Email ID</label>
                                    <div class="col-sm-3">
                                        <input type="text" row="2" name="institute_email_id" placeholder="Institute Email ID" class="form-control"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Email ID'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Institute Sender ID </label>
                                    <div class="col-sm-3">
                                        <input type="text" name="institute_sender_id" placeholder="Institute Sender ID" class="form-control"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Sender ID'" onkeyup="caps(this)">
                                    </div>
                                    <label class="col-sm-2 control-label">Institute Signature</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="institute_signature" placeholder="Institute Signature" class="form-control"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Institute Signature'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">School SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-3" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="institute_school_sms" id="example4">
                                                <label class="onoffswitch-label" for="example4">
                                                    <span class="onoffswitch-switch"></span>
                                                    <span class="onoffswitch-inner"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>