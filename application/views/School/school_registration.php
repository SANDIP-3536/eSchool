        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Add School</b></h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="ibox-tools">
                                        <a href="<?=site_url('School/view_school')?>"><button class="btn btn-xs btn-primary">View School</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSchool" action="<?=site_url('School/add_school_registration')?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Name <span style="color:red;">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="School Name" name="school_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address <span style="color:red;">*</span></label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="school_address" placeholder="School Address" rows="3" cols="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Logo <span style="color:red;">*</span></label>
                                        <div class="col-lg-8">
                                            <input type="file" placeholder="" name="school_logo" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-sm-offset-1" style="padding-top: 6px;">
                                        <span style="color:red;"><b>Only .jpg|.jpeg|.png File types are allowed</b></span>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email ID.</label>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="School Email ID" name="school_email_id" class="form-control">
                                    </div>
                                    <label class="col-lg-2 control-label">Acadmic Year<span style="color:red;">*</span></label>
                                    <div class="col-lg-3">
                                        <select name="school_AY_id" class="form-control">
                                            <option value="0">Select Year</option>
                                            <?php foreach ($acadmic_year as $key) { ?>
                                                <option value="<?=$key['AY_id']?>"><?=$key['AY_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Mobile Number <span style="color:red;">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="School Mobile Number" name="school_mobile_number" class="form-control">
                                    </div>
                                    <label class="col-lg-2 control-label">Phone Number </label>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="School Phone Number" name="school_phone_number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Latitude</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="school_latitude" placeholder="School Latitude" id="geofence_lat">
                                    </div>
                                    <label class="col-lg-2 control-label">Longitude</label>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="School Longitude" name="school_longitude" class="form-control" id="geofence_long">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal"><img src="https://trackmee.syntech.co.in/trackmee/assets/img/map_picker.png"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Website</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="school_website" placeholder="School Website">
                                    </div>
                                </div>
                                <?php if($school_sms == 1){ ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Student Absent SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_student_absent_sms" id="example5">
                                                <label class="onoffswitch-label" for="example5">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Student Birth SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_student_birth_sms" id="example6">
                                                <label class="onoffswitch-label" for="example6">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employee Salary SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_employee_salary_sms" id="example7">
                                                <label class="onoffswitch-label" for="example7">
                                                    <span class="onoffswitch-switch"></span>
                                                    <span class="onoffswitch-inner"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Student Fee Remainder SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_student_fee_remainder_sms" id="example8">
                                                <label class="onoffswitch-label" for="example8">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Authentication Details SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_authentication_details_sms" id="example9">
                                                <label class="onoffswitch-label" for="example9">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Parent Birthday SMS<span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_parent_birth_sms" id="example1077">
                                                <label class="onoffswitch-label" for="example1077">
                                                    <span class="onoffswitch-switch"></span>
                                                    <span class="onoffswitch-inner"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Employee Birthday SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_employee_birth_sms" id="example1078">
                                                <label class="onoffswitch-label" for="example1078">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Homework SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_homework_sms" id="example1079">
                                                <label class="onoffswitch-label" for="example1079">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Parent Meet SMS<span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_parentmeet_sms" id="example1087">
                                                <label class="onoffswitch-label" for="example1087">
                                                    <span class="onoffswitch-switch"></span>
                                                    <span class="onoffswitch-inner"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> News Feed SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_newsfeed_sms" id="example1088">
                                                <label class="onoffswitch-label" for="example1088">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Circular SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_circular_sms" id="example1089">
                                                <label class="onoffswitch-label" for="example1089">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Event SMS<span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_event_sms" id="example1097">
                                                <label class="onoffswitch-label" for="example1097">
                                                    <span class="onoffswitch-switch"></span>
                                                    <span class="onoffswitch-inner"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Holiday SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_holiday_sms" id="example1098">
                                                <label class="onoffswitch-label" for="example1098">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 control-label"> Enquiry SMS <span style="color:red;">*</span></label>
                                    <div class="col-sm-1" style="padding:10px;">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" name="school_enquiry_sms" id="example1099">
                                                <label class="onoffswitch-label" for="example1099">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?=site_url('School/view_school')?>"><span class="btn btn-white">Cancel</span></a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                     <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Map Lat-Long Picker</b></h4>
                  </div>
                  <div class="modal-body">
                     <fieldset class="gllpLatlonPicker">
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" class="form-control gllpSearchField">
                            </div>
                            <div class="col-sm-2">
                                <input type="button" class="btn btn-info gllpSearchButton" value="search">
                            </div>
                        </div>
                        <br><br>
                        <div class="gllpMap"></div><br><center>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-10">   
                                    <div class="form-group">
                                        <label class="control-label" style="padding-bottom:2%">Lattitude</label>
                                        <input type="text" name="" class="form-control gllpLatitude" value="22.38661818384341">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-10">   
                                    <div class="form-group">
                                        <label class="control-label" style="padding-bottom:2%">Longitude</label>
                                        <input type="text" name="" class="form-control gllpLongitude" value="79.52245681526063">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="gllpZoom hidden" value="3"/>
                    </fieldset>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="update_lat_long" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
                </div>
            </div>
        </div>