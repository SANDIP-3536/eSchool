    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#acc_group">Account Group</a></li>
                <li class=""><a data-toggle="tab" href="#voc_master">Vocher Master</a></li>
                <li class=""><a data-toggle="tab" href="#voc_head">Vocher Head</a></li>
                <li class=""><a data-toggle="tab" href="#cre_vocher"> Create Vocher</a></li>
            </ul>
            <div class="tab-content">
                <div id="acc_group" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_exam"><b>Account Group</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_exam" style="padding-left: 10%;padding-right: 26%;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="acc_group_val" action="<?=site_url('DayBook/acc_group_registration')?>">
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Account Name <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="acc_grp_name" class="form-control" placeholder="Please Enter the Account Name.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Group Under</label>
                                                <div class="col-lg-12">
                                                    <select name="acc_grp_acc_grp_id" class="form-control">
                                                        <option value="0">Please Select the Legder Sub Group</option>
                                                        <?php foreach ($acc_group as $key) { ?>
                                                            <option value="<?=$key['acc_grp_id']?>"><?=$key['acc_grp_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Opening Balance<span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="acc_grp_open_balance" class="form-control" placeholder="Please Enter the Account Opening Balance">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5 col-sm-offset-3">
                                                    <button class="btn btn-white close_data" type="reset">Cancel</button>
                                                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Account Group Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Name</th>
                                                        <th>Opening Balance</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($acc_group as $key) { ?>
                                                    <tr>                
                                                        <th><?php echo $i++; ?></th>
                                                        <th><?=$key['acc_grp_name']?></th>
                                                        <th><?=$key['acc_grp_open_balance']?></th>
                                                        <th>
                                                            <a href="<?=site_url('DayBook/delete_acc_group/' .$key['acc_grp_id'])?>"><span class="btn btn-xs btn-warning" style="background-color:red;"><i class="fa fa-trash " title="Delete Account"></i></span></a>
                                                        </th>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="voc_master" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_exam_marks"><b>Vocher Master</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_exam_marks" style="padding-left: 10%;padding-right: 26%;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="voc_master_val" action="<?=site_url('DayBook/voc_master_registration')?>">
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Master <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="voc_master_name" class="form-control" placeholder="Please Enter the Vocher Master.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Group Under <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="voc_master_type" class="form-control">
                                                        <option value="0">Please Select</option>
                                                        <option value="1">Credit</option>
                                                        <option value="2">Debit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5 col-sm-offset-3">
                                                    <button class="btn btn-white close_data" type="reset">Cancel</button>
                                                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Vocher Master Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Vocher Master</th>
                                                        <th>Credit/Debit</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($voc_master as $key) { ?>
                                                    <tr>                
                                                        <th><?php echo $i++; ?></th>
                                                        <th><?=$key['voc_master_name']?></th>
                                                        <?php if($key['voc_master_type'] == '1'){ ?>
                                                            <th>Credit</th>
                                                        <?php }else{ ?>
                                                            <th>Debit</th>
                                                        <?php } ?>
                                                        <th><a href="<?=site_url('DayBook/delete_voc_master/' .$key['voc_master_id'])?>"><span class="btn btn-xs btn-warning" style="background-color:red;"><i class="fa fa-trash " title="Delete Vocher Master"></i></span></a></th>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="voc_head" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class=""><b>Vocher Head</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content" style="padding-left: 10%;padding-right: 26%;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="voc_head_val" action="<?=site_url('DayBook/voc_head_registration')?>">
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Head Name <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="voc_head_name" class="form-control" placeholder="Please Enter the Vocher Head Name.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Master <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="voc_head_voc_master_id" class="form-control">
                                                        <option value="0">Please Select the Vocher Master</option>
                                                        <?php foreach ($voc_master as $key) { ?>
                                                            <option value="<?=$key['voc_master_id']?>"><?=$key['voc_master_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Account Group <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="voc_head_acc_grp_id" class="form-control">
                                                        <option value="0">Please Select Account Group</option>
                                                        <?php foreach ($acc_group as $key) { ?>
                                                            <option value="<?=$key['acc_grp_id']?>"><?=$key['acc_grp_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Number<span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="voc_head_number" class="form-control" placeholder="Please Enter the Vocher Master Number">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5 col-sm-offset-3">
                                                    <button class="btn btn-white close_data" type="reset">Cancel</button>
                                                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Vocher Head Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Vocher Head</th>
                                                        <th>Vocher Master</th>
                                                        <th>Legder Account</th>
                                                        <th>Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($voc_head as $key) { ?>
                                                    <tr>                
                                                        <th><?php echo $i++; ?></th>
                                                        <th><?=$key['voc_head_name']?></th>
                                                        <th><?=$key['voc_head_voc_master_name']?></th>
                                                        <th><?=$key['voc_head_acc_grp_name']?></th>
                                                        <th><?=$key['voc_head_number']?></th>
                                                        <th>
                                                            <a href="<?=site_url('DayBook/delete_voc_head/' .$key['voc_head_id'])?>"><span class="btn btn-xs btn-warning" style="background-color:red;"><i class="fa fa-trash " title="Delete Vocher Head"></i></span></a>
                                                        </th>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="cre_vocher" class="tab-pane">
                   <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class=""><b>Create Vocher</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content" style="padding-left: 10%;padding-right: 26%;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="cre_vocher_val" action="<?=site_url('DayBook/cre_vocher_registration')?>">
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Transaction Date <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="cre_vocher_date" class="form-control" value="<?php echo date('Y-m-d')?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Master <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="cre_vocher_master_id" class="form-control" id="vocher_master_id">
                                                        <option value="0">Please Select the Vocher Master</option>
                                                         <?php foreach ($voc_master as $key) { ?>
                                                            <option value="<?=$key['voc_master_id']?>"><?=$key['voc_master_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Head <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="cre_vocher_head" class="form-control" id="vocher_head_details">
                                                        <option value="0">Please Select Vocher Head</option>
                                                        <?php foreach ($voc_head as $key) { ?>
                                                            <option value="<?=$key['voc_head_id']?>"><?=$key['voc_head_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;">Credit Ledger Account <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="cre_vocher_credit_legder_acc" class="form-control">
                                                        <option value="0">Credit Ledger Account</option>
                                                        <?php foreach ($acc_group as $key) { ?>
                                                            <option value="<?=$key['acc_grp_id']?>"><?=$key['acc_grp_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Debit Ledger Account <span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="cre_vocher_debit_legder_acc" class="form-control">
                                                        <option value="0">Debit Ledger Account</option>
                                                        <?php foreach ($acc_group as $key) { ?>
                                                            <option value="<?=$key['acc_grp_id']?>"><?=$key['acc_grp_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Payment Mode<span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <select name="cre_vocher_payment_mode" class="form-control">
                                                        <option value="0">Select Payment Mode</option>
                                                        <option value="1">Cash</option>
                                                        <option value="2">Card</option>
                                                        <option value="3">NFTP/IMPS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Amount<span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="cre_vocher_amount" class="form-control" placeholder="Please Enter the Vocher Amount">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Narration<span style="color:red;">*</span></label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="cre_vocher_narration" class="form-control" placeholder="Please Enter the Vocher Narration">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-5 col-sm-offset-3">
                                                    <button class="btn btn-white close_data" type="reset">Cancel</button>
                                                    <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right:inherit;">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Vocher Details</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Vocher Number</th>
                                                        <th>Transcation Date</th>
                                                        <th>Vocher Master</th>
                                                        <th>Vocher Head</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 1;
                                                    foreach ($cre_vocher as $key) { ?>
                                                    <tr>                
                                                        <th><?=$key['cre_vocher_id']?></th>
                                                        <th><?=$key['cre_vocher_date']?></th>
                                                        <th><?=$key['cre_vocher_master_name']?></th>
                                                        <th><?=$key['cre_vocher_head_name']?></th>
                                                        <th>
                                                            <a href="<?=site_url('DayBook/update_cre_vocher/' .$key['cre_vocher_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-pencil " title="Edit Vocher"></i></span></a>
                                                            &nbsp <a href="<?=site_url('DayBook/delete_cre_vocher/' .$key['cre_vocher_id'])?>"><span class="btn btn-xs btn-warning" style="background-color:red;"><i class="fa fa-trash " title="Delete Vocher"></i></span></a>
                                                        </th>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
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
    </div>
   <!--  <div id="verify_evaluation_marks" class="modal fade" role="dialog">
        <form method="post" class="form-horizontal" id="eval_verification" action="<?=site_url('Exam/evaluation_status_update')?>" enctype="multipart/form-data">
            <div class="modal-dialog" style="margin-left: 21%;width: 58%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="modal-title">Student Marks Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                       <div class="form-group hidden">
                            <label class="col-sm-2 control-label">Fees ID</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_id_assign" name="marks_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Student Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control marks_student_assign" name="marks_student_proifle_id" readonly>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Outoff Marks</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control exam_outoff_marks_assign" name="exam_outoff_marks" id="exam_outoff_marks_eval" readonly>
                            </div>
                            <label class="col-sm-2 control-label">Exam Evaluation</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control exam_evaluation_assign" name="exam_evaluation_marks" id="exam_evaluation_marks_eval" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Exam Marks <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_exam_marks_assign" name="marks_obtained" id="marks_obtained_eval">
                            </div>
                            <label class="col-sm-2 control-label">Evaluation Marks <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control marks_evaluation_assign" name="marks_evaluation" id="marks_evaluation_eval">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Evaluation Status <span style="color: red;">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="marks_status">
                                    <option value="0">Select Status</option>
                                    <option value="2">Not Verified</option>
                                    <option value="1">Verified</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> -->
</div>