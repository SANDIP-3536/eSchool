    <style type="text/css">
    .total_payment_accoding_student tr,.total_payment_accoding_student td,.total_payment_accoding_student th{
        border:none;
    }
    </style>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom:0%;">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3><b>Student Class</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content notification_hide">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label class="col-lg-1 control-label">Class</label>
                                <div class="col-sm-2">
                                    <select class="form-control class_details1" name="class_name">
                                        <option value="0">Select Class</option>
                                        <?php foreach ($class_details as $key) { ?>
                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">Division</label>
                                <div class="col-sm-2">
                                    <select class="form-control division_details1" name="division">
                                    </select>
                                </div>
                                <label class="col-lg-1 control-label">Student</label>
                                <div class="col-sm-3">
                                    <select class="form-control student_details1 select2_demo" name="student">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="hidden" id="fee_status_detailssss">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Student Payment Details</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Type ID</th>
                                                        <th>Term</th>
                                                        <th>Fee Category</th>
                                                        <th>Total Fee</th>
                                                        <th>Fee Waiver Name</th>
                                                        <th>Fee Waiver Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="student_details_accor">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="ibox-title">
                                            <div class="row">
                                                <div class="col-sm-12" style="text-align:right;">
                                                    <span class="btn btn-xs btn-success student_new_payment"><i class="fa fa-inr"> Make Payment</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                </thead>
                                                <tbody class="total_payment_accoding_student">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><br><br>
                    <div class="hidden" id="payment_history_details">
                        <div class="row slider_down">
                            <div class="col-sm-6" style="padding-right:0px;">
                                <div class="ibox-title" style="border-top:2px solid;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="hidden" id="student_advance_payment_history_header"><b>Advance Payment History</b></h3>
                                            <h3 id="student_regular_payment_history_header"><b>Payment History</b></h3>
                                        </div>
                                        <div class="col-sm-6" style="text-align:right;">
                                            <!-- <span class="btn btn-xs btn-success" id="student_advance_payment_history"><i class="fa fa-inr"></i> Advance Payment History</span> -->
                                            <span class="btn btn-xs btn-success hidden" id="student_regular_payment_history"><i class="fa fa-inr"> Regular Payment History</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" id="regular_payment_history">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Type</th>
                                                <th>Payment Date</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="payment_history">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive hidden" id="advance_payment_history">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Last Payment Date</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="payment_advance_history">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="ibox-title" style="border-top:2px solid;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Make Payment</b></h3>
                                        </div>
                                        <div class="col-sm-6" style="text-align:right;">
                                            <span class="btn btn-xs btn-success" id="student_new_advance_payment"><i class="fa fa-inr"> Advance Payment</i></span>
                                            <span class="btn btn-xs btn-success hidden" id="student_new_make_payment"><i class="fa fa-inr"> Make New Payment</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content"  id="make_new_payments">
                                    <!-- <form class="form-horizontal" role="form" method="post" id="addNotification3" action="<?=site_url('Fee/add_student_payment')?>"> -->
                                    <form class="form-horizontal" role="form" method="post" id="addNotification3">
                                        <input type="hidden" class="fee_student_profile_id" name="fee_student_profile_id" id="student_profile_id">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Total Amount</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control total_amt" id="fees_total_amount" readonly="" name="total_amt" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Remaining Amount<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control remain_amt" id="balance" name="remain_amt" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Paid<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control fee_amount" id="paidamt" name="fee_amount">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Date<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control fee_datetime" name="fee_datetime" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d h:i'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Note</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control fee_narration" name="fee_narration"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Mode<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-control fee_payment_mode" id="pay_mode" name="fee_payment_mode">
                                                    <option value="0">- Choose Mode -</option>
                                                    <option value="1">Cash</option>
                                                    <option value="2">NEFT/RTGS/IMPS</option>
                                                    <option value="3">Cheque</option>
                                                    <!-- <option value="4">Advance Payment</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div id="pay_detail_cheque">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Bank Name</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control bank_name" name="bank_name" id="bank1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Cheque No.</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control fee_transaction_number" name="fee_transaction_number" id="chq">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pay_detail_card">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Bank Name</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control bank_name" name="bank_name" id="bank2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Trasaction No.</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control fee_transaction_number" name="fee_transaction_number" id="card">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <span type="" class="btn btn-primary hidden" id="add_student_payment">Submit</span>
                                                <span type="" class="btn btn-primary" id="disabled_add_student_payment" disabled>Submit</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ibox-content  hidden" id="make_advance_payments">
                                    <form class="form-horizontal" role="form" method="post" id="addNotification4" action="#">
                                        <input type="hidden" name="advance_student_profile_id" id="advance_student_profile_id">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Amount<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control"  name="advance_amount" id="advance_amount">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Date<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" name="advance_datetime" id="advance_datetime" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d h:i'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Note</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" name="advance_narration" id="advance_narration"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Mode<span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-control advance_payment_mode" id="advance_pay_mode" name="advance_payment_mode">
                                                    <option value="0">- Choose Mode -</option>
                                                    <option value="1">Cash</option>
                                                    <option value="2">NEFT/RTGS/IMPS</option>
                                                    <option value="3">Cheque</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="advance_pay_detail_cheque">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Bank Name<span style="color:red;">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="bank_name" id="advance_bank1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Cheque No.<span style="color:red;">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="advance_transaction_number" id="advance_transaction_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="advance_pay_detail_card">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Bank Name<span style="color:red;">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="bank_name" id="advance_bank2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Trasaction No.<span style="color:red;">*</span></label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="advance_transaction_number1" id="advance_transaction_number1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <span type="" class="btn btn-primary hidden" id="add_student_advance_payment">Submit</span>
                                                <span type="" class="btn btn-primary" disabled id="disabled_add_student_advance_payment">Submit</span>
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
    </div>
</div>       