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
     <script src="<?=base_url()?>assets/js/plugins/chosen/chosen.jquery.js"></script>
    
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    
    <script>
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        // Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
        var activeTab = localStorage.getItem('activeTab');

        // En la consola te va a mostrar la pestaña donde hiciste el último click y lo
        // guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
        // el browser, va a quedar activa la última donde hiciste el click.
        console.log(activeTab);

        if (activeTab) {
           $('a[href="' + activeTab + '"]').tab('show');
        }



        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        $.validator.addMethod("greaterThan", function (value, element, param) {
              var $otherElement = $(param);
              return parseInt(value, 10) > parseInt($otherElement.val(), 10);
        });
        $.validator.addMethod("lessThan", function (value, element, param) {
              var $otherElement = $(param);
              return parseInt($otherElement.val(), 10) > parseInt(value, 10);
        });

        $('.new_term').hide();
        $('.new_exam').hide();
        $('.new_exam_marks').hide();
        $('.new_grade').hide();
        $(document).on('click','#new_term',function(){
            $('.new_term').show();
            $('#new_term').hide();
        });
        $(document).on('click','#new_exam',function(){
            $('.new_exam').show();
            $('#new_exam').hide();
        });
        $(document).on('click','#new_exam_marks',function(){
            $('.new_exam_marks').show();
            $('#new_exam_marks').hide();
        });
        $(document).on('click','#new_grade',function(){
            $('.new_grade').show();
            $('#new_grade').hide();
        });
        $(document).on('click','.close_data',function(){
            $('.new_term').hide();
            $('.new_exam').hide();
            $('.new_exam_marks').hide();
            $('.new_grade').hide();
            $('#new_term').show();
            $('#new_exam').show();
            $('#new_exam_marks').show();
            $('#new_grade').show();
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
            //minDate:today,
            //startDate:today
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        <?php if($exam == 'exam'){ ?>
            $('#exam').addClass('active');
            document.title = "eSchool | Exam Details"
        <?php }elseif ($exam == 'term') { ?>
            $('#config').addClass('active');
            document.title = "eSchool | Term Details"
        <?php }elseif ($exam == 'grade') { ?>
            $('#config').addClass('active');
            document.title = "eSchool | Grade Details"
        <?php } ?>

         $('.clockpicker').clockpicker(function(){
             twelvehour: true
        });

        $(document).on('change','.class_details',function(){
            // $('.class_subject').empty();
            $('.eval_details').empty();
            var class_id = $(this).val();
            // console.log(class_id);
            $.post('<?=site_url('Exam/subject_details_class')?>',{class_id:class_id}, function(data){
                // console.log(data.eval);
                $('.eval_details').append('<option selected disabled>Select Eval Type</option>');
                $.each(data.eval, function(k,v){
                    $('.eval_details').append('<option value = "'+v.eval_id+'">'+v.eval_name+' </option>');
                });
                // $('.class_subject').append('<option selected disabled>Select Subject</option>');
                // $.each(data, function(k,v){
                //     $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                // });
            },'json');
        });

        
        $(document).on('change','.eval_details',function(){
            var eval_id = $(this).val();
            if (eval_id != 0 )
            {

                    var term_id = $('.exam_term_id').val();
                    var class_id = $('.class_details').val();

                    $.post('<?=site_url('Exam/eval_details')?>',{term_id:term_id,class_id:class_id,eval_id:eval_id},function(data){
                            console.log(data.exam);
                            console.log(data.subject);
                            var i = 1;
                            $('.dataTables-example1').DataTable().destroy();
                            $('.exam_details_body').empty();
                            $('.class_subject').empty();
                             $('.class_subject').append('<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(k,v){
                                $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                            });

                            $.each(data.exam,function(k,v){
                                var string_append = '<tr>'+                
                                                        '<td>'+i+'</td>'+
                                                        '<td>'+v.term_name+'</td>'+
                                                        '<td>'+v.class_name+'</td>'+
                                                        '<td>'+v.eval_name+'</td>'+
                                                        '<td>'+v.subject_name+'</td>'+
                                                        '<td>'+v.exam_start_date+'</td>'+
                                                        '<td>'+v.exam_end_date+'</td>'+
                                                        '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                        '<td>'+v.exam_outoff_marks+'</td>'+
                                                        '<td>'+v.exam_marksheet_marks+'</td>'+
                                                        '<td>'+v.exam_evaluation_marks+'</td>'+
                                                        '<td>'+v.exam_result_date+'</td>';
                                if (data.user_type == 3)
                                {
                                    var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                                }else{

                                    var string_append2 = string_append+'</tr>';
                                }
                                // console.log(string_append2);

                                $('.exam_details_body').append(string_append2);
                                i++;
                            });

                            var example1 = $('.dataTables-example1').DataTable({
                                pageLength: 10,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [    ],
                                "language": {
                                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                                }

                            });

                            $('.dataTables-example1 tfoot th').each( function () {
                                    var title = $(this).text();
                                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                            } );
                            var example1 = $('.dataTables-example1').DataTable();
                         
                            // Apply the search
                            example1.columns().every( function () {
                                var that = this;
                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

                            $('.add_exam_details').removeClass('hidden');

                    },'json');
                
            }else{
                
                    var term_id = $('.exam_term_id').val();
                    var class_id = $('.class_details').val();

                    $.post('<?=site_url('Exam/eval_details_class')?>',{term_id:term_id,class_id:class_id},function(data){
                            console.log(data.exam);
                            console.log(data.subject);
                            var i = 1;
                            $('.dataTables-example1').DataTable().destroy();
                            $('.exam_details_body').empty();
                            $('.class_subject').empty();
                             $('.class_subject').append('<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(k,v){
                                $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                            });

                            $.each(data.exam,function(k,v){
                                var string_append = '<tr>'+                
                                                        '<td>'+i+'</td>'+
                                                        '<td>'+v.term_name+'</td>'+
                                                        '<td>'+v.class_name+'</td>'+
                                                        '<td>'+v.eval_name+'</td>'+
                                                        '<td>'+v.subject_name+'</td>'+
                                                        '<td>'+v.exam_start_date+'</td>'+
                                                        '<td>'+v.exam_end_date+'</td>'+
                                                        '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                        '<td>'+v.exam_outoff_marks+'</td>'+
                                                        '<td>'+v.exam_marksheet_marks+'</td>'+
                                                        '<td>'+v.exam_evaluation_marks+'</td>'+
                                                        '<td>'+v.exam_result_date+'</td>';
                                if (data.user_type == 3)
                                {
                                    var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                                }else{

                                    var string_append2 = string_append+'</tr>';
                                }
                                // console.log(string_append2);

                                $('.exam_details_body').append(string_append2);
                                i++;
                            });

                            var example1 = $('.dataTables-example1').DataTable({
                                pageLength: 10,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [    ],
                                "language": {
                                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                                }

                            });

                            $('.dataTables-example1 tfoot th').each( function () {
                                    var title = $(this).text();
                                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                            } );
                            var example1 = $('.dataTables-example1').DataTable();
                         
                            // Apply the search
                            example1.columns().every( function () {
                                var that = this;
                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

                            $('.add_exam_details').removeClass('hidden');

                    },'json');

            }
            
        });

        $(document).on('change','.class_details,.exam_term_id',function(){
            var term_id = $('.exam_term_id').val();
            var class_id = $('.class_details').val();
            
            if (term_id != 0 && class_id == 0)
            {
                    $('.eval_details').val("0");             
                    $.post('<?=site_url('Exam/eval_details_term')?>',{term_id:term_id},function(data){
                            console.log(data.exam);
                            console.log(data.subject);
                            var i = 1;
                            $('.dataTables-example1').DataTable().destroy();
                            $('.exam_details_body').empty();
                            $('.class_subject').empty();
                             $('.class_subject').append('<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(k,v){
                                $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                            });

                            $.each(data.exam,function(k,v){
                                var string_append = '<tr>'+                
                                                        '<td>'+i+'</td>'+
                                                        '<td>'+v.term_name+'</td>'+
                                                        '<td>'+v.class_name+'</td>'+
                                                        '<td>'+v.eval_name+'</td>'+
                                                        '<td>'+v.subject_name+'</td>'+
                                                        '<td>'+v.exam_start_date+'</td>'+
                                                        '<td>'+v.exam_end_date+'</td>'+
                                                        '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                        '<td>'+v.exam_outoff_marks+'</td>'+
                                                        '<td>'+v.exam_marksheet_marks+'</td>'+
                                                        '<td>'+v.exam_evaluation_marks+'</td>'+
                                                        '<td>'+v.exam_result_date+'</td>';
                                if (data.user_type == 3)
                                {
                                    var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                                }else{

                                    var string_append2 = string_append+'</tr>';
                                }
                                // console.log(string_append2);

                                $('.exam_details_body').append(string_append2);
                                i++;
                            });

                            var example1 = $('.dataTables-example1').DataTable({
                                pageLength: 10,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [    ],
                                "language": {
                                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                                }

                            });

                            $('.dataTables-example1 tfoot th').each( function () {
                                    var title = $(this).text();
                                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                            } );
                            var example1 = $('.dataTables-example1').DataTable();
                         
                            // Apply the search
                            example1.columns().every( function () {
                                var that = this;
                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

                            $('.add_exam_details').removeClass('hidden');

                    },'json');
            }else if (term_id != 0 && class_id != 0)
            {
                    $('.eval_details').val("0"); 
                    $.post('<?=site_url('Exam/eval_details_class')?>',{term_id:term_id,class_id:class_id},function(data){
                            console.log(data.exam);
                            console.log(data.subject);
                            var i = 1;
                            $('.dataTables-example1').DataTable().destroy();
                            $('.exam_details_body').empty();
                            $('.class_subject').empty();
                             $('.class_subject').append('<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(k,v){
                                $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                            });

                            $.each(data.exam,function(k,v){
                                var string_append = '<tr>'+                
                                                        '<td>'+i+'</td>'+
                                                        '<td>'+v.term_name+'</td>'+
                                                        '<td>'+v.class_name+'</td>'+
                                                        '<td>'+v.eval_name+'</td>'+
                                                        '<td>'+v.subject_name+'</td>'+
                                                        '<td>'+v.exam_start_date+'</td>'+
                                                        '<td>'+v.exam_end_date+'</td>'+
                                                        '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                        '<td>'+v.exam_outoff_marks+'</td>'+
                                                        '<td>'+v.exam_marksheet_marks+'</td>'+
                                                        '<td>'+v.exam_evaluation_marks+'</td>'+
                                                        '<td>'+v.exam_result_date+'</td>';
                                if (data.user_type == 3)
                                {
                                    var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                                }else{

                                    var string_append2 = string_append+'</tr>';
                                }
                                // console.log(string_append2);

                                $('.exam_details_body').append(string_append2);
                                i++;
                            });

                            var example1 = $('.dataTables-example1').DataTable({
                                pageLength: 10,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [    ],
                                "language": {
                                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                                }

                            });

                            $('.dataTables-example1 tfoot th').each( function () {
                                    var title = $(this).text();
                                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                            } );
                            var example1 = $('.dataTables-example1').DataTable();
                         
                            // Apply the search
                            example1.columns().every( function () {
                                var that = this;
                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

                            $('.add_exam_details').removeClass('hidden');

                    },'json');

            }else if (term_id == 0)
            {
                    $('.eval_details').val("0"); 
                    $('.class_details').val("0"); 
                    $.post('<?=site_url('Exam/eval_details_default')?>',{},function(data){
                            console.log(data.exam);
                            console.log(data.subject);
                            var i = 1;
                            $('.dataTables-example1').DataTable().destroy();
                            $('.exam_details_body').empty();
                            $('.class_subject').empty();
                             $('.class_subject').append('<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(k,v){
                                $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                            });

                            $.each(data.exam,function(k,v){
                                var string_append = '<tr>'+                
                                                        '<td>'+i+'</td>'+
                                                        '<td>'+v.term_name+'</td>'+
                                                        '<td>'+v.class_name+'</td>'+
                                                        '<td>'+v.eval_name+'</td>'+
                                                        '<td>'+v.subject_name+'</td>'+
                                                        '<td>'+v.exam_start_date+'</td>'+
                                                        '<td>'+v.exam_end_date+'</td>'+
                                                        '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                        '<td>'+v.exam_outoff_marks+'</td>'+
                                                        '<td>'+v.exam_marksheet_marks+'</td>'+
                                                        '<td>'+v.exam_evaluation_marks+'</td>'+
                                                        '<td>'+v.exam_result_date+'</td>';
                                if (data.user_type == 3)
                                {
                                    var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                                }else{

                                    var string_append2 = string_append+'</tr>';
                                }
                                // console.log(string_append2);

                                $('.exam_details_body').append(string_append2);
                                i++;
                            });

                            var example1 = $('.dataTables-example1').DataTable({
                                pageLength: 10,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [    ],
                                "language": {
                                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                                }

                            });

                            $('.dataTables-example1 tfoot th').each( function () {
                                    var title = $(this).text();
                                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                            } );
                            var example1 = $('.dataTables-example1').DataTable();
                         
                            // Apply the search
                            example1.columns().every( function () {
                                var that = this;
                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );

                            $('.add_exam_details').removeClass('hidden');

                    },'json');
            };

         });

        $(document).on('click','.add_exam_details',function(){
            $('.add_details').removeClass('hidden');
            $('.add_exam').removeClass('hidden');
            $('.add_exam_details').addClass('hidden');
        });

        $(document).on('click','.add_exam',function(){
            var exam_term_id = $('.exam_term_id') .val();
            var class_details = $('.class_details') .val();
            var eval_details = $('.eval_details') .val();
            var class_subject = $('.class_subject') .val();
            var exam_result_date = $('.exam_result_date') .val();
            var exam_start_date = $('.exam_start_date') .val();
            var exam_end_date = $('.exam_end_date') .val();
            var exam_start_time = $('.exam_start_time') .val();
            var exam_end_time = $('.exam_end_time') .val();
            var exam_outoff_marks = $('.exam_outoff_marks') .val();
            var exam_evaluation_marks = $('.exam_evaluation_marks') .val();
            var exam_marksheet_marks = $('.exam_marksheet_marks') .val();

            $.post('<?=site_url('Exam/exam_registration')?>',{exam_marksheet_marks:exam_marksheet_marks,exam_term_id:exam_term_id,class_details:class_details,eval_details:eval_details,class_subject:class_subject,exam_result_date:exam_result_date,exam_start_date:exam_start_date,exam_end_date:exam_end_date,exam_start_time:exam_start_time,exam_end_time:exam_end_time,exam_outoff_marks:exam_outoff_marks,exam_evaluation_marks:exam_evaluation_marks},function(data){
                console.log(data);
            },'json');

             var term_id = $('.exam_term_id').val();
            var class_id = $('.class_details').val();
            var eval_id = $('.eval_details').val();

            $.post('<?=site_url('Exam/eval_details')?>',{term_id:term_id,class_id:class_id,eval_id:eval_id},function(data){
                console.log(data);
                    console.log(data.exam);
                    console.log(data.subject);
                    var i = 1;
                    $('.dataTables-example1').DataTable().destroy();
                    $('.exam_details_body').empty();
                    $('.class_subject').empty();
                     $('.class_subject').append('<option selected disabled>Select Subject</option>');
                    $.each(data.subject, function(k,v){
                        $('.class_subject').append('<option value = "'+v.subject_id+'">'+v.subject_name+' </option>');
                    });

                    $.each(data.exam,function(k,v){
                        var string_append = '<tr>'+                
                                                '<td>'+i+'</td>'+
                                                '<td>'+v.term_name+'</td>'+
                                                '<td>'+v.class_name+'</td>'+
                                                '<td>'+v.eval_name+'</td>'+
                                                '<td>'+v.subject_name+'</td>'+
                                                '<td>'+v.exam_start_date+'</td>'+
                                                '<td>'+v.exam_end_date+'</td>'+
                                                '<td>'+v.exam_start_time+' to '+v.exam_end_time+'</td>'+
                                                '<td>'+v.exam_outoff_marks+'</td>'+
                                                '<td>'+v.exam_marksheet_marks+'</td>'+
                                                '<td>'+v.exam_evaluation_marks+'</td>'+
                                                '<td>'+v.exam_result_date+'</td>';
                        if (data.user_type == 3)
                        {
                            var string_append2 = string_append+'<td><a href="<?=site_url("Exam/delete_exam/'+v.exam_id+'")?>""><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></td></tr>';

                        }else{

                            var string_append2 = string_append+'</tr>';
                        }
                        // console.log(string_append2);

                        $('.exam_details_body').append(string_append2);
                        i++;
                    });

                    var example1 = $('.dataTables-example1').DataTable({
                        pageLength: 10,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [    ],
                        "language": {
                            "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                        }

                    });

                    $('.dataTables-example1 tfoot th').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
                    } );
                    var example1 = $('.dataTables-example1').DataTable();
                 
                    // Apply the search
                    example1.columns().every( function () {
                        var that = this;
                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );

                    // $('.add_exam_details').removeClass('hidden');
                    // $('.exam_term_id') .empty();
                    // $('.class_details') .empty();
                    // $('.eval_details') .empty();
                    $('.class_subject') .empty();
                    $('.exam_result_date') .empty();
                    $('.exam_start_date') .empty();
                    $('.exam_end_date') .empty();
                    $('.exam_start_time') .empty();
                    $('.exam_end_time') .empty();
                    $('.exam_outoff_marks') .empty();
                    $('.exam_evaluation_marks') .empty();
                    $('.exam_marksheet_marks') .empty();

                    $('.add_details').addClass('hidden');
                    $('.add_exam').addClass('hidden');
                    $('.add_exam_details').removeClass('hidden');

            },'json');

        });

        $(document).on('change','.class_marks_details',function(){
            $('.subject_marks_details').empty().removeClass('chosen-select2');

            $('.student_marks_details').empty();
            var class_id = $(this).val();
            $.post('<?=site_url('Exam/subject_details_class_division')?>',{class_id:class_id}, function(data){
                console.log(data);
                $('.subject_marks_details').append('<option selected disabled>Select Subject</option>');
                $.each(data, function(k,v){
                    $('.subject_marks_details').append('<option value = "'+v.exam_id+'">'+v.subject_name+' <span>('+v.eval_name+')</span></option>');
                });

                $('.subject_marks_details').addClass('chosen-select2');
                $('.chosen-select2').chosen({width: "100%"});

            },'json');
        });

        $(document).on('change','.subject_marks_details',function(){
            $('.teacher_marks_details').empty();
            $('.student_marks_details').empty();

            var exam_id = $(this).val();
            // console.log("hii");
            var class_id = $('.class_marks_details').val();
            $.post('<?=site_url('Exam/teacher_details_class_division')?>',{exam_id:exam_id}, function(data){
                console.log(data);
                $('.teacher_marks_details').append('<option selected disabled>Select Teacher</option>');
                $.each(data, function(k,v){
                    $('.teacher_marks_details').append('<option value = "'+v.employee_profile_id+'">'+v.employee_last_name+' '+v.employee_first_name+' '+v.employee_middle_name+'</option>');
                });
            },'json');

            $.post('<?=site_url('Exam/fetch_exam_details')?>',{exam_id:exam_id}, function(data){
                console.log(data);
                $.each(data, function(k,v){
                    $('#exam_outoff_marks').val(v.exam_outoff_marks);
                    $('#exam_evaluation_marks').val(v.exam_evaluation_marks);
                    $('#exam_marksheet_marks').val(v.exam_marksheet_marks);
                });
            },'json');

            $.post('<?=site_url('Exam/student_details_class_division')?>',{exam_id:exam_id,class_id:class_id}, function(data){
                console.log(data);
                $.each(data, function(k,v){
                    $('.student_marks_details').append('<tr><td>'+v.SCD_Roll_No+'</td><td class="hidden"><input type="text" name="marks_student_id[]" value="'+v.student_profile_id+'"></td><td>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</td><td>'+v.exam_outoff_marks+'</td><td>'+v.marks_obtain+'</td><td style="width:20%;padding:inherit;">'+
                        (v.marks_obtain != "NA" ? (v.marks_status != "0" ? '<input type="text" class="form-control" name="marks_obtained[]" value="'+v.marks_obtain+'" readonly style="border:none;">' : '<input type="text" class="form-control" name="marks_obtained[]" value="'+v.marks_obtain+'" style="border:none;" max="'+v.exam_outoff_marks+'" min="1">') : '<input type="number" class="form-control" name="marks_obtained[]" max="'+v.exam_outoff_marks+'" min="1" >')+
                        '</td></tr>');
                });
            },'json');
        });

        $(document).on('change','.fetch_class_marks_details',function(){
            $('.fetch_subject_marks_details').empty().removeClass('chosen-select1');

            $('.fetch_student_marks_details').empty();
            var class_id = $(this).val();
            $.post('<?=site_url('Exam/subject_details_class_division1')?>',{class_id:class_id}, function(data){
                console.log(data);
                $('.fetch_subject_marks_details').append('<option selected disabled>Select Subject</option>');
                $.each(data, function(k,v){
                    $('.fetch_subject_marks_details').append('<option value = "'+v.exam_subject_id+'">'+v.subject_name+' </option>');
                });
                $('.fetch_subject_marks_details').addClass('chosen-select1');
                $('.chosen-select1').chosen({width: "100%"});
            },'json');
        });
        
        $(document).on('change','.fetch_subject_marks_details',function(){
             $(".loader").fadeIn("slow");
            // console.log("hii");
            // $('.fetch_student_marks_details').empty();
            if ( $.fn.DataTable.isDataTable('.dataTables-example2') ) {
              $('.dataTables-example2').DataTable().destroy();
            }
            $('.dataTables-example2 tbody').empty();

            var subject_id = $(this).val();
            var class_id = $('.fetch_class_marks_details').val();
            var term_id = $('.marks_term_id').val();

            var pri_term = $( ".marks_term_id option:selected" ).text();
            var pri_cls = $('.fetch_class_marks_details option:selected').text();
            var pri_sub = $('.fetch_subject_marks_details option:selected').text();
            var status=0;
            $.post('<?=site_url('Exam/fetch_sub_eval')?>',{subject_id:subject_id,class_id:class_id,term_id:term_id}, function(data){
                console.log(data);
                status=data.stu_data[0].marks_status;
                if(status==0)
                {
                    $('#marks_varification_status').html("Verification Pending").css("color","red");    
                    $('#marks_varification_status_btn').removeClass('hidden');  
                }
                else
                {
                    $('#marks_varification_status').html("Verified").css("color","green");    
                }
                 $('#marks_varification_status_label').removeClass('hidden');
                

                $('.mark_detail_thead_tr1').empty();
                $('.mark_detail_thead_tr1').append('<th style="text-align: center; vertical-align: middle;">Roll Number</th><th style="text-align: center; vertical-align: middle;">Student Name</th>');                    
                $.each(data.eval_type, function(k,v){
                    $('.mark_detail_thead_tr1').append('<th style="text-align: center;">'+v.eval_name+'<br> ('+v.exam_outoff_marks+')</th>');
                });
                if (data.eval_type.length > 1)
                {
                    $('.mark_detail_thead_tr1').append('<th style="text-align: center; vertical-align: middle;">Total</th>');                    
                };
                var eval_length = data.eval_type.length;
                var stu_cnt = 1;
                var total=0;
                var gross_total=0;
                var str='';
                var mark=0;
                $.each(data.stu_data, function(k,v){
                    if(v.marks_obtained=='-')
                    {
                        mark=0;
                    }
                    else
                    {
                        mark=v.marks_obtained;
                    }
                    if(eval_length==1)
                    {
                        $('.dataTables-example2 tbody').append('<tr><td>'+v.SCD_Roll_No+'</td><td style="text-align: left;">'+v.student_name+'</td><td>'+v.marks_obtained+'</td></tr>');
                    }
                    else if(stu_cnt==1)
                    {
                        str='';
                        str = '<tr><td>'+v.SCD_Roll_No+'</td><td style="text-align: left;">'+v.student_name+'</td><td>'+v.marks_obtained+'</td>';
                        total=mark;
                        gross_total=v.exam_outoff_marks;
                        stu_cnt++;
                    }
                    else if(stu_cnt==eval_length)
                    {   
                        total=eval(total)+eval(mark);
                        gross_total=eval(gross_total)+eval(v.exam_outoff_marks);
                        str = str+'<td>'+v.marks_obtained+'</td><td>'+total+' / '+gross_total+'</td></tr>';
                        $('.dataTables-example2 tbody').append(str);
                        stu_cnt = 1;
                        total=0;
                        gross_total=0;
                    }
                    else
                    {
                        str = str+'<td>'+v.marks_obtained+'</td>';
                        total=eval(total)+eval(mark);
                        gross_total=eval(gross_total)+eval(v.exam_outoff_marks);
                        stu_cnt++;
                    }
                    
                });

                $('.dataTables-example2').DataTable({
                    pageLength: 10,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {extend: 'print',
                        title: '',
                        orientation: 'portrait',
                        pageSize: 'A4',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                $(win.document.body).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:18px;text-align:center;border:none !important;">Term : '+pri_term+' | Class : '+pri_cls+' | Subject : '+pri_sub+'</td></center></tr>')
                                $(win.document.body).append('<br><br><br><br><table style="width:100%;"><tr><td>Subject Teacher<br>Signature</td><td>Class Teacher<br>Signature</td><td>Clerk<br>Signature</td><td>Principal<br>Signature</td></tr></table>')
                        
                        }

                        }
                    ]

                });
                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }

            },'json');


            
            // $.post('<?=site_url('Exam/fetch_student_marks_division')?>',{exam_id:exam_id,class_id:class_id}, function(data){
            //     // console.log(data);
            //     $.each(data, function(k,v){
            //         $('.dataTables-example2 tbody').append('<tr><td>'+v.SCD_Roll_No+'</td><td>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</td><td>'+v.marks_obtained+'</td><td>'+v.exam_outoff_marks+'</td></tr>');
            //     });

            //     $('.dataTables-example2').DataTable({
            //         pageLength: 10,
            //         responsive: true,
            //         dom: '<"html5buttons"B>lTfgitp',
            //         buttons: [
            //             {extend: 'print',title: '',
            //              customize: function (win){
            //                     $(win.document.body).addClass('white-bg');
            //                     $(win.document.body).css('font-size', '10px');

            //                     $(win.document.body).find('table')
            //                             .addClass('compact')
            //                             .css('font-size', 'inherit');
            //                     $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+pri_term+' | '+pri_cls+' | '+pri_sub+'</td></center></tr>')
                        
            //             }

            //             }
            //         ]

            //     });

            // },'json');

        });


            $(document).on('click','#marks_varification_status_btn',function(){
            var subject_id = $('.fetch_subject_marks_details').val();
            var class_id = $('.fetch_class_marks_details').val();
            var term_id = $('.marks_term_id').val();

            $.post('<?=site_url('Exam/update_sub_verification_status')?>',{term_id:term_id,class_id:class_id,subject_id:subject_id}, function(data){
                console.log(data);  
                    $('#marks_varification_status').html("Verified").css("color","green");   
                    $('#marks_varification_status_btn').addClass('hidden');   


            },'json');
            });



        $(document).on('click','#evaluation_verification',function(){
            $(".loader").fadeIn("slow");
            $('#division_evaluation_status').empty();
            $('#exam_evaluation_status').empty();
            $('#evaluation_status').empty();
            $('#total_exam').empty();
            $('#eval_exam_details').removeClass();
            $('#eval_exam_details1').removeClass();
            $('#eval_table_details').removeClass();
            $('#eval_exam_details').addClass('form-group');
            $('#eval_exam_details1').addClass('form-group');
            $('#eval_table_details').addClass('table table-bordered');

            var term = $('#eval_term_id').val();
            var class_id = $('#eval_class_id').val();
            $.post('<?=site_url('Exam/check_division_evaluation_process')?>',{term:term,class:class_id},function(data){
                console.log(data);
                var cnt = data.length;

                 $('#division_evaluation_status').append((cnt < 2 ? '<div class="col-sm-5"></div>' : (cnt < 3 ? '<div class="col-sm-4"></div>' : (cnt < 4 ? '<div class="col-sm-3"></div>' : (cnt < 5 ? '<div class="col-sm-2"></div>' : (cnt < 6 ? '<div class="col-sm-1"></div>' : '<div></div>')))))); 

                $.each(data,function(k,v){
                    $('#division_evaluation_status').append('<div class="col-sm-2 fetch_division_details">'+        
                        '<div class="ibox float-e-margins"  style="background-color:rgba(35, 198, 200, 0.74);margin-bottom:1px;">'+
                            '<div class="ibox-content" style="background-color:rgba(35, 198, 200, 0.74);padding:0px 0px 1px 21px;">'+
                                '<div class="row">'+
                                    '<div class="col-sm-5" style="color:#ffffff;">'+
                                        '<h1 class="no-margins" style="padding-top: 15px;"><b><center>'+
                                            ''+v.std_count+'</b></center>'+
                                        '</h1>'+
                                        '<h3><b>Student</b></h3>'+
                                    '</div>'+
                                    '<div class="col-sm-2" style="padding-left: 40px;font-size: 65px;color: black;">'+
                                        '<center>'+v.division_name+'</center>'+
                                        '<center><input type="text" value="'+v.division_id+'" id="eval_division_id" class="hidden"></center>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');
                });
                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }
            },'json');

            $.post('<?=site_url('Exam/check_division_exam_evaluation_process')?>',{term:term,class:class_id},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('#evaluation_status').text(data[0].evaluation_status);
                    $('#total_exam').text(data[0].total_exam);
                    if(data[0].exam_evaluation_status == 0){
                        $('#evaluation_change').html((data[0].button_status != 0 ? '<span class="btn btn-primary disabled">Start Evaluation</span><br> <span style=color:red;>Note: The marks evaluation process has not started yet. Waiting for teacher to enter the marks.</span>' : '<span class="btn btn-primary" id="start_evaluation_process">Start Evaluation</span><br><span style=color:red;>Note: The evaluation of marks is under process and will be completed soon.</span>'));
                    }
                    if(data[0].exam_evaluation_status == 1){
                        $('#evaluation_change').html((data[0].marks_verification_cnt != 0 ? '<span class="btn btn-primary disabled">Complete Evaluation</span><br> <span style=color:red;>Note: The marks evaluation process has started yet. Waiting for teacher to verified marks.</span>' : '<span class="btn btn-primary" id="complete_evaluation_process">Complete Evaluation</span><br><span style=color:red;>Note: The Verification of marks is under process and will be completed soon.</span>'));
                    }
                });
            },'json');
        })

        $(document).on('click','.fetch_division_details',function(){
            $('#exam_process_evaluation').removeClass();
            $('#exam_process_evaluation_header').removeClass();
            $('#exam_process_evaluation').addClass('table table-bordered');
            $('#exam_process_evaluation_header').addClass('ibox-content');
            $('#exam_evaluation_status').empty();
            $('#student_evaluation_status').empty();
            var term = $('#eval_term_id').val();
            var class_id = $('#eval_class_id').val();
            var division_id = $(this).find('#eval_division_id').val();

            $('html,body').animate({ scrollTop: $("#exam_evaluation_status").offset().top},'slow');
            $.post('<?=site_url('Exam/check_evaluation_process')?>',{term:term,class:class_id,division:division_id},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('#exam_evaluation_status').append('<tr class="fetch_student_records_evaluation"><td class="hidden exam_eval_division">'+v.division_id+'</td><td>'+v.division_name+'</td><td class="hidden exam_eval_id">'+v.exam_id+'</td><td>'+v.subject_name+'('+v.eval_name+')</td><td>'+v.exam_result_date+'</td><td>'+v.exam_evaluation_status+'</td><td>'+v.std_count+'</td><td>'+v.marks_std_cnt+'</td><td>'+v.balance+'</td></tr>');
                });
            },'json');
        })

        $(document).on('click','.fetch_student_records_evaluation',function(){
            $('#student_process_evaluation').removeClass();
            $('#student_process_evaluation_header').removeClass();
            $('#student_process_evaluation').addClass('table table-bordered');
            $('#student_process_evaluation_header').addClass('ibox-content');
            $('#student_evaluation_status').empty();
            var term = $('#eval_term_id').val();
            var class_id = $('#eval_class_id').val();
            var division_id = $(this).find('.exam_eval_division').text();
            var exam_id = $(this).find('.exam_eval_id').text();
             $('html,body').animate({ scrollTop: $("#student_evaluation_status").offset().top},'slow');
            $.post('<?=site_url('Exam/check_student_evaluation_process')?>',{term:term,class:class_id,division:division_id,exam:exam_id},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('#student_evaluation_status').append('<tr><td class="hidden">'+v.student_profile_id+'</td><td>'+v.SCD_Roll_No+'</td><td>'+v.student_name+'</td><td>'+v.teacher_name+'</td><td>'+v.marks_obtained+'/'+v.exam_outoff_marks+'</td><td>'+v.marks_evaluation+'/'+v.exam_evaluation_marks+'</td><td>'+v.status+'</td></tr>');
                });
            },'json');
        });

        $(document).on('click','#start_evaluation_process',function(){
            var term = $('#eval_term_id').val();
            var class_id = $('#eval_class_id').val();
             var eval_type = '1';
            $.post('<?=site_url('Exam/start_evaluation_process')?>',{term:term,class:class_id,eval_type:eval_type},function(data){

            },'json');
            window.location.href = "<?php  echo site_url('Exam/exam_details'); ?>";
        });

        $(document).on('click','#complete_evaluation_process',function(){
            var term = $('#eval_term_id').val();
            var class_id = $('#eval_class_id').val();
            var eval_type = '2';
            $.post('<?=site_url('Exam/complete_evaluation_process')?>',{term:term,class:class_id,eval_type:eval_type},function(data){
                 console.log(data);
            },'json');
            window.location.href = "<?php  echo site_url('Exam/exam_details'); ?>";
        });

        $(document).on('change','.fetch_eval_verify_class_marks_details',function(){
            $('.fetch_eval_subject_marks_details').empty();
            $('.fetch_eval_student_marks_details').empty();
            var class_id = $(this).val();
            $.post('<?=site_url('Exam/subject_details_class_division')?>',{class_id:class_id}, function(data){
                console.log(data);
                $('.fetch_eval_subject_marks_details').append('<option selected disabled>Select Subject</option>');
                $.each(data, function(k,v){
                    $('.fetch_eval_subject_marks_details').append('<option value = "'+v.exam_id+'">'+v.subject_name+' <span>('+v.eval_name+')</span></option>');
                });
            },'json');
        });

        $(document).on('change','.fetch_eval_subject_marks_details',function(){
            $(".loader").fadeIn("slow");
            $('.fetch_eval_student_marks_details').empty();
            var exam_id = $(this).val();
            var class_id = $('.fetch_eval_verify_class_marks_details').val();
            $.post('<?=site_url('Exam/fetch_student_marks_division')?>',{exam_id:exam_id,class_id:class_id}, function(data){
                console.log(data);
                $.each(data, function(k,v){
                    $('.fetch_eval_student_marks_details').append('<tr><td class="eval_marks_id_status hidden">'+v.marks_id+'</td><td>'+v.SCD_Roll_No+'</td><td>'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</td><td>'+v.marks_obtained+'/'+v.exam_outoff_marks+'</td><td>'+v.marks_evaluation+'/'+v.exam_evaluation_marks+'</td><td>'+v.marks_status_details+'</td><td>'+
                        (v.marks_status  == 0 ? '<span class="btn btn-info btn-xs" data-toggle="modal" id ="'+v.marks_id+'-'+v.student_first_name+'-'+v.student_middle_name+'-'+v.student_last_name+'-'+v.marks_obtained+'-'+v.exam_outoff_marks+'-'+v.marks_evaluation+'-'+v.exam_evaluation_marks+'" data-target="#verify_evaluation_marks"><i class="fa fa-pencil" title="Update Marks"></i></span>&nbsp&nbsp &nbsp<a href="<?=site_url("Exam/direct_verify_marks/'+v.marks_id+'") ?>""><span class="btn btn-primary btn-xs"><i class="fa fa-check-circle" title="Verified Marks"></i></a></span></tr>':''));
                });
                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }

            },'json');
        });

        $('#verify_evaluation_marks').on('show.bs.modal', function(e) {
                var id = e.relatedTarget.id;
                var eval_details = id.split('-');
                $('.marks_id_assign').val(eval_details[0]);
                $('.marks_student_assign').val(eval_details[1]+' '+eval_details[2]+' '+eval_details[3]);
                $('.exam_outoff_marks_assign').val(eval_details[5]);
                $('.exam_evaluation_assign').val(eval_details[7]);
                $('.marks_exam_marks_assign').val(eval_details[4]);
                $('.marks_evaluation_assign').val(eval_details[6]);
        });

        $(document).on('change','#marks_obtained_eval',function(){
            var obtained = $(this).val();
            var outoff = $('#exam_outoff_marks_eval').val();
            var eval = $('#exam_evaluation_marks_eval').val();
            $('#marks_evaluation_eval').val(Math.round((parseInt(eval)*parseInt(obtained))/parseInt(outoff)));
        });

        $(document).on('click','.print_exam_schedule',function(){
            var printOut_class_id = $('.printOut_class_id').val();
            var printOut_term_id = $('.printOut_term_id').val();
            var printOut_eval = $('.printOut_eval_id').val();
            var printOut_eval_id = printOut_eval.join();

            // console.log(printOut_class_id,printOut_term_id,printOut_eval_id);
            $.post('<?=site_url('Exam/print_exam_schedule_view')?>',{printOut_class_id:printOut_class_id,printOut_term_id:printOut_term_id,printOut_eval_id:printOut_eval_id},function(data){
                    // console.log(data);
                    var i = 1;
                    $('.dataTables-example').DataTable().destroy();
                    $('.print_exam_schedule_tbody').empty();
                    $.each(data,function(k,v){
                        $('.print_exam_schedule_tbody').append('<tr><td>'+i+'</td><td>'+v.exam_date+'</td><td>'+v.exam_start_time+' to '+v.exam_end_time+'</td><td>'+v.subject_name+' ( '+v.eval_name+' )</td><td>'+v.exam_outoff_marks+'</td></tr>');
                        i++;
                    });

                    $('.dataTables-example').DataTable({
                        pageLength: 10,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [    ],
                    });

                    $('.print_btn').removeClass('hidden');

            },'json');
        });
