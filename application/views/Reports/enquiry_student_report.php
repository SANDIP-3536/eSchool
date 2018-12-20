<style type="text/css">

    th{
        text-align:center;
    }
    td{
        white-space: nowrap !important;

    }
    table.dataTable th,
    table.dataTable td {
        white-space: nowrap !important;
    }

    .dataTables-example-all tr:last
    {
          width: 100%;
    }

    @media print{
        th{
            text-align: center;
        }
        td{
            white-space: nowrap !important;
            font-size : 16px;
        }
        dt-title{
            text-align: center;
        }
        table tbody tr:last-child td {
           /*border:none !important;*/
           font-weight: bold;
        }
        table {
           border-top:none !important;
           border-bottom:none !important;
           border-right:none !important;
           border-left:none !important;
        }
    } 
    .ibox-content
    {
        padding: 0px;
        border-width: 0px 0;
    }
    .top-navigation .wrapper .wrapper-content
    {
        padding-top: 0px;
    }
    .dataTables-example-all table table td:nth-child(10)
    {
          /*white-space:: 100%;*/
    }
    .loader_half {
        position: fixed;
        right: 0px;
        bottom: 92px;
        width: 100%;
        height: 69%;
        z-index: 9999;
        background: url('<?=base_url()?>assets/img/pageLoader1.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
    .dataTables_scrollHeadInner{
        display: none;
    }
    .dataTables_wrapper {
        padding-bottom: 0px;
    }
</style>

</style>
<div class="loader_half"></div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-12" style="padding: 0;">
            <div class="ibox float-e-margins">
              <!--   <div class="ibox-title">
                    <div class="row">
                        <div class="col-sm-6">
                            
                        </div>
                    </div>
                </div> -->
                <div class="ibox-content">
                        <div class="tabs-container">
                            <!-- <div class="tabs-left"> -->
                                <ul class="nav nav-tabs">
                                    <li style="margin-right: 3%;"><a href="#" style="padding: 10px 15px 0 15px;"> <h3><b>Student & Enquiry Reports Detail</b></h3></a></li>
                                    <li class="active"><a data-toggle="tab" href="#general_register"> General Register</a></li>
                                    <li class="govern_class_division_report"><a data-toggle="tab" href="#govern_class_division_report">Government Report</a></li>
                                    <li class="sms_report"><a data-toggle="tab" href="#sms_report">SMS Report</a></li>
                                    <li class="All_report"><a data-toggle="tab" href="#All_report">All Report</a></li>
                                    <li class="doc_report"><a data-toggle="tab" href="#doc_report">Document Report</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="general_register" class="tab-pane active">
                                        <div class="panel-body">
                                                            <div class="ibox-content">
                                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="StudentReport">
                                                                    <div class="form-group">
                                                                        <div style="padding-right: 0px;text-align: right;"> 
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="11"><span>Last School</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="12"><span>Admission Class</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="13"><span>Progress</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="14"><span>Conduct</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="15"><span>LC Date</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="16"><span>LC Reason</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="17"><span>Last A.Y.</span></a>
                                                                            <a class="toggle-vis1 btn btn-sm btn-default" data-column="18"><span>Last Class</span></a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <div class="table-responsive" style="width:100% !important">
                                                                    <table class="table table-striped table-bordered table-hover dataTables-example"  cellspacing="0" width="100%">
                                                                         <thead>
                                                                            <tr>
                                                                                <th rowspan="2">GRN No.</th>
                                                                                <th colspan="3">Student Name</th>
                                                                                <th rowspan="2">Religion</th>
                                                                                <th rowspan="2">Cast</th>
                                                                                <th rowspan="2">Sub Cast</th>
                                                                                <th rowspan="2">Birth Place</th>
                                                                                <th rowspan="2">Nationality</th>
                                                                                <th rowspan="2">DOB</th>
                                                                                <th rowspan="2">Admission Date</th>
                                                                                <th rowspan="2">Last School</th>
                                                                                <th rowspan="2">Admission Class</th>
                                                                                <th rowspan="2">Progress</th>
                                                                                <th rowspan="2" style="display: table-cell !important;">Conduct</th>
                                                                                <th rowspan="2">LC Date</th>
                                                                                <th rowspan="2">LC Reason</th>
                                                                                <th rowspan="2">Last A.Y.</th>
                                                                                <th rowspan="2">Last Class</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Last Name</th>
                                                                                <th>First Name</th>
                                                                                <th>Middle Name</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($genral as $key) { ?>
                                                                            <tr>
                                                                                <td><?=$key['student_GRN']?></td>
                                                                                <td><?=$key['student_last_name']?></td>
                                                                                <td><?=$key['student_first_name']?></td>
                                                                                <td><?=$key['student_middle_name']?></td>
                                                                                <td><?=$key['student_religion']?></td>
                                                                                <td><?=$key['student_cast']?></td>
                                                                                <td><?=$key['student_sub_cast']?></td>
                                                                                <td><?=$key['student_birth_place']?></td>
                                                                                <td><?=$key['student_nationality']?></td>
                                                                                <td><?=$key['DOB']?></td>
                                                                                <td><?=$key['admission_date']?></td>
                                                                                <td><?=$key['student_privious_school_name']?></td>
                                                                                <td><?=$key['class_of_admission']?></td>
                                                                                <td><?=$key['student_progress']?></td>
                                                                                <td class="old_parent"><?=$key['student_conduct']?></td>
                                                                                <td><?=$key['student_LC_date']?></td>
                                                                                <td><?=$key['student_LC_reason']?></td>
                                                                                <td><?=$key['last_AY_name']?></td>
                                                                                <td><?=$key['last_class_of_admission']?></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                        </div>
                                    </div>
                                    <div id="govern_class_division_report" class="tab-pane">
                                        <div class="panel-body" >
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example-gov" style="width:100% !important;">
                                                    <!--  -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sms_report" class="tab-pane">
                                        <div class="panel-body" >
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example-SMS" style="width:100% !important;">
                                                   
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="All_report" class="tab-pane">
                                        <div class="panel-body" style="padding-top: 5px;">
                                            <div class="ibox-content">
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="StudentReport">
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <div style="padding-right: 0px;"> 
                                                            <a class="toggle-vis btn btn-sm btn-primary" data-column="0"><span>Roll No</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-primary" data-column="3"><span>Gender</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="4"><span>Adhar Card</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="5"><span>DOB</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="6"><span>Birth Place</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="7"><span>Blood Group</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="8"><span>Town</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="9"><span>Address</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="10"><span>Admission Date</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-primary" data-column="11"><span>Class</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-primary" data-column="12"><span>Division</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="13"><span>Category</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="14"><span>Religion</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="15"><span>Cast</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="16"><span>SubCast</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="17"><span>Father Name</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="18"><span>Father Mobile No</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="19"><span>Mother Name</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="20"><span>Mother Mobile No</span></a>
                                                            <a class="toggle-vis btn btn-sm btn-default" data-column="21"><span>Signature</span></a>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example-all" style="width:100% !important;">
                                                        
                                                        <tfoot>
                                                             <tr>
                                                                <th>Roll No.</th>
                                                                <th>Student Name</th>
                                                                <th>GRN No.</th>
                                                                <th>Gender</th>
                                                                <th>Adhar Card</th>
                                                                <th>DOB</th>
                                                                <th>Birth Place</th>
                                                                <th>Blood Group </th>
                                                                <th>Town</th>
                                                                <th>Address</th>
                                                                <th>Admission Date</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Category</th>
                                                                <th>Religion</th>
                                                                <th>Cast</th>
                                                                <th>Sub Cast</th>
                                                                <th>Father Name</th>
                                                                <th>Mobile No.</th>
                                                                <th>Mother Name</th>
                                                                <th>Mobile No.</th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="doc_report" class="tab-pane">
                                        <div class="panel-body" >
                                            <div class="ibox-content">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example-doc" style="width:100% !important;">
                                                       
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Student Photo.</th>
                                                                <th>Father Photo.</th>
                                                                <th>Mother Photo.</th>
                                                                <th>Adhar Card.</th>
                                                                <th>Transfer Cert.</th>
                                                                <th>Leaving Cert.</th>
                                                                <th>Birth Cert.</th>
                                                                <th>Medical Cert.</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>