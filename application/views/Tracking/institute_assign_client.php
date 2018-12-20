<!-- <div id="page-wrapper" class="gray-bg"> -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row" id="info">
                <div class="col-lg-offset-2 col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Tracking <small>Sign in here to connect with Tracking</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                                    <p>Sign in for tracking.</p>
                                    <form role="form">
                                        <div class="form-group"><label>Username</label> <input type="text" placeholder="Enter Username" class="form-control username"></div>
                                        <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control password"></div>
                                        <div>
                                            <span class="btn btn-sm btn-primary pull-right m-t-n-xs" type="" id="get_client_id"><strong>Connect</strong></span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6"><h4>Not a member?</h4>
                                    <p>Please contact admin:</p>
                                    <p class="text-center">
                                        <a href="#"><i class="fa fa-sign-in big-icon"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div id="connect" hidden>
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8">
                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Connect Institude to Tracking</h5>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="<?=site_url('Tracking/assign_school_tracking')?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <input type="text" class="form-control" name="assgn_client_id" id="assgn_client_id" value = "" placeholder="Select Client ID" readonly>
                                       <br>
                                        <input type="text" class="form-control" name="assgn_school_name" id="assgn_school_name" value = "" placeholder="Select School" readonly>
                                        <input type="hidden" name="assgn_school_id" id="assgn_school_id" value = "">
                                        <!-- <br><div class="info1"><input type="text" class="form-control" placeholder="Select Employee from employee list" readonly></div> -->
                                    </div>
                                </div> 
                                <div class="hr-line-dashed"></div>
                               
                                <div class="form-group form_btn" hidden>
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Assign</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
            <div class="row">
                <div class="col-lg-offset-2 col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>List of School</h5>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example table-condensed" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>School Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class="school_list">
                                    <?php $i = 1; foreach ($all_school as $key) {  ?>
                                        <?php if ($key['school_client_profile_id'] == "0") { ?>
                                            <tr class="select_school" title="<?=$key['school_name']?>@<?=$key['school_profile_id']?>">
                                        <?php }else{ ?>
                                            <tr class="" title="<?=$key['school_name']?>@<?=$key['school_profile_id']?>">
                                        <?php } ?>
                                                <td><?=$i?></td>
                                                <td><?=$key['school_name']?>
                                                <?php if ($key['school_client_profile_id'] != "0") { ?>
                                                    <label class="btn btn-danger btn-xs confirm_delete remove_client_id" title="<?=$key['school_profile_id']?>"><i class="fa fa-trash-o delete" title="Delete"></i> </label>
                                                <?php } ?>
                                                </td>
                                    </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>  
                        </div> 
                    </div>
                </div>
                <!-- <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>List of Client Id</h5>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content" style="padding-bottom: 2px;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th> Client ID </th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;" class="client_id">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div> -->
            </div>
        </div>
    
    <!-- </div> -->
        