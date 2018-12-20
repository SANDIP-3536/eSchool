        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Homework</b></h3>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="ibox-tools">
                                                <span class="btn btn-xs btn-primary" id="toggle_route"> Add </span>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content class_details_hide">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSubject" action="<?=site_url('Homework/homework_registration')?>">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Date<span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <input type="text" placeholder="Date" name="hw_datetime" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"readonly>
                                            </div>
                                            <label class="col-lg-2 control-label">Home Work<span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <select name="hw_TCDS_id" class="form-control">
                                                    <option>Select Subject</option>
                                                    <?php foreach ($TCDS as $key) { ?>
                                                        <option value="<?=$key['TCDS_id']?>"><?=$key['subject_name']?>(<?=$key['eval_name']?>)</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Message<span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <textarea cols="3" rows="2" placeholder="Message" name="hw_msg" class="form-control"></textarea>
                                            </div>
                                            <label class="col-lg-2 control-label">End Date</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="hw_end_date" class="form-control datepicker" placeholder="End Date" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                            <div class="col-lg-3">
                                                <select name="hw_class_TCDS_id" id="class_homework_details" class="form-control">
                                                    <option>Select Class</option>
                                                    <?php foreach ($TCD_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?>(<?=$key['division_name']?>)</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                             <?php switch ($school_homework_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="hw_sms_sent"> <i></i>  &nbsp sent homework SMS to student </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="ibox-title">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h3><b>Student Details</b></h3>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="ibox-tools">
                                                                <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Roll No.</th>
                                                                <th>Student Name</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="student_details_accor">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-5 col-sm-offset-3">
                                                <button class="btn btn-white" type="reset">Cancel</button>
                                                <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Homework Details</b></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Date</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>End Date</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 1;
                                                foreach ($homework as $key) { ?>
                                                <tr>                
                                                    <th><?php echo $i++; ?></th>
                                                    <th><?=$key['hw_datetime']?></th>
                                                    <th><?=$key['subject_name']?> (<?=$key['eval_name']?>)</th>
                                                    <th><?=$key['hw_msg']?></th>
                                                    <th><?=$key['hw_end_date']?></th>
                                                    <!-- <th><a href="<?=site_url('Homework/Edit_homework/' .$key['hw_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-pencil"> Edit</i></span></th> -->
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
            </div>
        </div>