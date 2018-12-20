        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>New Subject</b></h3>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="ibox-tools">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content class_details_hide">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSubject" action="<?=site_url('Subject/subject_registration')?>">
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                            <div class="col-lg-7">
                                                <select name="subject_class_id" class="form-control">
                                                    <option value="0">Select Class</option>
                                                    <?php foreach ($school_class as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Name<span style="color:red;">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="Subject Name" name="subject_name" class="form-control device">
                                                <label class="class_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                                            </div>
                                        </div>

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
                        <div class="col-lg-6">
                                <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Subject Details</b></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Class Name</th>
                                                <th>Subject Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 1;
                                                foreach ($school_subject as $key) { ?>
                                                <tr>
                                                    <th><?php echo $i++; ?></th>
                                                    <th><?=$key['class_name']?></th>
                                                    <th><?=$key['subject_name']?></th>
                                                    <th><a href="<?=site_url('Subject/delete_subject/'.$key['subject_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></a>
                                                        <!-- <a href="<?=site_url('Subject/edit_subject/'.$key['subject_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></span></a> --></th>
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