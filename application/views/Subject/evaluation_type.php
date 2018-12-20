        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3><b>Evaluation Type</b></h3>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="ibox-tools">
                                                <!-- <span class="btn btn-xs btn-primary" id="toggle_route"> Add </span>      -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content class_details_hide">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addEval" action="<?=site_url('School_class/eval_registration')?>">
                                         <div class="form-group">
                                            <label class="col-lg-2 control-label">Type<span style="color:red;">*</span></label>
                                            <div class="col-lg-7">
                                                <select name="eval_type" class="form-control">
                                                    <option value="0">Select Type</option>
                                                    <option value="1"> Formative Evaluation</option>
                                                    <option value="2"> Summative Evaluation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Name<span style="color:red;">*</span></label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="Evaluation Name" name="eval_name" class="form-control">
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
                                            <h3><b>Evaluation Details</b></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                $i = 1;
                                                foreach ($eval as $key) { ?>
                                                <tr>
                                                    <th><?php echo $i++; ?></th>
                                                    <th>
                                                       <?php if($key['eval_type'] == 1){
                                                            echo "Formative Evaluation";
                                                        }elseif ($key['eval_type'] == 2) {
                                                            echo "Summative Evaluation";
                                                        }?>
                                                    </th>
                                                    <th><?=$key['eval_name']?></th>
                                                    <th><a href="<?=site_url('School_class/delete_eval/'.$key['eval_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-trash"></i></span></a></th>
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