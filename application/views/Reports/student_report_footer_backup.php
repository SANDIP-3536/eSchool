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
    <!--<script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>-->
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?=base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>

     <!-- Date range picker -->
    <script src="<?=base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- clockpicker -->
     <script src="<?=base_url()?>assets/js/plugins/clockpicker/clockpicker.js"></script>
    
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

        <?php if($report == 'student'){?>
             $('#student').addClass('active');
             document.title = "eSchool | Student Report"
        <?php } ?>

        $(document).on('change','#general_class_report_details,#class_class_report_details,#division_class_report_details,#gender_class_report_details,#cast_class_report_details,#town_class_report_details,#contact_class_report_details',function(){
            $('#general_class_name_report_details').empty();
            $('.general_division_report_details,#class_division_report_details,#division_division_report_details,#gender_division_report_details,#cast_division_report_details,#town_division_report_details').empty();
            var class_id = $(this).val();
            $.post('<?=site_url('Reports/fetch_class_division')?>',{class_id:class_id},function(data){
                // console.log(data);
                $('.general_division_report_details,.class_division_report_details,#division_division_report_details,#gender_division_report_details,#cast_division_report_details,#town_division_report_details').append("<option value='0'>All Division</option>");
                $.each(data,function(k,v){
                    $('.general_division_report_details,.class_division_report_details,#division_division_report_details,#gender_division_report_details,#cast_division_report_details,#town_division_report_details').append("<option value="+v.division_id+">"+v.division_name+"</option>")
                });
            },'json');

            $.post('<?=site_url('Reports/fetch_class_name')?>',{class_id:class_id},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('#general_class_name_report_details').val(v.class_name)
                });
            },'json');
        });

        $(document).on('change','.general_division_report_details,.class_division_report_details,#division_division_report_details,#gender_division_report_details,#cast_division_report_details,#town_division_report_details',function(){
            $('#general_division_name_report_details').empty();
            var division = $(this).val();
            $.post('<?=site_url('Reports/fetch_class_division_name')?>',{division:division},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('#general_division_name_report_details').val(v.division_name)
                });
            },'json');
        });

// -------------------------------------------------------------------------- General Register Reports ------------------------------------------------------------
        $('#general_division_report,#class_division_report').hide();
        $(document).on('change','#general_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#general_division_report').show(700);
                $('#class_division_report').show(700);
            }
            else{
                $('#general_division_report').hide(700);
                $('#class_division_report').hide(700);
            }
        });

         var genral = $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                
                {"extend": 'excel', title: 'Genral Register'},
            ],
            "columnDefs": [
                {
                    "targets": [ 15 ],
                    "visible": true
                }
            ],
            language: {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });


