        <div class="wrapper wrapper-content animated fadeInRight">
        	<div class="row">
        		<div class="col-lg-12">
        			<div class="ibox float-e-margins">
        				<div class="ibox-title">
        					<div class="row">
        						<div class="col-sm-6">
        							<h3><b>Update Fee Type Details</b></h3>
        						</div>
        					</div>
        				</div>
        				<div class="ibox-content">
        					<form method="post" class="form-horizontal" enctype="multipart/form-data" id="addNotification" action="<?=site_url('Fee/fee_types_edit')?>">
        						<div class="form-group">
                                <?php foreach ($fee_types as $key) { ?>
                                    <input type="text" class="form-control hidden" name="fees_type_id" placeholder="Fee Type Name" value="<?=$key['fees_type_id']?>">
                                   <label class="col-lg-2 control-label">Name</label>
                                   <div class="col-sm-3">
                                        <input type="text" class="form-control" name="fees_type_name" placeholder="Fee Type Name" value="<?=$key['fees_type_name']?>" readonly>
                                    </div>
                                    <label class="col-lg-2 control-label">Class</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="fees_type_class_id" placeholder="Fee Type Name" value="<?=$key['class_name']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-2 control-label">Fee Category</label>
                                   <div class="col-sm-3">
                                        <input type="text" class="form-control" name="fees_type_amount" id="update_fees_type_amount" placeholder="Fee Type Amount" value="<?=$key['fee_category_name']?>" readonly>
                                    </div> 
                                    <label class="col-lg-2 control-label">Amount</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="fees_type_amount" id="update_fees_type_amount" placeholder="Fee Type Amount" value="<?=$key['fees_type_amount']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?=site_url('Fee/fee_setup')?>"><span class="btn btn-white">Cancel</span></a>
                                        <button class="btn btn-primary enableOnInput" type="submit">Update</button>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="hr-line-dashed"></div>
                                <div class="col-sm-offset-1 col-sm-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <td colspan="2"><?php echo $total_fee_amount[0]['total_amount'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>GRN No.</th>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                <th>Amount</th>
                                            </tr>
                                            <?php foreach ($student_details as $key) {?>
                                            <tr>
                                                <td><?=$key['student_GRN']?></td>
                                                <td><?=$key['student_name']?></td>
                                                <td><?=$key['class_name']?></td>
                                                <td><?=$key['total_fee_amount']?></td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <td colspan="2" class="update_total_fee_amount"><?php echo $total_fee_amount[0]['total_amount'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>GRN No.</th>
                                                <th>Student Name</th>
                                                <th>Class</th>
                                                 <th class="hidden">Student id</th>
                                                <th>Amount</th>
                                            </tr>
                                            <?php foreach ($student_details as $key) {?>
                                            <tr>
                                                <td><?=$key['student_GRN']?></td>
                                                <td><?=$key['student_name']?></td>
                                                <td><?=$key['class_name']?></td>
                                                <td class="hidden"><input type="text" name="total_fee_student_profile_id[]" value="<?=$key['student_profile_id']?>"></td>
                                                <td class="updated_fee_amount"><?=$key['total_fee_amount']?></td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3 hidden">
                                        <input type="text" class="form-control" id="total_student" value="<?php echo $total_fee_amount[0]['total_new_fee_amount'] ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      