// ========================================

        $(document).on('click','.print_report_card_btn',function(){
            $(".loader").fadeIn("slow");

            if ( $.fn.DataTable.isDataTable('.dataTables-example4') ) {
              $('.dataTables-example4').DataTable().destroy();
            }
            $('.dataTables-example4 tbody').empty();

            var pri_term = $(".term_id_print_report_card option:selected" ).text();
            var pri_cls = $('.fetch_class_print_report_card option:selected').text();

            $('.print_report_card_thead_tr1').empty();
            $('.print_report_card_tbody').empty();

            var term_id = $('.term_id_print_report_card').val();
            var class_id = $('.fetch_class_print_report_card').val();

            $.post('<?=site_url('Exam/view_all_report')?>',{term_id:term_id,class_id:class_id},function(data){
                console.log(data);
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Roll no</th>');
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Student</th>');
                $.each(data.subject_report,function(k,v){
                    $('.print_report_card_thead_tr1').append('<th style="text-align: center;">'+v.subject_name+'</th>');
                }); 
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Spl. Remark</th>');
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Intrest</th>');
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Improvement</th>');
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Fee Balance</th>');
                $('.print_report_card_thead_tr1').append('<th style="text-align: center;vertical-align: middle;">Oprations</th>');
                var subject_length=data.subject_report.length;
                var str;
                var stu_cnt=1;
                var str1='';
                var str2='';
                var str3='';
                var str1_status=0;
                var str2_status=0;
                var str3_status=0;
                var feedback;
                for (var i = 0; i < data.student_grades.length; i++) 
                {
                    feedback='';
                    if(data.student_grades[i].SF_special_remark_1==null || data.student_grades[i].SF_special_remark_1=='')
                    {
                        str1_status=0;
                        str1='';
                        feedback=feedback+'<td class="SF_SR_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_special_remark_1+'"><i class="fa fa-times text-danger" aria-hidden="true"></i></td>';
                    }
                    else
                    {
                        str1_status=1;
                        str1=data.student_grades[i].SF_special_remark_1; 
                        feedback=feedback+'<td class="SF_SR_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_special_remark_1+'"><i class="fa fa-check text-success" aria-hidden="true"></i></td>';   
                    }
                    if(data.student_grades[i].SF_Int_Hob_1==null || data.student_grades[i].SF_Int_Hob_1=='')
                    {
                        str2_status=0;
                        str2='';
                        feedback=feedback+'<td class="SF_IH_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_Int_Hob_1+'"><i class="fa fa-times text-danger" aria-hidden="true"></i></td>';
                    }
                    else
                    {
                        str2_status=1;
                        str2=data.student_grades[i].SF_Int_Hob_1; 
                        feedback=feedback+'<td class="SF_IH_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_Int_Hob_1+'"><i class="fa fa-check text-success" aria-hidden="true"></i></td>';   
                    }
                    if(data.student_grades[i].SF_Improvement_need_1==null || data.student_grades[i].SF_Improvement_need_1=='')
                    {
                        str3_status=0;
                        str3='';
                        feedback=feedback+'<td class="SF_IN_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_Improvement_need_1+'"><i class="fa fa-times text-danger" aria-hidden="true"></i></td>';
                    }
                    else
                    {
                        str3_status=1;
                        str3=data.student_grades[i].SF_Improvement_need_1; 
                        feedback=feedback+'<td class="SF_IN_'+data.student_grades[i].student_profile_id+'" title="'+data.student_grades[i].SF_Improvement_need_1+'"><i class="fa fa-check text-success" aria-hidden="true"></i></td>';   
                    }
                    if(subject_length==1)
                    {
                        str='';
                        str = '<tr class="stu_'+data.student_grades[i].student_profile_id+'"><td>'+data.student_grades[i].SCD_Roll_No+'</td><td style="text-align: left;white-space:nowrap;">'+data.student_grades[i].student_name+'</td><td>'+data.student_grades[i].GC_grade+'</td>'+feedback+'<td>'+data.student_grades[i].balance+'</td><td><span class="btn btn-success btn-xs edit_remark"  data-toggle="modal" data-target="#myModal2" title ="'+data.student_grades[i].student_profile_id+'@'+data.term_id+'@'+data.student_grades[i].SF_id+'">Edit</span><span class="btn btn-white btn-xs print_receipt_btn" title="'+data.student_grades[i].student_profile_id+','+data.term_id+','+data.class_id+','+data.division_id+','+data.student_grades[i].balance+'">Print</span></td></tr>';
                        stu_cnt = 1;
                        $('.print_report_card_tbody').append(str);
                    }
                    else if(stu_cnt==1)
                    {
                        str='';
                        str = '<tr class="stu_'+data.student_grades[i].student_profile_id+'"><td>'+data.student_grades[i].SCD_Roll_No+'</td><td style="text-align: left;white-space:nowrap;">'+data.student_grades[i].student_name+'</td><td>'+data.student_grades[i].GC_grade+'</td>';
                        stu_cnt++;
                    }
                    else if(stu_cnt==subject_length)
                    {   
                        str = str+'<td>'+data.student_grades[i].GC_grade+'</td>'+feedback+'<td>'+data.student_grades[i].balance+'</td><td><span class="btn btn-success btn-xs edit_remark"  data-toggle="modal" data-target="#myModal2" title ="'+data.student_grades[i].student_profile_id+'@'+data.term_id+'@'+data.student_grades[i].SF_id+'">Edit</span><span class="btn btn-white btn-xs print_receipt_btn" title="'+data.student_grades[i].student_profile_id+','+data.term_id+','+data.class_id+','+data.division_id+','+data.student_grades[i].balance+'">Print</span></td></tr>';
                        $('.print_report_card_tbody').append(str);
                        stu_cnt = 1;
                    }
                    else
                    {
                        str =str+'<td>'+data.student_grades[i].GC_grade+'</td>';
                        stu_cnt++;
                    }
                };

                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }
                

                $('.dataTables-example4').DataTable({
                    pageLength: 10,
                    responsive: true,
                    // ScrollX:true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {extend: 'print',title: '',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5 ,6,7,8,9,10,11,12] //Your Colume value those you want
                        },
                        customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                $(win.document.body).prepend('<tr><center><td colspan="18" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="18" style="font-size:24px;text-align:center;border:none !important;">Term : '+pri_term+' |  Class : '+pri_cls+' </td></center></tr>')
                                $(win.document.body).append('<br><br><br><br><table style="width:100%;"><td>Class Teacher Signature</td><td>Principal Signature</td></tr></table>')
                        
                        }

                        }
                    ]
                });
                
            },'json');

        });
        
        // progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/



        $(document).on('click','.print_receipt_btn',function(){
            var data = this.title;
            console.log(data);
            var data1 = data.split(",");

            var student_profile_id = data1[0];
            var term_id = data1[1];
            var class_id = data1[2];
            var division_id = data1[3];
            var balance = data1[4];
            $('.bal_password').val('');
            $(".pass_alert").text("");

            $.post('<?=site_url('Exam/set_print_data')?>',{term_id:term_id,class_id:class_id,student_profile_id:student_profile_id,division_id:division_id},function(data){},'json');   
                $('#wait_model').modal('show');
                 var elem = document.getElementById("myBar");   
                  var width = 1;
                  var id = setInterval(frame, 10);
                  function frame() {
                    if (width >= 100) {
                      clearInterval(id);
                    } else {
                      width++; 
                      elem.style.width = width + '%'; 
                    }
                  }

                window.setTimeout(function() { 
                if (balance > 0)
                {
                    $('.close_model').click();
                    $('#balance_pass_model').modal('show');

                }else{
                    
                    $('.close_model').click();
                    window.open("<?=site_url('Exam/report_card_student')?>");
                }
             },2000);
        });

        $(document).on('click','.confirm_bal_pss',function(){
            var password = $('.bal_password').val();
            if (password == "eschool@123")
            {
                $('.close_model').click();
                window.open("<?=site_url('Exam/report_card_student')?>");

            }else{
                $(".pass_alert").text("Please Enter correct password.");
            }
        });

        $(document).on('click','.edit_remark',function(){
            
            var data = this.title;
            var data1 = data.split("@");
            var student_profile_id = data1[0];
            var term_id = data1[1];
            var SF_id = data1[2];
            var SF_SR = $('.SF_SR_'+student_profile_id+'').attr('title');
            var SF_IH = $('.SF_IH_'+student_profile_id+'').attr('title');
            var SF_IN = $('.SF_IN_'+student_profile_id+'').attr('title');
            
            $('.student_profile_id').val(student_profile_id);
            $('.term_id').val(term_id);
            

            if (SF_id == "null")
            {
                $('.SF_id').val('');
            }else{
                $('.SF_id').val(SF_id);
            }
            if (SF_SR == "null")
            {
                $('.SF_SR').val('');
            }else{
                $('.SF_SR').val(SF_SR);
            }
            if (SF_IH == "null")
            {
                $('.SF_IH').val('');
            }else{
                $('.SF_IH').val(SF_IH);
            }
            if (SF_IN == "null")
            {
                $('.SF_IN').val('');
            }else{
                $('.SF_IN').val(SF_IN);
            }

        });

        $(document).on('click','.save_remark',function(){
            var student_profile_id = $('.student_profile_id').val();
            var term_id = $('.term_id').val();
            var SF_id = $('.SF_id').val();
            var SF_SR = $('.SF_SR').val();
            var SF_IH = $('.SF_IH').val();
            var SF_IN = $('.SF_IN').val();

            if (SF_id == '' || SF_id == null)
            {
                SF_id = 0;
            };

            $.post('<?=site_url('Exam/save_remark')?>',{SF_id:SF_id,SF_SR:SF_SR,student_profile_id:student_profile_id,term_id:term_id,SF_IH:SF_IH,SF_IN:SF_IN},function(data){
            },'json');

            $('.close_model').click();

            if (SF_SR != null && SF_SR != '')
            {
                $('.SF_SR_'+student_profile_id+'').empty().append('<i class="fa fa-check text-success" aria-hidden="true"></i>');
                $('.SF_SR_'+student_profile_id+'').prop('title', SF_SR);
            }else{
                $('.SF_SR_'+student_profile_id+'').empty().append('<i class="fa fa-times text-danger" aria-hidden="true"></i>');
            };
            if (SF_IH != null && SF_IH != '')
            {
                $('.SF_IH_'+student_profile_id+'').empty().append('<i class="fa fa-check text-success" aria-hidden="true"></i>');
                $('.SF_IH_'+student_profile_id+'').prop('title', SF_IH);
            }else{
                $('.SF_IH_'+student_profile_id+'').empty().append('<i class="fa fa-times text-danger" aria-hidden="true"></i>');
            };
            if (SF_IN != null && SF_IN != '')
            {
                $('.SF_IN_'+student_profile_id+'').empty().append('<i class="fa fa-check text-success" aria-hidden="true"></i>');
                $('.SF_IN_'+student_profile_id+'').prop('title', SF_IN);
            }else{
                $('.SF_IN_'+student_profile_id+'').empty().append('<i class="fa fa-times text-danger" aria-hidden="true"></i>');
            };

             $('.student_profile_id').val('');
             $('.term_id').val('');
             $('.SF_id').val('');
             $('.SF_SR').val('');
             $('.SF_IH').val('');
             $('.SF_IN').val('');

        });


