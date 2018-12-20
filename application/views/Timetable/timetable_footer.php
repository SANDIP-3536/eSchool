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

        <?php if($education == 'education'){?>
             $('#education').addClass('active');
             document.title = "eSchool | Timetable"
        <?php } ?>

        $(".select2_demo_2").select2();

        $('.clockpicker').clockpicker(function(){
             twelvehour: true
        });

                    // create DateTimePicker from input HTML element
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 0,
            autoclose:true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('.confirm_delete').click(function() {
            if (confirm("Are You Sure? Do You Want To Delete It?"))
                return ture;
            else
                return false;
        });
            
        $(document).on('change','.class_details',function(){
            $('.division_details').empty();
            $('.subject_details').empty();
            $('.teacher_details').empty();
            $('.tt_start_time').empty();
            $('.tt_end_time').empty();
            $('#monday').empty();
            $('#tuesday').empty();
            $('#wednesday').empty();
            $('#thursday').empty();
            $('#friday').empty();
            $('#saturday').empty();
            $('#sunday').empty();
            $('#timetable_view').hide();
            $('#print_btn').hide();
            var class_id = $(this).val();
            $.post('<?=site_url('Timetable/fetch_class_division')?>',{class_id:class_id},function(data){
                // console.log(data);
                $('.division_details').html('<option value="" disabled selected>Select Division</option>');
                $.each(data,function(k,v){
                    $('.division_details').append('<option value="'+v.division_id+'">'+v.division_name+'</option>');
                });
            },'json');

            //  $.post('<?=site_url('Timetable/fetch_class_division_subject')?>',{class_id:class_id},function(data){
            //     // console.log(data);
            //     $('.subject_details').html('<option value="0">Select Subject</option>');
            //     $.each(data, function(k,v){
            //         $('.subject_details').append('<option value="'+v.subject_id+'">'+v.subject_name+' <span>('+v.subject_type+')</span></option>');
            //     });
            // },'json');
        });

         $(document).on('change','.division_details',function(){
           var class_name = $(".class_name").val();
           var division = $(".division").val();
           $('#days_select').show();
           $('#monday').empty();
           $('#tuesday').empty();
           $('#wednesday').empty();
           $('#thursday').empty();
           $('#friday').empty();
           $('#saturday').empty();
           $('#sunday').empty();
           $('.subject_details').empty();
           $('.teacher_details').empty();
           $('.tt_start_time').empty();
           $('.tt_end_time').empty();
           $('.timetable_head').empty();

            $.post('<?=site_url('Timetable/fetch_class_division_subject')?>',{class_id:class_name,division:division},function(data){
                // console.log(data);
                $('.subject_details').html('<option value="" disabled selected>Select Subject</option>');
                $.each(data, function(k,v){
                    $('.subject_details').append('<option value="'+v.subject_id+'">'+v.subject_name+' <span>('+v.eval_name+')</span></option>');
                });
            },'json');

            $.post('<?=site_url('Timetable/show_timetable')?>',{class_name:class_name,division:division},function(data1){
                console.log(data1);
                 $('.timetable_head').append('Class - '+data1.timetable[0].class_name+ ' ( ' +data1.timetable[0].division_name+ ' ) <span style="float: right;">Academic Year - <i>' + data1.timetable[0].AY_name+ '</i></span>');
                     $('#timetable_view').hide();
                     $('#print_btn').hide();
                if (data1.timetable != '') {
                     $('#timetable_view').show();
                     $('#print_btn').show();
                     var monday = 0;
                     var tuesday = 0;
                     var wednesday = 0;
                     var thursday = 0;
                     var friday = 0;
                     var saturday = 0;
                     var sunday = 0;
                   
                    $.each(data1.timetable, function(k,v){
                                console.log(v.tt_day);
                                if (v.tt_day == 1)
                                {
                                    if (monday == 0) 
                                    {
                                        monday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 1)
                                           {
                                                $('#monday_table').show();
                                              $('#monday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 2)
                                {
                                    if (tuesday == 0) 
                                    {
                                        tuesday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 2)
                                           {

                                                $('#tuesday_table').show();
                                                $('#tuesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 3)
                                {
                                    if (wednesday == 0) 
                                    {
                                        wednesday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 3)
                                           {
                                                $('#wednesday_table').show();
                                              $('#wednesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 4)
                                {
                                    if (thursday == 0) 
                                    {
                                        thursday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 4)
                                           {
                                                $('#thursday_table').show();
                                                $('#thursday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 5)
                                {
                                    if (friday == 0) 
                                    {
                                        friday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 5)
                                           {
                                                $('#friday_table').show();
                                                $('#friday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 6)
                                {
                                    if (saturday == 0) 
                                    {
                                        saturday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 6)
                                           {
                                                $('#saturday_table').show();
                                                $('#saturday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 7)
                                {
                                    if (sunday == 0) 
                                    {
                                        sunday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 7)
                                           {
                                                $('#sunday_table').show();
                                                $('#sunday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                
                            });
                };
                $('.confirm_delete').click(function() {
                    if (confirm("Are You Sure? Do You Want To Delete It?"))
                        return ture;
                    else
                        return false;
                });
            },'json');
         });

        $(document).on('change','.subject_details',function(){
            $('.teacher_details').empty();
            var subject_id = $(this).val();
            var class_name = $(".class_name").val();
            var division = $(".division").val();
            $.post('<?=site_url('Timetable/fetch_teacher')?>',{subject_id:subject_id,class_name:class_name,division:division},function(data){
                // console.log(data);
                $('.teacher_details').html('<option value="" disabled selected>Select Teacher</option>');
                $.each(data,function(k,v){
                    $('.teacher_details').append('<option value="'+v.TCDS_employee_profile_id+'">'+v.employee_first_name+' '+v.employee_middle_name+' '+v.employee_last_name+'</option>');
                });
            },'json');
        });
        // $(document).on('click','#print_timetable',function(){
        //     // $('.delete_day_time_table').addClass('hidden');
        // });

        $(document).on('click','.delete_day_time_table',function(){
                var day_time_table_id = this.title;
                // alert(day_time_table_id);
            $.post('<?=site_url('Timetable/delete_day_time_table')?>',{day_time_table_id:day_time_table_id},function(data){
            },'json');

            var class_name = $(".class_name").val();
           var division = $(".division").val();
           $('#days_select').show();
           $('#monday').empty();
           $('#tuesday').empty();
           $('#wednesday').empty();
           $('#thursday').empty();
           $('#friday').empty();
           $('#saturday').empty();
           $('#sunday').empty();
           $('.subject_details').empty();
           $('.teacher_details').empty();
           $('.tt_start_time').empty();
           $('.tt_end_time').empty();
           $('.timetable_head').empty();

            $.post('<?=site_url('Timetable/fetch_class_division_subject')?>',{class_id:class_name,division:division},function(data){
                // console.log(data);
                $('.subject_details').html('<option value="" disabled selected>Select Subject</option>');
                $.each(data, function(k,v){
                    $('.subject_details').append('<option value="'+v.subject_id+'">'+v.subject_name+' <span>('+v.eval_name+')</span></option>');
                });
            },'json');

            $.post('<?=site_url('Timetable/show_timetable')?>',{class_name:class_name,division:division},function(data1){
                console.log(data1);
                 $('.timetable_head').append('Class - '+data1.timetable[0].class_name+ ' ( ' +data1.timetable[0].division_name+ ' ) <span style="float: right;">Academic Year - <i>' + data1.timetable[0].AY_name+ '</i></span>');
                     $('#timetable_view').hide();
                     $('#print_btn').hide();
                if (data1.timetable != '') {
                     $('#timetable_view').show();
                     $('#print_btn').show();
                     var monday = 0;
                     var tuesday = 0;
                     var wednesday = 0;
                     var thursday = 0;
                     var friday = 0;
                     var saturday = 0;
                     var sunday = 0;
                   
                    $.each(data1.timetable, function(k,v){
                                console.log(v.tt_day);
                                if (v.tt_day == 1)
                                {
                                    if (monday == 0) 
                                    {
                                        monday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 1)
                                           {
                                                $('#monday_table').show();
                                              $('#monday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 2)
                                {
                                    if (tuesday == 0) 
                                    {
                                        tuesday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 2)
                                           {

                                                $('#tuesday_table').show();
                                                $('#tuesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 3)
                                {
                                    if (wednesday == 0) 
                                    {
                                        wednesday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 3)
                                           {
                                                $('#wednesday_table').show();
                                              $('#wednesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 4)
                                {
                                    if (thursday == 0) 
                                    {
                                        thursday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 4)
                                           {
                                                $('#thursday_table').show();
                                                $('#thursday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 5)
                                {
                                    if (friday == 0) 
                                    {
                                        friday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 5)
                                           {
                                                $('#friday_table').show();
                                                $('#friday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 6)
                                {
                                    if (saturday == 0) 
                                    {
                                        saturday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 6)
                                           {
                                                $('#saturday_table').show();
                                                $('#saturday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                 if (v.tt_day == 7)
                                {
                                    if (sunday == 0) 
                                    {
                                        sunday = 1;
                                        $.each(data1.timetable, function(m,n)
                                        {
                                           if (n.tt_day == 7)
                                           {
                                                $('#sunday_table').show();
                                                $('#sunday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                           }; 
                                        });
                                    };
                                };
                                
                            });
                };
                $('.confirm_delete').click(function() {
                    if (confirm("Are You Sure? Do You Want To Delete It?"))
                        return ture;
                    else
                        return false;
                });
            },'json');
        });

       
        var days_arr = [];
        $(document).on('click','.days',function(){
            var days = $(this).val();
            
            if(this.checked){
                if(jQuery.inArray(days, days_arr) == -1)
                {
                    days_arr.push(days);
                    // alert(days);
                    $('#days').append('<th class="'+days+'">'+days+'</th>');
                    $('#timetable_row').append('<td class="'+days+'"><button type="button" data-toggle="modal" data-target="#add_time_table" class="btn btn-xs btn-white assign" title="'+days+'">Assign</button></td>');
                }
            }
            else{
                $('.'+days+'').remove();
                days_arr = jQuery.grep(days_arr, function(value) {
                  return value != days;
                });
            }
        });

        $(document).on('click','.add_lecture',function(){
             var class_name = $(".class_name").val();
             var division = $(".division").val();
             var days = $(".day_name").text();
             var subject_name = $(".subject_name").val();
             var teacher_name = $(".teacher_name").val();
             var tt_start_time = $(".tt_start_time").val();
             var tt_end_time = $(".tt_end_time").val();
             var monday = 0;
             var tuesday = 0;
             var wednesday = 0;
             var thursday = 0;
             var friday = 0;
             var saturday = 0;
             var sunday = 0;

                $.post('<?=site_url('Timetable/add_timetable')?>',{class_name:class_name,division:division,days:days,subject_name:subject_name,teacher_name:teacher_name,tt_start_time:tt_start_time,tt_end_time:tt_end_time},function(data){
                    console.log(data);
                    if (data == 1) 
                    {
                        $('.close').click();
                    }; 
                    if (data == 0) 
                    {
                        $('.warning').empty();
                        $('.warning').append("Already assigned to anather lecture on this time.");
                    };
                    
                    $('#timetable_view').show();
                    $('#print_btn').show();

                },'json');
                $.post('<?=site_url('Timetable/show_timetable')?>',{class_name:class_name,division:division},function(data1){
                    // console.log(data1.timetable);
                       $('#monday').empty();
                       $('#tuesday').empty();
                       $('#wednesday').empty();
                       $('#thursday').empty();
                       $('#friday').empty();
                       $('#saturday').empty();
                       $('#sunday').empty();

                    $.each(data1.timetable, function(k,v){
                        // console.log(v.tt_day);
                        if (v.tt_day == 1)
                        {
                            if (monday == 0) 
                            {
                                monday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 1)
                                   {
                                        $('#monday_table').show();
                                        $('#monday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 2)
                        {
                            if (tuesday == 0) 
                            {
                                tuesday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 2)
                                   {

                                        $('#tuesday_table').show();
                                        $('#tuesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 3)
                        {
                            if (wednesday == 0) 
                            {
                                wednesday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 3)
                                   {
                                        $('#wednesday_table').show();
                                        $('#wednesday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 4)
                        {
                            if (thursday == 0) 
                            {
                                thursday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 4)
                                   {
                                        $('#thursday_table').show();
                                        $('#thursday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 5)
                        {
                            if (friday == 0) 
                            {
                                friday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 5)
                                   {
                                        $('#friday_table').show();
                                        $('#friday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 6)
                        {
                            if (saturday == 0) 
                            {
                                saturday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 6)
                                   {
                                        $('#saturday_table').show();
                                        $('#saturday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                         if (v.tt_day == 7)
                        {
                            if (sunday == 0) 
                            {
                                sunday = 1;
                                $.each(data1.timetable, function(m,n)
                                {
                                   if (n.tt_day == 7)
                                   {
                                        $('#sunday_table').show();
                                        $('#sunday').append('<tr><td>'+n.tt_start_time+'-'+n.tt_end_time+'<br><b> '+ n.subject_name+'('+n.eval_name+') </b><br>'+ n.employee_first_name +' '+ n.employee_last_name+' <span class="btn btn-danger btn-xs confirm_delete delete_day_time_table" title="'+n.tt_id+'" style="margin-top: -20px;padding: 1px;float:  right;"><i class="fa fa-trash-o delete" title="Delete"></i></span></td></tr>');
                                   }; 
                                });
                            };
                        };
                        
                    });
                $('.confirm_delete').click(function() {
                    if (confirm("Are You Sure? Do You Want To Delete It?"))
                        return ture;
                    else
                        return false;
                });
                },'json');
                

        });

        $(document).on('click','.assign',function(){
                $('.day_name').empty();
                $('.warning').empty();
                var day_name = this.title;
                $('.day_name').append(day_name);
                $('.tt_start_time').val("00:00");
                $('.tt_end_time').val("00:00");
                $('.subject_name option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('.teacher_details').empty();
        });
        $(document).on('click','.add_lecture1',function(){
            var subject_details = $('.subject_details').val();
            var teacher_details = $('.teacher_details').val();
            var tt_start_time = $('.tt_start_time').val();
            var tt_end_time = $('.tt_end_time').val();
            console.log(subject_details);
            console.log(teacher_details);
            console.log(tt_start_time);
            console.log(tt_end_time);
            if (subject_details != null) 
            {
                if (teacher_details != null) 
                {
                    if (tt_start_time != "00:00") 
                    {
                        if (tt_end_time != "00:00") 
                        {
                            if (tt_start_time < tt_end_time) 
                            {
                                $('.add_lecture').click();
                            };
                            if (tt_start_time > tt_end_time) 
                            {
                                $('.warning').empty();
                                $('.warning').append("Please check lecture timing.");
                            };
                        };
                    };
                };
            };
        });

         $(document).on('click','.add_one',function(){
               
                $('.add_one_plus').append('<div class="form-group">'+
                                               ' <label class="col-lg-2 control-label">Subject</label>'+
                                               ' <div class="col-sm-4">'+
                                               '     <select class="form-control subject_details" name="subject_name[]">'+
                                               '     </select>'+
                                               ' </div>'+
                                               ' <label class="col-lg-2 control-label">Teacher</label>'+
                                               ' <div class="col-sm-4">'+
                                               '     <select class="form-control teacher_details" name="teacher_name[]">'+
                                               '     </select>'+
                                               ' </div>'+
                                            '</div>'+
                                         '    <div class="form-group">'+
                                          '      <label class="col-lg-2 control-label">Start Time</label>'+
                                           '     <div class="col-sm-4">'+
                                            '        <div class="input-group clockpicker" data-autoclose="true">'+
                                             '           <span class="input-group-addon">'+
                                              '              <span class="fa fa-clock-o"></span>'+
                                               '         </span>'+
                                                '        <input type="text" class="form-control" name="tt_start_time[]" readonly>'+
                                                 '   </div>'+
                                               ' </div>'+
                                               ' <label class="col-lg-2 control-label">End Time</label>'+
                                                '<div class="col-sm-4">'+
                                                 '   <div class="input-group clockpicker" data-autoclose="true">'+
                                                  '      <span class="input-group-addon">'+
                                                   '         <span class="fa fa-clock-o"></span>'+
                                                    '    </span>'+
                                                     '   <input type="text" class="form-control" name="tt_end_time[]" readonly>'+
                                                   ' </div>'+
                                              '  </div>'+
                                            '</div> <div class="hr-line-dashed"></div>');
           });


        $(document).ready(function(){

            // $('.notification_hide').hide();
            $(document).on('click','#toggle_route',function(){
                $('.notification_hide').toggle();
            });

            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?>  
            $("#addNotification").validate({
                rules: {
                    notifi_datetime: {
                        required: true        
                    },
                    class_name: {
                        required: true        
                    },
                    notifi_title: {
                        required: true        
                    },
                    notifi_msg: {
                        required: true        
                    },
                    division: {
                        required: true        
                    }
                },
                messages: {
                    class_name:{
                        required:"Please Enter the School Class Name."
                    }
                }
            });

            // $("#add_lecture").validate({
            //     rules: {
            //         subject_name: {
            //             required: true,
            //             digits: true        
            //         },
            //         teacher_name: {
            //             required: true        
            //         },
            //         tt_start_time: {
            //             required: true        
            //         },
            //         tt_end_time: {
            //             required: true,
            //             // min: "#tt_start_time"        
            //         }
            //     },
            //     messages: {

            //     }
            // });

            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [    ]

            });
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>0