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
                                <div  class="col-sm-offset-4 col-sm-2" id="print_btn">
                                    <input type='button' class="btn btn-warning btn-xs" id="" value='Print Timetable' onclick='printDiv("timetable_view");'/>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                           <form method="post" class="form-horizontal" enctype="multipart/form-data" id="" action="#">
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Class</label>
                                    <div class="col-sm-3">
                                        <select class="form-control class_details class_name" name="class_name">
                                                <option value="" selected disabled>Select Class</option>
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
                                    
                                    
                                </div> -->
                              
                        <div class="ibox-content" style="border: none !important;">
                            <div class="row" id="timetable_view" hidden><br>
                               <center><h3 class="timetable_head" style="width: 95%;"></h3></center> 
                                <div class="table-responsive" style="padding: 0;">
                                    <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 0px;">
                                                <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="time_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <th style="text-align: center;">Time</th> 
                                                        </tr>
                                                        </thead>
                                                        <tbody id="time">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>    
                                            <td style="padding: 0px;">
                                                <div class="table-responsive col-sm-1" style="padding: 0;width: 100%;" id="monday_table" hidden>
                                                    <table class="table table-bordered table-hover " style="margin-bottom: 0px;">
                                                        <thead>
                                                        <tr>
                                                           <th style="text-align: center;">Monday</th> 
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
                                                           <th style="text-align: center;">Tuesday</th> 
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
                                                           <th style="text-align: center;">Wednesday</th> 
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
                                                           <th style="text-align: center;">Thursday</th> 
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
                                                           <th style="text-align: center;">Friday</th> 
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
                                                           <th style="text-align: center;">Saturday</th> 
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
                                                           <th style="text-align: center;">Sunday</th> 
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
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;     
       var originalContents = document.body.innerHTML;       
       document.body.innerHTML = printContents;      
       window.print();      
       document.body.innerHTML = originalContents;
   }
</script>