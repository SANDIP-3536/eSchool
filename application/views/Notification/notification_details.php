        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 0%;">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#parent_meet_demo">Parent Meet</a></li>
                        <li class=""><a data-toggle="tab" href="#event_demo">Event</a></li>
                        <li class=""><a data-toggle="tab" href="#notice_demo">Circular Notice</a></li>
                        <li class=""><a data-toggle="tab" href="#news_demo">News Feeds</a></li>
                        <li class=""><a data-toggle="tab" href="#personalize">Personalize MSG</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="parent_meet_demo" class="tab-pane active">
                            <div class="panel-body">
                                <div class="ibox float-e-margins">
                                    <?php if($user_type == 3) { ?>
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_parent_meet"><b>New Parent Meet</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_parent_meet"><i class="fa fa-plus" title="New Parent Meet"></i></span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_parent_meet">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addPMNotification" action="<?=site_url('Notification/add_parent_meeting')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control class_details" name="class_name">
                                                        <option>Select Class</option>
                                                        <option value="0">All</option>
                                                        <?php foreach ($class_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Division</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control division_details" name="division">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Parent Meet Date<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control datepicker" name="notifi_date" placeholder="Notification Date" readonly>
                                                </div>
                                                <label class="col-lg-2 control-label">Parent Meet Time<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control start_time" name="notifi_time" placeholder="Notification Time" id="notifi_time">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Parent Meet Title<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" maxlength="100" name="notifi_title" placeholder="Notification Title" id="notifi_title">
                                                    <span class="title_characters"><span>
                                                </div>
                                                <label class="col-lg-2 control-label">Parent Meet Message<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <textarea cols="2" rows="3" class="form-control" name="notifi_msg" placeholder="Notification Message" maxlength="500" id="notifi_msg"></textarea>
                                                    <span class="characters"><span>
                                                </div>
                                            </div>
                                            <?php switch ($school_parentmeet_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="notifi_sms"> <i></i>  Sent SMS to Parent about meeting </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ibox-title">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h3><b>Student Details</b></h3>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="ibox-tools">
                                                                    <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>Student_profile_id</th>
                                                                    <th>Sr No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>GRN</th>
                                                                    <th>Class</th>
                                                                    <th>Division</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="student_details_accor">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-white close_new_entry" type="reset">Cancel</button>
                                                    <button class="btn btn-primary  addPMNotification" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Parent Meet History </b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Title</th>
                                                        <th>Message</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1;
                                                    foreach ($notification as $key1) { 
                                                        if($key1['notifi_type'] == '11'){?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['date']?></td> 
                                                        <td style="white-space: nowrap;"><?=$key1['time']?></td> 
                                                        <td><?=$key1['notifi_title']?></td>
                                                        <td><?=$key1['notifi_msg']?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['notification_count']?></td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="event_demo" class="tab-pane">
                            <div class="panel-body">
                                <div class="ibox float-e-margins">
                                    <?php if ($user_type == 3) { ?>
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_event"><b>New Event </b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_event"><i class="fa fa-plus" title="New Event"></i></span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_event">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addEVNotification" action="<?=site_url('Notification/add_event_notification')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control class_details_event" name="class_name">
                                                        <option>Select Class</option>
                                                        <option value="0">All</option>
                                                        <?php foreach ($class_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Division<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control division_details_event" name="division">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Event Date<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control datepicker" name="notifi_date" placeholder="Notification Date" readonly>
                                                </div>
                                                <label class="col-lg-2 control-label">Event Time<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control start_time" id="event_time" name="notifi_time" placeholder="Notification Time">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Event Title<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" maxlength="100" name="notifi_title" placeholder="Notification Title">
                                                    <span class="title_characters"><span>
                                                </div>
                                                <label class="col-lg-2 control-label">Event Message<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <textarea cols="2" rows="3" class="form-control" name="notifi_msg" placeholder="Notification Message" maxlength="500"></textarea>
                                                    <span class="characters"><span>
                                                </div>
                                            </div>
                                            <?php switch ($school_event_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="notifi_sms"> <i></i>  Sent SMS to Parent about Event </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ibox-title">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h3><b>Student Details</b></h3>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="ibox-tools">
                                                                    <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>Student_profile_id</th>
                                                                    <th>Sr No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>GRN</th>
                                                                    <th>Class</th>
                                                                    <th>Division</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="student_details_accor_event">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-white close_new_entry" type="reset">Cancel</button>
                                                    <button class="btn btn-primary  addEVNotification" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Event History </b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                 <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Title</th>
                                                        <th>Message</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1;
                                                    foreach ($notification as $key1) { 
                                                        if($key1['notifi_type'] == '14'){?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['date']?></td> 
                                                        <td style="white-space: nowrap;"><?=$key1['time']?></td> 
                                                        <td><?=$key1['notifi_title']?></td>
                                                        <td><?=$key1['notifi_msg']?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['notification_count']?></td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="notice_demo" class="tab-pane">
                            <div class="panel-body">
                                <div class="ibox float-e-margins">
                                    <?php if ($user_type == 3) { ?>
                                    <div class="ibox-title" style="border:none !important;">
                                        <div class="row">
                                           <div class="col-sm-6">
                                                <h3 class="new_circular"><b>New Circular Notice</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_circular"><i class="fa fa-plus" title="New Circular Notice"></i></span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_circular">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addENotification" action="<?=site_url('Notification/add_circular_notification')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control class_details_circular" name="class_name">
                                                        <option>Select Class</option>
                                                        <option value="0">All</option>
                                                        <?php foreach ($class_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Division<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control division_details_circular" name="division">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Circular Title<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" maxlength="100" name="notifi_title" placeholder="Notification Title">
                                                    <span class="title_characters"><span>
                                                </div>
                                                <label class="col-lg-2 control-label"> Circular Message<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <textarea cols="2" rows="3" class="form-control" name="notifi_msg" placeholder="Notification Message" maxlength="500"></textarea>
                                                    <span class="characters"><span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Upload Circular Notice</label>
                                                <div class="col-sm-3">
                                                    <input type="file" class="form-control" name="notifi_img" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                                </div>
                                            </div>
                                            <?php switch ($school_circular_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="notifi_sms"> <i></i>  Sent SMS to Parent about Circular Notice </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ibox-title">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h3><b>Student Details</b></h3>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="ibox-tools">
                                                                    <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>Student_profile_id</th>
                                                                    <th>Sr No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>GRN</th>
                                                                    <th>Class</th>
                                                                    <th>Division</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="student_details_accor_circular">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-white close_new_entry" type="reset">Cancel</button>
                                                    <button class="btn btn-primary  addENotification" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Circular Notice History </b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Title</th>
                                                        <th>Message</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1;
                                                    foreach ($notification as $key1) { 
                                                        if($key1['notifi_type'] == '13'){?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['date']?></td> 
                                                        <td style="white-space: nowrap;"><?=$key1['time']?></td> 
                                                        <td><?=$key1['notifi_title']?></td>
                                                        <td><?=$key1['notifi_msg']?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['notification_count']?></td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="news_demo" class="tab-pane">
                            <div class="panel-body">
                                <?php if ($user_type == 3) {?>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_news"><b>News Feeds</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_news"><i class="fa fa-plus" title="New News Feeds"></i> </span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content new_news">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addSTNotification" action="<?=site_url('Notification/add_news_notification')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control class_details_news" name="class_name">
                                                        <option>Select Class</option>
                                                        <option value="0">All</option>
                                                        <?php foreach ($class_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Division<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control division_details_news" name="division">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">News Title<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" maxlength="100" name="notifi_title" placeholder="Notification Title">
                                                    <span class="title_characters"><span>
                                                </div>
                                                <label class="col-lg-2 control-label">News Message<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <textarea cols="2" rows="3" class="form-control" name="notifi_msg" placeholder="Notification Message" maxlength="500"></textarea>
                                                    <span class="characters"><span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Upload News Feeds</label>
                                                <div class="col-sm-3">
                                                    <input type="file" class="form-control" name="notifi_img" accept="image/jpeg, image/png, image/gif" style="border:none;">
                                                </div>
                                            </div>
                                            <?php switch ($school_newsfeed_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="notifi_sms"> <i></i>  Sent SMS to Parent about meeting </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ibox-title">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h3><b>Student Details</b></h3>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="ibox-tools">
                                                                    <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>Student_profile_id</th>
                                                                    <th>Sr No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>GRN</th>
                                                                    <th>Class</th>
                                                                    <th>Division</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="student_details_accor_news">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-white close_new_entry" type="reset">Cancel</button>
                                                    <button class="btn btn-primary  addSTNotification" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>News Feeds History </b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Title</th>
                                                        <th>Message</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1;
                                                    foreach ($notification as $key1) { 
                                                        if($key1['notifi_type'] == '12'){?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['date']?></td> 
                                                        <td style="white-space: nowrap;"><?=$key1['time']?></td> 
                                                        <td><?=$key1['notifi_title']?></td>
                                                        <td><?=$key1['notifi_msg']?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['notification_count']?></td>
                                                    </tr>
                                                    <?php } }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div id="personalize" class="tab-pane">
                            <div class="panel-body">
                                <?php if ($user_type == 3) {?>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border:none !important">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="new_personal"><b>Personalize MSG</b></h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ibox-tools">
                                                    <span class="btn btn-xs btn-primary" id="new_personal"><i class="fa fa-plus" title="New News Feeds"></i> </span>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ibox-content new_personal">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addONotification" action="<?=site_url('Notification/add_personal_notification')?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Class<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control class_details_personal" name="class_name">
                                                        <option>Select Class</option>
                                                        <option value="0">All</option>
                                                        <?php foreach ($class_details as $key) { ?>
                                                        <option value="<?=$key['class_id']?>"><?=$key['class_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="col-lg-2 control-label">Division<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="form-control division_details_personal" name="division">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Title<span style="color:red;">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" maxlength="100" name="notifi_title" placeholder="Notification Title">
                                                    <span class="title_characters"><span>
                                                </div>
                                                <label class="col-lg-2 control-label">Message <span style="color:red;">*</span></label>
                                                <div class="col-sm-3" >
                                                    <textarea name="notifi_msg" id="message" cols="2" rows="3" class="form-control" placeholder="Notification Message" maxlength="325"></textarea>
                                                    <ul  id="sms-counter">
                                                    Characters : <span class="length"></span> | SMS Credit :<span class="messages"></span>
                                                    </ul>
                                                    <input type="hidden" name="msg_cnt" id="msg_cnt">
                                                </div>
                                                <div class="col-sm-1"><a href="http://marathi.indiatyping.com/" target="_black"><i class="fa fa fa-external-link"></i></a></div>
                                            </div>
                                            <?php switch ($school_newsfeed_sms) {
                                                case '1': ?>
                                                <div class="form-group" style="padding-top:0px;">
                                                    <label class="col-lg-2 control-label"></label>
                                                    <div class="col-sm-3">
                                                        <div class="i-checks"><label> <input type="checkbox" class="smsm" name="notifi_sms"> <i></i>  Sent SMS to Parent </label></div> 
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ibox-title">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h3><b>Student Details</b></h3>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="ibox-tools">
                                                                    <h3><input type="checkbox" class="CheckAll"> CheckAll</h3>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>Student_profile_id</th>
                                                                    <th>Sr No.</th>
                                                                    <th>Student Name</th>
                                                                    <th>GRN</th>
                                                                    <th>Class</th>
                                                                    <th>Division</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="student_details_accor_personal">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <button class="btn btn-white close_new_entry" type="reset">Cancel</button>
                                                    <button class="btn btn-primary  addONotification" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <div class="ibox-title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Personal MSG History </b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Title</th>
                                                        <th>Message</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1;
                                                    foreach ($notification as $key1) { 
                                                        if($key1['notifi_type'] == '8'){?>
                                                    <tr>
                                                        <td><?=$i++;?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['date']?></td> 
                                                        <td style="white-space: nowrap;"><?=$key1['time']?></td> 
                                                        <td><?=$key1['notifi_title']?></td>
                                                        <td><?=$key1['notifi_msg']?></td>
                                                        <td style="white-space: nowrap;"><?=$key1['notification_count']?></td>
                                                    </tr>
                                                    <?php } }?>
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
        