       <style type="text/css">
       .dataTables_empty{
            display: none;
       }
       </style>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Tracking</b></h3>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <form method="post" class="form-horizontal" action="<?=site_url('Tracking/assign_tracking')?>" enctype="multipart/form-data" id="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content">
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-3">
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
                                                            <!-- <div class="col-sm-3">
                                                                <div class="col-sm-10">   
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="padding-bottom:2%">Division</label> 
                                                                        <select class="form-control student_division" name="student_division" style="border-radius:3px;">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-sm-3">
                                                                <div class="form-group" id="btn" hidden style="margin-top: 20px;">
                                                                    <button class="btn btn-success" type="submit">Assign Tracking</button>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                         
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content">
                                                    <div class="table-responsive stu_list" hidden>
                                                        <table class="table table-striped table-bordered table-hover table-condensed dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Student GRN</th>
                                                                    <th>Division</th>
                                                                    <th>Student Name</th>
                                                                    <th>Father</th>
                                                                    <th>Mother</th>
                                                                    <th>Gardian</th>
                                                                    <!-- <th>Selected</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>