<style type="text/css">
.onoffswitch-inner:before {
  content: "Present";
  padding-left: 10px;
  background-color: #1ab394;
  color: #FFFFFF;
}
.onoffswitch-inner:after {
  content: "Absent";
  padding-right: 10px;
  background-color: #ed5565;
  color: #fff;
  text-align: right;
}

.onoffswitch {
  width: 90px;
}
.onoffswitch-switch{
    width: 36px;
    right: 54px;
}
.onoffswitch-checkbox:disabled + .onoffswitch-label .onoffswitch-inner:before ,.onoffswitch-checkbox:disabled + .onoffswitch-label .onoffswitch-inner:after  {
    background-color: #919191;
}
.onoffswitch-switch,.onoffswitch-label{
    border: 1px solid gray;
}
</style>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom:0%;">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#attend_details"> Attendance Details</a></li>
                <li class=""><a data-toggle="tab" href="#attend"> New Attendance</a></li>
                <li class=""><a data-toggle="tab" href="#report"> Attendance Report</a></li>
            </ul>
            <div class="tab-content">
                <div id="attend_details" class="tab-pane active">
                    <div class="panel-body">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-lg-6 control-label"><h3><b>Attendance Details</b></h3></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Class</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control fetch_class_details" name="class_id">
                                                            <option>Select Class</option>
                                                            <?php foreach ($TCD_details as $key) { ?>
                                                            <option value="<?=$key['TCDS_class_id']?>-<?=$key['TCDS_division_id']?>-<?=$key['class_name']?>-<?=$key['division_name']?>"><?=$key['class_name']?> <?php echo "(" .$key['division_name']. ")"; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Date</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control datepicker" id="date_att" name="attend_datetime" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-4">
                                                        <span class="btn btn-info" id="att_record" title="View" style="float: right;">View</span>
                                                    </div>
                                                    <div class="col-sm-3 hidden del_btn">
                                                        <span class="btn btn-danger" id="delete_att_record" title="Delete" style="float: right;">Delete attendance</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example1" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="display:none;">ID</th>
                                                            	<th>Roll No</th>
                                                                <th>Student Name</th>
                                                                <th>In-Time</th>
                                                                <th>Out-Time</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fetch_class_attendance_status">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
                <div id="attend" class="tab-pane">
                    <div class="panel-body">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addNotification" action="<?=site_url('Attendance/add_student_attendance')?>">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                   <label class="col-lg-6 control-label"><h3><b>Class Attendance</b></h3></label>
                                                </div>
                                                <div class="form-group">
                                                   <label class="col-lg-4 control-label">Class</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control class_details" name="class_id">
                                                            <option>Select Class</option>
                                                            <?php foreach ($TCD_details as $key) { ?>
                                                            <option value="<?=$key['TCDS_class_id']?>-<?=$key['TCDS_division_id']?>"><?=$key['class_name']?> <?php echo "(" .$key['division_name']. ")"; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Teacher</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control subject_details" name="TCDS_id">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Date</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control datepicker attend_datetime"  name="attend_datetime" value="<?php echo date('Y-m-d');?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6 col-sm-offset-4">
                                                        <button class="btn btn-white" type="reset">Cancel</button>
                                                        <button class="btn btn-primary fill_att" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="col-lg-6 control-label"><h3><b>Student Details</b></h3></label>
                                                    <div class="col-sm-2">
                                                        <div class="ibox-tools">
                                                            <h3><input type="checkbox" name ="all_mark" value="attend" class="checkall"> CheckAll</h3>   
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="ibox-tools">
                                                            <h3><input type="checkbox" name ="all_mark" value="holiday" class="holidayall"> Holiday</h3>   
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="ibox-tools">
                                                            <h3><input type="checkbox" name ="all_mark" value="weekoff" class="weeklyoffall"> Weekly Off</h3>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" width="100%">
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
                                                        <tfoot>
                                                            
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
                <style type="text/css">
                thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
                        padding-right: 0px;
                    }
                    table.dataTable thead .sorting:after {
                        opacity: 0;
                        content: "\e150";
                    }
                </style>
                <div id="report" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"><h3><b>Monthly Attendance</b></h3></label>
                                           <label class="col-lg-1 control-label">Class</label>
                                            <div class="col-sm-2">
                                                <select class="form-control fetch_class_details_monthly" name="class_id">
                                                    <option>Select Class</option>
                                                    <?php foreach ($TCD_details as $key) { ?>
                                                    <option value="<?=$key['TCDS_class_id']?>-<?=$key['TCDS_division_id']?>-<?=$key['class_name']?>-<?=$key['division_name']?>"><?=$key['class_name']?> <?php echo "(" .$key['division_name']. ")"; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           
                                            <label class="col-lg-1 control-label">Select Month</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control month_date" id="selected_month" name="selected_month" readonly>
                                            </div>
                                            <div class="col-sm-1 show_attend_report">
                                                <span class="btn btn-info " id="att_month_record" title="View" style="float: right;"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <!-- <div class="col-sm-1  print_btn">
                                                <input type='button' class="btn btn-sm btn-warning" value='Print' onclick='printDiv();'/>
                                            </div> -->
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <!-- <span class="btn btn-primary" id="date_time"><? echo date('Y-m-d')?></span> -->

                                    <table class="table table-bordered table-hover dataTables-print display compact" style="color: #000;" id="example">
                                        <thead>        
                                            <tr id="att_dates">
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="attendance_table">

                                        </tbody>
                                    </table>
                                    <div id="total_table"></div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="editAttendance" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Student Attendance</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <form method="post" class="form-horizontal" id="update_agentDetails" action="<?=site_url('Attendance/edit_attendance')?>" enctype="multipart/form-data"> -->
                        <form method="post" class="form-horizontal" id="" action="#" enctype="multipart/form-data">
                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">attend ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="attend_id_edit1" name="attend_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-7">
                                    <select class="form-control"  name="attend_status" id="attend_status">
                                        <option disabled selected>Select</option>
                                        <option value="P">Present</option>
                                        <option value="A">Absent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-lg-6" style="text-align:right;">
                                    <label class="btn btn-primary edit_attendance">Update</label>
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
<!-- / -->  