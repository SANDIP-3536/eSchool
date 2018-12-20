        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Update School Indormation</b></h3>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSchool" action="<?=site_url('School/update_details_school')?>">
                                <?php foreach ($schooll as $key) { ?>
                                    <div class="form-group" hidden="">
                                        <label class="col-lg-2 control-label">School profile ID</label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="School Name" name="school_profile_id" class="form-control" value="<?=$key['school_profile_id']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">School Name <span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="School Name" name="school_name" class="form-control" value="<?=$key['school_name']?>">
                                        </div>
                                        <label class="col-lg-2 control-label">School Email ID.</label>
                                        <div class="col-lg-3">
                                           <input type="text" placeholder="School Email ID" name="school_email_id" class="form-control" value="<?=$key['school_email_id']?>">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">School Mobile Number</label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="School Mobile Number" name="school_mobile_number" class="form-control" value="<?=$key['school_mobile_number']?>">
                                        </div>
                                        <label class="col-lg-2 control-label">School Phone Number <span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="School Phone Number" name="school_phone_number" class="form-control" value="<?=$key['school_phone_number']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">School Latitude</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="school_latitude" placeholder="School Latitude" value="<?=$key['school_latitude']?>">
                                        </div>
                                        <label class="col-lg-2 control-label">School Longitude</label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="School Longitude" name="school_longitude" class="form-control" value="<?=$key['school_longitude']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">School Address <span style="color:red;">*</span></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="school_address" placeholder="School Address" value="<?=$key['school_address']?>">
                                        </div>
                                        <label class="col-lg-2 control-label">Acadmic Year<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <select name="school_AY_id" class="form-control update_school_AY_id">
                                                <option value="<?=$key['AY_id']?>"><?=$key['AY_name']?></option>
                                                <?php foreach ($acadmic_year as $key1) { ?>
                                                    <option value="<?=$key1['AY_id']?>"><?=$key1['AY_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group update_functionality">
                                        <label class="col-lg-2 control-label">Website</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="school_website" placeholder="School Website">
                                        </div>
                                        <label class="col-lg-2 control-label">Watermark</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_watermark" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-lg-2 control-label">Report Header</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_report_header" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                        <label class="col-lg-2 control-label">Report Footer</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_report_footer" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-lg-2 control-label">Leaving Certificate Header</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_leaving_certificate_header" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                        <label class="col-lg-2 control-label">Leaving Certificate Footer</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_leaving_certificate_footer" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-lg-2 control-label">Bonafied Certificate Header</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_bonafied_certificate_header" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                        <label class="col-lg-2 control-label">Bonafied Certificate Footer</label>
                                        <div class="col-lg-3">
                                            <input type="file" placeholder="" name="school_bonafied_certificate_footer" class="form-control" accept="image/gif,image/png,image/jpeg" style="border:none;">
                                        </div>
                                    </div> -->
                                    <div class="form-group functionality">
                                        <label class="col-sm-2 control-label">Absent SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_absent_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Birthday SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Salary SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_employee_salary_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group functionality">
                                        <label class="col-sm-2 control-label">Fee Remainder SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_fee_remainder_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Authentication SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_authentication_details_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Parent Birthday <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_parent_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example31  ">
                                                    <label class="onoffswitch-label" for="example31 ">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Employee Birthday <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_employee_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group functionality">
                                        <label class="col-sm-2 control-label">Homework SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_homework_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Parent Meeting <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_parentmeet_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">NewsFeeds <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_newsfeed_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Circular SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_circular_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group functionality">
                                        <label class="col-sm-2 control-label">Event SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_event_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Holiday SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_holiday_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked disabled class="onoffswitch-checkbox" id="example3">
                                                    <label class="onoffswitch-label" for="example3">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" disabled class="onoffswitch-checkbox" id="example4">
                                                    <label class="onoffswitch-label" for="example4">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-sm-2 control-label">Absent SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_absent_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_student_absent_sms" id="example31">
                                                    <label class="onoffswitch-label" for="example31">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_student_absent_sms" id="example32">
                                                    <label class="onoffswitch-label" for="example32">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Birthday SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_student_birth_sms" id="example41">
                                                    <label class="onoffswitch-label" for="example41">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_student_birth_sms" id="example42">
                                                    <label class="onoffswitch-label" for="example42">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Salary SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_employee_salary_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_employee_salary_sms" id="example51">
                                                    <label class="onoffswitch-label" for="example51">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_employee_salary_sms" id="example52">
                                                    <label class="onoffswitch-label" for="example52">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-sm-2 control-label">Fee Remainder SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_student_fee_remainder_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_student_fee_remainder_sms" id="example61">
                                                    <label class="onoffswitch-label" for="example61">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_student_fee_remainder_sms" id="example62">
                                                    <label class="onoffswitch-label" for="example62">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Authentication SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_authentication_details_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_authentication_details_sms" id="example71">
                                                    <label class="onoffswitch-label" for="example71">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_authentication_details_sms" id="example72">
                                                    <label class="onoffswitch-label" for="example72">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Parent Birthday <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_parent_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_parent_birth_sms" id="example516">
                                                    <label class="onoffswitch-label" for="example516">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_parent_birth_sms" id="example526">
                                                    <label class="onoffswitch-label" for="example526">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Employee Birthday <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_employee_birth_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_employee_birth_sms" id="example616">
                                                    <label class="onoffswitch-label" for="example616">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_employee_birth_sms" id="example626">
                                                    <label class="onoffswitch-label" for="example626">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-sm-2 control-label">Homework SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_homework_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_homework_sms" id="example716">
                                                    <label class="onoffswitch-label" for="example716">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_homework_sms" id="example726">
                                                    <label class="onoffswitch-label" for="example726">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Parent Meeting <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_parentmeet_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_parentmeet_sms" id="example56">
                                                    <label class="onoffswitch-label" for="example56">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_parentmeet_sms" id="example66">
                                                    <label class="onoffswitch-label" for="example66">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">NewsFeeds <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_newsfeed_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_newsfeed_sms" id="example316">
                                                    <label class="onoffswitch-label" for="example316">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_newsfeed_sms" id="example326">
                                                    <label class="onoffswitch-label" for="example326">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Circular SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_circular_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_circular_sms" id="example416">
                                                    <label class="onoffswitch-label" for="example416">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_circular_sms" id="example426">
                                                    <label class="onoffswitch-label" for="example426">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group update_functionality">
                                        <label class="col-sm-2 control-label">Event SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_event_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_event_sms" id="example566">
                                                    <label class="onoffswitch-label" for="example566">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_event_sms" id="example666">
                                                    <label class="onoffswitch-label" for="example666">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Holiday SMS <span style="color:red;">*</span></label>
                                        <div class="col-sm-1" style="padding:10px;">
                                            <?php if($key['school_holiday_sms'] == 1) {?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" name="school_holiday_sms" id="example3166">
                                                    <label class="onoffswitch-label" for="example3166">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" class="onoffswitch-checkbox" name="school_holiday_sms" id="example3266">
                                                    <label class="onoffswitch-label" for="example3266">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-2">
                                            <a href="<?=site_url('School/school_user_details/') .$key['school_profile_id']?>"><span class="btn btn-white">Cancel</span></a>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            <span class="btn btn-primary edit_functionality">Edit Functionality</span>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                </form>
                               </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>