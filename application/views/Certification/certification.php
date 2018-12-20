    <style type="text/css">
    .select2-container{
        width: 224px !important;
    }
    .table > thead > tr > td{
            padding: 15px;
    }
    </style>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Certification</b></h3>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="tabs-container">
                                <div class="tabs-left">
                                    <ul class="nav nav-tabs" style="width:15% !important;">
                                        <li class="active" id="bonafide"><a data-toggle="tab" href="#bonafide_tab"> Bonafide</a></li>
                                        <li class="" id="leaving"><a data-toggle="tab" href="#leaving_tab">Leaving Certificate</a></li>
                                    </ul>
                                    <div class="tab-content ">
                                        <div id="bonafide_tab" class="tab-pane active">
                                            <div class="panel-body" style="margin-left:15% !important; width:85%;">
                                                <h3> <b> Bonafide Certificate </b></h3>
                                                <div class="wrapper wrapper-content animated fadeInRight">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="ibox float-e-margins">
                                                                <div class="ibox-content">
                                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="">
                                                                        <div class="form-group">
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Class</label> 
                                                                                        <select class="form-control student_class" name="student_class" style="border-radius:3px;">
                                                                                            <option value="" disabled selected>Select Class Type</option> 
                                                                                            <?php foreach ($class as $key) {?>
                                                                                                <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                            <?php } ?>                                                                                          
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Division</label> 
                                                                                        <select class="form-control student_division" name="student_division" style="border-radius:3px;">
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Student</label>
                                                                                        <select class="form-control student_details1 select2_demo" name="student" id="student_details_bonafide"></select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group" id="btn" hidden style="margin-top: 20px;">
                                                                                    <!-- <div class="col-sm-5 col-sm-offset-1">    -->
                                                                                        <!-- <span class="btn btn-success" id="PDF" >Download</span> -->
                                                                                        <!-- <span class="btn btn-success create_bonafide">Create Bonafide</span> -->
                                                                                        <!-- <button class="btn-info btn btn-xs" title="'+v.Student_profile_id+'">Create</button> -->
                                                                                        <input type='button' class="btn btn-success" id="PDF" value='Print & Download' onclick='printDiv("certificate");'/>
                                                                                    <!-- </div> -->
                                                                                </div> 
                                                                            </div>

                                                                        </div>
                                                                         
                                                                    </form>
                                                                    <div class="hr-line-dashed"></div>
                                                                    <div id="example" style="" hidden>
                                                                        <div id="certificate">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="leaving_tab" class="tab-pane">
                                            <div class="panel-body" style="margin-left:15% !important; width:85%;">
                                                <h3> <b> Leaving Certificate </b></h3>
                                                <div class="wrapper wrapper-content animated fadeInRight">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="ibox float-e-margins">
                                                                <div class="ibox-content">
                                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="">
                                                                        <div class="form-group">
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Class</label> 
                                                                                        <select class="form-control student_class" name="student_class" style="border-radius:3px;">
                                                                                            <option value="" disabled selected>Select Class Type</option> 
                                                                                            <?php foreach ($class as $key) {?>
                                                                                                <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                                                            <?php } ?>                                                                                          
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Division</label> 
                                                                                        <select class="form-control student_division" name="student_division" style="border-radius:3px;">
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="col-sm-10">   
                                                                                    <div class="form-group">
                                                                                        <label class="control-label" style="padding-bottom:2%">Student</label>
                                                                                        <select class="form-control student_details1 select2_demo" name="student" id="student_details_LC">
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group" id="btn_LC" hidden style="margin-top: 20px;">
                                                                                    <!-- <span class="btn btn-success" id="PDF_LC" onclick='printDiv("certificate_LC");'>Make Alumni</span> -->
                                                                                    <span class="btn btn-success" id="PDF_LC" >Make Alumni</span>
                                                                                    <span class="btn btn-success hidden" id="PDF_LC_download" onclick='printDiv("certificate_LC");'>Download</span>
                                                                                   
                                                                                   <!-- <input type='button' class="btn btn-warning" id="print_LC" value='Print LC' onclick='printDiv("certificate_LC");'/> -->
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    <div class="hr-line-dashed"></div>
                                                                    <div id="example_LC" hidden>
                                                                        <div id="certificate_LC">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="certificate1" style="font-size:27px;color: #000;" hidden>   
                            </div>
                            <div id="certificate_LC1" style="font-size:27px;color: #000;" hidden>   
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