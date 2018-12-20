<style type="text/css">
    .image-upload > input ,.image-upload1 > input 
    {
        display: none;
    }

    .image-upload img,  .image-upload1 img
    {
        width: 80px;
        cursor: pointer;
    }
    label.error {
        display: inherit;
    }
</style>
<div class="wrapper wrapper-content animated fadeIn" style="padding: 0px;">
    <div class="row">
        <div class="col-lg-12" style="padding: 0px;">
            <div class="tabs-container">
                <ul class="nav nav-tabs" style="display: flex;">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Check IN</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Check OUT</a></li>
                </ul>
                <div class="tab-content" style="width: 100%;">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body" style="padding-bottom: 10%;">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="newVisitor" action="<?=site_url('Security/add_visitor_checkin')?>">
                               <!--  <div class="form-group">
                                    <label class="col-sm-2 control-label">Student<span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_demo_3"  name="visitor_student_id"  required style="width: 100% !important;">
                                            <option value="0"> Unregistered Student</option>
                                            <?php foreach ($student as $key) {?>
                                                <option value="<?=$key['student_profile_id']?>"><?=$key['student_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Token <span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control  select2_demo_3" name="visitor_token" style="width: 100% !important;">
                                            <option value="0">Please Select Token</option>
                                            <?php foreach ($token as $key) {?>
                                                <option value="<?=$key['no']?>"><?=$key['no']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="display: inline-flex;padding: 0px 20%;">
                                    <div class="col-sm-12">
                                        <div class="form-group" style="text-align: center;">
                                            <label class="control-label" style="padding-bottom:2%">&nbsp Visitor Photo <span style="color:red;">*</span></label> 
                                            <div class="image-upload1">
                                                <label for="file-input">
                                                    <img src="https://cdn2.iconfinder.com/data/icons/network-and-communication-9/28/9_user_profie_avatar_male_upload-512.png" id="image_profile" style="border-radius: 40%;" />
                                                </label>
                                                <input id="file-input" type="file" name="visitor_photo" class="form-control image-profile" accept="image/jpeg, image/png, image/gif" onchange="loadphoto(event)"/><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" style="text-align: center;">
                                            <label class="control-label" style="padding-bottom:2%">ID Photo <span style="color:red;">*</span></label> 
                                            <div class="image-upload">
                                                <label for="file-input1">
                                                    <img src="https://cdn2.iconfinder.com/data/icons/network-and-communication-9/28/9_user_profie_avatar_male_upload-512.png" id="image_card"/>
                                                </label>
                                                <input id="file-input1" type="file" name="visitor_id_card_photo" class="form-control" accept="image/jpeg, image/png, image/gif" onchange="loadcard(event)"/><br>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                               <!--  <div class="form-group">
                                    <label class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-8">
                                        <textarea name="visitor_comment" rows="4" style="width: 100%;"></textarea>
                                    </div>
                                </div> -->
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <center><button class="btn btn-primary" type="submit">Check IN</button></center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="newVisitorCheckOut" action="<?=site_url('Security/add_visitor_checkout')?>" target="_blank">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Token<span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2_demo_3"  name="visitor_id"  id="visitor_token_history" required style="width: 100% !important;">
                                            <option value="0"> Please Select Token</option>
                                            <?php foreach ($visitor_token as $key) {?>
                                                <option value="<?=$key['visitor_id']?>"><?=$key['visitor_token']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row hidden" id="visitor_details_with_token">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-sm-offset-3">
                                                <center>
                                                    <img class="rouded img-responsive" id="student_photo" src="<?=base_url()?>profile_photo/default_student_image.png" style="width: 70%;border-radius: 5%;"><br><figcaption><b>student Photo</b></figcaption></img>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="control-label col-sm-1" style="text-align: left;">Name</label>
                                            <label class="control-label col-sm-1" style="text-align: center;">:</label>
                                            <label class="control-label col-sm-6" id="student_name" style="text-align: left;">Daphal Sandip Karbhari</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1" style="text-align: left;">Token</label>
                                            <label class="control-label col-sm-1" style="text-align: center;">:</label>
                                            <label class="control-label col-sm-2" id="token_number" style="text-align: left;">17</label>
                                            <label class="control-label col-sm-1" style="text-align: left;">CheckIN</label>
                                            <label class="control-label col-sm-1" style="text-align: center;">:</label>
                                            <label class="control-label col-sm-4" id="checkIn" style="text-align: left;"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1" style="text-align: left;">Reason</label>
                                            <label class="control-label col-sm-1" style="text-align: center;">:</label>
                                            <label class="control-label col-sm-6" id="get_pass_reason" style="text-align: left;">17</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <center><!--<a href="<?=site_url('Teacher/view_teacher')?>"><span class="btn btn-white" type="reset">Cancel</span></a> -->
                                        <button class="btn btn-primary" type="submit">Check OUT & Verified</button></center>
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
<script type="text/javascript">
    var loadphoto = function(event) {
        var output = document.getElementById('image_profile');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadcard = function(event) {
        var output = document.getElementById('image_card');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>