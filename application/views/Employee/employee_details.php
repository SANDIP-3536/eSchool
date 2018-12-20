         <div class="wrapper wrapper-content">
            <?php foreach ($update_employee as $key) { ?>
            <div class="row animated fadeInRight">
                  <div class="col-md-offset-1 col-md-3" style="padding-right:0px;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background: #2f4050;">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h5  style="color: #fff;">Employee Profile Photo </h5>
                                </div>
                                <div class="col-lg-3" style="text-align:right;">
                                    <span class="btn btn-xs btn-white edit_profile"><i class="fa fa-pencil"></i></span>
                                    <span class="btn btn-xs btn-white cancel_profile"><i class="fa fa-times"></i> </span>
                                </div>
                            </div> 
                        </div>
                        <div class="ibox-content no-padding border-left-right" >
                           <center> 
                            <div class="img-wrapper profile_normal">
                                <img alt="Student Photo" class="img-responsive" src="<?=$key['employee_photo']?>" style="width: 55%;padding: 15px;">
                            </div>
                            <div class="ibox-content profile_normal"></div>
                            <div class="img-wrapper profile_hide">
                                <img alt="Student Photo" class="img-responsive" src="<?=$key['employee_photo']?>" style="width: 55%;padding: 15px; opacity:0.1;">
                            </div>
                            <div class="ibox-content profile_hide">
                            <div class="data">
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addStudent" action="<?=site_url('Employee/edit_profile')?>">
                                    <div class="form-group hidden">
                                        <div class="col-lg-3">
                                            <input type="text" name="employee_profile_id" class="form-control" value="<?=$key['employee_profile_id']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Profile Photo</label>
                                        <div class="col-lg-9">
                                            <input type="file" placeholder="placeholder" name="employee_photo" class="form-control" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                        </div>
                                        <div class="col-lg-1">
                                            <button class="btn btn-xs btn-primary" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-7" style="padding-left:0px;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="background: #2f4050;">
                     <div class="row">
                        <div class="col-lg-9">
                            <h5 style="color: #fff;">Employee Details</h5>
                        </div>   
                        <div class="col-lg-3" style="text-align:right;">
                            <a class="btn btn-xs btn-white" href="<?=site_url('Employee/update_employee/'.$key['employee_profile_id'])?>"><i class="fa fa-pencil" title="Edit Employee Details"></i></a>
                            <a class="btn btn-xs btn-white" href="<?=site_url('Employee/add_document/'.$key['employee_profile_id'])?>"><i class="fa fa-file" title="Add New Document"></i></a>
                            <?php if($key['employee_expiry_date'] == '9999-12-31') {?>
                                <a class="btn btn-xs btn-danger" href="<?=site_url('Employee/employee_deactive/'.$key['employee_profile_id'])?>"><i class="fa fa-ban" title="Deactivate Employee"></i></a>
                            <?php }else{ ?>
                                <a href="<?=site_url('Employee/employee_active/' .$key['employee_profile_id'])?>"><span class="btn btn-xs btn-success"><i class="fa fa-ban" title="Employee Active"></i></a></span>
                            <?php } ?>
                        </div>            
                    </div>
                </div>
                <div class="ibox-content">
                    <div> 
                     <div class="feed-activity-list">
                        <div class="feed-element" style="padding-top: 15px;">
                            <div class="media-body ">
                                <div class="form-group">
                                    <div class="col-sm-2"> <strong>Name</strong></div>
                                    <div class="col-sm-6"><?=$key['employee_first_name']?> <?=$key['employee_middle_name']?> <?=$key['employee_last_name']?></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="feed-activity-list">
                        <div class="feed-element" style="padding-top: 15px;"> 
                            <div class="media-body ">
                             <div class="form-group">
                                <div class="col-sm-2"> <strong>Date of Birth</strong></div>
                                <div class="col-sm-3"> <?=$key['employee_DOB']?></div>
                                <div class="col-sm-2"> <strong>Gender</strong></div>
                                <div class="col-sm-3"> <?=$key['employee_gender']?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feed-activity-list">
                    <div class="feed-element" style="padding-top: 15px;">
                        <div class="media-body ">
                         <div class="form-group">
                            <div class="col-sm-2"> <strong>Mobile No.</strong></div>
                            <div class="col-sm-3"> <?=$key['employee_pri_mobile_number']?></div>
                            <div class="col-sm-2"> <strong> Email</strong></div>
                            <div class="col-sm-4"> <?=$key['employee_email_id']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feed-activity-list">
                <div class="feed-element" style="padding-top: 15px;">
                    <div class="media-body ">
                     <div class="form-group">
                        <div class="col-sm-2"> <strong>Education</strong></div>
                        <div class="col-sm-3"> <?=$key['employee_higher_education']?></div>
                        <div class="col-sm-2"> <strong> Experience</strong></div>
                        <div class="col-sm-4"> <?=$key['employee_experiance']?></div>
                    </div>
                </div>
            </div>
            <div class="feed-activity-list">
                <div class="feed-element" style="padding-top: 15px;">
                    <div class="media-body ">
                     <div class="form-group">
                        <div class="col-sm-2"> <strong> Address</strong></div>
                        <div class="col-sm-6"> <?=$key['employee_address']?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox-title" style="background: #2f4050;">
            <div class="row">
                <div class="col-lg-10">
                    <h5  style="color: #fff;">Authetication Details</h5>
                </div>
            </div> 
        </div>
        <div class="ibox-content">
            <div class="feed-activity-list">
                <div class="feed-element" style="padding-top: 15px;">
                    <div class="media-body ">
                        <div class="form-group">
                            <div class="col-sm-2"> <strong> Username</strong></div>
                            <div class="col-sm-5"> <?=$key['credential_username']?></div>
                            <div class="col-sm-1"> <strong></strong></div>
                            <div class="col-sm-4" style="text-align:right;"> <button class="btn btn-primary btn-xs" data-toggle="modal" id ='<?=$key['employee_profile_id']?>-<?=$key['employee_type']?>' data-target="#resetPassword">Reset Password</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php }?>
<div class="row">
    <div class="col-md-offset-1 col-md-10" style="padding-right:0px;">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h5><b>Employee Documents</b></h5>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
               <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Document Name</th>
                            <th>Document Number</th>
                            <th>Document file</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;
                        foreach ($document as $key) {?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?=$key['doc_name']?></td>
                            <td><?=$key['doc_number']?></td>
                            <td><a href="<?=$key['doc_file']?>" download ><i class="fa fa-download fa-2x"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="resetPassword" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal addStudent1" id="addStudent1" action="<?=site_url('Employee/reset_employee_password')?>" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label class="col-sm-3 control-label">Employee ID</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control employee_reset_password" name="employee_id">
                        </div>
                        <label class="col-sm-3 control-label">Employee Type</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control employee_type_reset_password" name="employee_type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="confirm_pass">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-6" style="text-align:right;">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
