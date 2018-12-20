<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/logo.gif"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eSchool | School Admin</title>

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.3/jquery.datetimepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
    
    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
    <!-- <link href="<?=base_url()?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?=base_url();?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/jquery.paginate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
     <!-- c3 Charts -->
    <link href="<?=base_url()?>assets/css/plugins/c3/c3.min.css" rel="stylesheet">
    <style type="text/css">
    .open>.dropdown-menu {
        display: block;
        width: max-content;
    }
    .dropdown-menu > li > a:hover{
        border-bottom: 1px solid #a7b1c2;
        border-radius: 02px;
    }
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?=base_url()?>assets/img/pageLoader1.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
    </style>
   
</head>

<body class="top-navigation">
    <div class="loader"></div>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar" style="background-color: black;"></span>
                            <span class="icon-bar" style="background-color: black;"></span>
                            <span class="icon-bar" style="background-color: black;"></span> 
                        </button>
                        <img class="img-responsive" src="<?=base_url()?>assets/img/eschool_logo.gif" style="height:81px;"></a>
                    </div>
                    <div class="navbar-collapse collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <?php if($direct == 0){ ?>
                            <li>
                                <a href="<?=site_url('Authentication/direct_logout')?>"><img src="<?=base_url()?>assets/img/icon/school.png" style="display: -webkit-box;font-size: initial;padding-left: 4px;"></i> School</a>
                            </li>
                            <?php }?>
                            <li id="dashboard">
                            <a href="<?=site_url('School')?>"><img src="<?=base_url()?>assets/img/icon/dashboard.png" style="display: -webkit-box;font-size: initial;padding-left: 20px;"></i> Dashboard </a>
                            </li>
                            <li class="dropdown" id="config">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/config.png" style="display: -webkit-box;font-size: initial;padding-left: 5px;"></i> Config <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?=site_url('School_class/class_details')?>"><b>Class</b></a></li>
                                    <li><a href="<?=site_url('School_class/division_details')?>"><b>Division</b></a></li>
                                    <li><a href="<?=site_url('School_class/eval_details')?>"><b>Evaluation</b></a></li>
                                    <li><a href="<?=site_url('School_class/subject_details')?>"><b>Subject</b></a></li>
                                    <li><a href="<?=site_url('Exam/term_details')?>"> <b>Term</b></a></li>
                                    <li><a href="<?=site_url('Exam/grade_details')?>"><b>Grade</b></a></li>
                                    <li><a href="<?=site_url('Fee/fee_setup')?>"><b>Fee</b></a></li>
                                </ul>
                            </li>
                            <li class="dropdown" id="student">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/student.png" style="display: -webkit-box;font-size: initial;padding-left: 10px;"></i> Student <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?=site_url('Enquiry/view_enquiry')?>"><b>Enquiry Details</b></a></li>
                                    <li><a href="<?=site_url('Student/student_registration')?>"><b>Student Registration</b></a></li>
                                    <li><a href="<?=site_url('Student/view_student')?>"><b>Student Details</b></a></li>
                                    <li><a href="<?=site_url('Student_class_division_assign')?>"><b>Class & Division Allocation</b></a></li>
                                    <li class="dropdown"><a href="<?=site_url('Reports/enquiry_student_report')?>"><b>Report</b></a></li>
                                </ul>
                            </li>
                            <?php if($employee_type == 3){ ?>
                            <li class="dropdown" id="employee">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/employee.png" style="display: -webkit-box;font-size: initial;padding-left: 18px;"></i> Employee <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?=site_url('Employee/employee_registration')?>"><b>Employee Registration</b></a></li>
                                    <li><a href="<?=site_url('Employee/view_employee')?>"><b>Employee Details</b></a></li>
                                     <!-- <li><a href="<?=site_url('Employee/HR_pay_roll')?>"><b>HR Pay Roll</b></a></li> -->
                                </ul>
                            </li>
                            <?php } ?>
                            <li class="dropdown" id="education">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/acadmic.png" style="display: -webkit-box;font-size: initial;padding-left: 18px;"></i> Academic <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?=site_url('Teacher_subject_assign')?>"><b>Subject Allocation</b></a></li>
                                    <li><a href="<?=site_url('Teacher_class_division_subject_assign')?>"><b>Teacher Allocation</b></a></li>
                                    <li><a href="<?=site_url('Lesson')?>"> <b>Lesson Allocation</b></a></li>
                                    <li><a href="<?=site_url('Timetable')?>"><b>Timetables</b></a></li>
                                    <li><a href="<?=site_url('Attendance')?>"><b>Attendance</b></a></li>
                                </ul>
                            </li>
                            <li id="exam">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/exam.png" style="display: -webkit-box;font-size: initial;padding-left: 10px;"></i> Exam <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?=site_url('Exam/exam_details')?>"> <b>Exam Details</b></a></li>
                                    <!-- <li><a href="<?=site_url('Reports/exam_report')?>"> <b>Exam Report</b></a></li> -->
                                </ul>
                            </li>
                            <li class="dropdown" id="fee">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/money.png" style="display: -webkit-box;font-size: initial;padding-left: 10px;"></i> Finance <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <!-- <li><a href="<?=site_url('Fee/fee_setup')?>"><b> Fee Setup</b></a></li> -->
                                    <li><a href="<?=site_url('Fee/fee_details')?>"><b> Fee Details</b></a></li>
                                    <!-- <li><a href="<?=site_url('DayBook/dayBook_details')?>"><b> Accounting</b></a></li> -->
                                    <li><a href="<?=site_url('Reports/fee_report')?>"><b> Fee Reports</b></a></li>
                                </ul>
                            </li>
                            <li class="dropdown" id="other">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/other_big.png" style="display: -webkit-box;font-size: initial;padding-left: 18px;"></i> Add One's <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li id="gallery"><a href="<?=site_url('Gallery')?>"><b>Gallery </b></a></li>
                                    <li id="holiday"><a href="<?=site_url('Holiday/holidays')?>"><b>Holiday</b></a></li>
                                    <li id="notification"><a href="<?=site_url('Notification/notification_details')?>"><b>Notification's</b></a></li>
                                    <li id="certification"><a href="<?=site_url('Certification')?>"><b>Certification</b></a></li>
                                    <!-- <li id="tracking"><a href="<?=site_url('Tracking')?>"><b>Tracking</b></a></li> -->
                                    <li id="tracking"><a href="<?=site_url('Security/visitor')?>"><b>Visitors</b></a></li>
                                </ul>
                            </li>
                            <!-- <li id="visitor">
                                <a href="<?=site_url('Security/visitor')?>"><img src="<?=base_url()?>assets/img/icon/visitor.png" style="display: -webkit-box;font-size: initial;padding-left: 4px;"></i> Visitor </a>
                            </li> -->
                            <!-- <li class="dropdown" id="report">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/report.png" style="display: -webkit-box;font-size: initial;padding-left: 13px;"></i> Reports <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                </ul>
                            </li>
                            <li class="dropdown" id="help">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/icon/help.png" style="display: -webkit-box;font-size: initial;padding-left: 5px;"></i> Help <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                </ul>
                            </li> -->
                        </ul>  
                        <!-- <div id="google_translate_element"></div> -->
                        <ul class="nav navbar-top-links navbar-right">
                            <div class="dropdown profile-element">
                            <center>
                                <?php if($direct != 0){ ?>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false" style="padding: 0px 0px;">
                                    <span class="clear">
                                        <img alt="image" class="img-circle" src="<?php echo $photo ?>" style="height:61px;width:61px;padding: 10px;"></span> 
                                    </span>
                                </a>
                                <div class="dropdown-menu fadeInLeft" style="">
                                    <div class="contact-box" style="margin: 0 0 0 0;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <img alt="image" class="img-circle img-responsive"  src="<?php echo $photo ?>" style="height:81px;width:81px;">
                                            </div>
                                            <div class="col-sm-8" style="padding:0%;">
                                                <h3><strong><?php echo $first_name." ".$last_name; ?></strong></h3>
                                                <h4><?php echo $email_id; ?></h4>
                                                <h5><span>Username: </span><?php echo $username; ?></h5>
                                                <!-- <?php if($direct != 0){ ?><a href="<?=site_url('School/edit_profile')?>">My Account</a> <?php } ?> -->
                                            </div>       
                                        </div>

                                    </div>
                                    <div style="background-color:#000000;">
                                        <div style="padding:3%;">
                                            <a href="<?=site_url('School/forgot_password')?>" style="color:#ffffff;">Change Password?</a>
                                            <a href="<?=site_url('Authentication/logout')?>" class="btn btn-xs btn-primary pull-right" style:"color:#000000; padding-bottom:2%;">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </center>
                            </div>
                        </ul>
                    <?php } ?>
                    <ul class="nav navbar-top-links navbar-right">
                        <li style="padding-top: 20%;">
                            <span class="m-r-sm text-muted welcome-message"> <b>Academic Year </b><br><center><b><?php echo $AY_name; ?></b></center></span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>