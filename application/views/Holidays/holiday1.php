    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3><b>Add Holiday's</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div id="calendar" class="col-centered">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="form-horizontal" method="POST" action="<?=site_url('Holiday/addEvent')?>" id="addHoliday">
                                        <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                           <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="start" class="col-sm-2 control-label">Start date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="start" class="form-control" id="start" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group" hidden="">
                                                <label for="end" class="col-sm-2 control-label">End date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="end" class="form-control" id="end" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="form-horizontal" method="POST" action="<?=site_url('Holiday/cal_edit')?>">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <label class="text-danger">
                                                    <input type="checkbox" name="delete"> Delete event</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" class="form-control" id="id">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="footer">
    <div class="row">
        <div class="col-sm-4">
            <div class="pull-left">
                <strong>Copyright </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech_logo.png" style="height:13px;"></a><strong> &copy; 2017-2018 </strong>  
            </div>
        </div>
        <div class="col-sm-4">
            <center>
                <div>
                    <img src="<?php echo $school_logo; ?>" style="height:20px;width:20px;"> <strong style="color:#ffffff;"><?php echo $school_name; ?> </strong> 
                </div>
            </center>
        </div>
        <div class="pull-right">
            <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contact@syntech.co.in </strong> 
        </div>
    </div>
    </div>
    </div>
    </div>
</div>


<!-- Mainly scripts -->
<script src="<?=base_url()?>assets/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url()?>assets/js/inspinia.js"></script>
<script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI custom -->
<script src="<?=base_url()?>assets/js/jquery-ui.custom.min.js"></script>

<script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Data picker -->
<script src="<?=base_url()?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- iCheck -->
<script src="<?=base_url()?>assets/js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="<?=base_url()?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
 <script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });
</script>
<script>

$(document).ready(function() {
    <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
        swal({
            title: "<?=$flash['title']?>",
            text: "<?=$flash['text']?>",
            type: "<?=$flash['type']?>"
        });
        <?php } ?> 

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        }); 

         $("#addHoliday").validate({
                rules: {
                    title:{
                        required:true,
                        pattern:/^[a-zA-Z\s]*$/
                    }
                },
                messages: {
                    title:{
                        pattern:"Please Enter only charater."
                    }
                }
            });

        <?php if($holiday == 'holiday'){?>
            $('#holiday').addClass('active');
            $('#other').addClass('active');
            document.title = "eSchool | Holiday";
        <?php } ?>
            
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
            // defaultDate: 'date()',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                edit(event);

            },
            events: [
            <?php foreach($events as $event): 
            
            $start = explode(" ", $event['holiday_start_date']);
            $end = explode(" ", $event['holiday_end_date']);
            if($start[1] == '00:00:00'){
                $start = $start[0];
            }else{
                $start = $event['holiday_start_date'];
            }
            if($end[1] == '00:00:00'){
                $end = $end[0];
            }else{
                $end = $event['holiday_end_date'];
            }
            ?>
            {
                id: '<?php echo $event['holiday_id']; ?>',
                title: '<?php echo $event['holiday_name']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: 'red',
            },
            <?php endforeach; ?>
            ]
        });

function edit(event){
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
    }else{
        end = start;
    }
    
    id =  event.id;
    
    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;
    
    $.ajax({
       url: "<?=site_url('Holiday/select_cal_edit')?>",
       type: "POST",
       data: {Event:Event},
       success: function(rep){
        console.log(rep);
        if(rep == 'true'){
            alert('Saved');
        }else{
            alert('Could not be saved. try again.'); 
        }
    }
});
}

});

</script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:25:00 GMT -->
</html>
