    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12" style="padding-right:inherit;">
            	<div class="row">
            		<div class="col-sm-5">
		                <div class="ibox float-e-margins">
		                    <?php if ($user_type == 3) { ?>
		                    <div class="ibox-title" style="border:none !important;">
		                        <div class="row">
		                            <div class="col-sm-6">
		                                <h3 class="new_grade"><b>Assign Grade Scale</b></h3>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="ibox-content">
		                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addGrade" action="<?=site_url('Exam/grade_registration')?>">
		                            <div class="form-group">
		                                <label class="col-lg-4 control-label">Grade<span style="color:red;">*</span></label>
		                                <div class="col-lg-7">
		                                   <input type="text" class="form-control" name="GC_grade" placeholder="Grade Name">
		                               </div>
		                            </div>
		                           	<div class="form-group">
		                               <label class="col-lg-4 control-label">Lower Mark Range<span style="color:red;">*</span></label>
		                               <div class="col-lg-7">
		                                   <input type="text" class="form-control" name="GC_lower_mark_range" id="lower_mark_range" placeholder=" Lower Mark Range" >
		                               </div>
		                           	</div>
		                            <div class="form-group">
		                               <label class="col-lg-4 control-label">Higher Mark Range<span style="color:red;">*</span></label>
		                               <div class="col-lg-7">
		                                   <input type="text" class="form-control" name="GC_higher_mark_range" placeholder=" Higher Mark Range" id="GC_higher_mark_range">
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
	                		<?php } ?>
	                	</div>
	                </div>
	                <div class="col-sm-7">
		                <div class="ibox-title">
		                    <div class="row">
		                        <div class="col-sm-6">
		                            <h3><b>Grade Details</b></h3>
		                        </div>
		                    </div>
		                </div>
		                <div class="ibox-content">
		                    <div class="table-responsive">
		                        <table class="table table-striped table-bordered table-hover dataTables-example" >
		                            <thead>
		                                <tr>
		                                    <th>Sr No.</th>
		                                    <th>Grade</th>
		                                    <th>Lower Mark</th>
		                                    <th>Higher Mark</th>
		                                    <th>Action</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <?php 
		                                $i = 1;
		                                foreach ($grade_details as $key) { ?>
		                                <tr>                
		                                    <th><?php echo $i++; ?></th>
		                                    <th><?=$key['GC_grade']?></th>
		                                    <th><?=$key['GC_lower_mark_range']?></th>
		                                    <th><?=$key['GC_higher_mark_range']?></th>
		                                    <th><a href="<?=site_url('Exam/delete_grade/'.$key['GC_id'])?>"><span class="btn btn-xs btn-primary"><i class="fa fa-trash" title="Delete"></i></span></a></th>
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