// -------------------------------------------------------------------------- Class Wise Report ------------------------------------------------------------------------
        $('#class_division_report').hide();
        $(document).on('change','#class_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#class_division_report').show(700);
            }
            else{
                $('#class_division_report').hide(700);
            }
        });


        var class_name ='';
        var division_name ='';
        $(document).on('click','.show_class_report',function(){
            var class_id = $('#class_class_report_details').val();
            var division_id = $('#class_division_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            division_name = $('#general_division_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/class_all_class_report')?>',{},function(data){
                    console.log(data);
                    myClass.clear();
                    $.each(data,function(k,v){
                        myClass.row.add(v);
                    });
                    myClass.draw();
                },'json');
            }else if (class_id != 0 && division_id == 0) {
                $.post('<?=site_url('Reports/class_class_wise_report')?>',{class_id:class_id},function(data){
                    console.log(data);
                    myClass.clear();
                    $.each(data,function(k,v){
                        myClass.row.add(v);
                    });
                    myClass.draw();
                },'json');
            }else{
                $.post('<?=site_url('Reports/class_class_division_wise_report')?>',{class_id:class_id,division_id:division_id},function(data){
                    console.log(data);
                    myClass.clear();
                    $.each(data,function(k,v){
                        myClass.row.add(v);
                    });
                    myClass.draw();
                },'json');
            }
        });

        var myClass = $('.dataTables-example_class').DataTable({
            // "paging": true,
            "pageLength": 10,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' Student Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' Student Details'},
                {"extend": 'pdf', title: ''+class_name+' Student Details'},
            ],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title":"Admission Date",
                "data":"student_admission_date"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            },
            {
                "title": "Father Name",
                "data": "father_name",
            },
            {
                "title": "Mother Name",
                "data": "mother_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Nationality",
                "data": "student_nationality"
            },
            {
                "title": "Category",
                "data": "student_category"
            },
            {
                "title": "Religion",
                "data": "religion"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name"
            },
            {
                "title": "Address",
                "data": "address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

// -------------------------------------------------------------------------- Division Wise REport ----------------------------------------------------------------

        $('#division_division_report').hide();
        $(document).on('change','#division_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#division_division_report').show(700);
            }
            else{
                $('#division_division_report').hide(700);
            }
        });

        var class_name ='';
        var division_name ='';
        $(document).on('click','.show_division_report',function(){
            var class_id = $('#division_class_report_details').val();
            var division_id = $('#division_division_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            division_name = $('#general_division_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/division_all_class_report')?>',{},function(data){
                    console.log(data);
                    myDivision.clear();
                    $.each(data,function(k,v){
                        myDivision.row.add(v);
                    });
                    myDivision.draw();
                },'json');
            }else if (class_id != 0 && division_id == 0) {
                $.post('<?=site_url('Reports/division_class_wise_report')?>',{class_id:class_id},function(data){
                    console.log(data);
                    myDivision.clear();
                    $.each(data,function(k,v){
                        myDivision.row.add(v);
                    });
                    myDivision.draw();
                },'json');
            }else{
                $.post('<?=site_url('Reports/division_class_division_wise_report')?>',{class_id:class_id,division_id:division_id},function(data){
                    console.log(data);
                    myDivision.clear();
                    $.each(data,function(k,v){
                        myDivision.row.add(v);
                    });
                    myDivision.draw();
                },'json');
            }
        });

        var myDivision = $('.dataTables-example_division').DataTable({
            "pageLength": 100,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' '+division_name+' Student Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' '+division_name+'  Student Details'},
                {"extend": 'pdf', title: ''+class_name+' '+division_name+'  Student Details'},
            ],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Nationality",
                "data": "student_nationality"
            },
            {
                "title": "Category",
                "data": "student_category"
            },
            {
                "title": "Religion",
                "data": "religion"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name"
            },
            {
                "title": "Address",
                "data": "address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

// -------------------------------------------------------------------------- Gender Wise Report -------------------------------------------------------------------------------------

        $('#gender_division_report').hide();
        $(document).on('change','#gender_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#gender_division_report').show(700);
            }
            else{
                $('#gender_division_report').hide(700);
            }
        });


        var gender='';
        var class_name='';
        var division_name = '';
        $(document).on('click','.show_gender_report',function(){
            var class_id = $('#gender_class_report_details').val();
            var division_id = $('#gender_division_report_details').val();
            gender = $('#gender_gender_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            division_name = $('#general_division_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/gender_all_class_report')?>',{gender:gender},function(data){
                    console.log(data);
                    myGender.clear();
                    $.each(data,function(k,v){
                        myGender.row.add(v);
                    });
                    myGender.draw();
                },'json');
            }else if (class_id != 0 && division_id == 0) {
                    $.post('<?=site_url('Reports/gender_class_wise_report')?>',{class_id:class_id,gender:gender},function(data){
                        console.log(data);
                        myGender.clear();
                        $.each(data,function(k,v){
                            myGender.row.add(v);
                        });
                        myGender.draw();
                    },'json');
            }else{
                $.post('<?=site_url('Reports/gender_class_division_wise_report')?>',{class_id:class_id,gender:gender,division_id:division_id},function(data){
                    console.log(data);
                    myGender.clear();
                    $.each(data,function(k,v){
                        myGender.row.add(v);
                    });
                    myGender.draw();
                },'json');
            }
        });

        var myGender = $('.dataTables-example_gender').DataTable({
            "pageLength": 100,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' '+gender+' Student Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' '+gender+'  Student Details'},
                {"extend": 'pdf', title: ''+class_name+' '+gender+'  Student Details'},
            ],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Nationality",
                "data": "student_nationality"
            },
            {
                "title": "Category",
                "data": "student_category"
            },
            {
                "title": "Religion",
                "data": "religion"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name"
            },
            {
                "title": "Address",
                "data": "address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

// -------------------------------------------------------------------------- Cast Wise Report ----------------------------------------------------------------------------------------
        $('#cast_division_report').hide();
        $(document).on('change','#cast_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#cast_division_report').show(700);
            }
            else{
                $('#cast_division_report').hide(700);
            }
        });

        var cast='';
        var class_name='';
        var division_name='';
        $(document).on('click','.show_cast_report',function(){
            var class_id = $('#cast_class_report_details').val();
            var division_id = $('#cast_division_report_details').val();
            cast = $('#cast_cast_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            division_name = $('#general_division_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/cast_all_class_report')?>',{cast:cast},function(data){
                    console.log(data);
                    myCast.clear();
                    $.each(data,function(k,v){
                        myCast.row.add(v);
                    });
                    myCast.draw();
                },'json');
            }else if (class_id != 0 && division_id == 0) {
                $.post('<?=site_url('Reports/cast_class_wise_report')?>',{class_id:class_id,cast:cast},function(data){
                    console.log(data);
                    myCast.clear();
                    $.each(data,function(k,v){
                        myCast.row.add(v);
                    });
                    myCast.draw();
                },'json');
            }else{
                $.post('<?=site_url('Reports/cast_class_division_wise_report')?>',{class_id:class_id,cast:cast,division_id:division_id},function(data){
                    console.log(data);
                    myCast.clear();
                    $.each(data,function(k,v){
                        myCast.row.add(v);
                    });
                    myCast.draw();
                },'json');
            }
        });

        var myCast = $('.dataTables-example_cast').DataTable({
            "pageLength": 100,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' '+cast+' Student Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' '+cast+'  Student Details'},
                {"extend": 'pdf', title: ''+class_name+' '+cast+'  Student Details'},
            ],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Nationality",
                "data": "student_nationality"
            },
            {
                "title": "Category",
                "data": "student_category"
            },
            {
                "title": "Religion",
                "data": "religion"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name"
            },
            {
                "title": "Address",
                "data": "address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

// -------------------------------------------------------------------------- Town Wise Report ----------------------------------------------------------------------------------------
        $('#town_division_report').hide();
        $(document).on('change','#town_class_report_details',function(){
            var class_id = $(this).val();
            if(class_id != 0){
                $('#town_division_report').show(700);
            }
            else{
                $('#town_division_report').hide(700);
            }
        });

        var town='';
        var class_name='';
        var division_name='';
        $(document).on('click','.show_town_report',function(){
            var class_id = $('#town_class_report_details').val();
            var division_id = $('#town_division_report_details').val();
            town = $('#town_town_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            division_name = $('#general_division_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/town_all_class_report')?>',{town:town},function(data){
                    console.log(data);
                    myTown.clear();
                    $.each(data,function(k,v){
                        myTown.row.add(v);
                    });
                    myTown.draw();
                },'json');
            }else if (class_id != 0 && division_id == 0) {
                $.post('<?=site_url('Reports/town_class_wise_report')?>',{class_id:class_id,town:town},function(data){
                    console.log(data);
                    myTown.clear();
                    $.each(data,function(k,v){
                        myTown.row.add(v);
                    });
                    myTown.draw();
                },'json');
            }else{
                $.post('<?=site_url('Reports/town_class_division_wise_report')?>',{class_id:class_id,town:town,division_id:division_id},function(data){
                    console.log(data);
                    myTown.clear();
                    $.each(data,function(k,v){
                        myTown.row.add(v);
                    });
                    myTown.draw();
                },'json');
            }
        });

        var myTown = $('.dataTables-example_town').DataTable({
            "pageLength": 100,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' '+town+' Student Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' '+town+'  Student Details'},
                {"extend": 'pdf', title: ''+class_name+' '+town+'  Student Details'},
            ],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Nationality",
                "data": "student_nationality"
            },
            {
                "title": "Category",
                "data": "student_category"
            },
            {
                "title": "Religion",
                "data": "religion"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name"
            },
            {
                "title": "Address",
                "data": "address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

//-------------------------------------------------------------------------------- Contact Report ----------------------------------------------------------------------------------

        var class_name='';
        var division_name='';
        $(document).on('click','.show_contact_report',function(){
            var class_id = $('#contact_class_report_details').val();
            class_name = $('#general_class_name_report_details').val();
            if(class_id == 0){
                $.post('<?=site_url('Reports/contact_all_class_report')?>',{},function(data){
                    console.log(data);
                    myContact.clear();
                    $.each(data,function(k,v){
                        myContact.row.add(v);
                    });
                    myContact.draw();
                },'json');
            }else{
                $.post('<?=site_url('Reports/contact_class_division_wise_report')?>',{class_id:class_id},function(data){
                    console.log(data);
                    myContact.clear();
                    $.each(data,function(k,v){
                        myContact.row.add(v);
                    });
                    myContact.draw();
                },'json');
            }
        });

        var myContact = $('.dataTables-example_contact').DataTable({
            "pageLength": 100,
            "responsive": true,
            "ordering": false,
            // "info": true,
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                {
                    "extend": 'print',
                   
                    title:'',
                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' Student Parent Contact Details </td></center></tr>')
                    },
                },
                {"extend": 'excel', title: ''+class_name+' Student Parent Contact Details'},
                {"extend": 'pdf', title: ''+class_name+' Student Parent Contact Details'},
            ],
            "columns": [
            {
                "title":"Sr.No",
                "data":"serial_number"
            },
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title": "Student Name",
                "data": "student_name",
            }, 
            {
                "title": "Father Name",
                "data": "father_name"
            },
            {
                "title": "Father Mobile No.",
                "data": "father_mobile_number"
            },
            {
                "title": "Mother Name",
                "data": "mother_name"
            },
            {
                "title": "Mother Mobile No.",
                "data": "mother_mobile_number"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }
        });

