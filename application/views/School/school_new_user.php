        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>School User Registration</b></h3>
                                </div>
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSchool" action="<?=site_url('School/add_school_user')?>">
                            <div class="row">
                                    <div class="col-sm-3 col-sm-offset-1">
                                        <?php foreach ($school as $key) {?>
                                        <center><div class="form-group">
                                            <img src="<?=$key['school_logo']?>" height="150" width="200" alt="No Image Found" style="border:1px solid #000;padding: 15px;background-color: rgba(128, 128, 128, 0.11);border-top: 2px solid black;">
                                            <div class="col-lg-12" style="padding-top: 08px; color:#000;">
                                                <span><h3><?=$key['school_name']?></h3></span>
                                            </div>
                                        </div></center>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label">School Address </label>
                                            <div class="col-sm-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_address']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-6 control-label">School Email ID. </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_email_id']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-6 control-label">School Mobile Number :</label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_mobile_number']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-6 control-label">School Phone Number </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_phone_number']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-6 control-label">School Latitude </label>
                                            <div class="col-sm-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_latitude']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-6 control-label">School Longitude </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key['school_longitude']?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                        <?php } ?>    
                        <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Users </b></h3>
                                        </div>
                                    </div><hr>
                                </div>                          
                                
                                <div class="row">
                                    <?php 
                                        foreach ($user_details as $key1) {
                                    ?>
                                    <div class="col-sm-3">
                                        <center><div class="form-group">
                                            <img src="<?=$key1['user_photo']?>" class="img-circle" height="100" width="100" alt="No Image Found" style="border:1px solid #000;padding: 10px;background-color: rgba(128, 128, 128, 0.11);border-top: 2px solid black;">
                                            <div class="col-lg-12" style="padding-top: 08px; color:#000;">
                                                <span><h3><?=$key1['user_first_name']?>&nbsp<?=$key1['user_middle_name']?>&nbsp<?=$key1['user_last_name']?></h3></span>
                                            </div>

                                        </div>
                                        <span class="btn btn-primary details" >Details</span></center>
                                        <div class="info"  hidden>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label"> Name. </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key1['user_first_name']?>&nbsp<?=$key1['user_middle_name']?>&nbsp<?=$key1['user_last_name']?></b></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">Email ID. </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key1['user_email_id']?></b></span>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label class="col-lg-4 control-label">Mobile No. </label>
                                            <div class="col-lg-6" style="padding-top: 08px; color:#67C6F1;">
                                                <span><b><?=$key1['user_mobile_number']?></b></span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>  
                                                          
                                <div class="ibox-tools">
                                    <span class="btn btn-primary" id="add_user"><i class="fa fa-plus-square" aria-hidden="true"></i> Add User</span>
                                </div>
                                <div id="user">
                                    <div class="form-group" hidden="">
                                        <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control mobile_number" name="school_profile_id" value="<?=$key['school_profile_id']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="hr-line-dashed"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>