// ========================================





        var summary_head;
        $(document).on('click','.view_all_btn',function(){
            $(".loader").fadeIn("slow");
            if ( $.fn.DataTable.isDataTable('.dataTables-example3') ) {
              $('.dataTables-example3').DataTable().destroy();
            }
            $('.dataTables-example3 tbody').empty();

            var pri_term = $(".term_id_view_all option:selected" ).text();
            var pri_cls = $('.fetch_class_view_all option:selected').text();

            $('.view_all_thead_tr1').empty();
            $('.view_all_thead_tr2').empty();
            $('.view_all_tbody').empty();

            var term_id = $('.term_id_view_all').val();
            var class_id = $('.fetch_class_view_all').val();

            $.post('<?=site_url('Exam/view_all')?>',{term_id:term_id,class_id:class_id},function(data){
                console.log(data);
                summary_head='';
                 $('.view_all_thead_tr1').append('<th rowspan="2" style="text-align: center;vertical-align: middle;">Roll no</th>');
                 $('.view_all_thead_tr1').append('<th rowspan="2" style="text-align: center;vertical-align: middle;">Student</th>');
                 summary_head='<th></th><th></th>';
                $.each(data.subject,function(k,v){
                    if (v.eval_count > 1)
                    {
                         v.eval_count = +v.eval_count + +1;
                        $('.view_all_thead_tr1').append('<th colspan="'+v.eval_count+'" style="text-align: center;">'+v.subject_name+'</th>');
                        summary_head=summary_head+'<th colspan="'+v.eval_count+'" style="text-align: center;">'+v.subject_name+'</th>';

                    }else{

                        $('.view_all_thead_tr1').append('<th colspan="'+v.eval_count+'" style="text-align: center;">'+v.subject_name+'</th>');
                        summary_head=summary_head+'<th colspan="'+v.eval_count+'" style="text-align: center;">'+v.subject_name+'</th>';
                    }

                });
                $('.view_all_thead_tr1').append('<th rowspan="2" style="text-align: center;vertical-align: middle;">Gross Total</th>');
                $('.view_all_thead_tr1').append('<th rowspan="2" style="text-align: center;vertical-align: middle;">Percent</th>');
                summary_head=summary_head+'<th></th><th></th>'
                console.log(summary_head);
                var subject_id = [];
                subject_id.push(0);
                var sub_cnt = 0;
                var sub_cnt_pri = 0;
                // var eval_length_org = data.evaluation.length;
                var eval_length = data.evaluation.length;
                // alert(eval_length);
                var j = 0;

                for (var i = 0; i < (data.evaluation.length+1); i++) 
                {
                    j++;
                    if (j == data.evaluation.length+1)
                    {
                        if (sub_cnt_pri != 0)
                        {
                             $('.view_all_thead_tr2').append('<th style="text-align: center;">Sub.Total</th>'); 
                            sub_cnt_pri = 0;                           
                        };
                    }else{

                        subject_id.push(data.evaluation[i].exam_subject_id);

                        if (subject_id[j-1] == subject_id[j])
                        {
                            sub_cnt++;
                            sub_cnt_pri = sub_cnt;
                        }else{
                            if (sub_cnt_pri != 0)
                            {
                                 $('.view_all_thead_tr2').append('<th style="text-align: center;">Sub.Total</th>'); 
                                sub_cnt_pri = 0;                           
                            };
                        }

                        $('.view_all_thead_tr2').append('<th style="text-align: center;">'+data.evaluation[i].eval_name+'<br />('+data.evaluation[i].exam_marksheet_marks+')</th>');
                    }

                };
                
                var str;
                var total=0;
                var sub_id=0;
                var pre_sub_id=0;
                var marks=0;
                var eval_type=0;
                var stu_cnt=1;
                var add = 0;
                var outoff=0;
                var old_total=0;
                var gross_total=0;
                var gross_total_all=0;
                for (var i = 0; i < data.student.length; i++) 
                {
                    pre_sub_id=sub_id;
                    sub_id=data.student[i].exam_subject_id;
                    marks=data.student[i].marks_marksheet;
                    outoff=data.student[i].exam_marksheet_marks
                    if(marks!="-")
                    {
                       gross_total=eval(gross_total)+eval(marks); 
                    }
                    gross_total_all=eval(gross_total_all)+eval(outoff);
                    percent=(gross_total*100)/gross_total_all
                    per=percent.toFixed(2);
                    if(sub_id==pre_sub_id)
                    {
                        if(stu_cnt==eval_length)
                        {
                            if(marks!="-")
                            {   
                                old_total=eval(total)+eval(marks);
                                total=0;
                            }
                            else
                            {
                                old_total=eval(total);
                                total=0;
                            }
                            add=1;
                        }
                        else
                        {
                            if(marks!="-")
                            {
                                total=eval(total)+eval(marks);
                            }
                            eval_type=eval_type+1;
                            add=0;
                        }
                    }
                    else
                    {
                        if(eval_type==1)
                        {
                            if(marks!="-")
                            {
                                total=marks;
                            }
                            else
                            {
                                total=0;
                            }    
                            add=0;
                        }
                        else
                        {
                            old_total=total;
                            if(marks!="-")
                            {
                                total=marks;
                            }
                            else
                            {
                                total=0;
                            }
                            add=1;
                        }
                        eval_type=1;     
                    }
                    if(eval_length==1)
                    {
                        str='';
                        str = '<tr class="stu_'+data.student[i].student_GRN+'"><td>'+data.student[i].SCD_Roll_No+'</td><td style="text-align: left;white-space:nowrap;">'+data.student[i].student_name+'</td><td>'+data.student[i].marks_marksheet+'</td><td style="color: black;">'+gross_total+' / '+gross_total_all+'</td><td style="color: black;">'+per+'%</td></tr>';
                        stu_cnt = 1;
                        gross_total=0;
                        gross_total_all=0;
                        $('.view_all_tbody').append(str);
                    }
                    else if(stu_cnt==1)
                    {
                        str='';
                        str = '<tr class="stu_'+data.student[i].student_GRN+'"><td>'+data.student[i].SCD_Roll_No+'</td><td style="text-align: left;white-space:nowrap;">'+data.student[i].student_name+'</td><td>'+data.student[i].marks_marksheet+'</td>';
                        stu_cnt++;
                    }
                    else if(stu_cnt==eval_length)
                    {   
                        if(add==1)
                        {
                            str = str+'<td>'+data.student[i].marks_marksheet+'</td><td>'+old_total+'</td><td style="color: black;">'+gross_total+' / '+gross_total_all+'</td><td style="color: black;">'+per+'%</td></tr>';
                            old_total=0;

                        }
                        else
                        {
                            str = str+'<td>'+data.student[i].marks_marksheet+'</td><td style="color: black;">'+gross_total+' / '+gross_total_all+'</td><td style="color: black;">'+per+'%</td></tr>';
                        }   
                        $('.view_all_tbody').append(str);
                        stu_cnt = 1;
                        gross_total=0;
                        gross_total_all=0;
                    }
                    else
                    {
                        if(add==1)
                        {
                            str =str+'<td>'+old_total+'</td>'+'<td>'+data.student[i].marks_marksheet+'</td>';
                            old_total=0;
                        }
                        else
                        {
                             str =str+'<td>'+data.student[i].marks_marksheet+'</td>';
                        }
                        stu_cnt++;
                    }
                };

                $('.dataTables-example3').DataTable({
                    pageLength: 10,
                    responsive: true,
                    ScrollX:true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        // {extend: 'copy'},
                        // {extend: 'csv'},
                        // {extend: 'excel', title: 'ExampleFile'},
                        // {extend: 'pdf', title: 'ExampleFile'},
                        {extend: 'print',title: '',
                        orientation: 'landscape',
                        pageSize: 'A4',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                $(win.document.body).prepend('<tr><center><td colspan="18" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="18" style="font-size:24px;text-align:center;border:none !important;">Term : '+pri_term+' |  Class : '+pri_cls+' </td></center></tr>')
                                $(win.document.body).find('thead').prepend('<tr>'+summary_head+'</tr>');
                                $(win.document.body).append('<br><br><br><br><table style="width:100%;"><td>Class Teacher Signature</td><td>Principal Signature</td></tr></table>')
                        
                        }

                        }
                    ]

                });

                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }

            },'json');
        });

        $(document).on('change','.fetch_class_report',function(){
            var term_id = $('.term_id_report').val();
            var class_id = $('.fetch_class_report').val();
            $('.selected_stu').empty().removeClass('chosen-select3');

            $.post('<?=site_url('Exam/fetch_class_report_student')?>',{term_id:term_id,class_id:class_id},function(data){
                // console.log(data);
                
                $('.selected_stu').empty().append('<option selected disabled>Select Student</option>');
                $.each(data.student,function(k,v){
                    $('.selected_stu').append('<option value = "'+v.student_profile_id+'">'+v.student_name+' </option>');
                });

                $('.selected_stu').addClass('chosen-select3');
                $('.chosen-select3').chosen({width: "100%"});

            },'json');    
        });

        

        $(document).ready(function(){
            var lines = 2;
            $('#countMe1').keydown(function(e) {
                
                newLines1 = $(this).val().split("\n").length;
               
                if(e.keyCode == 13 && newLines1 >= lines) {
                    return false;
                }
            });
            $('#countMe2').keydown(function(e) {
                
                newLines2 = $(this).val().split("\n").length;
                
                if(e.keyCode == 13 && newLines2 >= lines) {
                    return false;
                }
            });
            $('#countMe3').keydown(function(e) {
                
                newLines3 = $(this).val().split("\n").length;
                
                if(e.keyCode == 13 && newLines3 >= lines) {
                    return false;
                }

            });
            $('.chosen-select').chosen({width: "100%"});
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?> 

            $("#addTerm").validate({
                rules: {
                    term_name: {
                        required: true,
                        pattern:/^[a-zA-Z0-9\s]*$/        
                    },
                    term_start_date: {
                        required: true        
                    },
                    term_end_date: {
                        required: true     
                    }
                },
                messages: {
                    term_name:{
                        pattern:"Please Enter only charater or digits."
                    }
                }
            }); 

            $("#printOut").validate({
                rules: {
                    printOut_term_id: {
                        required:true,
                        min:1     
                    },
                    printOut_class_id: {
                        required:true,
                        min:1        
                    },
                    printOut_eval_id: {
                        required: true,
                        min:1     
                    }
                },
                messages: {
                    printOut_term_id: {
                        required:"Please Select the Term.",
                        min:"Please Select the Term."     
                    },
                    printOut_class_id: {
                        required:"Please Select the Class.",
                        min:"Please Select the Class."       
                    },
                    printOut_eval_id: {
                        required:"Please Select the Exam.",
                        min:"Please Select the Exam."     
                    }
                }
            }); 

            $("#addExam").validate({
                rules: {
                    exam_term_id: {
                        min:1 ,
                        required:true   
                    },
                    exam_class_id: {
                        min:1 ,
                        required:true   
                    },
                    exam_subject_id: {
                        min:1  , 
                        required:true 
                    },
                    exam_start_date: {
                        required:true    
                    },
                    exam_end_date: {
                        required:true    
                    },
                    exam_outoff_marks:{
                        required:true,
                        digits:true,
                        min:1,
                        max:100
                    },
                    exam_evaluation_marks:{
                        required:true,
                        digits:true,
                        min:1,
                        max:100,
                        lessThan:"#higher_Marks"
                    },
                    exam_result_date: {
                        required:true    
                    }
                },
                messages: {
                    exam_term_id:{
                        min:"Please select the exam term."
                    },
                    exam_class_id:{
                        min:"Please select the exam class."
                    },
                    exam_subject_id:{
                        min:"Please select the exam subject."
                    },
                    exam_start_date: {
                        required:"Please select the exam start date."
                    },
                    exam_end_date: {
                        required:"Please select the exam end date."
                    },
                    exam_outoff_marks:{
                        required:"Please enter exam weightage marks.",
                        digits:"Please enter only digits.",
                        min:"Don't enter less than 0.",
                        max:"Don't enter greater than 100."
                    },
                    exam_evaluation_marks:{
                        required:"Please enter exam evaluation marks.",
                        digits:"Please enter only digits.",
                        min:"Don't enter less than 0.",
                        max:"Don't enter greater than 100.",
                        lessThan:"Please enter less than Weightage Marks."
                    },
                    exam_result_date: {
                        required:"Please select the exam result date."
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

            var example1 = $('.dataTables-example1').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [    ],
                "language": {
                    "emptyTable": "<img src='<?=base_url()?>/assets/img/No-record-found.png'> "
                }

            });

            $('.dataTables-example1 tfoot th').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" style="border: none;width: 100%;" placeholder="'+title+'" />' );
            } );
            var example1 = $('.dataTables-example1').DataTable();
         
            // Apply the search
            example1.columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
            
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>