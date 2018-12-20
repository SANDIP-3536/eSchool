<!-- <link rel="stylesheet" href="https://andreas-peter.de/font-awesome/css/font-awesome.min.css"> -->
<div class="wrapper wrapper-content animated fadeIn" style="background-color:#ffffff;">
    <div class="row">
         <div class="col-lg-12" style="padding-right:0px;" id="visitor_details_with_get_pass">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3><b>Visitor Details</b></h3>
                    </div>
                    <div class="col-sm-6">
                        <span class="btn btn-success btn-xs pull-right" id="student_get_pass" style="padding: 0px;margin: 0px;"><i class="fa fa-vcard" style="font-size:27px;"></i></span>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                 <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Sr No.</th>
                            <!-- <th>Student Name</th> -->
                            <th>Token</th>
                            <!-- <th>Comment</th> -->
                            <th>Date</th>
                            <th>IN Time</th>
                            <th>Out Time</th>
                            <!-- <th>PASS ID</th>
                            <th>Get Pass Reason</th> -->
                            <!-- <th>Get Pass Status</th> -->
                            <!-- <th>Actions</th> -->
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;foreach ($visitor_data as $key) {?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <!-- <td><?=$key['student_name']?></td> -->
                                <td><?=$key['visitor_token']?></td>
                                <!-- <td><?=$key['visitor_comment']?></td> -->
                                <td><?=$key['visitor_date']?></td>
                                <td><?=$key['visitor_checkin_time']?></td>
                                <td><?=$key['visitor_checkout_time']?></td>
                                <!-- <?php if($key['get_pass_id'] != ''){ ?>
                                    <td>PASS NO.<?=$key['get_pass_id']?></td>
                                <?php }else{ ?>
                                    <td></td>
                                <?php } ?>
                                <td><?=$key['get_pass_reason']?></td> -->
                            </tr>
                           <?php } ?>
                           <!-- <?php $i = 1;foreach ($visitor_data as $key) {
                            if($key['visitor_checkout_time'] == ''){?>
                                <tr class="visitor_token_history" title="<?php echo $key['visitor_id'] ?>">
                                    <td><?php echo $i++; ?></td>
                                    <td><?=$key['student_name']?></td>
                                    <td><?=$key['visitor_token']?></td>
                                    <td><?=$key['visitor_comment']?></td>
                                    <td><?=$key['visitor_date']?></td>
                                    <td><?=$key['visitor_checkin_time']?></td>
                                    <td><?=$key['visitor_checkout_time']?></td>
                                    <?php if($key['get_pass_id'] != ''){ ?>
                                        <td>PASS NO.<?=$key['get_pass_id']?></td>
                                    <?php }else{ ?>
                                        <td></td>
                                    <?php } ?>
                                    <td><?=$key['get_pass_reason']?></td>
                                </tr>
                            <?php }else{ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?=$key['student_name']?></td>
                                    <td><?=$key['visitor_token']?></td>
                                    <td><?=$key['visitor_comment']?></td>
                                    <td><?=$key['visitor_date']?></td>
                                    <td><?=$key['visitor_checkin_time']?></td>
                                    <td><?=$key['visitor_checkout_time']?></td>
                                    <?php if($key['get_pass_id'] != ''){ ?>
                                        <td>PASS NO.<?=$key['get_pass_id']?></td>
                                    <?php }else{ ?>
                                        <td></td>
                                    <?php } ?>
                                    <td><?=$key['get_pass_reason']?></td>
                                </tr>
                           <?php }} ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 hidden" id="get_pass_details">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3><b>GET PASS</b></h3>
                    </div>
                    <div class="col-sm-6">
                        <span class="btn btn-success btn-xs pull-right" id="close_get_pass"><i class="fa fa-times" title="Close Get Pass Details"></i></span>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="newGetPass" action="<?=site_url('Security/get_gate_pass')?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Student<span style="color:red;">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control select2_demo_3"  name="visitor_student_id"  required style="width: 100% !important;">
                                <option value="0"> Please Select  Student</option>
                                <?php foreach ($student as $key) {?>
                                    <option value="<?=$key['student_profile_id']?>"><?=$key['student_name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Token<span style="color:red;">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control select2_demo_3"  name="visitor_id"  required style="width: 100% !important;">
                                <option value="0"> Please Select Token</option>
                                <?php foreach ($visitor_token as $key) {?>
                                    <option value="<?=$key['visitor_id']?>"><?=$key['visitor_token']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <textarea rows="3" name="get_pass_reason" style="width:100%;" placeholder="Reason For GET PASS."></textarea>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12" style="border-bottom: 1px dashed;padding-bottom: 1%;">
                        <div class="form-group">
                            <div class="col-sm-4">    
                                <center><img class="rouded img-responsive" id="visitor_photo" src="<?=base_url()?>profile_photo/default_employee_image.png" style="width: 70%;   border-radius: 43%;"><br><figcaption><b>Visitor Photo</b></figcaption></img>
                                </center>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <img class="rouded img-responsive" id="visitor_ID_proof_photo" src="<?=base_url()?>profile_photo/default_driver_licence_image.png" style="width: 70%;border-radius: 5%;"><br><figcaption><b>Visitor ID Proof</b></figcaption></img>
                                </center>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <img class="rouded img-responsive" id="student_photo" src="<?=base_url()?>profile_photo/default_student_image.png" style="width: 70%;border-radius: 5%;"><br><figcaption><b>student Photo</b></figcaption></img>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style="padding-top: 1%;">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Name</label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-9" id="student_name">Daphal Sandip Karbhari</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Class</label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-2" id="class_name">1st</label>
                            <label class="control-label col-sm-2">Division</label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-3" id="division_name">A</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Token</label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-2" id="token_number">17</label>
                            <label class="control-label col-sm-2">CheckIN </label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-4" id="checkin_details">20 Aug 2018 10:30 PM</label>
                        </div><br>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Message</label>
                            <label class="control-label col-sm-1">:</label>
                            <label class="control-label col-sm-9" id="visitor_msg">This is Visitor Message.</label>
                        </div>
                        <div class="form-group"  style="padding-top: 5%;padding-bottom: 2%;">
                            <div class="col-sm-12">
                                <textarea rows="3" name="get_pass_reason" style="width:100%;" placeholder="Reason For GET PASS."></textarea>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <center><button class="btn btn-primary" type="submit">Print GET PASS </button></center>
                        </div>
                    </div>
                </form>
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
<script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

<!-- Full Calendar -->
<script src="<?=base_url()?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
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
<script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>

 <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
<script>
$(document).ready(function() {

    $.validator.setDefaults({
        ignore: [],
        submitHandler: function (form) {
            form.submit();
        }
    });

    <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
        swal({
            title: "<?=$flash['title']?>",
            text: "<?=$flash['text']?>",
            type: "<?=$flash['type']?>"
        });
            <?php } ?> <?php if($visitor = 'visitor') {?>
                $('#other').addClass('active');
                document.title = 'eSchool | Visitor'
            <?php } ?>

            $(".select2_demo_3").select2({
                allowClear: true
            });

            var today = new Date();
            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                maxDate: today
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

            $(document).on('click','#student_get_pass',function(){
                $('#visitor_details_with_get_pass').removeClass();
                $('#visitor_details_with_get_pass').addClass('col-sm-7');
                $('#get_pass_details').removeClass();
                $('#get_pass_details').addClass('col-sm-5');
                $('#student_get_pass').removeClass();
                $('#student_get_pass').addClass('btn btn-success btn-xs pull-right hidden');
            })

            // $(document).on('click','.visitor_token_history',function(){
            //    var visitor = this.title;               
            //    $.post('<?=site_url('Security/visitor_details')?>',{visitor:visitor},function(data){
            //         console.log(data);
            //         $('#visitor_details_with_get_pass').removeClass();
            //         $('#visitor_details_with_get_pass').addClass('col-sm-7');
            //         $('#get_pass_details').removeClass();
            //         $('#get_pass_details').addClass('col-sm-5');
            //         if(data[0].student_name != null){
            //             $('#student_name').text(data[0].student_name);
            //             $('#class_name').text(data[0].class_name);
            //             $('#division_name').text(data[0].division_name);
            //             $('#token_number').text(data[0].visitor_token);
            //             $('#checkin_details').text(data[0].checkin);
            //             $('#visitor_msg').text(data[0].visitor_comment);
            //             $('#visitor_photo').attr("src",""+data[0].visitor_photo+"");
            //             $('#visitor_ID_proof_photo').attr("src",""+data[0].visitor_id_card_photo+"");
            //             $('#student_photo').attr("src",""+data[0].student_photo+"");
            //         }else{
            //             $('#student_name').text('Unregistered Student');
            //             $('#class_name').text('');
            //             $('#division_name').text('');
            //             $('#token_number').text(data[0].visitor_token);
            //             $('#checkin_details').text(data[0].checkin);
            //             $('#visitor_msg').text(data[0].visitor_comment);
            //             $('#visitor_photo').attr("src",""+data[0].visitor_photo+"");
            //             $('#visitor_ID_proof_photo').attr("src",""+data[0].visitor_id_card_photo+"");
            //         }
            //    },'JSON');
            // });

            $(document).on('click','#close_get_pass',function(){
                $('#visitor_details_with_get_pass').removeClass();
                $('#visitor_details_with_get_pass').addClass('col-sm-12');
                $('#get_pass_details').removeClass();
                $('#get_pass_details').addClass('col-sm-5 hidden');
                $('#student_get_pass').removeClass();
                $('#student_get_pass').addClass('btn btn-success btn-xs pull-right');
            });

            $("#newGetPass").validate({
                rules: {
                    visitor_student_id:{
                        required:true,
                        min:1
                    },
                    visitor_id:{
                        required:true,
                        min:1
                    }
                },
                messages: {
                    visitor_student_id:{
                        required:"Please Select Student",
                        min:"Please Select Student"
                    },
                    visitor_id:{
                        min:"Please Select Token.",
                        required:"Please Select Token."
                    }
                }
            });

            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [    ],
                "language": {
                    "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                }

            });
    });



        </script>
    </body>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:25:00 GMT -->
    </html>



