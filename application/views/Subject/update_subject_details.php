        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3><b>Edit Subject</b></h3>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="ibox-tools">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSubject" action="<?=site_url('Subject/edit_subject_registration')?>">
                                <?php foreach ($school_subject as $key) { ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" value="<?=$key['class_name']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Name<span style="color:red;">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="text" placeholder="Subject Name" name="subject_name" class="form-control" value="<?=$key['subject_name']?>" readonly>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-lg-2 control-label">Evaluation<span style="color:red;">*</span></label>
                                    <div class="col-lg-7">
                                        <select data-placeholder="Choose a Evaluation type..." name="eval_id[]" class="chosen-select" multiple tabindex="4">
                                            <option value="0">-Select Evaluation-</option>
                                            <?php foreach ($eval as $key) { ?>
                                                <option value="<?=$key['eval_id']?>"><?=$key['eval_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
                                <?php } ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-5 col-sm-offset-3">
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary enableOnInput" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>