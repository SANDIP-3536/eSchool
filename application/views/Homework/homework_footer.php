<div class="footer">
    <div class="row">
        <div class="col-sm-4">
            <div class="pull-left">
                <strong>Copyright </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech_logo.png" style="height:13px;"></a><strong> &copy; 2017-2018 </strong>  
            </div>
        </div>
        <?php if(!empty($school_logo)){  ?>
        <div class="col-sm-4">
            <center>
                <div>
                   <img src="<?php if(!empty($school_logo)){echo $school_logo;} ?>" style="height:20px;width:20px;"> <strong style="color:#ffffff;"><?php if(!empty($school_name)){echo $school_name;} ?> </strong> 
                </div>
            </center>
        </div>
        <?php } ?>
        <div class="pull-right">
            <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contact@syntech.co.in </strong> 
        </div>
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
<script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.class_details_hide').hide();
        $(document).on('click','#toggle_route',function(){
            $('.class_details_hide').toggle();
        });

        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 0,
            autoclose:true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        <?php if($homework == 'homework'){?>
             $('#homework').addClass('active');
             document.title = "eSchool | Homework"
        <?php } ?>

        $(document).on('change','#class_homework_details',function(){
            $('.student_details_accor').empty();
            var data = $(this).val();
            var res = data.split('-');
            var class_id = res[0];
            var division_id = res[1];
            $.post('<?=site_url('Homework/fetch_student_acc_class_division')?>',{class_id:class_id,division_id:division_id},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('.student_details_accor').append('<tr><td>'+v.SCD_Roll_No+'</td><td>'+v.student_last_name+' '+v.student_first_name+'</td><td>'+v.class_name+'</td><td>'+v.division_name+'</td><td><input type="checkbox" class="checking" name="hw_student_profile_id[]" value="'+v.student_profile_id+'"></td></tr>');
                });
            },'json');
        });

        $(document).ready(function(){

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?>

            $(".CheckAll").change(function(){  //"select all" change 
                $(".checking").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
            });

            $('.checking').change(function(){ 
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if(false == $(this).prop("checked")){ //if this item is unchecked
                    $(".CheckAll").prop('checked', false); //change "select all" checked status to false
                }
                //check "select all" if all checkbox items are checked
                if ($('.checking:checked').length == $('.checking').length ){
                    $(".CheckAll").prop('checked', true);
                }
            }); 

            $("#addSubject").validate({
            	rules: {
            		hw_datetime: {
            			required: true        
            		},
                    hw_TCDS_id: {
                        required: true        
                    },
                    hw_msg: {
                        required: true     
                    }
            	},
            	messages: {
            	}
            });

            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [    ],
                "language": {
                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                }

            });
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>