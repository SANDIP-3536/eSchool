        <style type="text/css">
        .wizard > .content{
            background:#fff;
        }
        </style>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Student Registration</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal wizard-big wizard clearfix" enctype="multipart/form-data" id="form" action="add_student_registration">
                                <h1>Student Information</h1>
                                <fieldset style="padding:0px;">
                                    <div class="row">
                                        <div class="form-group">
                                        <?php if($enquiry != 1){?>
                                            <label class="col-lg-2 control-label hidden">Enquiry ID</label>
                                            <div class="col-lg-3 hidden">
                                                <input type="text" name="student_enquiry_id" class="form-control " value="<?php echo $enquiry_details[0]['enquiry_id'] ?>" readonly>
                                            </div>
                                            <label class="col-lg-2 control-label">Enquiry Form Number</label>
                                            <div class="col-lg-3">
                                                 <input type="text" name="student_enquiry_form_number" class="form-control " value="<?php echo $enquiry_details[0]['enquiry_form_no'] ?>" readonly>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Admission Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder=" Student admission Date" name="student_admission_date" class="form-control datepicker1" readonly>
                                        </div>
                                        <label class="col-lg-2 control-label">Registartion Date<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder=" Student Reg. Date" name="student_reg_date" class="form-control datepicker1"  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Student Name <span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="text" class="form-control student_first_name" name="student_first_name" placeholder="First Name" id="student_first_name" value="<?php echo $enquiry_details[0]['enquiry_student_first_name'] ?>" id="student_first_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php }else{ ?>
                                                        <input type="text" class="form-control student_first_name" name="student_first_name" placeholder="First Name" id="student_first_name" id="student_first_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="text" class="form-control" name="student_middle_name" placeholder="Middle Name" value="<?php echo $enquiry_details[0]['enquiry_student_middle_name'] ?>" id="student_middle_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php }else{ ?>
                                                        <input type="text" class="form-control" name="student_middle_name" placeholder="Middle Name" id="student_middle_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="text" class="form-control" name="student_last_name" placeholder="Last Name" value="<?php echo $enquiry_details[0]['enquiry_student_last_name'] ?>" id="student_last_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php }else{ ?>
                                                        <input type="text" class="form-control" name="student_last_name" placeholder="Last Name" id="student_last_name" onkeyup="capitalize(this.id, this.value);">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Adhar Card No.<!-- <span style="color:red;">*</span> --></label>
                                        <div class="col-sm-3">
                                            <input type="text" placeholder="Student Adhar card No." data-mask="9999 9999 9999" name="student_adhar_card_number" class="form-control">
                                        </div>
                                        <label class="col-lg-2 control-label">GRN No. <span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="GRN No." name="student_GRN_regular" class="form-control" id="regular_generate">
                                            <label class="GRN_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder="GRN No." name="student_GRN_auto" class="form-control hidden" id="auto_generate" value="<?php echo $GRN_number;?>">
                                            <label class="GRN_verification_auto" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                        </div>
                                        <span class="btn btn-xs btn-primary" id="GRN_number_change"><i class="fa fa-refresh" title="Genrate"></i></span>
                                        <span class="btn btn-xs btn-primary hidden" id="auto_generate_change"><i class="fa fa-times" title="Genrate"></i></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Student Birth Date <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                            <?php if ($enquiry != 1){?>
                                                <input type="text" readonly="" placeholder="Student Birth Date" name="student_DOB" class="form-control datepicker" value="<?php echo $enquiry_details[0]['enquiry_student_DOB'] ?>">
                                            <?php }else{ ?>
                                                <input type="text" readonly="" placeholder="Student Birth Date" name="student_DOB" class="form-control datepicker">
                                            <?php } ?>
                                        </div>
                                        <label class="col-lg-2 control-label">Gender <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <?php if($enquiry != 1){ ?>
                                                    <?php if ($enquiry_details[0]['enquiry_student_gender'] == 'male') {?>
                                                        <label class="radio-inline"> 
                                                            <input type="radio" name="student_gender" value="male" checked>&nbsp  Male 
                                                        </label> 
                                                    <?php }elseif ($enquiry_details[0]['enquiry_student_gender'] == 'female') { ?>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="student_gender" value="female" checked>  &nbsp Female
                                                        </label>
                                                    <?php }else{ ?>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="student_gender" value="other" checked>  &nbsp Other
                                                        </label>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <label class="radio-inline"> 
                                                        <input type="radio" name="student_gender" value="male">&nbsp  Male 
                                                    </label> 
                                                    <label class="radio-inline">
                                                        <input type="radio" name="student_gender" value="female">  &nbsp Female
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="student_gender" value="other">  &nbsp Other
                                                    </label>
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Blood Group</label>
                                        <div class="col-lg-3">
                                            <select name="student_blood_group" class="form-control">
                                                <option>Select Blood Group</option>
                                                <option value="A+">A +ve</option>
                                                <option value="B+">B +ve</option>
                                                <option value="AB+">AB +ve</option>
                                                <option value="O+">O +ve</option>
                                                <option value="A-">A -ve</option>
                                                <option value="B-">B -ve</option>
                                                <option value="AB-">AB -ve</option>
                                                <option value="O-">O -ve</option>
                                            </select>
                                        </div>
                                        <label class="col-lg-2 control-label">Birth Place</label>
                                        <div class="col-lg-3">
                                            <INPUT type="text" placeholder=" Student Birth Place" name="student_birth_place" class="form-control" id="student_birth_place" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nationality<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder=" Student Nationality" name="student_nationality" class="form-control" id="student_nationality" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                        <label class="col-lg-2 control-label">Mother Tongue</label>
                                        <div class="col-lg-3">
                                            <input type="text" placeholder=" Student Mother Tongue" name="student_mother_tongue" class="form-control" id="student_mother_tongue" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Category</label>
                                        <div class="col-lg-3">
                                            <select name="student_category" class="form-control">
                                                <option value="0">Select Category</option>
                                                <option value="OPEN">OPEN</option>
                                                <option value="ST">ST</option>
                                                <option value="SBC">SBC</option>
                                                <option value="BC-A">BC-A</option>
                                                <option value="BC-B">BC-B</option>
                                                <option value="SC">SC</option>
                                                <option value="OBC">OBC</option>
                                                <option value="VJNT">VJNT</option>
                                                <option value="NT">NT</option>
                                            </select>
                                        </div>
                                        <label class="col-lg-2 control-label">Religion</label>
                                        <div class="col-lg-3">
                                            <INPUT type="text" placeholder="Student Religion" name="student_religion" class="form-control" id="student_religion" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Cast</label>
                                        <div class="col-lg-3">
                                            <INPUT type="text" placeholder="Student Cast" name="student_cast" class="form-control" id="student_cast" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                        <label class="col-lg-2 control-label">Sub Cast</label>
                                        <div class="col-lg-3">
                                            <INPUT type="text" placeholder="Student Sub Cast" name="student_sub_cast" class="form-control" id="student_sub_cast" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Student Photo</label>
                                        <div class="col-sm-3">
                                            <input type="file" placeholder="placeholder" name="student_photo" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                        </div>
                                    </div>
                                    <div class="ibox-title" style="border:none;border-top:1px solid #e7eaec;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Present Address Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">House No./Street Name/Landmark</label>
                                        <div class="col-lg-3">
                                        <?php if($enquiry != 1){ ?>
                                             <input type="text" class="form-control student_present_pre_house" name="student_present_house_no" placeholder="Enter the House No./Street Name/Landmark." value="<?php echo $enquiry_details[0]['enquiry_house_no'] ?>" id="student_present_house_no" onkeyup="capitalize(this.id, this.value);">
                                        <?php }else{ ?>
                                             <input type="text" class="form-control student_present_pre_house" name="student_present_house_no" placeholder="Enter the House No./Street Name/Landmark." id="student_present_house_no" onkeyup="capitalize(this.id, this.value);">
                                        <?php } ?>
                                        </div>
                                        <label class="col-lg-2 control-label">Town<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                        <?php if($enquiry != 1){ ?>
                                            <input type="text" class="form-control student_present_pre_town" name="student_present_town" placeholder="Enter the Home Town" value="<?php echo $enquiry_details[0]['enquiry_town'] ?>" id="student_present_town" onkeyup="capitalize(this.id, this.value);">
                                        <?php }else{ ?>
                                            <input type="text" class="form-control student_present_pre_town" name="student_present_town" placeholder="Enter the Home Town" id="student_present_town" onkeyup="capitalize(this.id, this.value);">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Taluka<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                        <?php if($enquiry != 1){ ?>
                                             <input type="text" class="form-control student_present_pre_tal" name="student_present_tal" placeholder="Enter the taluka." value="<?php echo $enquiry_details[0]['enquiry_tal'] ?>" id="student_present_tal" onkeyup="capitalize(this.id, this.value);">
                                        <?php }else{ ?>
                                             <input type="text" class="form-control student_present_pre_tal" name="student_present_tal" placeholder="Enter the taluka." id="student_present_tal" onkeyup="capitalize(this.id, this.value);">
                                        <?php } ?>
                                        </div>
                                        <label class="col-lg-2 control-label">District<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                        <?php if($enquiry != 1){ ?>
                                            <input type="text" class="form-control student_present_pre_dist" name="student_present_dist" placeholder="Enter the District." value="<?php echo $enquiry_details[0]['enquiry_dist'] ?>" id="student_present_dist" onkeyup="capitalize(this.id, this.value);">
                                        <?php }else{ ?>    
                                            <input type="text" class="form-control student_present_pre_dist" name="student_present_dist" placeholder="Enter the District." id="student_present_dist" onkeyup="capitalize(this.id, this.value);">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">State<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                            <select class="form-control student_present_pre_state" name="student_present_state">
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha (Orissa)">Odisha (Orissa)</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                        </div>
                                        <label class="col-lg-2 control-label">Pin Code<span style="color:red;">*</span></label>
                                        <div class="col-lg-3">
                                        <?php if($enquiry != 1){ ?>
                                            <input type="text" class="form-control student_present_pre_pincode" name="student_present_pincode" placeholder="Enter the Pin Code." value="<?php echo $enquiry_details[0]['enquiry_pincode'] ?>">
                                        <?php }else{ ?>
                                            <input type="text" class="form-control student_present_pre_pincode" name="student_present_pincode" placeholder="Enter the Pin Code.">
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="ibox-title" style="border:none;border-top:1px solid #e7eaec;">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <h3><b>Permament Address Details</b>
                                                <label class="radio-inline" style="padding-top:0px;font-size: 11px;"> 
                                                    <input type="checkbox" name="copy_student_permament_address" class="copy_student_permament_address">&nbsp Same As Student Present Address. 
                                                </label></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">House No./Street Name/Landmark</label>
                                        <div class="col-lg-3">
                                             <input type="text" class="form-control student_permament_pre_house" name="student_permament_house_no" placeholder="Enter the House No./Street Name/Landmark." id="student_permament_house_no" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                        <label class="col-lg-2 control-label">Town</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control student_permament_pre_town" name="student_permament_town" placeholder="Enter the Home Town." id="student_permament_town" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Taluka</label>
                                        <div class="col-lg-3">
                                             <input type="text" class="form-control student_permament_pre_tal" name="student_permament_tal" placeholder="Enter the taluka." id="student_permament_tal" onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                        <label class="col-lg-2 control-label">District</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control student_permament_pre_dist" name="student_permament_dist" id="student_permament_dist" placeholder="Enter the District." onkeyup="capitalize(this.id, this.value);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">State</label>
                                        <div class="col-lg-3">
                                            <select class="form-control student_present_pre_state" name="student_permament_state">
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha (Orissa)">Odisha (Orissa)</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                        </div>
                                        <label class="col-lg-2 control-label">Pin Code</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control student_permament_pre_pincode" name="student_permament_pincode" placeholder="Enter the Pin Code.">
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                                <h1>Parent Details</h1>
                                <fieldset style="padding:0px;">
                                   <div class="" id="family_details">
                                        <div class="ibox-title" style="border:none;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <h3><b>Parents</b></h3>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <label class="radio-inline" readonly> 
                                                            <input type="checkbox" name="parent_type_show[]" value="1"  class="father_details" checked>&nbsp  Father 
                                                        </label>
                                                        <label class="radio-inline" readonly> 
                                                            <input type="checkbox" name="parent_type_show[]" value="2" class="mother_details">&nbsp  Mother 
                                                        </label>
                                                        <label class="radio-inline"> 
                                                            <input type="checkbox" name="parent_type_show[]" class="gardien_details" value="3">&nbsp  Gardien 
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="father_details">
                                            <div class="ibox-title" style="border-top:1px solid #e7eaec;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Fill Father Details</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group hidden">
                                                <label class="col-lg-2 control-label">Parent Type <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <label class="radio-inline"> 
                                                        <input type="checkbox" name="parent_type[0]" value="1" checked>&nbsp  Father 
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Father Name <span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <div class="col-sm-4">
                                                            <?php if ($enquiry != 1){?>
                                                                <input type="text" class="form-control parent_first_name" name="parent_first_name[0]" placeholder="First Name" value="<?php echo $enquiry_details[0]['enquiry_parent_first_name'] ?>" id="father_first_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php }else{ ?>
                                                                <input type="text" class="form-control parent_first_name" name="parent_first_name[0]" placeholder="First Name" id="father_first_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php if ($enquiry != 1){?>
                                                            <input type="text" class="form-control" name="parent_middle_name[0]" placeholder="Middle Name" value="<?php echo $enquiry_details[0]['enquiry_parent_middle_name'] ?>" id="father_middle_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php }else{ ?>
                                                                <input type="text" class="form-control" name="parent_middle_name[0]" placeholder="Middle Name" id="father_middle_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <?php if ($enquiry != 1){?>
                                                                <input type="text" class="form-control" name="parent_last_name[0]" placeholder="Last Name" value="<?php echo $enquiry_details[0]['enquiry_parent_last_name'] ?>" id="father_last_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php }else{ ?>
                                                                <input type="text" class="form-control" name="parent_last_name[0]" placeholder="Last Name" id="father_last_name" onkeyup="capitalize(this.id, this.value);">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               <label class="col-lg-2 control-label">Father Birth Date <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" readonly="" placeholder="Parent Birth Date" name="parent_DOB[0]" class="form-control datepicker">
                                                </div>
                                               
                                                <label class="col-lg-2 control-label">Gender <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" name="parent_gender[0]" value="male" style="border:none;" class="form-control hidden">&nbsp  Male 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Father Mobile No. <span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="text" class="form-control mobile" id="mobile" name="parent_mobile_number[0]" placeholder="Parent Mobile No." value="<?php echo $enquiry_details[0]['enquiry_parent_mobile_number'] ?>">
                                                        <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                    <?php }else{ ?>
                                                        <input type="text" class="form-control mobile" id="mobile" name="parent_mobile_number[0]" placeholder="Parent Mobile No.">
                                                        <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                    <?php } ?>
                                                </div>
                                                <label class="col-sm-2 control-label">Father Email ID.</label>
                                                <div class="col-sm-3">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="email" class="form-control email_id" id="email_id" name="parent_email_id[0]" placeholder="Parent Email Address" value="<?php echo $enquiry_details[0]['enquiry_parent_email_id'] ?>">
                                                        <label class="email_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                    <?php }else{ ?>
                                                        <input type="email" class="form-control email_id" id="email_id" name="parent_email_id[0]" placeholder="Parent Email Address">
                                                        <label class="email_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Father Qualification</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="parent_qualification[0]" placeholder="Parent Qualification" >
                                                </div>
                                                <label class="col-sm-2 control-label">Father Occupation</label>
                                                <div class="col-sm-3">
                                                    <?php if ($enquiry != 1){?>
                                                        <input type="text" class="form-control" name="parent_occupation[0]" placeholder="Parent Occupation" value="<?php echo $enquiry_details[0]['enquiry_parent_occupation'] ?>" id="father_occ upation" onkeyup="capitalize(this.id, this.value);">
                                                    <?php }else{ ?>
                                                        <input type="text" class="form-control" name="parent_occupation[0]" placeholder="Parent Occupation" id="father_occupation" onkeyup="capitalize(this.id, this.value);">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Father Photo</label>
                                                <div class="col-sm-7">
                                                    <input type="file" name="parent_photo[0]" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">House No./Street Name/Landmark</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_father_house" name="parent_permament_house_no[0]" placeholder="Enter the House No./Street Name/Landmark." id="father_house" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">Town</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_father_town" name="parent_permament_town[0]" placeholder="Enter the Home Town." id="father_town" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Taluka</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_father_tal" name="parent_permament_tal[0]" placeholder="Enter the taluka." id="father_tal" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">District</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_father_dist" name="parent_permament_dist[0]" placeholder="Enter the District." id="father_dist" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">State</label>
                                                                    <div class="col-lg-6">
                                                                        <select class="form-control parent_present_father_state" name="parent_permament_state[0]">
                                                                            <option value="Maharashtra">Maharashtra</option>
                                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                            <option value="Assam">Assam</option>
                                                                            <option value="Bihar">Bihar</option>
                                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                                            <option value="Goa">Goa</option>
                                                                            <option value="Gujarat">Gujarat</option>
                                                                            <option value="Haryana">Haryana</option>
                                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                            <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                                            <option value="Jharkhand">Jharkhand</option>
                                                                            <option value="Karnataka">Karnataka</option>
                                                                            <option value="Kerala">Kerala</option>
                                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                            <option value="Manipur">Manipur</option>
                                                                            <option value="Meghalaya">Meghalaya</option>
                                                                            <option value="Mizoram">Mizoram</option>
                                                                            <option value="Nagaland">Nagaland</option>
                                                                            <option value="Odisha (Orissa)">Odisha (Orissa)</option>
                                                                            <option value="Punjab">Punjab</option>
                                                                            <option value="Rajasthan">Rajasthan</option>
                                                                            <option value="Sikkim">Sikkim</option>
                                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                                            <option value="Telangana">Telangana</option>
                                                                            <option value="Tripura">Tripura</option>
                                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                            <option value="Uttarakhand">Uttarakhand</option>
                                                                            <option value="West Bengal">West Bengal</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label"></label>
                                                                    <div class="col-sm-7">
                                                                        <label class="radio-inline" style="padding-top:0px;"> 
                                                                            <input type="checkbox" name="student_father_address[0]" class="student_father_address">&nbsp Same As Student Address 
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Pin Code</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control parent_permament_father_pincode" name="parent_permament_pincode[0]" placeholder="Enter the Pin Code.">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-1 col-sm-12">
                                                    <div class="radio">
                                                        <input id="student_parent_primary" type="radio" name="student_parent_primary[]"  value="1" checked>
                                                        <label for="">Do You Want To Register This Number For Daily Communication</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mother_details">
                                            <div class="ibox-title" style="border-top:1px solid #e7eaec;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Fill Mother Details</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group hidden">
                                                <label class="col-lg-2 control-label">Parent Type <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="parent_type[1]" value="2" checked>  &nbsp Mother 
                                                    </label>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-sm-2 control-label">Mother Name <span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
                                                     <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control parent_first_name" name="parent_first_name[1]" placeholder="First Name" id="mother_first" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="parent_middle_name[1]" placeholder="Middle Name" id="mother_middle" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="parent_last_name[1]" placeholder="Last Name" id="mother_last" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               <label class="col-lg-2 control-label">Mother Birth Date <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" readonly="" placeholder="Parent Birth Date" name="parent_DOB[1]" class="form-control datepicker">
                                                </div>
                                         
                                                <label class="col-lg-2 control-label">Gender <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" name="parent_gender[1]" value="female" class="form-control hidden" style="border:none;">  &nbsp Female
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Mother Mobile No. <span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control mobile" name="parent_mobile_number[1]" placeholder="Parent Mobile No.">
                                                    <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                </div>
                                                <label class="col-sm-2 control-label">Mother Email ID.</label>
                                                <div class="col-sm-3">
                                                    <input type="email" class="form-control email_id" id="email_id" name="parent_email_id[1]" placeholder="Parent Email Address">
                                                    <label class="email_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Mother Qualification</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="parent_qualification[1]" placeholder="Parent Qualification">
                                                </div>
                                                <label class="col-sm-2 control-label">Mother Occupation</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="parent_occupation[1]" placeholder="Parent Occupation" id="mother_occu" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Mother Photo</label>
                                                <div class="col-sm-3">
                                                    <input type="file" name="parent_photo[1]" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">House No./Street Name/Landmark</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_mother_house" name="parent_permament_house_no[1]" placeholder="Enter the House No./Street Name/Landmark." id="mother_house" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">Town</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_mother_town" name="parent_permament_town[1]" placeholder="Enter the Home Town." id="mother_town" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Taluka</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_mother_tal" name="parent_permament_tal[1]" placeholder="Enter the taluka." id="mother_tal" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">District</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_mother_dist" name="parent_permament_dist[1]" placeholder="Enter the District." id="mother_dist" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">State</label>
                                                                    <div class="col-lg-6">
                                                                        <select class="form-control parent_present_mother_state" name="parent_permament_state[1]">
                                                                            <option value="Maharashtra">Maharashtra</option>
                                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                            <option value="Assam">Assam</option>
                                                                            <option value="Bihar">Bihar</option>
                                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                                            <option value="Goa">Goa</option>
                                                                            <option value="Gujarat">Gujarat</option>
                                                                            <option value="Haryana">Haryana</option>
                                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                            <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                                            <option value="Jharkhand">Jharkhand</option>
                                                                            <option value="Karnataka">Karnataka</option>
                                                                            <option value="Kerala">Kerala</option>
                                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                            <option value="Manipur">Manipur</option>
                                                                            <option value="Meghalaya">Meghalaya</option>
                                                                            <option value="Mizoram">Mizoram</option>
                                                                            <option value="Nagaland">Nagaland</option>
                                                                            <option value="Odisha (Orissa)">Odisha (Orissa)</option>
                                                                            <option value="Punjab">Punjab</option>
                                                                            <option value="Rajasthan">Rajasthan</option>
                                                                            <option value="Sikkim">Sikkim</option>
                                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                                            <option value="Telangana">Telangana</option>
                                                                            <option value="Tripura">Tripura</option>
                                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                            <option value="Uttarakhand">Uttarakhand</option>
                                                                            <option value="West Bengal">West Bengal</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label"></label>
                                                                    <div class="col-sm-7">
                                                                        <label class="radio-inline" style="padding-top:0px;"> 
                                                                            <input type="checkbox" name="student_mother_address[1]" class="student_mother_address">&nbsp Same As Student Address 
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Pin Code</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control parent_permament_mother_pincode" name="parent_permament_pincode[1]" placeholder="Enter the Pin Code.">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-1 col-sm-12">
                                                <div class="radio">
                                                    <input id="student_parent_primary" type="radio" name="student_parent_primary[]" value="1">
                                                    <label for="">Do You Want To Register This Number For Daily Communication</label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="gardien_details">
                                            <div class="ibox-title" style="border-top:1px solid #e7eaec;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Fill Gardian Details</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group hidden">
                                                <label class="col-lg-2 control-label">Parent Type <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <label class="radio-inline">
                                                        <input type="checkbox" name="parent_type[2]" value="3" checked>  &nbsp Gardian 
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gardian Name <span style="color:red;">*</span></label>
                                                <div class="col-sm-8">
                                                     <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control parent_first_name" name="parent_first_name[2]" placeholder="First Name" id="gardien_first" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="parent_middle_name[2]" placeholder="Middle Name" id="gardien_middle" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="parent_last_name[2]" placeholder="Last Name" id="gardien_last" onkeyup="capitalize(this.id, this.value);">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               <label class="col-lg-2 control-label">Gardian Birth Date <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" readonly="" placeholder="Parent Birth Date" name="parent_DOB[2]" class="form-control datepicker">
                                                </div>
                                         
                                                <label class="col-lg-2 control-label">Gender <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="parent_gender[2]" value="male">  &nbsp Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="parent_gender[2]" value="female">  &nbsp Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gardian Mobile No. <span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control mobile" name="parent_mobile_number[2]" placeholder="Parent Mobile No.">
                                                    <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                </div>
                                                <label class="col-sm-2 control-label">Gardian Email ID.</label>
                                                <div class="col-sm-3">
                                                    <input type="email" class="form-control email_id" id="email_id" name="parent_email_id[2]" placeholder="Parent Email Address">
                                                    <label class="email_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gardian Qualification</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="parent_qualification[2]" placeholder="Parent Qualification">
                                                </div>
                                                <label class="col-sm-2 control-label">Gardian Occupation</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="parent_occupation[2]" placeholder="Parent Occupation" id="gardien_occ" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Gardian Photo</label>
                                                <div class="col-sm-7">
                                                    <input type="file" name="parent_photo[2]" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">House No./Street Name/Landmark</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_gardien_house" name="parent_permament_house_no[2]" placeholder="Enter the House No./Street Name/Landmark." id="gardien_house" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">Town</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_gardien_town" name="parent_permament_town[2]" placeholder="Enter the Home Town." id="gardien_town" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Taluka</label>
                                                <div class="col-lg-3">
                                                     <input type="text" class="form-control parent_permament_gardien_tal" name="parent_permament_tal[2]" placeholder="Enter the taluka." id="gardien_tal" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                                <label class="col-lg-2 control-label">District</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control parent_permament_gardien_dist" name="parent_permament_dist[2]" placeholder="Enter the District." id="gardien_dist" onkeyup="capitalize(this.id, this.value);">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">State</label>
                                                                    <div class="col-lg-6">
                                                                        <select class="form-control parent_present_gardien_state" name="parent_permament_state[2]">
                                                                            <option value="Maharashtra">Maharashtra</option>
                                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                            <option value="Assam">Assam</option>
                                                                            <option value="Bihar">Bihar</option>
                                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                                            <option value="Goa">Goa</option>
                                                                            <option value="Gujarat">Gujarat</option>
                                                                            <option value="Haryana">Haryana</option>
                                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                            <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                                                            <option value="Jharkhand">Jharkhand</option>
                                                                            <option value="Karnataka">Karnataka</option>
                                                                            <option value="Kerala">Kerala</option>
                                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                            <option value="Manipur">Manipur</option>
                                                                            <option value="Meghalaya">Meghalaya</option>
                                                                            <option value="Mizoram">Mizoram</option>
                                                                            <option value="Nagaland">Nagaland</option>
                                                                            <option value="Odisha (Orissa)">Odisha (Orissa)</option>
                                                                            <option value="Punjab">Punjab</option>
                                                                            <option value="Rajasthan">Rajasthan</option>
                                                                            <option value="Sikkim">Sikkim</option>
                                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                                            <option value="Telangana">Telangana</option>
                                                                            <option value="Tripura">Tripura</option>
                                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                            <option value="Uttarakhand">Uttarakhand</option>
                                                                            <option value="West Bengal">West Bengal</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label"></label>
                                                                    <div class="col-sm-7">
                                                                        <label class="radio-inline" style="padding-top:0px;"> 
                                                                            <input type="checkbox" name="student_gardien_address[2]" class="student_gardien_address">&nbsp Same As Student Address 
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Pin Code</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control parent_permament_gardien_pincode" name="parent_permament_pincode[2]" placeholder="Enter the Pin Code.">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-1 col-sm-12">
                                                    <div class="radio">
                                                        <input id="student_parent_primary" type="radio" name="student_parent_primary[]" value="1">
                                                        <label for="">Do You Want To Register This Number For Daily Communication</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Document Details</h1>
                                <fieldset style="padding:0px;">
                                    <div class="ibox-title" style="border-top:none;">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <h3><b>Documents</b></h3>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-09">
                                                    <label class="radio-inline" readonly> 
                                                        <input type="checkbox" name="doc_name_show[]" value="Adhar_Card"  class="AC_details" checked>&nbsp  Adhar Card 
                                                    </label>
                                                    <label class="radio-inline"> 
                                                        <input type="checkbox" name="doc_name_show[]" value="Transfer_Certificate" class="TC_details">&nbsp  Transfer Certificate (TC) 
                                                    </label>
                                                    <label class="radio-inline"> 
                                                        <input type="checkbox" name="doc_name_show[]" class="BC_details" value="Birth_Certificate">&nbsp  Birth Certificate
                                                    </label>
                                                    <label class="radio-inline"> 
                                                        <input type="checkbox" name="doc_name_show[]" class="LC_details" value="Leaving_Certificate">&nbsp  Leaving Certificate (LC)
                                                    </label>
                                                    <label class="radio-inline"> 
                                                        <input type="checkbox" name="doc_name_show[]" class="MC_details" value="Medical_Certificate">&nbsp  Medical Certificate (If Any)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="AC_details">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Fill Adhar Card Details</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group hidden">
                                            <label class="col-lg-2 control-label">Document Name <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="doc_name[0]" value="Adhar_Card" checked>  &nbsp Adhar Card 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Adhar Card Number <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Student Adhar Card Number " name="doc_number[0]" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Document File <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="file" placeholder="placeholder" name="doc_file[0]" class="form-control" accept="file/pdf,file/doc,file/jpeg" style="border:none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Type <span style="color:red;">*</span></label>
                                            <div class="col-lg-5">
                                                <div class="col-sm-6">
                                                    <label class="radio-inline"> 
                                                        <input type="radio" name="doc_type[0]" value="1" checked>&nbsp  Original 
                                                    </label>
                                                    <label class="radio-inline"> 
                                                        <input type="radio" name="doc_type[0]" value="0" >&nbsp  Duplicate 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="TC_details">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Fill Transfer Certificate Details</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group hidden">
                                            <label class="col-lg-2 control-label">Document Name <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="doc_name[1]" value="Transfer_Certificate" checked>  &nbsp Transfer Certificate 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Transfer Certificate Number <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Student Transfer Certificate Number " name="doc_number[1]" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Document File <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="file" placeholder="placeholder" name="doc_file[1]" class="form-control" accept="file/pdf,file/doc,file/jpeg" style="border:none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Type <span style="color:red;">*</span></label>
                                            <div class="col-lg-5">
                                                <div class="col-sm-6">
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[1]" value="1" checked>&nbsp  Original 
                                                    </label>
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[1]" value="0" >&nbsp  Duplicate 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="BC_details">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Fill Birth Certificate Details</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group hidden">
                                            <label class="col-lg-2 control-label">Document Name <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="doc_name[2]" value="Birth_Certificate" checked>  &nbsp Birth Certificate 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Birth Certificate Number <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Student Birth Certificate Number " name="doc_number[2]" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Document File <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="file" placeholder="placeholder" name="doc_file[2]" class="form-control" accept="file/pdf,file/doc,file/jpeg" style="border:none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Type <span style="color:red;">*</span></label>
                                            <div class="col-lg-5">
                                                <div class="col-sm-6">
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[2]" value="1" checked>&nbsp  Original 
                                                    </label>
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[2]" value="0" >&nbsp  Duplicate 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="LC_details">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Fill Living  Certificate Details</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group hidden">
                                            <label class="col-lg-2 control-label">Document Name <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="doc_name[3]" value="Living_Certificate" checked>  &nbsp Living Certificate 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Living Certificate Number <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Student Living CertificateMedical Certificate Number " name="doc_number[3]" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Document File <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="file" placeholder="placeholder" name="doc_file[3]" class="form-control" accept="file/pdf,file/doc,file/jpeg" style="border:none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Type <span style="color:red;">*</span></label>
                                            <div class="col-lg-5">
                                                <div class="col-sm-6">
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[3]" value="1" checked>&nbsp  Original 
                                                    </label>
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[3]" value="0" >&nbsp  Duplicate 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="MC_details">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Fill Medical Certificate Details (If Any)</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group hidden">
                                            <label class="col-lg-2 control-label">Document Name <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <label class="radio-inline">
                                                    <input type="checkbox" name="doc_name[4]" value="Medical_Certificate" checked>  &nbsp Medical Certificate 
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Medical Certificate Number <span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Student Medical Certificate Number " name="doc_number[4]" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Document File <span style="color:red;">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="file" placeholder="placeholder" name="doc_file[4]" class="form-control" accept="file/pdf,file/doc,file/jpeg" style="border:none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Type <span style="color:red;">*</span></label>
                                            <div class="col-lg-5">
                                                <div class="col-sm-6">
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[4]" value="1" checked>&nbsp  Original 
                                                    </label>
                                                    <label class="radio-inline" readonly> 
                                                        <input type="radio" name="doc_type[4]" value="0" >&nbsp  Duplicate 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Class & Fees Details</h1>
                                <fieldset style="padding:0px;">
                                    <!-- <h2>Terms and Conditions</h2> -->
                                    <div class="ibox-title" style="border-top:none; border-bottom:">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <h3><b>Assign Class & Division</b></h3>
                                            </div>
                                             <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label class="col-lg-1 control-label">Class</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control class_details" name="SCD_class_id">
                                                                <option value="0">Select Class</option>
                                                                <?php foreach ($class_details as $key) { ?>
                                                                    <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label class="col-lg-1 control-label">Division</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control division_details" name="SCD_division_id">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div><hr></div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="ibox-title" style="border-top:none;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Class wise Fee's</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="form-group"  style="border-bottom: 1px solid #000000;">
                                                    <label class="col-sm-1 control-label">Sr.No</label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;">Type</label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;">Category</label>
                                                    <label class="col-sm-2 control-label" style="text-align:left;">Amount</label>
                                                    <label class="col-sm-1 control-label" style="text-align:center;">Select</label>
                                                </div>
                                                <div class="fee_details">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="ibox-title" style="border-top:none;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Select Other Fee's</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="form-group" style="border-bottom: 1px solid #000000;">
                                                    <label class="col-sm-1 control-label">Sr.No</label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;">Type</label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;">Category</label>
                                                    <label class="col-sm-2 control-label" style="text-align:left;">Amount</label>
                                                    <label class="col-sm-1 control-label" style="text-align:center;">Select</label>
                                                </div>
                                                <?php $i =1; foreach ($fee_type as $key) { ?>
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label"><?=$i++;?>)</label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;"><?=$key['fees_type_name']?></label>
                                                    <label class="col-sm-4 control-label" style="text-align:center;"><?=$key['fee_category_name']?></label>
                                                    <div class="col-sm-2" style="text-align:left;">    
                                                        <input type="text" class="form-control"  name="" value="<?php  echo number_format($key['fees_type_amount'])?>" readonly>
                                                        <input type="text" class="form-control hidden"  name="total_fee_amount[]" value="<?=$key['fees_type_amount']?>" readonly>
                                                    </div>
                                                    <div class="col-sm-1" style="text-align:center;">
                                                        <label class="checkbox-inline i-checks"> <input type="checkbox" name="fee_type_id[]" value="<?=$key['fees_type_id']?>"></label> 
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label> -->
                                </fieldset>

                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>