<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/invoice_print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:32:37 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Exam | Schedule</title>

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
                <div class="wrapper wrapper-content p-xl" style="padding:0px !important; border:1px solid #000000;">
                    <div class="ibox-content p-xl" style="padding:0px !important;">
                            <div class="row">
                                <img src="<?=$school_report_header?>">
                            </div><br>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="padding-right: 10%;">
                                            <th colspan="2" style="border-bottom: none !important;padding-left: 10%;">
                                                <h4>Class: <strong><?=$exam_details[0]['class_name']?></strong></h4>
                                            </th> 
                                            <th colspan="2" class="text-right" style="border-bottom: none !important;padding-right: 10%;">
                                               <h4>Term : <strong><?=$exam_details[0]['term_name']?></strong></h4>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td  colspan="5">
                                                <center><strong><?=$exam_details[0]['eval_name']?> Exam Timetable</strong></center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Date</th>
                                            <th>Timing</th>
                                            <th>Subject</th>
                                            <th>Paper Marks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach ($exam_details as $key ) { ?>
                                            <tr>
                                                <td><?=$i++; ?></td>
                                                <td><?=$key['exam_date']?></td>
                                                <td><?=$key['exam_start_time']?> to <?=$key['exam_end_time']?></td>
                                                <td><?=$key['subject_name']?></td>
                                                <td><?=$key['exam_outoff_marks']?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <table class="table" style="margin-top: 10%;margin-bottom: 0px;">
                                    <thead>
                                        <tr style="padding-right: 10%;">
                                            <th colspan="2" style="border-bottom: none !important;padding-left: 10%;">
                                                <h4><strong>Co-ordination Signature</strong></h4>
                                            </th> 
                                            <th colspan="2" class="text-right" style="border-bottom: none !important;padding-right: 10%;">
                                               <h4<strong>Clerk Signature</strong></h4>
                                            </th>
                                            <th colspan="2" class="text-right" style="border-bottom: none !important;padding-right: 10%;">
                                               <h4><strong>Principal Signature</strong></h4>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div><!-- /table-responsive -->

                            <div class="well m-t" style="padding:0px !important;margin-bottom: 0px;">
                                <img src="<?=$school_report_footer?>">
                            </div>
                        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