// ----------------------------------------------------------------------------------- Enquiey Report -------------------------------------------------------------------------------
        $(document).on('click','.show_enquiry_report',function(){
            var report_for = $('.enquiry_report_for').val();
            if (report_for == 1) {
                var school_id = $('.enquiry_school_report').val();
                $.post('<?=site_url('Reports/school_enquiry_report')?>',{school_id:school_id},function(data){
                    console.log(data);
                    enquiry_report.clear();
                    $.each(data,function(k,v){
                        enquiry_report.row.add(v);
                    });
                    enquiry_report.draw();
                },'json');
            } else{
                var admission_class = $('.enquiry_admission_class_report').val();
                $.post('<?=site_url('Reports/enquiry_admission_class_report')?>',{admission_class:admission_class},function(data){
                    console.log(data);
                    enquiry_report.clear();
                    $.each(data,function(k,v){
                        enquiry_report.row.add(v);
                    });
                    enquiry_report.draw();
                },'json');
            };
        }) 
        

        var enquiry_report = $('.dataTables-example1').DataTable({
            "paging": true,
            "pageLength": 10,
            "searching": false,
            "ordering": true,
            "info": true,
            "data": [],
            "columns": [
            {
                "title":"Form Number",
                "data":"enquiry_form_no"
            },
            {
                "title": "First Name",
                "data": "enquiry_student_first_name",
            },
            {
                "title": "Mother Name",
                "data": "enquiry_mother_first_name",
            },
            {
                "title": "Father Name",
                "data": "enquiry_parent_first_name",
            },
            {
                "title": "Last Name",
                "data": "enquiry_student_last_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "enquiry_student_DOB"
            },
            {
                "title": "Gender",
                "data": "enquiry_student_gender"
            },
            {
                "title": "Mobile No.",
                "data": "enquiry_parent_mobile_number"
            },
            {
                "title": "Admission Class",
                "data": "enquiry_admission_class"
            },
            {
                "title": "Appoinment Date",
                "data": "enquiry_appointment_date"
            },
            {
                "title": "Meeting Review",
                "data": "enquiry_meeting_review"
            },
            {
                "title": "Present Address",
                "data": "enquiry_residential_address"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }

        });

        var class_division_report = $('.dataTables-example2').DataTable({
            "paging": true,
            "pageLength": 10,
            "searching": false,
            "ordering": true,
            "info": true,
            "data": [],
            "columns": [
            {
                "title":"GRN Number",
                "data":"student_GRN"
            },
            {
                "title":"Adhar Card Number",
                "data":"student_adhar_card_number"
            },
            {
                "title": "First Name",
                "data": "student_first_name",
            },
            {
                "title": "Last Name",
                "data": "student_last_name",
            }, 
            {
                "title": "Date Of Birth",
                "data": "student_DOB"
            },
            {
                "title": "Gender",
                "data": "student_gender"
            },
            {
                "title": "Class",
                "data": "class_name"
            },
            {
                "title": "Division",
                "data": "division_name",
                "defaultContent": "<i>N/A</i>"
            }],
            "language": {
                "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
            }

        });

        var data_gov = $('.dataTables-example-gov').DataTable({
            pageLength: 10,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                // {
                //     "extend": 'print',
                   
                //     title:'',
                //     // footer:true,
                //     customize: function ( win ) {
                //       $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' Student Parent Contact Details </td></center></tr>')
                //     },
                // },
                {"extend": 'excel', title: 'All Student Details'},
                // {"extend": 'pdf', title: ''+class_name+' Student Parent Contact Details'},
            ],
            "language": {
                "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
            }

        });

        var all_report = $('.dataTables-example-all').DataTable({
            pageLength: 25,
            responsive: true,
            // ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            "buttons": [
                // {extend: 'copy'},
                // {
                //     "extend": 'print',
                   
                //     title:'',
                //     // footer:true,
                //     customize: function ( win ) {
                //       $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">'+class_name+' Student Parent Contact Details </td></center></tr>')
                //     },
                // },
                {"extend": 'excel', title: 'All Student Details'},
                // {"extend": 'pdf', title: ''+class_name+' Student Parent Contact Details'},
            ],
            "language": {
                "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
            },

        });
        // genral.row.child();

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
     
            // Get the column API object
            var column = all_report.column( $(this).attr('data-column') );
     
            // Toggle the visibility
            column.visible( ! column.visible() );
        } );

        $( all_report.table().container() ).on( 'keyup', 'tfoot input', function () {
            all_report
                .column( $(this).data('index') )
                .search( this.value )
                .draw();
        });

        var sms = $('.dataTables-example-SMS').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            "buttons": [
                {"extend": 'excel', title: 'All Student SMS Details'},
            ],
            "language": {
                "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
            },

        });

        $(".select2_demo").select2({
            placeholder: "Select a Town",
            allowClear: true,
        });  
        $(".select2-container").css("width", "100%"); 
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>