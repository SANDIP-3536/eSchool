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
            <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contactus@syntech.co.in </strong> 
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

    <script>

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

         $('.datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            minDate:today,
            startDate:today
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        <?php if($dayBook == 'dayBook'){ ?>
            $('#fee').addClass('active');
            document.title = "eSchool | Accounting"
        <?php } ?>

         $('.clockpicker').clockpicker(function(){
             twelvehour: true
        });

        $(document).on('change','#vocher_master_id',function(){
            $('#vocher_head_details').empty();
            var master_id = $(this).val();
            $.post('<?=site_url('DayBook/fetch_vocher_head_by_master')?>',{master_id:master_id},function(data){
                console.log(data);
                $('#vocher_head_details').append('<option value="0">Please Select the Vocher Master</option>');
                $.each(data,function(k,v) {
                    $('#vocher_head_details').append('<option value='+v.voc_head_id+'>'+v.voc_head_name+'</option>');
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

            $("#acc_group_val").validate({
                rules: {
                    acc_group_name: {
                        required: true,
                        pattern:/^[a-zA-Z\s]*$/        
                    },
                    acc_grp_open_balance: {
                        required: true,
                        digits:true     
                    }
                },
                messages: {
                    acc_group_name:{
                        required:"Please Enter the Account Group Name.",
                        pattern:"Please Enter only charater."
                    },
                    acc_grp_open_balance:{
                        required:"Please Enter the Account Opening Balance",
                        digits:"Please Enter only digits."
                    }
                }
            }); 

            $("#voc_master_val").validate({
                rules: {
                    voc_master_name: {
                        required: true,
                        pattern:/^[a-zA-Z\s]*$/        
                    },
                    voc_master_type: {
                        required: true,
                        min:1        
                    }                
                },
                messages: {
                    voc_master_name:{
                        required:"Please Enter the Vocher Master Name.",
                        pattern:"Please Enter only charater."
                    },
                    voc_master_type:{
                        required:"Please Select the Vocher Master Type.",
                        min:"Please Select the Vocher Master Type."
                    }
                }
            }); 

            $("#voc_head_val").validate({
                rules: {
                    voc_head_name: {
                        required: true,
                        pattern:/^[a-zA-Z\s]*$/        
                    },
                    voc_head_voc_master_id: {
                        required: true,
                        min:1        
                    },
                    voc_head_acc_grp_id: {
                        required: true,
                        min:1        
                    },
                    voc_head_number: {
                        required: true,
                        digits:true        
                    }               
                },
                messages: {
                    voc_head_name:{
                        required:"Please Enter the Vocher Head Name.",
                        pattern:"Please Enter only charater."
                    },
                    voc_head_voc_master_id:{
                        required:"Please Select the Vocher Master.",
                        min:"Please Select the Vocher Master."
                    },
                    voc_head_acc_grp_id:{
                        required:"Please Select the Account Group.",
                        min:"Please Select the Account Group."
                    },
                    voc_head_number:{
                        required:"Please Enter the Vocher Head Number.",
                        digits:"Please Enter only Digits."
                    }
                }
            }); 

            $("#cre_vocher_val").validate({
                rules: {
                    cre_vocher_date: {
                        required: true       
                    },
                    cre_vocher_master_id: {
                        required: true,
                        min:1        
                    },
                    cre_vocher_head: {
                        required: true,
                        min:1        
                    },
                    cre_vocher_credit_legder_acc: {
                        required: true,
                        min:1        
                    },
                    cre_vocher_debit_legder_acc: {
                        required: true,
                        min:1        
                    }, 
                    cre_vocher_payment_mode: {
                        required: true,
                        min:1        
                    },
                    cre_vocher_amount: {
                        required: true,
                        digits:true        
                    },
                    cre_vocher_narration: {
                        required: true,
                        pattern:/^[a-zA-Z0-9\s]*$/        
                    },               
                },
                messages: {
                    cre_vocher_date:{
                        required:"Please Enter the Vocher Head Name.",
                        pattern:"Please Enter only charater."
                    },
                    cre_vocher_master_id:{
                        required:"Please Select the Vocher Master.",
                        min:"Please Select the Vocher Master."
                    },
                    cre_vocher_head:{
                        required:"Please Select the Cocher Head.",
                        min:"Please Select the Cocher Head."
                    },
                    cre_vocher_credit_legder_acc:{
                        required:"Please Select the Credit Legder Account.",
                        min:"Please Select the Credit Legder Account."
                    },
                    cre_vocher_debit_legder_acc:{
                        required:"Please Select the Debit Legder Account.",
                        min:"Please Select the Debit Legder Account."
                    },
                    cre_vocher_payment_mode:{
                        required:"Please Select the Vocher Payment Mode.",
                        min:"Please Select the Vocher Payment Mode."
                    },
                    cre_vocher_amount:{
                        required:"Please Enter the Vocher Amount.",
                        digits:"Please Enter only Digits."
                    },
                    cre_vocher_narration:{
                        required:"Please Enter the Vocher Narration.",
                        pattern:"Please Enter Vocher Narration."
                    }
                }
            }); 

            $("#addGrade").validate({
                rules: {
                    GC_grade: {
                        required:true        
                    },
                    GC_higher_mark_range: {
                        required: true,
                        digits:true,
                        max:100,
                        min:1,
                        greaterThan:"#lower_mark_range"  
                    },
                    GC_lower_mark_range: {
                        required: true, 
                        digits:true,
                        max:100,
                        min:1,
                    }
                },
                messages: {
                     GC_higher_mark_range: {
                        required: true,
                        digits:true,
                        max:100,
                        min:1,
                        lessThan:"Please enter greater than lower Marks."  
                    },
                }
            });

            $("#addEMark").validate({
                rules: {
                    marks_term_id: {
                        required: true,
                        min:1
                    },
                    marks_exam_id: {
                        required: true,
                        min:1
                    },
                    marks_student_id: {
                        required: true,
                        min:1
                    }, 
                    marks_teacher_id: {
                        required: true,
                        min:1
                    },
                    marks_obtained: {
                        required:true,
                        digits:true        
                    },
                    marks_evaluation: {
                        required: true,
                        digits:true   
                    }
                },
                messages: {
                    marks_term_id:{
                        min:"Please select the term."
                    },
                    marks_exam_id:{
                        min:"Please select the exam."
                    },
                    marks_student_id:{
                        min:"Please select the student."
                    },
                    marks_teacher_id:{
                        min:"Please select teacher."
                    }
                }
            });

            $("#eval_verification").validate({
            	rules: {
            		marks_obtained: {
            			required: true,
                        digits:true      
            		},
                    marks_evaluation: {
                        required: true,
                        digits:true        
                    },
                    marks_status: {
                        min: 1     
                    }
            	},
            	messages: {
                    marks_obtained:{
                        required:"Please Enter Obtained Marks.",
                        digits:"Please Enter only digits."
                    },
                    marks_obtained:{
                        required:"Please Enter Evaluation Marks.",
                        digits:"Please Enter only digits."
                    },
                    marks_status:{
                        min:"Please Select evaluation Status."
                    }
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