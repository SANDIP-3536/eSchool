        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins aactive">
                        <div class="ibox float-e-margins list">
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><i class="fa fa-th list_view" aria-hidden="true"><b> Students Details</b></i></h3>
                                    </div>
                                    <?php if ($user_type == 3) { ?>
                                    <div class="col-sm-6">
                                        <div class="ibox-tools">
                                            <span class="btn btn-xs btn-danger stu_deactive">Student Alumani</span>
                                            <a href="<?=site_url('Student/student_registration')?>"><button class="btn btn-xs btn-primary">Student Registration</button></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th hidden>Student Profile</th>
                                                <th>GRN No.</th>
                                                <th>Adhar Card No.</th>
                                                <th>Student Name</th>
                                                <th>Parent Details</th>
                                                <th>Mobile No.</th>
                                                <th>Email ID.</th>
                                                <th> Gender</th>
                                                <th> Nationality</th>
                                                <th> Address</th>
                                                <th>Student DOB</th>
                                                <!-- <th>Actions</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;
                                            foreach ($student as $key) {
                                               ?>
                                                <tr class="student_details">
                                                    <td><?=$i++?></td>
                                                    <td class="student_details_profile hidden"><?=$key['student_profile_id']?></td>
                                                    <td><?=$key['student_GRN']?></td>
                                                    <td><?=$key['student_adhar_card_number']?></td>
                                                    <td><?=ucfirst($key['student_first_name'])?>&nbsp<?=ucfirst($key['student_middle_name'])?>&nbsp<?=ucfirst($key['student_last_name'])?></td>
                                                    <td><?=ucfirst($key['parent_first_name'])?>&nbsp<?=ucfirst($key['parent_middle_name'])?>&nbsp<?=ucfirst($key['parent_last_name'])?></td>
                                                    <td><?=$key['parent_mobile_number']?></td>
                                                    <td><?=$key['parent_email_id']?></td>
                                                    <td><?=ucfirst($key['student_gender'])?></td>
                                                    <td><?=ucfirst($key['student_nationality'])?></td>
                                                    <td><?=ucfirst($key['student_present_house_no'])?> <?=ucfirst($key['student_present_town'])?> <?=ucfirst($key['student_present_tal'])?> <?=ucfirst($key['student_present_dist'])?> <?=ucfirst($key['student_present_state'])?> <?=ucfirst($key['student_present_pincode'])?></td>
                                                    <td><?=$key['student_DOB']?></td>
                                                </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="ibox float-e-margins grid" >
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><i class="fa fa-list grid_view" aria-hidden="true"></i><b> Students Details</b></h3>
                                    </div>
                                    <?php if ($user_type == 3) { ?>
                                    <div class="col-sm-6">
                                        <div class="ibox-tools">
                                            <span class="btn btn-xs btn-danger stu_deactive">Student Alumani</span>
                                            <a href="<?=site_url('Student/student_registration')?>"><button class="btn btn-xs btn-primary">Student Registration</button></a>
                                           
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                   <?php $i=1;
                                   foreach ($student as $key) {
                                       ?>

                                        <?php if($key['student_expiry_date']=='9999-12-31') {?>
                                        <div class="col-md-2">
                                            <div class="ibox-content text-center" style="padding: 5% 0%;">
                                                <h3><?=$key['student_first_name']?>&nbsp<?=$key['student_last_name']?></h3>
                                                <div class="m-b-sm">
                                                    <img alt="image" class="img-circle" src="<?=$key['student_photo']?>" style="max-width:25%;height: 85px;">
                                                </div>
                                                <p class="font-bold">GRN No. <?=$key['student_GRN']?></p>
                                                <p class="font-bold">Mobile No. <?=$key['parent_mobile_number']?></p>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        
                                    <?php } ?>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox float-e-margins deactive" >
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Students Details</b></h3>
                                </div>
                                <?php if ($user_type == 3) { ?>
                                <div class="col-sm-6">
                                    <div class="ibox-tools">
                                        <span class="btn btn-xs btn-primary stu_active">Student</span>
                                        <a href="<?=site_url('Student/student_registration')?>"><button class="btn btn-xs btn-primary">Student Registration</button></a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                           <th>Sr No.</th>
                                            <th hidden>Student Profile</th>
                                            <th>GRN No.</th>
                                            <th>Adhar Card No.</th>
                                            <th>Student Name</th>
                                            <th>Parent Details</th>
                                            <th>Mobile No.</th>
                                            <th>Email ID.</th>
                                            <th> Gender</th>
                                            <th> Nationality</th>
                                            <th> Address</th>
                                            <th>Student DOB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;
                                        foreach ($alumini as $key) {
                                           ?>
                                           <tr class="student_details">
                                                <td><?=$i++?></td>
                                                <td class="student_details_profile hidden"><?=$key['student_profile_id']?></td>
                                                <td><?=$key['student_GRN']?></td>
                                                <td><?=$key['student_adhar_card_number']?></td>
                                                <td><?=ucfirst($key['student_first_name'])?>&nbsp<?=ucfirst($key['student_middle_name'])?>&nbsp<?=ucfirst($key['student_last_name'])?></td>
                                                <td><?=ucfirst($key['parent_first_name'])?>&nbsp<?=ucfirst($key['parent_middle_name'])?>&nbsp<?=ucfirst($key['parent_last_name'])?></td>
                                                <td><?=$key['parent_mobile_number']?></td>
                                                <td><?=$key['parent_email_id']?></td>
                                                <td><?=ucfirst($key['student_gender'])?></td>
                                                <td><?=ucfirst($key['student_nationality'])?></td>
                                                <td><?=ucfirst($key['student_present_house_no'])?> <?=ucfirst($key['student_present_town'])?> <?=ucfirst($key['student_present_tal'])?> <?=ucfirst($key['student_present_dist'])?> <?=ucfirst($key['student_present_state'])?> <?=ucfirst($key['student_present_pincode'])?></td>
                                                <td><?=$key['student_DOB']?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        