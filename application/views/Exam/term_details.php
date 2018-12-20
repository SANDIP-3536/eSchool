    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" style="padding-right:inherit;">
                <div class="ibox float-e-margins">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ibox-title" style="border:none !important;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><b>New Term</b></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addTerm" action="<?=site_url('Exam/term_registration')?>">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Term Name<span style="color:red;">*</span></label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="term_name">
                                                <option value="Term I">Term I</option>
                                                <option value="Term II">Term II</option>
                                                <option value="Term III">Term III</option>
                                                <option value="Term IV">Term IV</option>
                                                <option value="Term V">Term V</option>
                                                <option value="Term VI">Term VI</option>
                                                <option value="Term VII">Term VII</option>
                                                <option value="Term VIII">Term VIII</option>
                                                <option value="Term VIII">Term VIII</option>
                                                <option value="Term IX">Term IX</option>
                                                <option value="Term X">Term X</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Start Date<span style="color:red;">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Start Date" name="term_start_date" class="form-control datepicker" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">End Date<span style="color:red;">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="End Date" name="term_end_date" class="form-control datepicker" readonly>
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
                        <div class="col-sm-6">
                            <div class="ibox-title" style="border:none !important;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><b>Term Details</b></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Term Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 1;
                                            foreach ($term_details as $key) { ?>
                                            <tr>                
                                                <th><?php echo $i++; ?></th>
                                                <th><?=$key['term_name']?></th>
                                                <th><?=$key['term_start_date']?></th>
                                                <th><?=$key['term_end_date']?></th>
                                                <th><a href="<?=site_url('Exam/delete_term/' .$key['term_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-trash" title="Delete Term"></i></span></th>
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