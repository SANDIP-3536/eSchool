<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eschool | Marksheet Printing</title>
    <link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">
    <style type="text/css">
    @media print{
        .table_td{
           width: 50% !important; 
        }
        div.new_page {
            display: block; page-break-before: always;
        }
        .table{
            margin-bottom: 0px;
        }
        @page
           {
            size: 8.286in 11.693in;
            size: potrait;
          }
    }
    </style>
</head> 
<body class="top-navigation"> 
    <div>
        <div class="gray-bg" id="result">
            <div class="" style="border:2px solid black;min-height: 27.3cm;">
                <div class="" style="border:5px solid black;min-height: 27.3cm;margin: 5px 5px 5px 5px;">
                <?php foreach ($query1 as $key) { ?>
                    <img src="<?=$school_leaving_certificate_header;?>" class="img-responsive" alt="" height="10%">
                    <h2 style="text-align: center;font-style: bold;"><p style="font-weight: bold;">STUDENT'S PROGRESS REPORT</p></h2>
                    <h4 style="text-align: center;"><p style="margin-bottom: 5%;">Academic Year : <b><?=$acadamic_name?></b></p></h4>
					<center>
						<table class="table"  style="font-size: 16px;width: 90%;">
							<tr>
								<td style="border-top: none;">Name of student</td>
								<td style="border-top: none;">:</td>
								<td colspan="7" style="color: #000;border-top: none;"><b><?=$key['student_name']?></b></td>
								<td colspan="4" style="border-top: none;text-align: right">Student Photo</td>
							</tr>
							<tr>
								<td style="border-top: none;">Standard</td>
								<td style="border-top: none;">:</td>
								<td colspan="2" style="color: #000;border-top: none;"><b><?=$key['class_name']?></b></td>
								<td style="text-align: right;border-top: none;">Division</td>
								<td style="border-top: none;">:</td>
								<td colspan="2" style="color: #000;border-top: none;"><b><?=$key['division_name']?></b></td>
								<td colspan="5" rowspan="4" style="text-align: right;border-top: none;"><img src="<?=$key['student_photo']?>" style="height: 150px;border: 3px solid #000;"></td>
							</tr>
							<tr>
								<td style="border-top: none;">GRN No</td>
								<td style="border-top: none;">:</td>
								<td colspan="2" style="color: #000;border-top: none;"><b><?=$key['student_GRN']?></b></td>
								<td style="text-align: right;border-top: none;">Roll No</td>
								<td style="border-top: none;">:</td>
								<td colspan="7" style="color: #000; border-top: none;"><b><?=$key['SCD_Roll_No']?></b></td>
								
							</tr>
							<tr>
								<td style="border-top: none;">Gender</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="border-top: none;color: #000;"><b><?=$key['student_gender']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Date of Birth</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="border-top: none;color: #000;"><b><?=$key['DOB']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Place of Birth</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="border-top: none;color: #000;"><b><?=$key['student_birth_place']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Father Name</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="color: #000; border-top: none;"><b><?=$key['father_name']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Mother Name</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="color: #000;border-top: none;"><b><?=$key['mother_name']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Aadhar card No.</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="color: #000; border-top: none;"><b><?=$key['student_adhar_card_number']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Category</td>
								<td style="border-top: none;">:</td>
								<td colspan="2" style="color: #000;border-top: none;"><b><?=$key['student_category']?></b></td>
								<td style="text-align: right;border-top: none;">Nationality</td>
								<td style="border-top: none;">:</td>
								<td colspan="7" style="color: #000;border-top: none;"><b><?=$key['student_nationality']?></b></td>
							</tr>
							<tr>
								<td style="border-top: none;">Address</td>
								<td style="border-top: none;">:</td>
								<td colspan="11" style="color: #000;border-top: none;"><b><?=$key['address']?></b></td>
							</tr>
						<table>
					</center>
                <?php } ?>
                <?php foreach ($query3 as $key) { ?>
                    <div style="text-align: center;margin-top: 4%;">
                        <span style="text-decoration: underline;font-weight: bold;font-size: 150%;">ATTENDANCE RECORD</span>
                    </div>
                    <br>
                    <center>
                        <table class="table table-bordered" style="width: 90%;">
                            <thead>
                                <tr>
                                    <td>Month</td>
                                    <td>Jun</td>
                                    <td>Jul</td>
                                    <td>Aug</td>
                                    <td>Sep</td>
                                    <td>Oct</td>
                                    <td>Nov</td>
                                    <td>Dec</td>
                                    <td>Jan</td>
                                    <td>Feb</td>
                                    <td>Mar</td>
                                    <td>Apr</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Present Days</td>
                                    <?php if ($key['present6'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present6']?></td><?php } ?>
                                    <?php if ($key['present7'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present7']?></td><?php } ?>
                                    <?php if ($key['present8'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present8']?></td><?php } ?>
                                    <?php if ($key['present9'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present9']?></td><?php } ?>
                                    <?php if ($key['present10'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present10']?></td><?php } ?>
                                    <?php if ($key['present11'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present11']?></td><?php } ?>
                                    <?php if ($key['present12'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present12']?></td><?php } ?>
                                    <?php if ($key['present1'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present1']?></td><?php } ?>
                                    <?php if ($key['present2'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present2']?></td><?php } ?>
                                    <?php if ($key['present3'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present3']?></td><?php } ?>
                                    <?php if ($key['present4'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['present4']?></td><?php } ?>
                                </tr>
                                <tr>
                                    <td>Absent Days</td>
                                    <?php if ($key['absent6'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent6']?></td><?php } ?>
                                    <?php if ($key['absent7'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent7']?></td><?php } ?>
                                    <?php if ($key['absent8'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent8']?></td><?php } ?>
                                    <?php if ($key['absent9'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent9']?></td><?php } ?>
                                    <?php if ($key['absent10'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent10']?></td><?php } ?>
                                    <?php if ($key['absent11'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent11']?></td><?php } ?>
                                    <?php if ($key['absent12'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent12']?></td><?php } ?>
                                    <?php if ($key['absent1'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent1']?></td><?php } ?>
                                    <?php if ($key['absent2'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent2']?></td><?php } ?>
                                    <?php if ($key['absent3'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent3']?></td><?php } ?>
                                    <?php if ($key['absent4'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['absent4']?></td><?php } ?>
                                </tr>
                                <tr>
                                    <td>Holiday Days</td>
                                    <?php if ($key['holiday6'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday6']?></td><?php } ?>
                                    <?php if ($key['holiday7'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday7']?></td><?php } ?>
                                    <?php if ($key['holiday8'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday8']?></td><?php } ?>
                                    <?php if ($key['holiday9'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday9']?></td><?php } ?>
                                    <?php if ($key['holiday10'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday10']?></td><?php } ?>
                                    <?php if ($key['holiday11'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday11']?></td><?php } ?>
                                    <?php if ($key['holiday12'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday12']?></td><?php } ?>
                                    <?php if ($key['holiday1'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday1']?></td><?php } ?>
                                    <?php if ($key['holiday2'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday2']?></td><?php } ?>
                                    <?php if ($key['holiday3'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday3']?></td><?php } ?>
                                    <?php if ($key['holiday4'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['holiday4']?></td><?php } ?>                                
                                </tr>
                                <tr>
                                    <td>Total Days</td>
                                    <?php if ($key['c6_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c6_count']?></td><?php } ?>
                                    <?php if ($key['c7_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c7_count']?></td><?php } ?>
                                    <?php if ($key['c8_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c8_count']?></td><?php } ?>
                                    <?php if ($key['c9_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c9_count']?></td><?php } ?>
                                    <?php if ($key['c10_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c10_count']?></td><?php } ?>
                                    <?php if ($key['c11_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c11_count']?></td><?php } ?>
                                    <?php if ($key['c12_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c12_count']?></td><?php } ?>
                                    <?php if ($key['c1_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c1_count']?></td><?php } ?>
                                    <?php if ($key['c2_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c2_count']?></td><?php } ?>
                                    <?php if ($key['c3_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c3_count']?></td><?php } ?>
                                    <?php if ($key['c4_count'] == '') { ?><td>0</td><?php }else{ ?><td><?=$key['c4_count']?></td><?php } ?>

                                </tr>
                                
                            </tbody>
                        </table>
                    </center>
                <?php } ?>
                </div>
            </div>

            <div class="new_page" style="border:2px solid black;min-height: 27.3cm;">
                <div class="" style="border:5px solid black;min-height: 27.3cm;margin: 5px 5px 5px 5px;">
                    <div class="row" style="">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td style="text-align: center;font-weight: bold;width: 50%;padding: 5px;">TERM I</td>
                                        <td style="text-align: center;font-weight: bold;width: 50%;padding: 5px;">TERM II</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0;width: 50%;">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td style="font-weight: bold;width: 50%;padding: 5px 5px 5px 30px;">SUBJECTS</td>
                                                    <td style="font-weight: bold;width: 50%;padding: 5px;text-align: center;">GRADE OBTAINED</td>
                                                </tr>
                                                <?php foreach ($query4[0] as $key1) { ?>
                                                    <tr>
                                                        <td style="padding: 5px 5px 5px 30px;"><?=$key1['subject_name']?></td>
                                                        <td style="padding: 5px;text-align: center;"><?=$key1['GC_grade']?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </td>
                                        <td style="padding: 0;width: 50%;">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td style="font-weight: bold;width: 50%;padding: 5px 5px 5px 30px;">SUBJECTS</td>
                                                    <td style="font-weight: bold;width: 50%;padding: 5px;text-align: center;">GRADE OBTAINED</td>
                                                </tr>
                                                <?php foreach ($query4[1] as $key2) { ?>
                                                    <tr>
                                                        <td style="padding: 5px 5px 5px 30px;"><?=$key2['subject_name']?></td>
                                                        <td style="padding: 5px;text-align: center;"><?=$key2['GC_grade']?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr style="height: 60px;">
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%; ">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Special Remark</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[0])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[0][0]['SF_special_remark_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%;">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Special Remark</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[1])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[1][0]['SF_special_remark_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr style="height: 50px;">
                                    <tr>
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%;">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Intrest & Hobbies</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[0])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[0][0]['SF_Int_Hob_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%;">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Intrest & Hobbies</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[1])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[1][0]['SF_Int_Hob_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr style="height: 50px;">
                                    <tr>
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%;">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Improvement Require</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[0])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[0][0]['SF_Improvement_need_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="padding: 0;">
                                            <table style="width: 100%;text-align: center;border:1px solid black;margin-top: 0%;">
                                                <tr>
                                                    <th  style="padding: 5px;text-align: center;background-color: black;border:2px solid black;color: #fff;">Improvement Require</th>
                                                </tr>
                                                <tr style="height: 50px;">
                                                    <?php if (!empty($query4[1])) { ?>
                                                        <td style="padding: 5px;"><?=$query4[1][0]['SF_Improvement_need_1']?></td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr style="margin: 0px;border: 1px solid #000;">
                            <center>
                                
                                <table class="table table-bordered" style="width: 100%;text-align: center;border: 1px solid #000;">
                                    <tr>
                                        <td rowspan="2" style="font-weight: bold;border: 1px solid #000;">GRADE TABLE</td>
                                        <td style="font-weight: bold;white-space: nowrap;border: 1px solid #000;">MARKS RANGE</td>
                                        <?php $col_cnt=2; foreach ($query5 as $key) { $col_cnt++; ?>
                                            <td style="white-space: nowrap;border: 1px solid #000;"><?=$key['GC_lower_mark_range']?> - <?=$key['GC_higher_mark_range']?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;border: 1px solid #000;">GRADE</td>
                                        <?php foreach ($query5 as $key) { ?>
                                            <td style="border: 1px solid #000;"><?=$key['GC_grade']?></td>
                                        <?php } ?>
                                    </tr>
                                </table>
                            </center>
                            <hr style="margin: 0;border: 1px solid #000;">
                                    <?php if (!empty($query4[1])) { ?>
                                        <div style="padding-left: 10px;">
                                            <span style="text-align: center;">After summer vacation school reopen on 2019-06-01</span>
                                        <br>
                                            <span style="text-align: center;">Passes and goes to Std : IIIrd.</span>
                                        </div>
                                    <?php } ?>
                                        <br>
                                        <div style="margin-top: 10%;margin-left: 1%;">
                                            <table width="100%" border=0>
                                                <tr>
                                                    <td width="30%" style="text-align: center;">
                                                        <span style="text-align: center;font-weight: bold;font-weight: bold;font-size: 120%;">Parent</span>
                                                    </td>
                                                    <td width="30%" style="text-align: center;">
                                                        <span style="text-align: center;font-weight: bold;font-weight: bold;font-size: 120%;">Class Teacher</span>
                                                    </td>
                                                    <td width="30%" style="text-align: center;">
                                                        <span style="text-align: center;font-weight: bold;font-weight: bold;font-size: 120%;">Principal</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                   
                            <hr style="margin: 0;border: 1px solid #000;">
                            <div class="">
                                <div style="text-align: center;padding: 8px;">
                                    <span style="text-decoration: underline;font-weight: bold;font-size: 100%;">FOR PARENTS</span>
                                </div>
                                <div style="margin: 0 2% 0 2%;font-size: 10px;letter-spacing: 2px;">
                                    1) Parent co operation is indispensable for proper education of the children.<br>
                                    2) Parent should urge the child to cultivate the habits of cleanliness and self help right from childhood. <br>
                                    3) Students should be send to the school in time every day. <br>
                                    4) Those who suffer from the contagious diseases will not be allowed to attend the classes. <br>
                                    5) Allow your child to play at least for one hour according to his/her age. <br>
                                    6) Encourage your child to do the self study for at least one hour every day. <br>
                                    7) Encourage your Child to view/hear educational programs on the T.V./Radio. <br>
                                    8) kindly follow the diet chart given in the school diary. <br>
                                    9) Gold rings,chain and costly articles are strictly forbidden in  the school. <br>
                                    10) Parents are not allowed to meet teachers without the permission of the principal. <br>
                                    11) Parents are always governed by the rule framed by the management time to time. <br>
                                    12) No change will be made in the result of the examination once declared. <br>
                                    13) Show the child right path to reach the peak of success. <br>
                                     <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
<!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>