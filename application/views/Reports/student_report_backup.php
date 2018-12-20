<style type="text/css">

    th{
        text-align:center;
    }
    td{
        white-space: nowrap !important;
    }
    table.dataTable th,
    table.dataTable td {
        white-space: nowrap !important;
    }

</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3><b>Student & Enquiry Reports Detail</b></h3>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                        <div class="tabs-container">
                            <div class="tabs-left">
                                <ul class="nav nav-tabs" style="width:15% !important;">
                                    <li class="active"><a data-toggle="tab" href="#general_register"> General Register</a></li>
                                    <li class=""><a data-toggle="tab" href="#class_wise_report">Class Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#division_wise_report">Division Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#gender_class_division_report">Gender Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#cast_class_division_report">Cast Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#town_class_division_report">Town Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#contact_class_division_report">Contact Wise Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#govern_class_division_report">Government Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#sms_report">SMS Report</a></li>
                                    <li class=""><a data-toggle="tab" href="#All_report">All Report</a></li>
                                    <!-- <li class=""><a data-toggle="tab" href="#enquiry_report">Enquiry Report</a></li> -->
                                </ul>
                                <div class="tab-content">
                                    <div id="general_register" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <div class="table-responsive" style="width:100% !important">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example"  cellspacing="0" width="100%">
                                                                         <thead>
                                                                            <tr>
                                                                                <th rowspan="2">GRN No.</th>
                                                                                <th colspan="3">Student Name</th>
                                                                                <th rowspan="2">Religion</th>
                                                                                <th rowspan="2">Cast</th>
                                                                                <th rowspan="2">Sub Cast</th>
                                                                                <th rowspan="2">Birth Place</th>
                                                                                <th rowspan="2">Nationality</th>
                                                                                <th rowspan="2">DOB</th>
                                                                                <th rowspan="2">Last School</th>
                                                                                <th rowspan="2">Admission Date</th>
                                                                                <th rowspan="2">Admission Class</th>
                                                                                <th rowspan="2">Progress</th>
                                                                                <th rowspan="2" style="display: table-cell !important;">Conduct</th>
                                                                                <th rowspan="2">LC Date</th>
                                                                                <th rowspan="2">LC Reason</th>
                                                                                <th rowspan="2">Last A.Y.</th>
                                                                                <th rowspan="2">Last Class</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Last Name</th>
                                                                                <th>First Name</th>
                                                                                <th>Middle Name</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($genral as $key) { ?>
                                                                            <tr>
                                                                                <td><?=$key['student_GRN']?></td>
                                                                                <td><?=$key['student_last_name']?></td>
                                                                                <td><?=$key['student_first_name']?></td>
                                                                                <td><?=$key['student_middle_name']?></td>
                                                                                <td><?=$key['student_religion']?></td>
                                                                                <td><?=$key['student_cast']?></td>
                                                                                <td><?=$key['student_sub_cast']?></td>
                                                                                <td><?=$key['student_birth_place']?></td>
                                                                                <td><?=$key['student_nationality']?></td>
                                                                                <td><?=$key['DOB']?></td>
                                                                                <td><?=$key['student_privious_school_name']?></td>
                                                                                <td><?=$key['admission_date']?></td>
                                                                                <td><?=$key['class_of_admission']?></td>
                                                                                <td><?=$key['student_progress']?></td>
                                                                                <td class="old_parent"><?=$key['student_conduct']?></td>
                                                                                <td><?=$key['student_LC_date']?></td>
                                                                                <td><?=$key['student_LC_reason']?></td>
                                                                                <td><?=$key['last_AY_name']?></td>
                                                                                <td><?=$key['last_class_of_admission']?></td>
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
                                    <div id="class_wise_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control class_class_report" name="" style="border-radius:3px;" id="class_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3" id="class_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control class_division_report_details" name="" style="border-radius:3px;" id="class_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_class_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_class" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="division_wise_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control division_class_report" name="" style="border-radius:3px;" id="division_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3" id="division_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control division_division_report" name="" style="border-radius:3px;" id="division_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_division_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_division" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="gender_class_division_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control gender_class_report" name="" style="border-radius:3px;" id="gender_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3" id="gender_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control gender_division_report" name="" style="border-radius:3px;" id="gender_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Gender</label> 
                                                                                    <select class="form-control gender_gender_report" name="" style="border-radius:3px;" id="gender_gender_report_details">
                                                                                        <option value="male">Male</option>
                                                                                        <option value="female">Female</option>
                                                                                        <!-- <option value="other">Other</option> -->
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_gender_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_gender" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cast_class_division_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control cast_class_report" name="" style="border-radius:3px;" id="cast_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3" id="cast_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control cast_division_report" name="" style="border-radius:3px;" id="cast_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Cast</label> 
                                                                                    <select class="form-control cast_cast_report" name="" style="border-radius:3px;" id="cast_cast_report_details">
                                                                                        <option value="OPEN">OPEN</option>
                                                                                        <option value="ST">ST</option>
                                                                                        <option value="SBC">SBC</option>
                                                                                        <option value="BC-A">BC-A</option>
                                                                                        <option value="BC-B">BC-B</option>
                                                                                        <option value="SC">SC</option>
                                                                                        <option value="SC">OBC</option> 
                                                                                        <option value="SC">VJNT</option> 
                                                                                        <option value="SC">NT</option> 
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_cast_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_cast" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="town_class_division_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control town_class_report" name="" style="border-radius:3px;" id="town_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3" id="town_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control town_division_report" name="" style="border-radius:3px;" id="town_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Town</label> <br>
                                                                                    <select class="form-control town_town_report select2_demo" name="" style="border-radius:3px;" id="town_town_report_details" style="width: 100%;">
                                                                                        <?php foreach ($town as $key) {?>
                                                                                            <option value="<?=$key['student_present_town']?>"><?=$key['student_present_town']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_town_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_town" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="contact_class_division_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addtEmployee">
                                                                     <div class="form-group">
                                                                        <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Class</label> 
                                                                                    <select class="form-control contact_class_report" name="" style="border-radius:3px;" id="contact_class_report_details">
                                                                                         <option value="0">All CLass</option>
                                                                                        <?php foreach ($class as $key) {?>
                                                                                            <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-sm-3" id="town_division_report">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Division</label> 
                                                                                    <select class="form-control town_division_report" name="" style="border-radius:3px;" id="town_division_report_details">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- <div class="col-sm-3">
                                                                            <div class="col-sm-10">   
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="padding-bottom:2%">&nbsp Town</label> <br>
                                                                                    <select class="form-control town_town_report select2_demo" name="" style="border-radius:3px;" id="town_town_report_details" style="width: 100%;">
                                                                                        <?php foreach ($town as $key) {?>
                                                                                            <option value="<?=$key['student_present_town']?>"><?=$key['student_present_town']?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-5 col-sm-offset-1">   
                                                                            <span class="btn btn-success show_contact_report">Show Report</span>
                                                                        </div>
                                                                    </div>  
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example_contact" style="width:100% !important;">
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="govern_class_division_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example-gov" style="width:100% !important;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th rowspan="2">GRN No.</th>
                                                                                <th rowspan="2">A.Y.</th>
                                                                                <th rowspan="2">Class</th>
                                                                                <th rowspan="2">Division</th>
                                                                                <th colspan="3">Student Name</th>
                                                                                <th rowspan="2">DOB</th>
                                                                                <th rowspan="2">Gender</th>
                                                                                <th colspan="3">Mother Name</th>
                                                                                <th rowspan="2">UDISE No</th>
                                                                                <th rowspan="2">Semi English</th>
                                                                                <th rowspan="2">Admission Date</th>
                                                                                <th rowspan="2">Admission Class</th>
                                                                                <th rowspan="2">Admission Type</th>
                                                                                <th rowspan="2">Religion</th>
                                                                                <th rowspan="2">Category</th>
                                                                                <th rowspan="2">BPL</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Last Name</th>
                                                                                <th>First Name</th>
                                                                                <th>Middle Name</th>
                                                                                <th>Last Name</th>
                                                                                <th>First Name</th>
                                                                                <th>Middle Name</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($government as $key) { ?>
                                                                            <tr>
                                                                               <td><?=$key['student_GRN']?></td>
                                                                                <td><?=$key['AY_name']?></td>
                                                                                <td><?=$key['class_name']?></td>
                                                                                <td><?=$key['division_name']?></td>
                                                                                <td><?=$key['student_last_name']?></td>
                                                                                <td><?=$key['student_first_name']?></td>
                                                                                <td><?=$key['student_middle_name']?></td>
                                                                                <td><?=$key['DOB']?></td>
                                                                                <td><?=$key['student_gender']?></td>
                                                                                <td><?=$key['parent_last_name']?></td>
                                                                                <td><?=$key['parent_first_name']?></td>
                                                                                <td><?=$key['parent_middle_name']?></td>
                                                                                <td>27350504907</td>
                                                                                <td>No</td>
                                                                                <td><?=$key['admission_date']?></td>
                                                                                <td><?=$key['class_of_admission']?></td>
                                                                                <td></td>
                                                                                <td><?=$key['student_religion']?></td>
                                                                                <td><?=$key['student_category']?></td>
                                                                                <td>No</td>
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
                                    <div id="sms_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example-SMS" style="width:100% !important;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>GRN No.</th>
                                                                                <th>Student</th>
                                                                                <th>Parent</th>
                                                                                <th>Date</th>
                                                                                <th>Mobile No.</th>
                                                                                <th>Status</th>
                                                                                <th>Message</th>
                                                                                <th>MSG ID</th>
                                                                                <!-- <th>SMS Count</th> -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($total_sms_report as $key) { ?>
                                                                            <tr>
                                                                                <td><?=$key['student_GRN']?></td>
                                                                                <td><?=$key['student_name']?></td>
                                                                                <td><?=$key['parent_name']?></td>
                                                                                <td><?=$key['sms_date']?></td>
                                                                                <td><?=$key['sent_sms_mobile_number']?></td>
                                                                                <td><?=$key['sent_sms_status']?></td>
                                                                                <td><?=$key['sent_sms_MSG']?></td>
                                                                                <td><?=$key['sent_sms_MsgID']?></td>
                                                                                <!-- <td><?=$key['sent_sms_count']?></td> -->
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
                                    <div id="All_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="StudentReport">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="4"><span class="btn btn-primary">Gender</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:3.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="6"><span class="btn btn-primary">DOB</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:3.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="16"><span class="btn btn-primary">Cast</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="17"><span class="btn btn-primary">SubCast</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:3.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="9"><span class="btn btn-primary">Town</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:3.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="12"><span class="btn btn-primary">Class</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="13"><span class="btn btn-primary">Division</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="14"><span class="btn btn-primary">Roll No</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="15"><span class="btn btn-primary">Religion</span></a>
                                                                        </div>
                                                                        <div class="col-sm-1" style="width:4.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="10"><span class="btn btn-primary">Address</span></a>
                                                                        </div>
                                                                        <div class="col-sm-2" style="width:5.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="5"><span class="btn btn-primary">Adhar Card</span></a>
                                                                        </div>
                                                                        <div class="col-sm-2" style="width:5.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="7"><span class="btn btn-primary">Birth Place</span></a>
                                                                        </div>
                                                                        <div class="col-sm-2" style="width:6.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="8"><span class="btn btn-primary">Blood Group</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:7.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="11"><span class="btn btn-primary">Admission Date</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:8.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="18"><span class="btn btn-primary">Father First Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="19"><span class="btn btn-primary">Father middle Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="20"><span class="btn btn-primary">Father Last Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:8.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="21"><span class="btn btn-primary">Father Mobile No</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:7.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="22"><span class="btn btn-primary">Father Email ID</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="23"><span class="btn btn-primary">Mother First Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="24"><span class="btn btn-primary">Mother middle Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="25"><span class="btn btn-primary">Mother Last Name</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="26"><span class="btn btn-primary">Mother Mobile No</span></a>
                                                                        </div>
                                                                        <div class="col-sm-3" style="width:9.666667% !important;"> 
                                                                            <a class="toggle-vis" data-column="27"><span class="btn btn-primary">Mother Email ID</span></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="hr-line-dashed"></div>
                                                                </form>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example-all" style="width:100% !important;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>GRN No.</th>
                                                                                <th>First Name</th>
                                                                                <th>Middle Name</th>
                                                                                <th>Last Name</th>
                                                                                <th>Gender</th>
                                                                                <th>Adhar Card</th>
                                                                                <th>DOB</th>
                                                                                <th>Birth Place</th>
                                                                                <th>Blood Group </th>
                                                                                <th>Town</th>
                                                                                <th>Address</th>
                                                                                <th>Admission Date</th>
                                                                                <th>Class</th>
                                                                                <th>Division</th>
                                                                                <th>Roll No.</th>
                                                                                <th>Religion</th>
                                                                                <th>Cast</th>
                                                                                <th>Sub Cast</th>
                                                                                <th>Father First Name</th>
                                                                                <th>Father Middle Name</th>
                                                                                <th>Father Last Name</th>
                                                                                <th>Mobile No.</th>
                                                                                <th>Email ID</th>
                                                                                <th>Mother First Name</th>
                                                                                <th>Mother Middle Name</th>
                                                                                <th>Mother Last Name</th>
                                                                                <th>Mobile No.</th>
                                                                                <th>Email ID</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($all_report as $key) { ?>
                                                                            <tr>
                                                                                <td><?=$key['student_GRN']?></td>
                                                                                <td><?=$key['student_first_name']?></td>
                                                                                <td><?=$key['student_middle_name']?></td>
                                                                                <td><?=$key['student_last_name']?></td>
                                                                                <td><?=$key['student_gender']?></td>
                                                                                <td><?=$key['student_adhar_card_number']?></td>
                                                                                <td><?=$key['DOB']?></td>
                                                                                <td><?=$key['student_birth_place']?></td>
                                                                                <td><?=$key['student_blood_group']?></td>
                                                                                <td><?=$key['student_present_town']?></td>
                                                                                <td><?=$key['student_address']?></td>
                                                                                <td><?=$key['admission_date']?></td>
                                                                                <td><?=$key['class_name']?></td>
                                                                                <td><?=$key['division_name']?></td>
                                                                                <td><?=$key['SCD_roll_no']?></td>
                                                                                <td><?=$key['student_religion']?></td>
                                                                                <td><?=$key['student_cast']?></td>
                                                                                <td><?=$key['student_sub_cast']?></td>
                                                                                <td><?=$key['father_first_name']?></td>
                                                                                <td><?=$key['father_middle_name']?></td>
                                                                                <td><?=$key['father_last_name']?></td>
                                                                                <td><?=$key['father_mobile_number']?></td>
                                                                                <td><?=$key['father_email_id']?></td> 
                                                                                <td><?=$key['mother_first_name']?></td>
                                                                                <td><?=$key['mother_middle_name']?></td>
                                                                                <td><?=$key['mother_last_name']?></td>
                                                                                <td><?=$key['mother_mobile_number']?></td>
                                                                                <td><?=$key['mother_email_id']?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr >
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search GRN" data-index="0" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search First Name" data-index="1" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Middle Name" data-index="2" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Last Name" data-index="3" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Gender" data-index="4" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Adhar Card" data-index="5" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search DOB" data-index="6" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Birth Place" data-index="7" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Blood Group" data-index="8" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Town" data-index="9" style="padding:5%;padding-right: 1%;"></th>
                                                                                <th style="padding:0px;"><!-- <input type="text" placeholder="Search GRN" data-index="10" style="padding:2%;"> --></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Admission Date" data-index="11" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Class" data-index="12" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Division" data-index="13" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Roll No" data-index="14" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Religion" data-index="15" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Cast" data-index="16" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Sub Cast" data-index="17" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search First Name" data-index="18" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Middle Name" data-index="19" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Last Name" data-index="20" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Mobile No." data-index="21" style="padding:5%;padding-right: 1%;"></th>
                                                                                <th style="padding:0px;"><!-- <input type="text" placeholder="Search Father Email ID" data-index="22" style="padding:5%;"> --></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search First Name" data-index="23" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Middle Name" data-index="24" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Last Name" data-index="25" style="padding:5%;"></th>
                                                                                <th style="padding:0px;"><input type="text" placeholder="Search Mobile No." data-index="26" style="padding:5%;padding-right: 2%;"></th>
                                                                                <th style="padding:0px;"><!-- <input type="text" placeholder="Search Mother Email ID" data-index="27" style="padding:5%;"> --></th>
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
                                    </div>
                                   <!--  <div id="enquiry_report" class="tab-pane">
                                        <div class="panel-body" style="margin-left:15% !important;width:85%;">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-content">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example1" style="width: 100%;">
                                                                        <thead>
                                                                            <th>GRN No.</th>
                                                                            <th>Academic Year</th>
                                                                            <th>Class</th>
                                                                            <th>Division</th>
                                                                            <th>Student</th>
                                                                            <th>DOB</th>
                                                                            <th>Gender</th>
                                                                            <th>Mother</th>
                                                                            <th>UDISE No.</th>
                                                                            <th>Admission Date</th>
                                                                            <th>Admission Type</th>
                                                                            <th>Religion</th>
                                                                            <th>Category</th>
                                                                            <th>BPL</th>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>