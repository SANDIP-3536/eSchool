 <style type="text/css">

        th{
            
        }
        td{
            white-space: nowrap !important;
        }
       /* table tbody tr:last-child td {
           /*font-size: 16px;
           border-right:none;
           font-weight: bold;
        }*/

        .data_daily tbody tr:last-child td {
           /*font-size: 16px;*/
           border-right:1px solid #e7eaec;
           font-weight: inherit;
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
           /* table tbody tr:last-child td {
               border:none !important;
               font-weight: bold;
            }*/
            table {
               border-top:none !important;
               border-bottom:none !important;
               border-right:none !important;
               border-left:none !important;
            }
            .pb_before_avoid {
               page-break-before: avoid !important;
           }

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
    /*input {
        width: auto !important;
    }*/
        </style>
        <div class="loader_half"></div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <!-- <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Fee Reports Detail</b></h3>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="ibox-content"> -->
                            <div class="tabs-container">
                                <!-- <div class="tabs-left"> -->
                                    <ul class="nav nav-tabs">
                                        <li class=""><a href="#" style="padding: 10px 100px 6px 20px;background-color: #fff;margin-right: 5px;"> <h3><b>Fee Reports Detail</b></h3></a></li>
                                        <li class="active total_fee_report"><a data-toggle="tab" href="#total_fee_report"> Total Fee Report</a></li>
                                        <li class="fee_due_report"><a data-toggle="tab" href="#fee_due_report">Fee Balance Report</a></li>
                                        <li class="paid_fee_report"><a data-toggle="tab" href="#paid_fee_report">Fee Paid Report</a></li>
                                        <li class="fee_category_report"><a data-toggle="tab" href="#fee_category_report">Fee Category Wise Report</a></li>
                                        <li class="fee_waiver_report"><a data-toggle="tab" href="#fee_waiver_report">Fee Waiver Report</a></li>
                                        <li class="view_daily_payment_report"><a data-toggle="tab" href="#daily_payment_report">Daily Payment Report</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="total_fee_report" class="tab-pane active">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" style="width:100%;">
                                                        
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <!-- <th>Father Name</th> -->
                                                                <!-- <th>Gender</th> -->
                                                                <th>Mobile No.</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Total Fee Amount</th>
                                                                <th>Total Fee Waiver Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Balance</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fee_due_report" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example1" style="width: 100%;">
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <th>Mobile No.</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Total Fee Amount</th>
                                                                <th>Total Fee Waiver Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Balance</th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="paid_fee_report" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example_paid" style="width: 100%;">
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <th>Mobile No.</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Total Fee Amount</th>
                                                                <th>Total Fee Waiver Amount</th>
                                                                <th>Paid Amount</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fee_category_report" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example_category" style="width:100%;">
                                                        
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <!-- <th>Father Name</th> -->
                                                                <!-- <th>Gender</th> -->
                                                                <th>Mobile No.</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Fee Type name</th>
                                                                <th>Fee Category</th>
                                                                <th>Fee Type Amount</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fee_waiver_report" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example_waiver" style="width:100%;">
                                                       
                                                        <tfoot>
                                                            <tr>
                                                                <th>GRN No.</th>
                                                                <th>Student Name</th>
                                                                <!-- <th>Father Name</th> -->
                                                                <!-- <th>Gender</th> -->
                                                                <!-- <th>Mobile No.</th> -->
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Total Fee Amount</th>
                                                                <th>Total Fee Waiver Amount</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="daily_payment_report" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="ibox-content">
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="StudentReport">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-1 col-sm-offset-1">From</label> 
                                                            <div class="col-sm-2" style="width: 13%;">
                                                                <input type="text" class="form-control datepicker date-range-filter" name="" style="border-radius:3px;" id="day_book_from" value="<?php echo date('Y-m-d')?>" readonly>
                                                            </div>
                                                            <label class="control-label col-sm-1" style="width: 3%;">To</label> 
                                                            <div class="col-sm-2" style="width: 13%;">
                                                                <input type="text" class="form-control datepicker date-range-filter" name="" style="border-radius:3px;" id="day_book_to" value="<?php echo date('Y-m-d')?>" readonly>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <span class="btn btn-sm btn-info view_datewise_daily_payment_report">View</span>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="row" style="background-color: #000;color: #fff;padding: 3px;">
                                                                    <div class="col-sm-offset-1 col-sm-6">
                                                                        <h3>Total Amount : Rs.</h3> 
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <h3 class="total_amount"></h3> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- <div class="hr-line-dashed"></div> -->
                                                    <div class="table-responsive">
                                                        <table class="table data_daily table-striped table-bordered table-hover dataTables-example_daily" style="width:100%;">
                                                                <tfoot class="pb_before_avoid">
                                                                    <tr>
                                                                        <th>SR No.</th>
                                                                        <th>Date</th>
                                                                        <th>Time</th>
                                                                        <th>GRN No.</th>
                                                                        <th>Student Name</th>
                                                                        <th>Class</th>
                                                                        <th>Division</th>
                                                                        <th>Amount</th>
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
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>