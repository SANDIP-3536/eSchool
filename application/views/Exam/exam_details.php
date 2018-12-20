   <style type="text/css">
   .tabs-container .nav-tabs > li.active > a{
    background-color: #fff !important;
   }
   </style>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding : 0px">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#exam_demo">Exam Details</a></li>
                <li class=""><a data-toggle="tab" href="#exam_schu_demo">Print Exam Schedule</a></li>
                <li class=""><a data-toggle="tab" href="#exam_marks_demo">Marks Details</a></li>
                <li class="" style=""><a data-toggle="tab" href="#view_all" style="color:#000;background-color: rgba(255, 165, 0, 0.6);border-left: 1px solid #000;border-right: 1px solid #000;">Marks Summary</a></li>
                <li class="" style=""><a data-toggle="tab" href="#print_report_card" style="color:#000;background-color: rgba(255, 165, 0, 0.6);border-right: 1px solid #000;">Report Card</a></li>
                <?php if ($user_type == 3) {?>
                    <li class=""><a data-toggle="tab" href="#eval_process_demo">Evaluation Process</a></li>
                <?php } ?>
                <li class=""><a data-toggle="tab" href="#eval_verify_demo">Evaluation Verification</a></li>
            </ul>
            <div class="tab-content">
                <div id="exam_demo" class="tab-pane active">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <?php if ($user_type == 3) { ?>
                                    <div class="ibox-content new_exam" style="padding: 15px 0px 20px 0px;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addExam" action="#">                           
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label"> Term <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <select name="exam_term_id" class="form-control exam_term_id">
                                                        <option value="0">Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                        <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <select name="exam_class_id" class="form-control class_details">
                                                        <option value="0">Select Class</option>
                                                        <?php foreach ($school_class as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Eval Type <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <select name="exam_eval_type" class="form-control eval_details">
                                                        <option value="0">Select Eval Type</option>
                                                    </select>
                                                </div>
                                                <label class="btn btn-xs btn-info add_exam_details hidden"> Add </label>
                                                
                                                
                                            </div>
                                            <div class="add_details hidden">
                                                <div class="hr-line-dashed"></div>
                                                <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Exam Weightage</th>
                                                            <th>Marksheet Weightage</th>
                                                            <th>Evaluation Weightage</th>
                                                            <th>Result Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <Select name="exam_subject_id" class="form-control class_subject"></select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_start_date" class="form-control datepicker1 exam_start_date" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_end_date" class="form-control datepicker1 exam_end_date" readonly>
                                                            </td>
                                                            <td>
                                                                <div class="input-group clockpicker" data-autoclose="true">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-clock-o"></span>
                                                                    </span>
                                                                    <input type="text" class="form-control exam_start_time" name="exam_start_time" readonly>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group clockpicker" data-autoclose="true">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-clock-o"></span>
                                                                    </span>
                                                                    <input type="text" class="form-control exam_end_time" name="exam_end_time" readonly>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_outoff_marks" class="form-control exam_outoff_marks" id="higher_Marks">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_marksheet_marks" class="form-control exam_marksheet_marks">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_evaluation_marks" class="form-control exam_evaluation_marks">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="exam_result_date" class="form-control exam_result_date" value="9999-12-31" readonly>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            <center><label class="btn btn-sm btn-primary add_exam hidden"> Submit</label></center>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Exam Details</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="btn btn-xs btn-primary pull-right" id="new_exam"><i class="fa fa-plus"></i></span>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example1" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Term</th>
                                                        <th>Class</th>
                                                        <th>Eval Type</th>
                                                        <th>Subject</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Timing</th>
                                                        <th>Exam weightage</th>
                                                        <th>Marksheet weightage</th>
                                                        <th>Evaluation weightage</th>
                                                        <th>Marks status</th>
                                                        
                                                        <?php if ($user_type == 3) { ?>
                                                            <th>Action</th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody class="exam_details_body">
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($exam_details as $key) { ?>
                                                    <tr>                
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?=$key['term_name']?></td>
                                                        <td><?=$key['class_name']?></td>
                                                        <td><?=$key['eval_name']?></td>
                                                        <td><?=$key['subject_name']?></td>
                                                        <td><?=$key['start_date']?></td>
                                                        <td><?=$key['end_date']?></td>
                                                        <td><?=$key['start_time']?> to <?=$key['end_time']?></td>
                                                        <td><?=$key['exam_outoff_marks']?></td>
                                                        <td><?=$key['exam_marksheet_marks']?></td>
                                                        <td><?=$key['exam_evaluation_marks']?></td>
                                                        <td>( <?=$key['count']?> ) <?=$key['std_count']?> / <?=$key['total']?></td>
                                                        
                                                        <?php if ($user_type == 3) { ?>
                                                            <td><a href="<?=site_url('Exam/delete_exam/' .$key['exam_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Term</th>
                                                        <th>Class</th>
                                                        <th>Eval Type</th>
                                                        <th>Subject</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Timing</th>
                                                        <th>Exam</th>
                                                        <th>Marksheet</th>
                                                        <th>Evaluation</th>
                                                        <th>Marks status</th>
                                                        
                                                        <?php if ($user_type == 3) { ?>
                                                            <th>Action</th>
                                                        <?php } ?>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="exam_marks_demo" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_exam_marks"><b>Exam Marks</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_exam_marks"><i class="fa fa-plus" title="Add"></i> </span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_exam_marks">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addEMark" action="<?=site_url('Exam/mark_registration')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"> Term <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_term_id" class="form-control" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_class_id" class="form-control class_marks_details" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class_division as $key) { ?>
                                                            <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?> (<?=$key['division_name']?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Subject <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <select class="chosen-select2 subject_marks_details form-control" data-placeholder="..." name="marks_exam_id" tabindex="2">
                                                        <option selected disabled>Choose a Subject</option>
                                                    </select>

                                                    <input type="hidden" id="exam_marksheet_marks" name="exam_marksheet_marks">
                                                </div>
                                            </div>
                                            <div class="form-group hidden">
                                                <label class="col-lg-2 control-label">Outoff Marks<span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" placeholder="Obtained Exam Marks" name="exam_outoff_marks" id="exam_outoff_marks" class="form-control" readonly>
                                                </div>
                                                <label class="col-lg-2 control-label">Evaluation Marks<span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <input type="text" placeholder="Exam Evaluation" name="exam_evaluation_marks" id="exam_evaluation_marks" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <center>
                                            <table class="table table-bordered" style="width:85%;">
                                                <thead>
                                                    <tr>
                                                        <th>Roll Number</th>
                                                        <th class="hidden">student ID</th>
                                                        <th>Student Name</th>
                                                        <th>OutOff Marks</th>
                                                        <th>Exam Marks</th>
                                                        <th>Obtained Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="student_marks_details">
                                                </tbody>
                                            </table>
                                            </center>
                                            <?php if ($user_type == 3) {?>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"> Teacher <span style="color:red;">*</span></label>
                                                <div class="col-lg-3">
                                                    <Select name="marks_teacher_id" class="form-control teacher_marks_details">
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5 col-sm-offset-3">
                                                    <button class="btn btn-white close_data" type="reset">Cancel</button>
                                                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="ibox-content">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3><b>Exam Marks Details</b></h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="padding-top: 31px;">
                                                    <label class="col-lg-3 "> Exam Term <span style="color:red;">*</span></label>
                                                    <div class="col-lg-6">
                                                        <Select name="marks_term_id" class="form-control marks_term_id" required>
                                                            <option selected disabled>Select Term</option>
                                                            <?php foreach ($school_term as $key) { ?>
                                                                <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="padding-top: 31px;">
                                                    <label class="col-lg-3 "> Class <span style="color:red;">*</span></label>
                                                    <div class="col-lg-6">
                                                        <Select name="marks_class_id" class="form-control fetch_class_marks_details" required>
                                                            <option selected disabled>Select Class</option>
                                                            <?php foreach ($school_class_division as $key) { ?>
                                                                <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?> (<?=$key['division_name']?>)</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="padding-top: 31px;">
                                                    <label class="col-lg-3 "> Subject <span style="color:red;">*</span></label>
                                                    <div class="col-lg-6">
                                                        <select class="chosen-select1 fetch_subject_marks_details form-control"  data-placeholder="..." name="marks_exam_id" tabindex="2">
                                                            <option selected disabled>Choose a Subject</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 hidden" style="padding-top: 31px; "id="marks_varification_status_label">
                                                    <label class="col-lg-3">Status</label>
                                                    <div class="col-lg-6">
                                                        <label style="color:red" id="marks_varification_status"></label><br>
                                                        <span class="btn btn-primary hidden" id="marks_varification_status_btn">Verify Now !</span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-lg-8"style="border-left-color: #e7eaec;border-left-style: solid;padding-left: 100px;">
                                            <center>
                                            <table class="table table-striped table-bordered dataTables-example2" style="text-align: center;">
                                                <thead>
                                                    <tr class="mark_detail_thead_tr1" >
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="fetch_student_marks_details">
                                                </tbody>
                                            </table>
                                            </center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="eval_process_demo" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="eval_process"><b>Evaluation Process Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select id="eval_term_id" class="form-control" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="eval_class_id" class="form-control" id="eval_class_id" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class as $key) { ?>
                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <span class="btn btn-primary" id="evaluation_verification">Check</span>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group hidden" id="eval_exam_details">
                                                <label class="col-sm-4 control-label">Evaluation Status :</label>
                                                <div class="col-sm-2" style="padding-top: 0.5%;font-weight: 400;color:black;">
                                                    <span class="control-form" id="evaluation_status"></span>
                                                </div> 
                                                <label class="col-sm-1 control-label">Total Exam :</label>
                                                <div class="col-sm-1" style="padding-top: 0.5%;font-weight: 400;color:black;">
                                                    <span class="control-form" id="total_exam"></span>
                                                </div>
                                                <div class="col-sm-3" id="evaluation_change">
                                                </div>
                                            </div>
                                            <div class="row fetch_exam_division" id="division_evaluation_status"></div>
                                            <div class="form-group hidden" id="eval_exam_details1"><br>
                                                <label class="col-sm-offset-2 col-sm-6"style="color:red;">Note: <span>Please Select Division For Check Exam Details.</span></label>
                                            </div>
                                            <div class="ibox-title hidden" id="exam_process_evaluation_header" style="border:none !important">
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="eval_process"><b>Exam Details</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                            <table class="table table-bordered hidden" id="exam_process_evaluation" style="width:85%;">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden">division id</th>
                                                        <th>Division</th>
                                                        <th class="hidden">exam id</th>
                                                        <th>Exam</th>
                                                        <th>Result Date</th>
                                                        <th>Evaluation Status</th>
                                                        <th>Total Student</th>
                                                        <th>Evaluated</th>
                                                        <th>Not Evaluated</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="exam_evaluation_status">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="color:red;">Note: <span>Please Select Exam For Check student Details.</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </center>
                                            <div class="ibox-title hidden" id="student_process_evaluation_header" style="border:none !important">
                                                <div class="hr-line-dashed"></div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="eval_process"><b>Student Details</b></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                            <table class="table table-bordered hidden" id="student_process_evaluation" style="width:85%;">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden">student id</th>
                                                        <th>Roll No.</th>
                                                        <th>Student</th>
                                                        <th>Teacher</th>
                                                        <th>Exam Marks</th>
                                                        <th>Evaluation Marks</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="student_evaluation_status">
                                                </tbody>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="color:red;">Note: <span>Please Select Exam For Check student Details.</th>
                                                    </tr>
                                                </tfoot> -->
                                            </table>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="eval_verify_demo" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_term_id" class="form-control" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_class_id" class="form-control fetch_eval_verify_class_marks_details" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class_division as $key) { ?>
                                                            <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?> (<?=$key['division_name']?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Subject <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_exam_id" class="form-control fetch_eval_subject_marks_details">
                                                    </select>
                                                </div>
                                            </div>
                                            <center>
                                            <table class="table table-striped table-bordered" style="width:85%;">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden">Exam ID</th>
                                                        <th>Roll Number</th>
                                                        <th>Student Name</th>
                                                        <th>Exam Marks</th>
                                                        <th>Evaluation Mark</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fetch_eval_student_marks_details">
                                                </tbody>
                                            </table>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="exam_schu_demo" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="printOut" action="<?=site_url('Exam/print_exam_schedule')?>">
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="printOut_term_id" class="form-control printOut_term_id" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="printOut_class_id" class="form-control printOut_class_id" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class_division as $key) { ?>
                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select data-placeholder="Select Exam..." class="chosen-select printOut_eval_id" multiple  name="printOut_eval_id[]" required>
                                                        <?php foreach ($eval_type as $key) { ?>
                                                            <option value="<?=$key['eval_id']?>"><?=$key['eval_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="btn btn-info print_exam_schedule">View</label>
                                                    <button class="btn btn-primary print_btn hidden"><i class="fa fa-print"></i> Print </button>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Timing</th>
                                                        <th>Subject</th>
                                                        <th>Marksheet Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="print_exam_schedule_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style type="text/css">
                    table.dataTable thead>tr>th.sorting{
                        padding-right: 3px;
                    }
                    table.dataTable thead .sorting:after {
                        opacity: 0;
                        content: "\e150";
                    }
                    table.dataTable thead>tr>th.sorting_asc{
                        padding: 0px;
                    }
                    table.dataTable thead .sorting_asc:after {
                        opacity: 0;
                        content: "\e155";
                    }
                </style>
                <div id="view_all" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content" style="padding: 15px 2px 20px 2px;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_term_id" class="form-control term_id_view_all" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_class_id" class="form-control fetch_class_view_all" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class_division as $key) { ?>
                                                            <!-- <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option> -->
                                                            <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?> (<?=$key['division_name']?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 btn btn-sm btn-info view_all_btn"> View </label>
                                            </div>

                                            <div class="table-responsive" style="text-align: center;">
                                                <table class="table table-striped table-bordered table-hover dataTables-example3" >
                                                    <thead class="view_all_thead">
                                                        <tr class="view_all_thead_tr1"></tr>
                                                        <tr class="view_all_thead_tr2"></tr>
                                                    </thead>
                                                    <tbody class="view_all_tbody">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="print_report_card" class="tab-pane">
                    <div class="panel-body" style="padding : 0px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content" style="padding: 15px 2px 20px 2px;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label"> Exam <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_term_id" class="form-control term_id_print_report_card" required>
                                                        <option selected disabled>Select Term</option>
                                                        <?php foreach ($school_term as $key) { ?>
                                                            <option value="<?=$key['term_id']?>"><?=$key['term_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 control-label"> Class <span style="color:red;">*</span></label>
                                                <div class="col-lg-2">
                                                    <Select name="marks_class_id" class="form-control fetch_class_print_report_card" required>
                                                        <option selected disabled>Select Class</option>
                                                        <?php foreach ($school_class_division as $key) { ?>
                                                            <!-- <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option> -->
                                                            <option value="<?=$key['class_id']?>-<?=$key['division_id']?>"><?=$key['class_name']?> (<?=$key['division_name']?>)</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-1 btn btn-sm btn-info print_report_card_btn"> View </label>
                                            </div>

                                            <div class="table-responsive" style="text-align: center;">
                                                <table class="table table-striped table-bordered table-hover dataTables-example4" >
                                                    <thead class="print_report_card_thead">
                                                        <tr class="print_report_card_thead_tr1"></tr>
                                                    </thead>
                                                    <tbody class="print_report_card_tbody">
                                                        
                                                    </tbody>   
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   
    </div>
                            <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Remark</h4>
                                            <small class="font-bold">Update or add new remark.</small>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label"> Spl. Remark <span style="color:red;">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="hidden" class="form-control student_profile_id" required>
                                                        <input type="hidden" class="form-control term_id" required>
                                                        <input type="hidden" class="form-control SF_id" required>
                                                        <textarea class="form-control SF_SR" rows="2" id="countMe1" maxlength="115"style="resize:none;" required></textarea>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label"> Intrest <span style="color:red;">*</span></label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control SF_IH" rows="2" id="countMe2" maxlength="115" style="resize:none;"required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label"> Improvement <span style="color:red;">*</span></label>
                                                    <div class="col-lg-8">
                                                         <textarea class="form-control SF_IN" rows="2" id="countMe3" maxlength="115" style="resize:none;" required></textarea>
                                                    </div>
                                                </div>

                                            </form>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white close_model" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary save_remark">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

    <div id="verify_evaluation_marks" class="modal fade" role="dialog">
        <form method="post" class="form-horizontal" id="eval_verification" action="<?=site_url('Exam/evaluation_status_update')?>" enctype="multipart/form-data">
            <div class="modal-dialog" style="margin-left: 21%;width: 58%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="modal-title">Student Marks Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                       <div class="form-group hidden">
                            <label class="col-sm-2 control-label">Fees ID</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_id_assign" name="marks_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Student Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control marks_student_assign" name="marks_student_proifle_id" readonly>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Outoff Marks</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control exam_outoff_marks_assign" name="exam_outoff_marks" id="exam_outoff_marks_eval" readonly>
                            </div>
                            <label class="col-sm-2 control-label">Exam Evaluation</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control exam_evaluation_assign" name="exam_evaluation_marks" id="exam_evaluation_marks_eval" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Marks <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_exam_marks_assign" name="marks_obtained" id="marks_obtained_eval">
                            </div>
                            <label class="col-sm-2 control-label">Evaluation Marks <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_evaluation_assign" name="marks_evaluation" id="marks_evaluation_eval">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Evaluation Status <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="marks_status">
                                    <option value="0">Select Status</option>
                                    <option value="2">Not Verified</option>
                                    <option value="1">Verified</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

                            <div class="modal inmodal" id="balance_pass_model" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Balance Pending</h4>
                                            <small class="font-bold">Enter password to print report card.</small>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label"> Password <span style="color:red;">*</span></label>
                                                    <div class="col-lg-8">
                                                         <input type="password" name="" class="form-control bal_password" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <p class="col-lg-offset-2 col-lg-7 control-label pass_alert text-danger"></p>
                                                </div>
                                            </form>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white close_model" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary confirm_bal_pss">Print Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="modal inmodal" id="wait_model" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header" style="background-color: #000;color: #fff;">
                                            <h4 class="modal-title" >Checking Student Details</h4>
                                            <small class="font-bold">Please wait for Sec while loading student Data.</small>
                                            <div id="myProgress" style="margin-top: 20px;width: 100%;background-color: #ddd;">
                                              <div id="myBar" style="width: 1%; height: 30px; background-color: #4CAF50;"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer hidden">
                                            <button type="button" class="btn btn-white close_model" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
