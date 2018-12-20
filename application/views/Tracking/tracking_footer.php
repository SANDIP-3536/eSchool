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
    <script src="<?=base_url()?>assets/js/plugins/fullcalendar/moment.min.js"></script>
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
    
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js" integrity="sha384-CchuzHs077vGtfhGYl9Qtc7Vx64rXBXdIAZIPbItbNyWIRTdG0oYAqki3Ry13Yzu" crossorigin="anonymous"></script>
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

        <?php if($tracking == 'tracking'){?>
             $('#tracking').addClass('active');
             document.title = "eSchool | Tracking"
        <?php } ?>

         var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 0,
            autoclose:true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $(document).ready(function(){
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?> 

        
            $(document).on('change','.student_class',function(){
                $(".loader").fadeIn("fast");
                // $('.student_division').empty();
                $('.stu_list').show();
                $('#btn').show();
                // $('#student_list').empty();
                if ( $.fn.DataTable.isDataTable('.dataTables-example') ) {
                  $('.dataTables-example').DataTable().destroy();
                }
                $('.dataTables-example tbody').empty();
                $(".dataTables_empty").css("display","none");
                var class_id = $(this).val();
                // $.post('<?=site_url('Tracking/fetch_class_division')?>',{class_id:class_id},function(data){
                //     $('.student_division').append("<option value='' selected disabled>Select Division</option>");
                //     $.each(data,function(k,v){
                //         $('.student_division').append("<option value="+v.division_id+">"+v.division_name+"</option>")
                //     });
                // },'json');

                $.post('<?=site_url('Tracking/fetch_class_division_student')?>',{class_id:class_id},function(data){
                    console.log(data);
                    $.each(data,function(k,v){
                        $('.dataTables-example tbody').append('<tr>'+
                                            '<td>'+v.student_GRN+'</td>'+
                                            '<td>'+v.division_name+'</td>'+
                                            '<td>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</td> '+
                                            '<td>'+
                                                (v.father != null ? (v.father_user != 0 ? '<input type="checkbox" name="" value="" checked disabled>' : '<input type="checkbox" name="parent_profile_id[]" value="'+v.father+'" >') : '')+
                                            '</td>'+
                                            '<td>'+
                                                (v.mother != null ? (v.mother_user != 0 ? '<input type="checkbox" name="" value="" checked disabled>' : '<input type="checkbox" name="parent_profile_id[]" value="'+v.mother+'" >') : '')+
                                            '</td>'+
                                            '<td>'+
                                                (v.gardian != null ? (v.gardian_user != 0 ? '<input type="checkbox" name="" value="" checked disabled>' : '<input type="checkbox" name="parent_profile_id[]" value="'+v.gardian+'" >') : '')+
                                            '</td>'+
                                          '</tr>');
                    });
                },'json');
                $(".loader").fadeOut("slow");
                
                setTimeout(function () {
                        $('.dataTables-example').DataTable({
                            pageLength: 10,
                            responsive: true,
                            dom: '<"html5buttons"B>lTfgitp',
                            buttons: [  ]
                        });
                }, 5000);
              
            });

            // $(document).on('change','.student_division',function(){
            //     $(".loader").fadeIn("fast");
            //     $('.stu_list').show();
            //     // $('#student_list').empty();
            //     if ( $.fn.DataTable.isDataTable('.dataTables-example') ) {
            //       $('.dataTables-example').DataTable().destroy();
            //     }
            //     $('.dataTables-example tbody').empty();
            //     // $(".dataTables_empty").css("display","none");
            //     var division_id = $(this).val();
            //     var class_id = $('.student_class').val();
            //     $.post('<?=site_url('Tracking/fetch_division_class_student')?>',{class_id:class_id,division_id:division_id},function(data){
            //         $.each(data,function(k,v){
            //             $('.dataTables-example tbody').append('<tr>'+
            //                                 '<td>'+v.student_profile_id+'</td>'+
            //                                 '<td>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</td> '+
            //                                 '<td>'+
            //                                     '<div class="checkbox checkbox-primary">'+
            //                                         '<input type="checkbox" name="student_profile_id[]" value="'+v.student_profile_id+'" >'+
            //                                         '<label for="checkbox2"></label>'+
            //                                     '</div>'+
            //                                 '</td>'+
            //                               '</tr>');
            //         });
            //     },'json');
            //     $(".loader").fadeOut("slow");
            //     setTimeout(function () {
            //             $('.dataTables-example').DataTable({
            //                 pageLength: 10,
            //                 responsive: true,
            //                 dom: '<"html5buttons"B>lTfgitp',
            //                 buttons: [  ]
            //             });
            //     }, 5000);
            // });

            

            $(".select2_demo").select2({
                placeholder: "Select a Student Name",
                allowClear: true,
            }); 

        
            // $('.dataTables-example').DataTable({
            //     pageLength: 10,
            //     responsive: true,
            //     dom: '<"html5buttons"B>lTfgitp',
            //     buttons: [  ]

            // });

        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>