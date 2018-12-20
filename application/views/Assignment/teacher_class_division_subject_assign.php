        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> View Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">New Assign</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('Teacher_class_division_subject_assign/TCDS_remove')?>">
                                        <div class="ibox-title" style="border:none;">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3><b>Teacher Class Division Subject Assign Details</b></h3>
                                                </div>
                                                <div class="col-sm-6" style="text-align:right;">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <span class="btn btn-white ass_details_edit"><i class="fa fa-pencil"></i></span>
                                                            <span class="btn btn-white ass_details1"><i class="fa fa-times"></i></span>
                                                            <button class="btn btn-primary ass_details" type="submit"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>Teacher Name</th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Subject</th>
                                                                <th class="ass_details">Select To Remove</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $i=1;
                                                            foreach ($teacher_class_division_subject as $key) { ?>
                                                            <tr>
                                                                <td><?=$i++?></td>
                                                                <td><?=$key['employee_first_name']?>&nbsp<?=$key['employee_middle_name']?>&nbsp<?=$key['employee_last_name']?></td>
                                                                <td><?=$key['class_name']?></td>
                                                                <td><?=$key['division_name']?></td>
                                                                <td><?=$key['subject_name']?></td>
                                                                <td class="ass_details">
                                                                    <input type="checkbox" name="TCDS_id[]" value="<?=$key['TCDS_id']?>">
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="ibox-title" style="border:none;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3><b>Teacher Class Division Subject Assign</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="Assign" action="<?=site_url('Teacher_class_division_subject_assign/TCDS_registration')?>">
                                                <div class="row" style="margin: 10px 0;text-align:right;">
                                                    <div class="col-lg-12">
                                                        <span class="btn btn-xs btn-primary" id="add_row">Add New Record</span>
                                                        <span class="btn btn-xs btn-danger" id="delete_row" onclick="deleteRow('stock')">Delete</span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" >
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Class</th>
                                                                <th>Division</th>
                                                                <th>Subject</th>
                                                                <th>Teacher</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="stock">
                                                            <tr id="org">
                                                                <td><input type="checkbox"></td>
                                                                <td id="class">
                                                                    <select class="form-control class" name="TCDS_class_id[]">
                                                                        <option value="">- Choose Class -</option>
                                                                        <?php foreach ($school_class as $key) { ?>
                                                                            <?php $s = $s . '<option value="'.$key['class_id'] .'">' .$key['class_name'] .'</option>' ?>
                                                                            <option value="<?=$key['class_id']  ?>"><?=$key['class_name'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td id="division">
                                                                    <select class="form-control division" name="TCDS_division_id[]">
                                                                        <option value="">- Choose Division -</option>
                                                                    </select>
                                                                </td>
                                                                <td id="subject">
                                                                    <select class="form-control subject" name="TCDS_subject_id[]">
                                                                        <option value="">- Choose Subject -</option>
                                                                    </select>
                                                                </td>
                                                                <td id="teacher">
                                                                    <select class="form-control teacher" name="TCDS_employee_profile_id[]">
                                                                        <option value="">- Choose Teacher -</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>           
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-offset-4 col-lg-8">
                                                        <button type="submit" class="btn btn-success"> Submit </button>
                                                        <button type="reset" class="btn btn-primary">Reset</button>
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
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?=base_url()?>assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?=base_url()?>assets/js/inspinia.js"></script>
        <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

        
        <!-- clockpicker -->
         <script src="<?=base_url()?>assets/js/plugins/clockpicker/clockpicker.js"></script>
        
        <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
        <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
         <script type="text/javascript">
        $(window).load(function() {
	            $(".loader").fadeOut("slow");
	        });
	    </script>
        <script type="text/javascript">
            
            $.validator.setDefaults({
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $(document).ready(function(){

                <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                    swal({
                        title: "<?=$flash['title']?>",
                        text: "<?=$flash['text']?>",
                        type: "<?=$flash['type']?>"
                    });
                <?php } ?>

                //========================================================= Teacher Class Division Subject Assign ========================================================
                var rowCnt = 1;
                $('#add_row').click(function () {
                    rowCnt++;
                    var old = $('#org').html();
                    var newrow = '<tr id="org">'+
                            '<td><input type="checkbox"></td>'+
                            '<td id="class">'+
                                '<select class="form-control class" name="TCDS_class_id[]">'+
                                    '<option value="">- Choose Class -</option>'+
                                    '<?php echo $s; ?>'+
                                '</select>'+
                            '</td>'+
                            '<td id="division">'+
                                '<select class="form-control division" name="TCDS_division_id[]">'+
                                    '<option value="">- Choose Division -</option>'+
                                '</select>'+
                            '</td>'+
                            '<td id="subject">'+
                                '<select class="form-control subject" name="TCDS_subject_id[]">'+
                                    '<option value="">- Choose Subject -</option>'+
                                '</select>'+
                            '</td>'+
                            '<td id="teacher">'+
                                '<select class="form-control teacher" name="TCDS_employee_profile_id[]">'+
                                    '<option value="">- Choose Teacher -</option>'+
                                '</select>'+
                            '</td>'+
                        '</tr>';
                    $('#stock').append(newrow);
                });

                $(document).on('change','.class',function(){
                    var class_id = $(this).val();
                    $(this).parent().siblings('#division').find('.division');
                    
                    $.post('<?=site_url('Teacher_class_division_subject_assign/class_wise_division_details')?>',{class_id : class_id}, function(data){
                        console.log(data);
                        $.each(data, function(k,v){
                            $('.division').append('<option value="'+v.division_id+'">'+v.division_name+'</option>');
                        });
                    },'json');
                })

                $(document).on('change','.division',function(){
                    var division_id = $(this).val();

                    $(this).parent().siblings('#subject').find('.subject');
                    $.post('<?=site_url('Teacher_class_division_subject_assign/class_wise_subject_details')?>',{division_id : division_id}, function(data){
                        console.log(data);
                        $('.subject').append('<option value="0"> Class Teacher</option>');
                        $.each(data, function(k,v){
                            $('.subject').append('<option value="'+v.subject_id+'">'+v.subject_name+'</option>');
                        });
                    },'json');
                })

                $(document).on('change','.subject',function(){
                    var q = $(this).parent().siblings('#teacher').find('.teacher');
                    var subject_id = $(this).val();
                    if(subject_id == 0){
                        $.post('<?=site_url('Teacher_class_division_subject_assign/all_teacher_division_details')?>',{}, function(data){
                            console.log(data);
                            $.each(data, function(k,v){
                                $('.teacher').append('<option value="'+v.employee_profile_id+'">'+v.employee_name+'</option>');
                            });
                        },'json');
                    }else{
                        $.post('<?=site_url('Teacher_class_division_subject_assign/teacher_subject_wise_division_details')?>',{subject_id : subject_id}, function(data){
                            console.log(data);
                            $.each(data, function(k,v){
                                $('.teacher').append('<option value="'+v.employee_profile_id+'">'+v.employee_name+'</option>');
                            });
                        },'json');
                    }
                });

                $('.dataTables-example').DataTable({
                    "pageLength": 100,
                    "responsive": true,
                    "ordering": false,
                    // "info": true,
                    "dom": '<"html5buttons"B>lTfgitp',
                    "buttons": [
                        // {extend: 'copy'},
                        {
                            "extend": 'print',
                            exportOptions: {
                                columns: ':visible'
                            },
                           
                            title:'',
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Class Teacher Details </td></center></tr>')
                            },
                        },
                        {"extend": 'excel', title: 'Class Teacher Details '},
                        {"extend": 'pdf', title: 'Class Teacher Details '},
                    ],
                    "language": {
                        "emptyTable": "<img src='<?=base_url();?>assets/img/No-record-found.png'> "
                    }

                });

                $('.ass_details').hide();
                $('.ass_details1').hide();
                $(document).on('click','.ass_details_edit',function(){
                     $('.ass_details').show();
                     $('.ass_details1').show();
                     $('.ass_details_edit').hide();
                });
                $(document).on('click','.ass_details1',function(){

                     $('.ass_details').hide();
                     $('.ass_details1').hide();
                     $('.ass_details_edit').show();
                });
            });

            //===================================================== TCDS Delete Row ================================================
            function deleteRow(tbid) {  
                try {
                    var table = document.getElementById(tbid);
                    var rowCount = table.rows.length;
                    for (var i = 0; i < rowCount; i++) {
                        var row = table.rows[i];
                        var chk = row.cells[0].childNodes[0];
                        if (null != chk && true == chk.checked) {
                            if (rowCount <= 1) {
                                alert("Cannot delete all rows.");
                                break;
                            }
                            table.deleteRow(i);
                            rowCount--;
                            i--;
                        }
                    }
                } catch (e) {
                    alert(e);
                }
            }

        </script>