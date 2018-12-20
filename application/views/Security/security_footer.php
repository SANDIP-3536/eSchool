<div class="footer">
    <div class="row">
        <!-- <div class="col-sm-2">
            <div class="pull-left">
                <center><strong>Copyright </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech_logo.png" style="width: 35%;"></a><strong> &copy; 2017-2018 </strong>  </center>
            </div>
        </div> -->
        <div class="col-sm-12">
            <center>
                <div>
                   <img src="<?php echo $institute_logo; ?>" style="height:20px;width:20px;"> <strong style="color:#ffffff;"><?php echo $institute_name; ?> </strong> 
                </div>
            </center>
        </div>
        <!-- <div class="pull-right">
            <center><i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong style=f>contactus@syntech.co.in </strong> </center>
        </div> -->
    </div>
</div>


<!-- Mainly scripts -->
<script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url()?>assets/js/inspinia.js"></script>
<script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

<script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- clockpicker -->
<script src="<?=base_url()?>assets/js/plugins/clockpicker/clockpicker.js"></script>

<script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>

<script src="<?=base_url();?>assets/js/plugins/lat_long_picker/jquery-gmaps-latlon-picker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?=$key?>"></script>

<!--google translate -->
<script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- end google translate -->
<script>

    $.validator.setDefaults({
        ignore: [],
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(document).ready(function(){
        <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
            swal({
                title: "<?=$flash['title']?>",
                text: "<?=$flash['text']?>",
                type: "<?=$flash['type']?>"
            });
            <?php } ?>

            $(".select2_demo_3").select2({
                allowClear: true
            });

            // $('#page-wrapper').css('background', 'black');
            

            var today = new Date();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                maxDate: today
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


            $('.datepicker').keyup(function () {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });

            $(document).on('click','#checkin_data',function(){
                // $(".loader").show();
            });

            $(document).on('change','#visitor_token_history',function(){
               var visitor = $(this).val();
               alert(visitor);
               $.post('<?=site_url('Security/visitor_pass_details')?>',{visitor:visitor},function(data){
                    console.log(data);
                    $('#visitor_details_with_token').removeClass();
                    $('#visitor_details_with_token').addClass('row');
                    if(data[0].student_name != null){
                        $('#student_name').text(data[0].student_name);
                        $('#token_number').text(data[0].visitor_token);
                        $('#get_pass_reason').text(data[0].get_pass_reason);
                        $('#checkIn').text(data[0].visitor_checkin);
                        $('#student_photo').attr("src",""+data[0].student_photo+"");
                    }else{
                        $('#student_name').text('Unregistered Student');
                        $('#token_number').text(data[0].visitor_token);
                        $('#get_pass_reason').text(data[0].get_pass_reason);
                        $('#checkIn').text(data[0].visitor_checkin);
                    }
               },'JSON');
            });


        $("#newVisitor").validate({
            rules: {
                visitor_student_id:{
                    required:true
                },
                visitor_photo:{
                    required:true
                },
                visitor_id_card_photo:{
                    required:true
                },
                visitor_token:{
                    required:true,
                    min:1
                },
                photo:{
                    required:true
                }
            },
            messages: {
                visitor_student_id:{
                    min:"Please Select Student"
                },
                visitor_token:{
                    min:"Please Select Token.",
                    digits:"Please enter only digits."
                }
            }
        });

        $("#newVisitorCheckOut").validate({
            rules: {
                visitor_id:{
                    required:true,
                    min:1,
                    digits:true
                }
            },
            messages: {
                visitor_id:{
                    required:"Please Select Token.",
                    min:"Please Select Token.",
                    digits:"Please Enter only digits."
                }
            }
        });

        $(document).on('click','.details', function(){
            $('.info').toggle();
        })
});
</script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>