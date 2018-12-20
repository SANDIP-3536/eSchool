    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <div class="row">
                <div class="col-lg-12" style="padding-right:inherit;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="border:none !important;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class=""><b>Create Vocher</b></h3>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content" style="padding-left: 10%;padding-right: 26%;">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="cre_vocher_val" action="<?=site_url('DayBook/update_cre_vocher_registration')?>">
                                <?php foreach ($vocher_details as $key) { ?>
                                    <div class="form-group hidden">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Number <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="cre_vocher_id" class="form-control" value="<?=$key['cre_vocher_id']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Transaction Date <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="cre_vocher_date" class="form-control" value="<?=$key['cre_vocher_date']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Master <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <select name="cre_vocher_master_id" class="form-control" readonly>
                                            <option value="<?=$key['cre_vocher_master_id']?>"><?=$key['cre_vocher_master_name']?></option>
                                             <!-- <?php foreach ($voc_master as $key1) { ?>
                                                <option value="<?=$key1['voc_master_id']?>"><?=$key1['voc_master_name']?></option>
                                            <?php } ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Vocher Head <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <select name="cre_vocher_head" class="form-control" readonly>
                                            <option value="<?=$key['cre_vocher_head_id']?>"><?=$key['cre_vocher_head_name']?></option>
                                            <!-- <?php foreach ($voc_head as $key2) { ?>
                                                <option value="<?=$key2['voc_head_id']?>"><?=$key2['voc_head_name']?></option>
                                            <?php } ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;">Credit Ledger Account <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <select name="cre_vocher_credit_legder_acc" class="form-control">
                                            <option value="<?=$key['cre_vocher_credit_legder_acc']?>"><?=$key['cre_vocher_credit_legder_acc_name']?></option>
                                            <?php foreach ($acc_group as $key3) { ?>
                                                <option value="<?=$key3['acc_grp_id']?>"><?=$key3['acc_grp_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Debit Ledger Account <span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <select name="cre_vocher_debit_legder_acc" class="form-control">
                                            <option value="<?=$key['cre_vocher_debit_legder_acc']?>"><?=$key['cre_vocher_debit_legder_acc_name']?></option>
                                            <?php foreach ($acc_group as $key4) { ?>
                                                <option value="<?=$key4['acc_grp_id']?>"><?=$key4['acc_grp_name']?></option>
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
                                        <input type="text" name="cre_vocher_amount" class="form-control" placeholder="Please Enter the Vocher Amount" value="<?=$key['cre_vocher_amount']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-12 control-label" style="margin-bottom: 2% !important;text-align: left;"> Narration<span style="color:red;">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="cre_vocher_narration" class="form-control" placeholder="Please Enter the Vocher Narration" value="<?=$key['cre_vocher_narration']?>">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-5 col-sm-offset-3">
                                        <a href="<?=site_url('DayBook/dayBook_details')?>"><span class="btn btn-white">Cancel</span></a>
                                        <button class="btn btn-primary enableOnInput" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>