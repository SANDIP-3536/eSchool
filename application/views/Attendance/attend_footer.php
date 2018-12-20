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
         $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
           $('a[href="' + activeTab + '"]').tab('show');
        }
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        <?php if($education == 'education'){?>
             $('#education').addClass('active');
             $('#attendance').addClass('active');
             document.title="eSchool | Attendance"
        <?php } ?>

        $('.month_date').datepicker({
            format:"yyyy-mm-dd",
            minViewMode: 1,
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true
        });

        

       // create DateTimePicker from input HTML element
       var today = new Date();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                endDate: "today",
                maxDate: today
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
        
        $(document).on('change','.fetch_class_details',function(){
            $('.fetch_subject_details').empty();
            var class_id = $(this).val();
            $.post('<?=site_url('Attendance/fetch_teacher_acor_SCD')?>',{class_id:class_id},function(data){
                console.log(data);
                $(".fetch_subject_details").append('<option value="0">-Select Class Teacher-</option>')
                $.each(data,function(k,v){
                    $(".fetch_subject_details").append('<option value="'+v.TCDS_id+'">'+v.employee_first_name+' '+v.employee_last_name+'</option>');
                });
            },'json');
        });

        // $('#delete_att_record').click(function() {
        //     if (confirm("Are You Sure? Do You Want To Delete It?"))
        //         return ture;
        //     else
        //         return false;
        // });

        $(document).on('click','#delete_att_record',function(){
            if (confirm("Are You Sure? Do You Want To Delete It?")){

                var class_div = $('.fetch_class_details').val();
                var class_div_split = class_div.split("-");
                var class_att = class_div_split[0];
                var div_att = class_div_split[1];
                var date = $('#date_att').val();
                $('.dataTables-example1 tbody').empty();
                // $('.dataTables-example1').DataTable().destroy();
                $.post('<?=site_url('Attendance/delete_att_record')?>',{date_att:date,class_att:class_att,div_att:div_att},function(data){
                    console.log(data);
                },'json');

                swal({
                    title: "Deleted Succeefully!",
                    type: "success"
                });

                $('.del_btn').addClass('hidden');
            }
            else
                return false;
        });

        $(document).on('click','#att_record',function(){
            
            $(".loader").fadeIn("slow");
            $('.fetch_class_attendance_status').empty();
            // var TCDS_id = $('.fetch_subject_details').val();
            var class_div = $('.fetch_class_details').val();
            var class_div_split = class_div.split("-");
            var class_att = class_div_split[0];
            var div_att = class_div_split[1];
            var date = $('#date_att').val();
			var sel_date = new Date(date);
			var day = sel_date.getDate();
			var month = sel_date.getMonth();
			var year = sel_date.getFullYear();
			var class_name='';
            $('#date_time').text(date);
            $.post('<?=site_url('Attendance/fetch_att_records')?>',{date_att:date,class_att:class_att,div_att:div_att},function(data){
                console.log(data);
                if (data != '')
                {
                    $('.del_btn').removeClass('hidden');
                }else{
                    $('.del_btn').addClass('hidden');
                }
				class_name=class_div_split[2]+' ('+class_div_split[3]+')';
                $('.dataTables-example1').DataTable().destroy();
				// console.log(data);
                var table = $('.dataTables-example1').DataTable({
                    // scrollY: height1,
                    // scrollCollapse: true,
                    // paging: false,
					order: [[ 1, "asc" ]],
                    pageLength: 10,
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [{
                       extend: 'print',
					   title: '',
					   exportOptions: {
                       columns: [ 1, 2, 3, 4, 5 ] //Your Colume value those you want
                           },
					   customize: function ( win ) { $(win.document.body).prepend( '<img src="<?php echo $header ?>" />' );$(win.document.body).find('h1').css('text-align', 'center');
					   $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Attendance Report for Date "'+day+'/'+month+'/'+year+'" of '+class_name+' Class</td></tr>')
					   }
					}
                    ],
                    info:false,
                    data: data,
                    columns:[
                        {title: "ID",data:"attend_id",visible:false},
                        {title: "Roll No",data:"SCD_Roll_No"},
                        {title: "Student Name",data:"name"},
                        {title: "In-Time",data:"in_time"},
                        {title: "Out-Time",data:"out_time"},
                        {title: "Status",data:"attend_status_name",sClass:""},
						{title: "Action",data:null,defaultContent:"<span class='btn btn-primary btn-xs' data-toggle='modal' id='12799' data-target='#editAttendance'><i class='fa fa-pencil'></i></span>"},
						
                    ]

                        });

                 $('.dataTables-example1 tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();

                    // $(this).addClass(''+data.attend_id+'');
                    // console.log(data.attend_id);
                    $(this).find('td:nth-child(5)').addClass('ok'+data.attend_id+'');
                    $('#attend_id_edit1').val(data.attend_id);
                    // alert( 'You clicked on '+data.attend_id+'   '+data.SCD_Roll_No+'\'s row' );
                } );

                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }

            },'json');
            
        });
        
        

        $(document).on('click','#att_month_record',function(){
            $(".loader").fadeIn("slow");
            // $('.print_btn').removeClass('hidden');
            var test = $('.fetch_class_details_monthly').val();
            var test1 = test.split("-");
            var class_id = test1[0];
            var division_id = test1[1];
            var selected_month = $('#selected_month').val();
            var split_date = selected_month.split('-');
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var month_cnt = split_date[1]-1;
            var month_name = months[month_cnt];
            var month = month_name+' '+split_date[0];
            var total_table;var total_avg;
                
            $('#total_table').empty();
            $('#attendance_table').empty();
            $('#att_dates').empty();

            if ($.fn.DataTable.isDataTable('.dataTables-print')){
                $('.dataTables-print').DataTable().clear().destroy();
            }

            $.post('<?=site_url('Attendance/attendance_grid_view')?>',{class_id:class_id,division_id:division_id,selected_month:selected_month},function(data1){
                console.log(data1);
                if (data1.total != '')
                {
                    total_avg = +data1.total[0].Average + +data1.total[1].Average;
                    total_table = '<table class="table table-bordered"> <tr> <th style="text-align:center;">Description</th> <th style="text-align:center;">Total Girls</th> <th  style="text-align:center;">Total Boys</th> <th  style="text-align:center;">Total Student</th> <th  style="text-align:center;">Student Average</th><th  style="text-align:center;">Total Student Average</th> </tr> <tr> <th  style="text-align:center;">'+data1.total[0].g_type+'</th> <th  style="text-align:center;">'+data1.total[0].g_count+'</th> <th  style="text-align:center;">'+data1.total[0].b_count+'</th> <th  style="text-align:center;">'+data1.total[0].total+'</th> <th  style="text-align:center;">'+data1.total[0].Average+' % </th> <th  style="text-align:center;" rowspan="2">'+total_avg+' % </th> </tr> <tr> <th  style="text-align:center;">'+data1.total[1].g_type+'</th> <th  style="text-align:center;">'+data1.total[1].g_count+'</th>  <th  style="text-align:center;">'+data1.total[1].b_count+'</th> <th  style="text-align:center;">'+data1.total[1].total+'</th> <th  style="text-align:center;">'+data1.total[1].Average+' % </th> </tr></table>';
                    $('#total_table').empty().append(total_table);
                };
                // console.log(total_table);

                $('#attendance_table').empty();
                $('#att_dates').empty().append('<th>Roll No.</th>'+
                                        '<th>Student Name</th>'+
                                        '<th>GRN</th>'+
                                        '<th>DOB</th>');

                $.each(data1.date_details,function(k,v){
                    $('#att_dates').append('<th>'+v.date[8]+''+v.date[9]+'</th>');
                });

                $('#att_dates').append('<th>P</th>'+
                                        '<th>A</th>'+
                                        '<th>Total</th>');

                for (var i = 0; i < data1.student_details.length; i++) 
                {

                    if (data1.student_details[i].student_profile_id != "77777777" && data1.student_details[i].student_profile_id != "88888888" && data1.student_details[i].student_profile_id != "99999999" )
                    {
                        $('#attendance_table').append('<tr class="att_'+data1.student_details[i].student_profile_id+'">'+
                                                        '<td><b>'+data1.student_details[i].SCD_Roll_No+'</b></td>'+
                                                        '<td><b>'+data1.student_details[i].name+'</b></td>'+
                                                        '<td><b>'+data1.student_details[i].student_GRN+'</b></td>'+
                                                        '<td><b>'+data1.student_details[i].student_DOB+'</b></td>'+
                                                      '</tr>');

                    }else{
                        $('#attendance_table').append('<tr class="att_'+data1.student_details[i].student_profile_id+'" style="background-color: #f5f5f5;">'+
                                                        '<td style="background-color: #fff;border: none;" class="td_blank"></td>'+
                                                        '<td><b>'+data1.student_details[i].name+'</b></td>'+
                                                        '<td><b>'+data1.student_details[i].student_GRN+'</b></td>'+
                                                        '<td><b>'+data1.student_details[i].student_DOB+'</b></td>'+
                                                      '</tr>');
                    }

                    $.each(data1.attendance_details,function(k,v){
                        if (data1.student_details[i].student_profile_id == v.SCD_student_profile_id)
                        {
                            $('.att_'+v.SCD_student_profile_id+'').append(v.status == "-" ? '<td>'+v.status+'</td>' : (v.status == "A" ? '<td style="background-color: #fed1d1;">A</td>' : (v.status == "P" ? '<td style="">P</td>' : (v.status == "H" ? '<td style="background-color: yellow;">H</td>' : (v.status == "W" ? '<td style="background-color: #ddd;">W</td>' : '<td>'+v.status+'</td>')))));
                                                                          
                        };
                    });

                    if (data1.student_details[i].student_profile_id != "77777777" && data1.student_details[i].student_profile_id != "88888888" && data1.student_details[i].student_profile_id != "99999999" )
                    {
                            $('.att_'+data1.student_details[i].student_profile_id+'').append('<td style="background-color: lightblue;color: #000;"><b>'+data1.student_details[i].present+'</b></td>'+
                                                                                            '<td style="background-color: lightblue;color: #000;"><b>'+data1.student_details[i].absent+'</b></td>'+
                                                                                            '<td style="background-color: lightblue;color: #000;"><b>'+data1.student_details[i].working_day+'</b></td>');
                    }else{

                        $('.att_'+data1.student_details[i].student_profile_id+'').append('<td style="background-color: #fff;border: none;" class="td_blank"></td><td style="background-color: #fff;border: none;" class="td_blank"></td><td style="background-color: #fff;border: none;" class="td_blank"></td>');
                    }

                    if (i == (data1.student_details.length-1)) 
                    {
                        $(".loader").fadeOut("slow");
                    }

                };

                $('.dataTables-print').DataTable({
                    pageLength: 10,
                    paging: false,
                    responsive: true,
                    sorting: false,
                    dom: '<"html5buttons"B>lTfgitp',
					processing: true,
                    buttons: [

                        {extend: 'print', title: 'Attendance Report For : '+test1[2]+' ('+test1[3]+') | '+month+' ',
                            customize: function (win){
                                $(win.document.body).prepend( '<img src="<?php echo $header ?>" />' );
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).append(total_table);
                                $(win.document.body).find('h1').css('text-align', 'center');
                                $(win.document.body).find('table')
                                        .css({'font-size':'inherit','white-space': 'nowrap'});
                                $(win.document.body).append('<br><br><br><br><table style="width:100%;"><td>Class Teacher Signature</td><td>Principal Signature</td></tr></table>')
                            }

                        }
                    ],
					language: {
						loadingRecords: '&nbsp;',
						processing: 'Loading...'
					} 

                });

    
            },'json');

           

        });




            // $("#btnPrint").click(function () {
            //     var contents = $("#example").html();
            //     var frame1 = $('<iframe />');
            //     frame1[0].name = "frame1";
            //     frame1.css({ "position": "absolute", "top": "-1000000px" });
            //     $("body").append(frame1);
            //     var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            //     frameDoc.document.open();
            //     //Create a new HTML document.
            //     frameDoc.document.write('<html><head><title>DIV Contents</title>');
            //     frameDoc.document.write('</head><body>');
            //     //Append the external CSS file.
            //     frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
            //     //Append the DIV contents.
            //     frameDoc.document.write(contents);
            //     frameDoc.document.write('</body></html>');
            //     frameDoc.document.close();
            //     setTimeout(function () {
            //         window.frames["frame1"].focus();
            //         window.frames["frame1"].print();
            //         frame1.remove();
            //     }, 500);
            // });

            $(document).on('click','.edit_attendance',function(){
                var attend_id_edit1 = $('#attend_id_edit1').val();
                var attend_status = $('#attend_status').val();
                // console.log(attend_id_edit1);
                // console.log(attend_status);

                if (attend_status == "P")
                {
                    $('.ok'+attend_id_edit1+'').html('Present');
                }else{
                    $('.ok'+attend_id_edit1+'').html('Absent');
                }
                
			    $.post('<?=site_url('Attendance/edit_attendance')?>',{attend_id_edit1:attend_id_edit1,attend_status:attend_status},function(data1){
                    $("#editAttendance .close").click();
                },'json');
            });

                // $('.dataTables-example1 tbody').on( 'click', 'label', function () {
                //     var data = table.row( $(this).parents('tr') ).data();
                //     // console.log(data);

                //     var attend_id = data[0];
                //         $(this).remove();
                //     $.post('<?=site_url('Coins/update_status')?>',{attend_id:attend_id},function(data){

                //     },'json');

                // } );



