<style type="text/css">
.popover.bottom {
    z-index: 2050 !important;
}
   </style>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Class Timetables</b></h3>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content notification_hide">
                           <!-- <form method="post" class="form-horizontal" enctype="multipart/form-data" id="" action="<?=site_url('Timetable/add_timetable')?>"> -->
                           <form method="post" class="form-horizontal" enctype="multipart/form-data" id="add_lecture" action="#">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Class</label>
                                    <div class="col-sm-3">
                                        <select class="form-control class_details class_name" name="class_name">
                                                <option>Select Class</option>
                                                <?php foreach ($class_details as $key) { ?>
                                                    <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label">Division</label>
                                    <div class="col-sm-3">
                                        <select class="form-control division_details division" name="division">
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-2" id="print_btn" hidden>
                                        <input type='button' class="btn btn-warning" id="print_timetable" value='Print Timetable' onclick='printDiv("timetable_view");'/>
                                        <!-- <input type='button' class="btn btn-warning" id="print_timetable" value='Print Timetable'/> -->
                                    </div>
                                </div>
                                <div class="form-group" id="days_select" hidden>
                                    <label class="col-lg-2 control-label">Select Working Days</label>
                                    <div class="col-sm-6">
                                       
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Monday" name="days[]">
                                            <label> Monday </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Tuesday" name="days[]">
                                            <label> Tuesday </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Wednesday" name="days[]">
                                            <label> Wednesday </label>
                                        </div>
                                         <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Thursday" name="days[]">
                                            <label> Thursday </label>
                                        </div>
                                         <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Friday" name="days[]">
                                            <label> Friday </label>
                                        </div>
                                         <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Saturday" name="days[]">
                                            <label> Saturday </label>
                                        </div>
                                         <div class="checkbox checkbox-inline">
                                            <input type="checkbox" class="days" value="Sunday" name="days[]">
                                            <label> Sunday </label>
                                        </div>
                                    </div>
                                </div>
                           

                         <div class="modal inmodal" id="add_time_table" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-clock-o modal-icon"></i>
                                            <h4 class="modal-title">Add Lecture</h4>
                                            <small>Select Subject, Teacher, Lecture timing.</small>
                                            <h5 class="modal-title day_name">Day</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="add_one_plus">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Subject</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control subject_details subject_name" name="subject_name">
                                                           
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Teacher</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control teacher_details teacher_name" name="teacher_name">
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-lg-2 control-label">Start Time</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group clockpicker" data-autoclose="true">
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-clock-o"></span>
                                                        </span>
                                                        <input type="text" class="form-control tt_start_time" name="tt_start_time" readonly>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 control-label">End Time</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group clockpicker" data-autoclose="true">
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-clock-o"></span>
                                                        </span>
                                                        <input type="text" class="form-control tt_end_time" name="tt_end_time" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <center>
                                                <h5 class="label label-danger warning" style="font-size: 15px;"></h5>
                                            </center>    
                                            </div>
                                            
                                            <!-- <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-4">
                                                    <button class="btn btn-info add_one" type="button">Add New</button>
                                                </div>
                                            </div> -->
                                           
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary add_lecture1">Save</button>
                                            <input type="hidden" class="add_lecture" value="save">
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form> 


                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover timetable">
                                    <thead>
                                    <tr id= "days">
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <tr id= "timetable_row">
                                        
                                    </tr>  
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row" id="timetable_view" hidden>
                                <!-- <div class="row"  id="page_header">
                                    <img src="<?=$school_report_header ?>" width="100%">
                                    <br>
                                </div><br> -->
                                <center><h3 class="timetable_head"></h3></center> 
                                <div class="table-responsive" style="padding: 0;">
                                    <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 0px;">
                                                <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="monday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Monday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="monday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">    
                                                <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="tuesday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Tuesday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tuesday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">      
                                               <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="wednesday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Wednesday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="wednesday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">      
                                               <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="thursday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Thursday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="thursday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">      
                                               <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="friday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Friday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="friday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">      
                                               <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="saturday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Saturday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="saturday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">      
                                               <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="sunday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <td>Sunday</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="sunday">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                        </tr>    
                                    </table>
                                </div>
                                <!-- <div class="row"  id="page_footer">
                                    <img src="<?=$school_report_footer ?>" width="100%">
                                    <br>
                                </div><br> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// function myFunction()
// {
//      var page_header = document.getElementById("page_header");
//         var page_footer = document.getElementById("page_footer");
//         page_header.style.visibility = 'hidden';
//         page_footer.style.visibility = 'hidden';
//         alert("alerttt");
// }
function printDiv(divName) {
        var printButton = document.getElementsByClassName("delete_day_time_table");
        // var page_header = document.getElementById("page_header");
        // var page_footer = document.getElementById("page_footer");
        // page_header.style.visibility = 'hidden';
        // page_footer.style.visibility = 'hidden';
        for (var i = 0; i < printButton.length; i++) 
        {
            var printButton1 = document.getElementsByClassName("delete_day_time_table")[i];
            printButton1.style.visibility = 'hidden';
        };  

       var printContents = document.getElementById(divName).innerHTML;     
       var originalContents = document.body.innerHTML;       
       document.body.innerHTML = printContents;      
       window.print();      
       document.body.innerHTML = originalContents;

        for (var i = 0; i < printButton.length; i++) 
        {
            var printButton1 = document.getElementsByClassName("delete_day_time_table")[i];
            printButton1.style.visibility = 'visible';
        };
   }
</script>