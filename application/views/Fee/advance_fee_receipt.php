<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/logo.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trackmee | School</title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
</head>
<style type="text/css">
   @media print {
    body {
        /*font-size: 80px;*/
    }
    h1 {
        /*font-size: 100px;*/
    }
}
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
  /* ... the rest of the rules ... */
}

</style>

<body class="top-navigation">

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content p-xl" style="border-top: 0;">
                <?php foreach ($fee_details as $key) { ?>
                <?php foreach ($student_total_payments as $key1) { ?>
                <div class="row">
                    <img src="<?=$key['school_report_header'] ?>" width="100%">
                    <br>
                </div><br>
                <center>
                    <div style="width:40%;border: 1px solid #000;">
                        <h3 style="margin-top: 10px;"> <i>OFFICIAL ADVANCE FEE RECEIPT</i></h3>
                    </div>
                </center><br>
                <!-- <hr style="border-top: 1px solid #000;"> -->
                    <div>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <td style="border-top: 0;padding: 5px;"><strong>Academic year : </strong><?=$key['AY_name']?></td>
                                    <td style="text-align: right;border-top: 0;padding: 5px;"><strong>GRN. No : </strong><?=$key['student_GRN']?></td>
                                </tr>
                                <tr>
                                    <td style="border-top: 0;padding: 5px;"><strong>Reciept Date : </strong><?=substr($key['advance_datetime'], 0,10) ?></td>
                                    <td style="text-align: right;border-top: 0;padding: 5px;"><strong>Reciept No : </strong>AR-<?=$key['advance_id']?></td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #000;"><strong>Name : </strong><?=$key['student_first_name'] ?> <?=$key['student_middle_name'] ?> <?=$key['student_last_name'] ?></td>
                                    <td style="text-align: right;border-top: 1px solid #000;"><strong>Class : </strong> <?=$key['class_name']?> ( <?=$key['division_name']?> )</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <center>
                        <div class="table-responsive m-t">
                            <table class="table invoice-table">
                                <thead>
                                    <tr>
                                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000;">Sr. No</th>
                                        <th style="text-align: center;border-top: 1px solid #000;border-bottom: 1px solid #000;">Fee Head</th>
                                        <th style="text-align: center;border-top: 1px solid #000;border-bottom: 1px solid #000;">Category</th>
                                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($fee_details as $key2) { ?>
                                        <tr>
                                            <td style="border-top: 0;"><?=$i;?></td>
                                            <td style="text-align: center;border-top: 0;">Adavnce Payment</td>
                                            <td style="text-align: center;border-top: 0;">Advance Payment</td>
                                            <td style="border-top: 0;">+ INR. <?=$key2['advance_amount']?></td>
                                        </tr>
                                    <?php $i++; } ?>
                                    <?php foreach ($fetch_student_total_payments as $key3) { ?>
                                    <?php } ?>
                                    <?php $total_previous_amt = 0;$total_paid_amt = 0;
                                        foreach ($payment_history as $key4) 
                                        { 

                                        } ?> 
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive m-t">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000;text-transform: capitalize;"><h3><b>Amount In Words : <?=$amt_in_words?> </b></h3></th>
                                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;"><h3><b>Amount Received : <?=$key['advance_amount'] ?> </b></h3></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div>
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <td style="border-top: 0;;padding: 5px;"></td>
                                        <td style="border-top: 0;padding: 5px;text-align: right"><strong>Advance Total Payment : </strong>INR. <?=$advance_payment[0]['student_total_advance_payment']?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0;padding: 5px;"><strong>Payment Mode : </strong>
                                            <?php if ($key['advance_payment_mode'] == 1) { ?> CASH <?php } ?>
                                            <?php if ($key['advance_payment_mode'] == 2) { ?> ONLINE (NEFT/RTGS/IMPS/PAYTM)  <?php } ?>
                                            <?php if ($key['advance_payment_mode'] == 3) { ?> CHEQUE  <?php } ?>
                                        </td>
                                        <td style="border-top: 0;text-align: right;padding: 5px;"><strong>Narration : </strong> <?=$key['advance_narration']?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Fee deposit by.</td>
                                    <td>Issused by.</td>
                                    <td>Fee Collected by.</td>
                                </tr>
                            </thead>
                        </table>

                    <?php } } ?>

                    </center>
                    <div style="display: block;position: fixed;bottom: 0;left:15px;">
                        <img src="<?=$key['school_report_footer'] ?>" width="100%">
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

    $(document).ready(function(){
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?> 
    });
    </script>
</body>
</html>