// var atten = $('.dataTables-example').DataTable({
//             "pageLength": 10,
//             "responsive": true,
//             "ordering":true,
//             "dom": '<"html5buttons"B>lTfgitp',
//             "buttons": [
//                   {
//                         "extend": 'print',
//                   },
//                   //{"extend": 'excel', title: 'Classwise Attendance Report'},
//                   //{"extend": 'pdf', title: 'Classwise Attendance Report'},
//                   ],
//             "columns": [
//                  	{
// 	                    "title": "Roll No",
// 	                    "data": "SCD_Roll_No",
//                 	},
//                 	{
//                     	"title": "Student Name",
//                     	"data": "name",
//                 	},
//                 	{
//                     	"title": "In-Time",
//                     	"data": "in_time",
//                 	},
//                 	{
//                     	"title": "Out-Time",
//                     	"data": "out_time",
//                 	},               
//                 	{
//                     	"title": "Status",
//                     	"data": "attend_status_name",
//                 	}

//                     // { 
//                     //     "defaultContent": "awasads", 
//                     //     "data": "null"
//                     // }
//                 ],
//                 "language": {
//                     "emptyTable": "<img src='http://trackmee.syntech.co.in/trackmee/assets/img/No-record-found.png'> "
//                 }, 
//             });

        


    // $('.dataTables-example').DataTable({
    //     pageLength: 10,
    //     responsive: true,
    //     dom: '<"html5buttons"B>lTfgitp',
    //     buttons: [
    //     {extend: 'copy'},
    //     {extend: 'csv'},
    //     {extend: 'excel', title: 'ExampleFile'},
    //     {extend: 'pdf', title: 'ExampleFile'},
    //     {extend: 'print',
    //     customize: function (win){
    //         $(win.document.body).addClass('white-bg');
    //         $(win.document.body).css('font-size', '10px');

    //     }
    // }
    // ]
    // });

        var school_header = '<?php echo $header ?>';
        var school_footer = '<?php echo $footer ?>';
        $(document).on('change','.class_details,.attend_datetime',function(){
            $(".loader").fadeIn("slow");
            
            $('.student_details_accor').empty();
            $('.subject_details').empty();
            var class_id = $('.class_details').val();
            var date = $('.attend_datetime').val();
            $.post('<?=site_url('Attendance/fetch_student_acor_SCD')?>',{class_id:class_id,date:date},function(data){
                console.log(data);
                $.each(data,function(k,v){
                    $('.student_details_accor').append('<tr><td>'+v.SCD_Roll_No+'</td><td >'+v.student_name+'</td><td>'+v.class_name+'</td><td>'+v.division_name+'</td><td><input type="hidden" name="insert_status[]" value="'+v.attend_id+'"><div class="switch">'+
                                '<div class="onoffswitch">'+
                                    '<input type="checkbox" name="attend_status[]" value="'+v.SCD_id+'" class="onoffswitch-checkbox checking" id="example1_'+v.SCD_id+'" '+(v.attend_id == null ? '' : (v.attend_status == "P" ? 'checked disabled' : 'disabled'))+'>'+
                                    '<label class="onoffswitch-label" for="example1_'+v.SCD_id+'">'+
                                        '<span class="onoffswitch-inner"></span>'+
                                        '<span class="onoffswitch-switch"></span>'+
                                    '</label>'+
                                '</div>'+
                            '</div></td></tr>');
                            

                 });
                if (data[0].attend_id != null)
                {
                    $(".checkall").attr("disabled", true);
                    $(".holidayall").attr("disabled", true);
                    $(".weeklyoffall").attr("disabled", true);
                    $(".fill_att").attr("disabled", true);
                    $(".checking").attr("disabled", true);
                }else{
                    $(".checkall").attr("disabled", false);
                    $(".holidayall").attr("disabled", false);
                    $(".weeklyoffall").attr("disabled", false);
                    $(".fill_att").attr("disabled", false);
                    $(".checking").attr("disabled", false);
                }

                if ( $.fn.dataTable.isDataTable( '.dataTables-example' ) ) {}
                else{
                    // $('.dataTables-example').prepend('<tfoot><tr><td colspan="5">Snaip</td></tr></tfoot>');
                    $('.dataTables-example').DataTable({
                        "pageLength": 100,
                        "responsive": true,
                        "ordering": false,
                        "searching":false,
                        // "info": true,
                        "dom": '<"html5buttons"B>lTfgitp',
                        "buttons": [
                            // {extend: 'copy'},
                            {
                                "extend": 'print',
                               
                                title:'',
                                // footer:true,
                                // header:true,
                                customize: function ( win ) {
                                    $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="5"><img src="'+school_header+'"</td></tr><tr><td colspan="5" style="font-size:24px;text-align:center;border-bottom:none !important;"> Attendance Details </td></center></tr><tr><td colspan="3" style="font-size:24px;text-align:left;border-top:none !important;border-right:none !important;">Teacher : </td><td colspan="2" style="font-size:24px;text-align:left;border-top:none !important;border-left:none !important;">Date : </td></center></tr>')
                                },
                            }],
                    });
                }

                if (data != "-1") 
                { 
                    $(".loader").fadeOut("slow");
                }
                
            },'json');

            $.post('<?=site_url('Attendance/fetch_teacher_acor_SCD')?>',{class_id:class_id},function(data){
                console.log(data);
                $(".subject_details").append('<option value="0">-Select Class Teacher-</option>')
                $.each(data,function(k,v){
                    $(".subject_details").append('<option value="'+v.TCDS_id+'">'+v.employee_first_name+' '+v.employee_last_name+'</option>');
                });
            },'json');
        });
		

		$('#editAttendance').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.id;
            var attend_details = id.split('-');   

            $('#attend_id_edit').val(attend_details);
        });
		
        $(".checkall,.holidayall,.weeklyoffall").change(function(){  //"select all" change 
            $(".checking").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
        });
        $(".checkall").change(function(){ 
            $(".holidayall").attr("checked", false);
            $(".weeklyoffall").attr("checked", false);
        }); 
        $(".holidayall").change(function(){
            $(".weeklyoffall").attr("checked", false);
            $(".checkall").attr("checked", false);
        });
         $(".weeklyoffall").change(function(){ 
            $(".holidayall").attr("checked", false);
             $(".checkall").attr("checked", false);
        });

        $('.checking').change(function(){ 

            if(false == $(this).prop("checked")){ //if this item is unchecked
                $(".checkall").attr("checked", false);
            }

            // if ($('.checking:checked').length == $('.checking').length ){
            //     $(".checkall").attr("checked", true);
            // }
        });


        $(document).ready(function(){
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
        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>