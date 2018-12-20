<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/invoice_print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:32:37 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eSchool | GET PASS Print</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
    <div class="wrapper wrapper-content p-xl">
        <div class="ibox-content p-xl" style="border: 1px solid;">
            <img src="<?php echo $school_report_header; ?>" width="100%">
            <center>
                <div style="width:100%;">
                    <h4 style="margin-top: 10px;font-size:25px;margin-bottom:5px; font-style: oblique;">GET PASS</h4>
                </div>
            </center>
             <p style="margin-top: 10px;padding: 0px 2% 0px 2%"><b> PASS NO. :  <?php echo $pass_details[0]['get_pass_id'] ?> </b>
                    <span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo $pass_details[0]['get_pass_date']; ?>  </b></span>
                </p>
            <div class="hr-line-dashed"></div>

            <div class="table-responsive">
                <table class="table table table-striped table-bordered table-hover" style="padding-bottom: 10%;">
                    <tbody>
                        <tr>
                            <td colspan="3"  rowspan="4"><center><img src="<?php echo $student_details[0]['student_photo'] ?>" width="50%"></td></center>
                            <tr><td colspan="1">Name : </td><td colspan="4"><?php echo $student_details[0]['student_name'] ?></td></tr>
                            <tr><td colspan="1">Token : </td><td colspan="4"><?php echo $pass_details[0]['visitor_token'] ?></td><td colspan="4">Time : <?php echo $pass_details[0]['get_pass'] ?></td></tr>
                            <tr><td colspan="1">Reason : </td><td colspan="5"><?php echo $pass_details[0]['get_pass_reason'] ?></td></tr>
                        </tr>
                        <tr>                            
                        </tr>
                    </tbody>
                </table> 
                <center>           
                <table class="table table table-striped table-bordered table-hover" style="width:100%;padding-left: 15%;padding-right: 10%;">
                    <tbody>
                    <tr>
                        <td colspan="3">
                            <h4>Principal Signature</h4>
                        </td>
                        <td colspan="3">
                            <h4>Clerk Signature</h4>
                        </td>
                        <td colspan="3">
                            <h4>Class Teacher Signature</h4>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </center>
            </div><!-- /table-responsive -->
            <div class="well m-t">
               <img src="<?php echo $school_report_footer; ?>" width="100%">
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/invoice_print.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:32:37 GMT -->
</html>
