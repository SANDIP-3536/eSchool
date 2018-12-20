<style type="text/css">
#pie.svg{
    width: 200px !important;
}
.label-white{
    background-color:#9370db;
    color: #fff;
}
.clockpicker-popover{
    z-index: 9999;
}
</style>
        <div class="wrapper wrapper-content">
            <div class="row"> 
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: #ec4758;border-color: #ec4758;color: #fff;">
                            <h5>SMS Count</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row" style="height: 139px;">
                                <div class="col-lg-6">
                                    <canvas id="doughnutChart2" width="120" height="120" style="margin: 18px auto 0"></canvas>
                                </div>
                                <div class="col-lg-6" style="padding: 10px;">
                                    <h4 style="line-height: 2;">Used Count : <?=$used_sms?></h4>
                                    <h4 style="line-height: 2;">Pending Count : <?=$pending_sms?></h4>
                                    <h4 style="line-height: 2;">Total Count : <?=$total_sms?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: #1c84c6;border-color: #1c84c6;color: #fff;">
                            <h5>Student Count</h5>
                        </div>
                        <div class="ibox-content main_box">
                            <div>
                                <div class="flot-chart" style="height: 139px;">
                                    <!-- <div class="flot-chart-content" id="flot-bar-chart"></div> -->
                                    <canvas id="barChart1" height="110"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: #f859a2;border-color: #f859a2;color: #fff;">
                            <h5>Birthday</h5>
                            <div class="ibox-tools">
                                <span class="label label-white pull-right"><?php echo date('Y-m-d'); ?></span>
                            </div>
                        </div>
                        <div class="ibox-content" style="background: url(<?=base_url()?>assets/img/balloons.png);background-size: cover;background-color: white;color: #000;">
                            <div class="row" style="height: 139px;"> 
                                <div class="col-sm-6" style="padding: 20px;background: rgba(255,255,255,0.85);" data-toggle="modal" data-target="#myModal6">
                                    <center>
                                        <h1 class="no-margins" style="padding-top: 0px;"><b>
                                            <?php echo $student_birthday; ?></b>
                                        </h1>
                                        <h3><b>Student Birthday</b></h3>
                                    </center>
                                    <!-- <button class="btn btn-outline btn-danger  dim " type="button" data-toggle="modal" data-target="#myModal6" style="float: right;"><i class="fa fa-eye"></i></button> -->
                                </div>
                                <div class="col-lg-6" style="padding: 20px;background: rgba(255,255,255,0.85);" data-toggle="modal" data-target="#myModal7" >
                                    <center>
                                        <h1 class="no-margins" style="padding-top: 0px;"><b>
                                            <?php echo $employee_birthday; ?></b>
                                        </h1>
                                        <h3><b>Employee Birthday</b></h3>
                                    </center>
                                    <!-- <button class="btn btn-outline btn-danger  dim " type="button" data-toggle="modal" data-target="#myModal7" style="float: right;"><i class="fa fa-eye"></i></button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h1 class="modal-title">Student Birthday List</h1>
                            </div>
                            <div class="modal-body">
                                <div class="feed-activity-list">
                                    <?php foreach ($student_birthday_list as $key5) { ?>
                                        <div class="feed-element" style="padding-bottom: 12px;">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="<?=$key5['student_photo']?>">
                                            </a>
                                            <div class="media-body" style="text-align: left;padding-left: 25px;">
                                                Name :  <strong><?=$key5['name']?></strong> <br>
                                                DOB  :  <strong><?=$key5['student_DOB']?><strong><br>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal inmodal fade" id="myModal7" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Employee Birthday List</h4>
                            </div>
                            <div class="modal-body">
                                <div class="feed-activity-list">
                                    <?php foreach ($employee_birthday_list as $key6) { ?>
                                        <div class="feed-element" style="padding-bottom: 12px;">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="<?=$key6['employee_photo']?>">
                                            </a>
                                            <div class="media-body" style="text-align: left;padding-left: 25px;">
                                                <small class="pull-right"><?=$key6['employee_DOB']?></small>
                                                <strong><?=$key6['employee_first_name']?> <?=$key6['employee_middle_name']?> <?=$key6['employee_last_name']?></strong> <br>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: #f8ac59;border-color: #f8ac59;color: #fff;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Fee Reports</h5>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2">Fee Received : <b><?=$today_fee_collection_sum?></b></button>
                                </div>
                            </div>
                        </div>

                            <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Fee </h4>
                                            <small class="font-bold"> Total Fee Received : <b id="total_received"><?=$today_fee_collection_sum?></b></small>
                                            <!-- <span class="label label-success pull-right result_date"><?php echo date('Y-m-d'); ?></span> -->
                                            <div class="row">
                                                <div class="col-sm-offset-8 col-sm-3 input-group date fee_date">
                                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="fee_select_date" class="form-control" name="" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox-content">
                                                <div>
                                                    <div class="feed-activity-list fee_colection_list" style="max-height: 300px;overflow-y: scroll;">
                                                        <?php foreach ($today_fee_collection as $key5) { ?>
                                                            <div class="feed-element" style="padding-bottom: 12px;">
                                                                <div class="media-body" style="text-align: left;padding-left: 25px;padding-right: 25px;">
                                                                    <small class="pull-right">GRN : <?=$key5['student_GRN']?></small>
                                                                    <strong><?=$key5['student_first_name']?> <?=$key5['student_middle_name']?> <?=$key5['student_last_name']?></strong> <br>
                                                                    <small class="text-muted"><?=$key5['fee_amount']?> | <?=$key5['fee_narration']?></small>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="ibox-content" style="padding-top: 0;">
                           <div class="row" style="height: 142px;">
                                <div>
                                    <canvas id="barChart" height="110"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>  
            <style type="text/css">
            .fc-event{
                font-size: .80em;
                line-height: 1;
                white-space: normal;
            }
            .fc-title{
                white-space: normal;
            }
            </style>   
            <div class="row">  
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: #23c6c8;border-color: #23c6c8;color: #fff;">
                            <h5>Schedule Overview</h5>
                        </div>
                        <div class="ibox-content">
                           <div>
                                <div class="calendar" class="col-centered" height="140" style="position: sticky;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="background-color: rgba(103, 198, 241, 0.74);border-color: rgba(103, 198, 241, 0.74);color: #fff;">
                            <div class="col-sm-6">
                                <h5>Attendance Overview</h5>
                            </div>
                            <div class="col-sm-3">
                                <span class="label label-warning pull-left result_date">Today</span>
                            </div>
                            <div class="col-sm-3 input-group date attendance_date" style="margin-top: -10px;color: #000;">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="select_date" class="form-control" name="" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                        </div>
                        <div class="ibox-content">
                           <div class="row">
                                <div class="col-sm-5">
                                    <div class="ibox-content">
                                        <canvas id="doughnutChart" width="120" height="120" style="margin: 18px auto 0"></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="table-responsive" style="max-height: 247px;">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Class</td>
                                                    <td>Division</td>
                                                    <td>Present</td>
                                                    <td>Absent</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody id="present_absent">
                                                <?php foreach ($present_absent as $pa) { ?>
                                                    <tr>
                                                        <td><?=$pa['class_name']?></td>
                                                        <td><?=$pa['division_name']?></td>
                                                        <td><?=$pa['present_count']?></td>
                                                        <td><?=$pa['absent_count']?></td>
                                                        <td><?=$pa['total']?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-right: 0px;margin-left: 0px;">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="ibox float-e-margins"  style="background-color:rgba(35, 198, 200, 0.74);margin-bottom:1px;">
                                    <div class="ibox-content"  style="background-color:rgba(35, 198, 200, 0.74);padding:5px 7px 11px 21px;">
                                        <div class="row">
                                            <div class="col-sm-5" style="color:#ffffff;">
                                                <h1 class="no-margins" style="padding-top: 21px;"><b><center>
                                                    <?php echo $total_student; ?></b></center>
                                                </h1>
                                                <h3><b>Student's</b></h3>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="image"><img src="<?=base_url()?>assets/img/student.png"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="ibox float-e-margins"  style="background-color:rgba(103, 198, 241, 0.74);margin-bottom:1px;">
                                    <div class="ibox-content"  style="background-color:rgba(103, 198, 241, 0.74);padding:5px 7px 11px 21px;">
                                        <div class="row">
                                            <div class="col-sm-5" style="color:#ffffff;">
                                                <h1 class="no-margins" style="padding-top: 21px;"><b><center>
                                                    <?php echo $total_employee; ?></b></center></h1>
                                                    <h3><b>Employee's</b></h3>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="image"><img src="<?=base_url()?>assets/img/employee.png"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="ibox float-e-margins"  style="background-color:rgba(103, 58, 183, 0.74);margin-bottom:1px;">
                                    <div class="ibox-content"  style="background-color:rgba(103, 58, 183, 0.74);padding:5px 7px 11px 21px;">
                                        <div class="row">
                                            <div class="col-sm-5" style="color:#ffffff;">
                                                <h1 class="no-margins" style="padding-top: 21px;"><b><center>
                                                    <?php echo $total_teacher; ?></b></center></h1>
                                                    <h3><b>Teacher's</b></h3>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="image"><img src="<?=base_url()?>assets/img/teacher.png"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title row" style="background-color: #ae3ab7bd;border-color: #ae3ab7bd;color: #fff;">
                                <div class="col-sm-6">
                                    <h5>TO DO</h5>
                                </div>
                                <div class="col-sm-6">
                                    <label class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" style="background-color: #000;border-color: #000;float: right;"><i class="fa fa-bell"></i></label>
                                </div>
                            </div>
                            <div class="row">                           
                                <div class="ibox-content " style="overflow: scroll;height: 490px;">
                                    <div class="feed-activity-list remainder_table">
                                        <?php foreach ($remainder as $re) { ?>
                                            <div class="feed-element">
                                                <div>
                                                    <small class="pull-right text-navy"><?=$re['remainder_timestamp']?></small>
                                                    <strong><?=$re['remainder_title']?></strong>
                                                    <div><?=$re['remainder_message']?></div>
                                                    <?php if ($re['remainder_type'] == 3) { ?>
                                                        <b><small class="text-muted"><?=$re['remainder_date']?> - <?=$re['remainder_time']?></small></b>
                                                        <span class="btn btn-xs btn-info pull-right other_remainder_done" title="<?=$re['remainder_id']?>">Done</span>
                                                    <?php } else if ($re['remainder_type'] == 1) { ?>
                                                        <br>
                                                        <div class="fee_btn_<?=$re['remainder_id']?>">
                                                            <span class="btn btn-xs btn-warning pull-right reshedule_fee_remainder" title="<?=$re['remainder_id']?>">Reshedule</span>
                                                            <span class="btn btn-xs btn-info pull-right other_remainder_done" title="<?=$re['remainder_id']?>">Received</span>
                                                        </div>
                                                        <div class="reshedule_date_div_<?=$re['remainder_id']?> hidden">
                                                            <div class="input-group date " style="width: 55%;">
                                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control reshedule_date_<?=$re['remainder_id']?>" readonly>
                                                            </div>
                                                            <span class="btn btn-xs btn-info pull-right reshedule_remainder_done" style="margin-top: -10%;" title="<?=$re['remainder_id']?>">Done</span>
                                                            <span class="btn btn-xs btn-danger pull-right reshedule_remainder_cancel" style="margin-top: -10%;margin-right: 15%;" title="<?=$re['remainder_id']?>"><i class="fa fa-ban"></i></span>
                                                        </div>

                                                    <?php } else if ($re['remainder_type'] == 2) { ?>
                                                        <br>
                                                        <div class="meeting_<?=$re['remainder_id']?>">
                                                            <span class="btn btn-xs btn-info pull-right remark_meeting_remainder" title="<?=$re['remainder_id']?>">Attend Remark</span>
                                                            <span class="btn btn-xs btn-danger pull-right remark_meeting_not_attended_remainder" title="<?=$re['remainder_id']?>">Not attended</span>
                                                        </div>
                                                        <div class="meeting_remark_div_<?=$re['remainder_id']?> hidden">
                                                            <textarea class="form-control meeting_remark_<?=$re['remainder_id']?>" maxlength="50"></textarea>
                                                            <span class="btn btn-xs btn-warning pull-right meeting_remark_done" title="<?=$re['remainder_id']?>">Done</span>
                                                            <span class="btn btn-xs btn-danger pull-right meeting_remark_cancel" title="<?=$re['remainder_id']?>"><i class="fa fa-ban"></i></span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-bell modal-icon"></i>
                                <h4 class="modal-title">Add New Remainder</h4>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="post">
                                        <div class="form-group">
                                            <label>Title</label> 
                                            <select class="form-control remainder_type" required="" name="remainder_type">
                                                <option value="" disabled selected> Select type </option>
                                                <option value="1">Fee Remainder</option>
                                                <option value="2">Meeting Remainder</option>
                                                <option value="3">Other Remainder</option>
                                            </select>
                                        </div>
                                        <div class="fee_remainder_form hidden">
                                            <div class="form-group">
                                                <label>Select Student</label> 
                                                    <select data-placeholder="Choose Student" class="chosen-select student_fee_remainder"  tabindex="2">
                                                        <option>Select Student</option>
                                                        <?php foreach ($student_fee_remainder as $key) { ?>
                                                            <option value="<?=$key['student_name']?>@<?=$key['balance']?>@<?=$key['parent_mobile_number']?>"><?=$key['student_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Balance Amount</label> 
                                                <input type="text" class="form-control balance_amt" name="balance_amt" required="" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label>Promise Amount</label> 
                                                <input type="text" class="form-control promise_amt" name="promise_amt" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Commited Date</label> 
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control remainder_date" value="" name="remainder_date" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Commited Time</label> 
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control remainder_time"  name="remainder_time" required="">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="meeting_remainder_form hidden">
                                            <div class="form-group">
                                                <label>Meeting Title</label> 
                                                <input type="text" class="form-control meeting_title" name="meeting_title" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Meeting Address</label> 
                                                <textarea class="form-control meeting_address" name="meeting_address" maxlength="250" required=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Date</label> 
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control meeting_date" value="" name="meeting_date" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Time</label> 
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control meeting_time"  name="meeting_time" required="">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="other_remainder_form hidden">
                                            <div class="form-group">
                                                <label>Title</label> 
                                                <input type="text" class="form-control other_remainder_title" name="other_remainder_title" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Message</label> 
                                                <textarea class="form-control other_remainder_message" name="other_remainder_message" maxlength="250" required=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Date</label> 
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control other_remainder_date" value="" name="other_remainder_date" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Time</label> 
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control other_remainder_time"  name="other_remainder_time" required="">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary add_remainder">Add</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>

            </div>     
            
                </div>
            </div>
            <div class="footer">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="pull-left">
                            <strong>Copyright </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech_logo.png" style="height:13px;"></a><strong> &copy; 2017-2018 </strong>  
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <center>
                            <div>
                               <img src="<?php echo $school_logo; ?>" style="height:20px;width:20px;"> <strong style="color:#ffffff;"><?php echo $school_name; ?> </strong> 
                            </div>
                        </center>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contact@syntech.co.in </strong> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url()?>assets/js/inspinia.js"></script>
<script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI custom -->
<script src="<?=base_url()?>assets/js/jquery-ui.custom.min.js"></script>

<script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Data picker -->
<script src="<?=base_url()?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- iCheck -->
<script src="<?=base_url()?>assets/js/plugins/iCheck/icheck.min.js"></script>

<script src="<?=base_url()?>assets/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Full Calendar -->
<script src="<?=base_url()?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/clockpicker/clockpicker.js"></script>
<!-- d3 and c3 charts -->
<script src="<?=base_url()?>assets/js/plugins/d3/d3.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/c3/c3.min.js"></script>

<script src="<?=base_url()?>assets/js/plugins/chartJs/Chart.min.js"></script>
 <!-- Flot -->
<script src="<?=base_url()?>assets/js/plugins/flot/jquery.flot.js"></script>
<script src="<?=base_url()?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?=base_url()?>assets/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?=base_url()?>assets/js/plugins/flot/jquery.flot.time.js"></script>

<script src="<?=base_url()?>assets/js/plugins/chartJs/Chart.min.js"></script>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
<script>
$(document).ready(function() {

    $('.clockpicker').clockpicker();
    $('.chosen-select').chosen({width: "100%"});

    <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
        swal({
            title: "<?=$flash['title']?>",
            text: "<?=$flash['text']?>",
            type: "<?=$flash['type']?>"
        });
            <?php } ?> <?php if($dashboard = 'dashboard') {?>
                $('#dashboard').addClass('active');
                document.title = 'eSchool | Dashboard'
            <?php } ?>

             var today = new Date();
            // $('.date').datepicker({
            //     format: 'yyyy-mm-dd',
            //     autoclose:true,
            //     endDate: "today",
            //     maxDate: today
            // }).on('changeDate', function (ev) {
            //     $(this).datepicker('hide');
            // });

             $('.date').datepicker({
                format:"yyyy-mm-dd",
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            

            $(document).on('click','#birthday_sms',function(){
                // alert('Birthday SMS');
            });
            

            $('.calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    // right: 'month'
                },
            // defaultDate: 'date()',
            // editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {

                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                edit(event);

            },
            events: [
            <?php foreach($events as $event): 
            
            $start = explode(" ", $event['holiday_start_date']);
            $end = explode(" ", $event['holiday_end_date']);
            if($start[1] == '00:00:00'){
                $start = $start[0];
            }else{
                $start = $event['holiday_start_date'];
            }
            if($end[1] == '00:00:00'){
                $end = $end[0];
            }else{
                $end = $event['holiday_end_date'];
            }
            ?>
            {
                id: '<?php echo $event['holiday_id']; ?>',
                title: '<?php echo $event['holiday_name']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '#000',
            },
            <?php endforeach; ?>
            ]
        });
        
        function edit(event){
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }
            
            id =  event.id;
            
            Event = [];
            Event[0] = id;
            Event[1] = start;
            Event[2] = end;
            
            $.ajax({
               url: "<?=site_url('Holiday/select_cal_edit')?>",
               type: "POST",
               data: {Event:Event},
               success: function(rep){
                console.log(rep);
                if(rep == 'true'){
                    alert('Saved');
                }else{
                    alert('Could not be saved. try again.'); 
                }
            }
        });
        }

    var barData = {
        labels: [
                <?php foreach ($fee_report as $class_name) { ?>
                      "<?=$class_name['class_name']?>",   
                <?php } ?>
                ],
        datasets: [
            {
                label: "Received",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: [
                        <?php foreach ($fee_report as $received) { ?>
                              "<?=$received['received']?>",   
                        <?php } ?>
                      ]
            },
            {
                label: "Wavier",
                backgroundColor: 'rgba(199, 200, 35, 0.5)',
                borderColor: "rgba(199, 200, 35, 0.7)",
                pointBackgroundColor: "rgba(199, 200, 35, 1)",
                pointBorderColor: "#fff",
                data: [
                        <?php foreach ($fee_report as $fee_waiver_total) { ?>
                              "<?=$fee_waiver_total['fee_waiver_total']?>",   
                        <?php } ?>
                      ]
            },
            {
                label: "Pending",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [
                        <?php foreach ($fee_report as $pending) { ?>
                              "<?=$pending['pending']?>",   
                        <?php } ?>
                      ]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };


    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

    
    var present = "<?php echo $present; ?>";
    var absent = "<?php echo $absent; ?>";
        
        var doughnutData2 = {
            labels: ["Pending","Used" ],
            datasets: [{
                data: [present,absent],
                backgroundColor: ["#a3e1d4","#9CC3DA"]
            }]
        } ;
        var doughnutOptions2 = {
            responsive: false,
            legend: {
                display: false
            }
        };

    var ctx6 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx6, {type: 'doughnut', data: doughnutData2, options:doughnutOptions2});

            // c3.generate({
            //     bindto: '#pie',
            //     data:{
            //         columns: [
            //             ['present', present],
            //             ['absent', absent]
            //         ],
            //         colors:{
            //             present: '#1ab394',
            //             absent: '#BABABA'
            //         },
            //         type : 'pie'
            //     }
            // });

    $(document).on('change','.attendance_date',function(){
        var select_date  = $('#select_date').val();
        $.post('<?=site_url('School/view_stu_attendance')?>',{select_date:select_date}, function(data){
            // console.log(data);
            $('#present_absent').empty();
            $('.result_date').empty();
            $('.result_date').append(select_date);
            // console.log(data);
            var doughnutData = {
                labels: ["Present","Absent"],
                datasets: [{
                    data: [data.present,data.absent],
                    backgroundColor: ["#a3e1d4","#9D0C0C"]
                }]
            } ;
            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions2});

            $.each(data.present_absent, function(k,v){
                $('#present_absent').append('<tr>'+
                                                '<td>'+v.class_name+'</td>'+
                                                '<td>'+v.division_name+'</td>'+
                                                (v.present_count == null ? '<td> 0 </td>' : '<td>'+v.present_count+'</td>')+
                                                (v.absent_count == null ? '<td> 0 </td>' : '<td>'+v.absent_count+'</td>')+
                                                (v.total == null ? '<td> 0 </td>' : '<td>'+v.total+'</td>')+
                                            '</tr>');
            });

        },'json');
    });


        var pending_sms = "<?php echo $pending_sms; ?>";
        var used_sms = "<?php echo $used_sms; ?>";
        var doughnutData = {
            labels: ["Pending","Used" ],
            datasets: [{
                data: [pending_sms,used_sms],
                backgroundColor: ["#a3e1d4","#9CC3DA"]
            }]
        } ;
        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };

    var ctx5 = document.getElementById("doughnutChart2").getContext("2d");
    new Chart(ctx5, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

    var barData = {
           
        labels: [
                <?php foreach ($class_cnt as $key) { ?>
                    "<?=$key['class_name']?>", 
                <?php } ?>
                ],
        datasets: [
            {
                label: "Student",
                backgroundColor: 'rgba(26,179,148,0.8)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [
                        <?php foreach ($class_cnt as $key) { ?>
                            <?=$key['std_count']?>, 
                        <?php } ?>
                ]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };


    var ctx2 = document.getElementById("barChart1").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

    $(document).on('change','.fee_date',function(){
         var select_date  = $('#fee_select_date').val();
         // alert(select_date);
            $.post('<?=site_url('School/today_fee_collection')?>',{select_date:select_date}, function(data){
                console.log(data);
                $('.fee_colection_list').empty();
                $('#total_received').empty();
                if (data.today_fee_collection_sum != null) {
                    $('#total_received').append(data.today_fee_collection_sum);
                    $.each(data.today_fee_collection, function(k,v){
                        $('.fee_colection_list').append('<div class="feed-element" style="padding-bottom: 12px;">'+
                                                                    '<div class="media-body" style="text-align: left;padding-left: 25px;padding-right: 25px;">'+
                                                                        '<small class="pull-right">GRN : '+v.student_GRN+'</small>'+
                                                                        '<strong>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</strong> <br>'+
                                                                        '<small class="text-muted">'+v.fee_amount+' | '+v.fee_narration+'</small>'+
                                                                   ' </div>'+
                                                                '</div>');
                    });
                };

                if (data.today_fee_collection_sum == null) {
                    $('#total_received').append("00");
                    $('.fee_colection_list').append("No Record Found...!!");
                };


            },'json');
    });
        
        $(document).on('change','.remainder_type',function(){
            var type = $('.remainder_type').val();
            if (type == 1)
            {
                $('.fee_remainder_form').removeClass('hidden');
                $('.meeting_remainder_form').addClass('hidden');
                $('.other_remainder_form').addClass('hidden');
            }else if (type == 2)
            {
                $('.fee_remainder_form').addClass('hidden');
                $('.meeting_remainder_form').removeClass('hidden');
                $('.other_remainder_form').addClass('hidden');
            }else{
                $('.fee_remainder_form').addClass('hidden');
                $('.meeting_remainder_form').addClass('hidden');
                $('.other_remainder_form').removeClass('hidden');
            }
            $('.balance_amt').val('');
            $('.remainder_date').val('');
            $('.remainder_time').val('');
            $('.promise_amt').val('');
            $('.student_fee_remainder').val('');
            $('.meeting_title').val('');
            $('.meeting_address').val('');
            $('.meeting_date').val('');
            $('.meeting_time').val('');
            $('.other_remainder_title').val('');
            $('.other_remainder_message').val('');
            $('.other_remainder_date').val('');
            $('.other_remainder_time').val('');

        });

        $(document).on('change','.student_fee_remainder',function(){
            var student_fee_remainder_1 = $('.student_fee_remainder').val();
            var student_fee_remainder_2 = student_fee_remainder_1.split("@");
            var balance = student_fee_remainder_2[1];
            $('.balance_amt').val(balance);
        });

        $(document).on('click','.other_remainder_done',function(){
            var remainder_id = this.title;
            $.post('<?=site_url('School/other_remainder_done')?>',{remainder_id:remainder_id},function(data){
            },'json');
            // $(".remainder_table").load(location.href + " .remainder_table");

            $.post('<?=site_url('School/refresh_remainder_table')?>',{},function(data){
                console.log(data);
                $('.remainder_table').empty();
                $.each(data,function(k,v){
                    $('.remainder_table').append('<div class="feed-element">'+
                                            '<div>'+
                                                '<small class="pull-right text-navy">'+v.remainder_timestamp+'</small>'+
                                                '<strong>'+v.remainder_title+'</strong>'+
                                                '<div>'+v.remainder_message+'</div>'+
                                                (v.remainder_type == 3 ? '<b><small class="text-muted">'+v.remainder_date+' - '+v.remainder_time+'</small></b><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Done</span>' : (v.remainder_type == 2 ? '<br><div class="meeting_'+v.remainder_id+'"><span class="btn btn-xs btn-info pull-right remark_meeting_remainder" title="'+v.remainder_id+'">Done Remark</span><span class="btn btn-xs btn-danger pull-right remark_meeting_not_attended_remainder" title="'+v.remainder_id+'">cancel</span></div><div class="meeting_remark_div_'+v.remainder_id+' hidden"><textarea class="form-control meeting_remark_'+v.remainder_id+'" maxlength="50"></textarea><span class="btn btn-xs btn-warning pull-right meeting_remark_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right meeting_remark_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>' : '<br><div class="fee_btn_'+v.remainder_id+'"><span class="btn btn-xs btn-warning pull-right reshedule_fee_remainder" title="'+v.remainder_id+'">Reshedule</span><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Received</span></div><div class="reshedule_date_div_'+v.remainder_id+' hidden"><div class="input-group date " style="padding-right: 30px;"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control reshedule_date_'+v.remainder_id+'" readonly></div><span class="btn btn-xs btn-info pull-right reshedule_remainder_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right reshedule_remainder_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>'))+
                                            '</div>'+
                                        '</div>');
                });

                $('.date').datepicker({
                    format:"yyyy-mm-dd",
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

            },'json');

        });

        $(document).on('click','.reshedule_fee_remainder',function(){
            var remainder_id = this.title;
            $('.reshedule_date_div_'+remainder_id+'').removeClass('hidden');
            $('.fee_btn_'+remainder_id+'').addClass('hidden');
        });
        $(document).on('click','.reshedule_remainder_cancel',function(){
            var remainder_id = this.title;
            $('.reshedule_date_div_'+remainder_id+'').addClass('hidden');
            $('.fee_btn_'+remainder_id+'').removeClass('hidden');
            $('.reshedule_date_'+remainder_id+'').val('');
        });
        $(document).on('click','.reshedule_remainder_done',function(){
            var remainder_id = this.title;
            $('.reshedule_date_div_'+remainder_id+'').addClass('hidden');
            $('.fee_btn_'+remainder_id+'').removeClass('hidden');
            var new_date = $('.reshedule_date_'+remainder_id+'').val();
            $.post('<?=site_url('School/reshedule_fee_remainder')?>',{remainder_id:remainder_id,new_date:new_date},function(data){
                console.log(data);
            },'json');
            $('.reshedule_date_'+remainder_id+'').val('');
            // $(".remainder_table").load(location.href + " .remainder_table");
            $.post('<?=site_url('School/refresh_remainder_table')?>',{},function(data){
                console.log(data);
                $('.remainder_table').empty();
                $.each(data,function(k,v){
                    $('.remainder_table').append('<div class="feed-element">'+
                                            '<div>'+
                                                '<small class="pull-right text-navy">'+v.remainder_timestamp+'</small>'+
                                                '<strong>'+v.remainder_title+'</strong>'+
                                                '<div>'+v.remainder_message+'</div>'+
                                                (v.remainder_type == 3 ? '<b><small class="text-muted">'+v.remainder_date+' - '+v.remainder_time+'</small></b><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Done</span>' : (v.remainder_type == 2 ? '<br><div class="meeting_'+v.remainder_id+'"><span class="btn btn-xs btn-info pull-right remark_meeting_remainder" title="'+v.remainder_id+'">Done Remark</span><span class="btn btn-xs btn-danger pull-right remark_meeting_not_attended_remainder" title="'+v.remainder_id+'">cancel</span></div><div class="meeting_remark_div_'+v.remainder_id+' hidden"><textarea class="form-control meeting_remark_'+v.remainder_id+'" maxlength="50"></textarea><span class="btn btn-xs btn-warning pull-right meeting_remark_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right meeting_remark_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>' : '<br><div class="fee_btn_'+v.remainder_id+'"><span class="btn btn-xs btn-warning pull-right reshedule_fee_remainder" title="'+v.remainder_id+'">Reshedule</span><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Received</span></div><div class="reshedule_date_div_'+v.remainder_id+' hidden"><div class="input-group date " style="padding-right: 30px;"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control reshedule_date_'+v.remainder_id+'" readonly></div><span class="btn btn-xs btn-info pull-right reshedule_remainder_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right reshedule_remainder_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>'))+
                                            '</div>'+
                                        '</div>');
                });

                 $('.date').datepicker({
                    format:"yyyy-mm-dd",
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

            },'json');
        });

        

        var meeting_status = 0;
        $(document).on('click','.remark_meeting_remainder',function(){
            var remainder_id = this.title;
            meeting_status = "Meeting attended remark : ";
            $('.meeting_remark_div_'+remainder_id+'').removeClass('hidden');
            $('.meeting_'+remainder_id+'').addClass('hidden');
        });
        $(document).on('click','.remark_meeting_not_attended_remainder',function(){
            var remainder_id = this.title;
            meeting_status = "Meeting not attended reason : ";
            $('.meeting_remark_div_'+remainder_id+'').removeClass('hidden');
            $('.meeting_'+remainder_id+'').addClass('hidden');
        });
        $(document).on('click','.meeting_remark_cancel',function(){
            meeting_status = 0;
            var remainder_id = this.title;
            $('.meeting_remark_div_'+remainder_id+'').addClass('hidden');
            $('.meeting_'+remainder_id+'').removeClass('hidden');
            $('.meeting_remark_'+remainder_id+'').val('');
        });
        $(document).on('click','.meeting_remark_done',function(){
            var remainder_id = this.title;
            $('.meeting_remark_div_'+remainder_id+'').addClass('hidden');
            $('.meeting_'+remainder_id+'').removeClass('hidden');
            var remark1 = $('.meeting_remark_'+remainder_id+'').val();
            var remark = meeting_status+' '+remark1;
            $.post('<?=site_url('School/remark_meeting_remainder')?>',{remainder_id:remainder_id,remark:remark},function(data){
            },'json');
            $('.meeting_remark_'+remainder_id+'').val('');
            // $(".remainder_table").load(location.href + " .remainder_table");
            $.post('<?=site_url('School/refresh_remainder_table')?>',{},function(data){
                console.log(data);
                $('.remainder_table').empty();
                $.each(data,function(k,v){
                    $('.remainder_table').append('<div class="feed-element">'+
                                            '<div>'+
                                                '<small class="pull-right text-navy">'+v.remainder_timestamp+'</small>'+
                                                '<strong>'+v.remainder_title+'</strong>'+
                                                '<div>'+v.remainder_message+'</div>'+
                                                (v.remainder_type == 3 ? '<b><small class="text-muted">'+v.remainder_date+' - '+v.remainder_time+'</small></b><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Done</span>' : (v.remainder_type == 2 ? '<br><div class="meeting_'+v.remainder_id+'"><span class="btn btn-xs btn-info pull-right remark_meeting_remainder" title="'+v.remainder_id+'">Done Remark</span><span class="btn btn-xs btn-danger pull-right remark_meeting_not_attended_remainder" title="'+v.remainder_id+'">cancel</span></div><div class="meeting_remark_div_'+v.remainder_id+' hidden"><textarea class="form-control meeting_remark_'+v.remainder_id+'" maxlength="50"></textarea><span class="btn btn-xs btn-warning pull-right meeting_remark_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right meeting_remark_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>' : '<br><div class="fee_btn_'+v.remainder_id+'"><span class="btn btn-xs btn-warning pull-right reshedule_fee_remainder" title="'+v.remainder_id+'">Reshedule</span><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Received</span></div><div class="reshedule_date_div_'+v.remainder_id+' hidden"><div class="input-group date " style="padding-right: 30px;"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control reshedule_date_'+v.remainder_id+'" readonly></div><span class="btn btn-xs btn-info pull-right reshedule_remainder_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right reshedule_remainder_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>'))+
                                            '</div>'+
                                        '</div>');
                });

                 $('.date').datepicker({
                    format:"yyyy-mm-dd",
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

            },'json');
        });

        $(document).on('click','.add_remainder',function(){
            var type = $('.remainder_type').val();
            if (type == 1)
            {
                var remainder_date = $('.remainder_date').val();
                var remainder_time = $('.remainder_time').val();
                var promise_amt = $('.promise_amt').val();
                var student_fee_remainder_1 = $('.student_fee_remainder').val();
                var student_fee_remainder_2 = student_fee_remainder_1.split("@");
                var student_name = student_fee_remainder_2[0];
                var balance = student_fee_remainder_2[1];
                var parent_mobile_number = student_fee_remainder_2[2];
                var remainder_title = "Fee Remainder <br> [ "+ student_name + " ] ";
                var remainder_message = student_name + "'s parents has promised that they will pay balance fee of RS. " + promise_amt + " out of RS." + balance + " On <br><b> Date : </b>" + remainder_date + "<br><b> Time : </b>" + remainder_time +" <br><b> Parent Mob. : </b>" + parent_mobile_number ;
                
            }else if (type == 2)
            {
                var meeting_title = $('.meeting_title').val();
                var meeting_address = $('.meeting_address').val();
                var remainder_date = $('.meeting_date').val();
                var remainder_time = $('.meeting_time').val();
                
                var remainder_title = "Meeting Remainder [ "+ meeting_title + " ] ";
                var remainder_message = "Meeting has been fixed at "+ remainder_date + " - "+ remainder_time + "<br><b> Venue </b>- " + meeting_address;
            }else{

                var remainder_title = $('.other_remainder_title').val();
                var remainder_message = $('.other_remainder_message').val();
                var remainder_date = $('.other_remainder_date').val();
                var remainder_time = $('.other_remainder_time').val();

            }
                
            var remainder_type = type;
            
            $.post('<?=site_url('School/add_remainder')?>',{remainder_type:remainder_type,remainder_date:remainder_date,remainder_time:remainder_time,remainder_title:remainder_title,remainder_message:remainder_message},function(data){
                console.log(data);
            },'json');

            // $(".remainder_table").load(location.href + " .remainder_table");
            $.post('<?=site_url('School/refresh_remainder_table')?>',{},function(data){
                console.log(data);
                $('.remainder_table').empty();
                $.each(data,function(k,v){
                    $('.remainder_table').append('<div class="feed-element">'+
                                            '<div>'+
                                                '<small class="pull-right text-navy">'+v.remainder_timestamp+'</small>'+
                                                '<strong>'+v.remainder_title+'</strong>'+
                                                '<div>'+v.remainder_message+'</div>'+
                                                (v.remainder_type == 3 ? '<b><small class="text-muted">'+v.remainder_date+' - '+v.remainder_time+'</small></b><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Done</span>' : (v.remainder_type == 2 ? '<br><div class="meeting_'+v.remainder_id+'"><span class="btn btn-xs btn-info pull-right remark_meeting_remainder" title="'+v.remainder_id+'">Done Remark</span><span class="btn btn-xs btn-danger pull-right remark_meeting_not_attended_remainder" title="'+v.remainder_id+'">cancel</span></div><div class="meeting_remark_div_'+v.remainder_id+' hidden"><textarea class="form-control meeting_remark_'+v.remainder_id+'" maxlength="50"></textarea><span class="btn btn-xs btn-warning pull-right meeting_remark_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right meeting_remark_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>' : '<br><div class="fee_btn_'+v.remainder_id+'"><span class="btn btn-xs btn-warning pull-right reshedule_fee_remainder" title="'+v.remainder_id+'">Reshedule</span><span class="btn btn-xs btn-info pull-right other_remainder_done" title="'+v.remainder_id+'">Received</span></div><div class="reshedule_date_div_'+v.remainder_id+' hidden"><div class="input-group date " style="padding-right: 30px;"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control reshedule_date_'+v.remainder_id+'" readonly></div><span class="btn btn-xs btn-info pull-right reshedule_remainder_done" title="'+v.remainder_id+'">Done</span><span class="btn btn-xs btn-danger pull-right reshedule_remainder_cancel" title="'+v.remainder_id+'"><i class="fa fa-ban"></i></span></div>'))+
                                            '</div>'+
                                        '</div>');
                });

                 $('.date').datepicker({
                    format:"yyyy-mm-dd",
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

            },'json');
            $('#myModal').modal('hide');
            $('.balance_amt').val('');
            $('.remainder_date').val('');
            $('.remainder_time').val('');
            $('.promise_amt').val('');
            $('.student_fee_remainder').val('');
            $('.meeting_title').val('');
            $('.meeting_address').val('');
            $('.meeting_date').val('');
            $('.meeting_time').val('');
            $('.other_remainder_title').val('');
            $('.other_remainder_message').val('');
            $('.other_remainder_date').val('');
            $('.other_remainder_time').val('');
        });


    //Flot Bar Chart
        // $(function() {
        //     var barOptions = {
        //         series: {
        //             bars: {
        //                 show: true,
        //                 barWidth: 0.6,
        //                 fill: true,
        //                 fillColor: {
        //                     colors: [{
        //                         opacity: 0.8
        //                     }, {
        //                         opacity: 0.8
        //                     }]
        //                 }
        //             }
        //         },
        //         xaxis: {
        //             tickDecimals: 0
        //         },
        //         colors: ["#1ab394"],
        //         grid: {
        //             color: "#999999",
        //             hoverable: true,
        //             clickable: true,
        //             tickColor: "#D4D4D4",
        //             borderWidth:0
        //         },
        //         legend: {
        //             show: false
        //         },
        //         tooltip: true,
        //         tooltipOpts: {
        //             content: "Class: %x, Student: %y"
        //         }
        //     };
        //     var barData = {
        //         label: "bar",
        //         data: [
        //         <?php foreach ($class_cnt as $key) { ?>
        //             [<?=$key['SCD_class_id']?>, <?=$key['std_count']?>],
        //         <?php } ?>
        //         ]
        //     };
        //     $.plot($("#flot-bar-chart"), [barData], barOptions);

        // });


});



        </script>
    </body>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:25:00 GMT -->
    </html>



