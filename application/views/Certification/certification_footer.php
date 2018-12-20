<div class="footer">
    <div class="row">
        <div class="col-sm-4">
            <div class="pull-left">
                <strong>Copyright </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech_logo.png" style="height:13px;"></a><strong> &copy; 2017-2018 </strong>  
            </div>
        </div>
        <?php if(!empty($school_logo)){  ?>
        <div class="col-sm-4">
            <center>
                <div>
                   <img src="<?php if(!empty($school_logo)){echo $school_logo;} ?>" style="height:20px;width:20px;"> <strong style="color:#ffffff;"><?php if(!empty($school_name)){echo $school_name;} ?> </strong> 
                </div>
            </center>
        </div>
        <?php } ?>
        <div class="pull-right">
            <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contact@syntech.co.in </strong> 
        </div>
    </div>
</div>



    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

    <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- clockpicker -->
    
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js" integrity="sha384-CchuzHs077vGtfhGYl9Qtc7Vx64rXBXdIAZIPbItbNyWIRTdG0oYAqki3Ry13Yzu" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        <?php if($certification == 'certification'){?>
             $('#certification').addClass('active');
             document.title = "eSchool | Certification"
        <?php } ?>

         var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            minDate: 0,
            autoclose:true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $(document).ready(function(){
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>
                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });
            <?php } ?> 

            var REF_no = 0;
            var LC_no = 0;
             var th = ['','thousand','million', 'billion','trillion'];
             var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine']; 
             var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen']; 
             var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; 
             function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'not a number'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'too big'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'hundred ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'point '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ');}   


            $('#PDF').click(function() {
                $('#certificate1').show();
                 var element = $("#certificate1")[0];
                    html2canvas(element).then(function (canvas) {
                        var myImage = canvas.toDataURL();
                        downloadURI(myImage, ""+REF_no+".png");
                        // $.post('<?=site_url('Certification/upload')?>',{myImage:myImage},function(data1){
                        //     console.log(data1);
                        // },'json');
                    });

                    $.post('<?=site_url('Certification/add_bonafide')?>',{},function(data1){
                        console.log(data1);
                    },'json');
                $('#certificate1').hide();
            });

            $('#PDF_LC').click(function() {

                var student_profile_id = $('#student_profile_id').val();
                var class_since_date = $('#class_since_date').val();
                var student_privious_school_name = $('textarea#student_privious_school_name').val();
                var student_progress = $('textarea#student_progress').val();
                var student_conduct = $('textarea#student_conduct').val();
                var student_LC_date = $('#student_LC_date').val();
                var student_LC_reason = $('textarea#student_LC_reason').val();
                var student_remark = $('textarea#student_remark').val();

                console.log(student_LC_date);

                $.post('<?=site_url('Certification/update_LC_details')?>',{student_profile_id:student_profile_id,student_privious_school_name:student_privious_school_name,student_progress:student_progress,student_conduct:student_conduct,student_LC_date:student_LC_date,student_LC_reason:student_LC_reason,student_remark:student_remark},function(data5){
                        // console.log("update data : ");
                        console.log(data5);
                },'json');

                 $.post('<?=site_url('Certification/student_details_LC')?>',{student_profile_id:student_profile_id},function(data){
                        $('#certificate_LC').empty();
                        $('#certificate_LC1').empty();
                        var stu = data.LC[0].student_DOB.split('-');
                        var amd = data.LC[0].student_admission_date.split('-');
                        var wMonths=['january','february','march','april','may','june','july','august','september','october','november','december'];
                        var in_word  = toWords(stu[2]) + " " + wMonths[parseInt(stu[1])-1] + " " + toWords(stu[0]);   
                        // alert(final);

                        // console.log("new_data : ");
                        // console.log(data);
                        $('#btn_LC').show();
                        $('#example_LC').show();
                        LC_no = data.LC_no; 
                    $('#certificate_LC').append('<div class="ibox-content" style="border-top: 0;padding: 1px;">'+
                                                    '<div>'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_header+'" width="100%">'+
                                                    '</div>'+
                                                    '<p style="margin: 10px 0px 0px 0px;"><b> Serial No. :  '+data.LC_no+'  </b>'+
                                                        '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                    '</p>'+
                                                    '<center>'+
                                                        '<div style="width:100%;">'+
                                                            '<h4 style="margin: 1px 0px 5px 0px;font-family: Edwardian Script ITC;font-size:45px;">Leaving Certificate</h4>'+
                                                        '</div>'+
                                                    '</center>'+
                                                    '<table class="table" style="margin-bottom: 5px;">'+
                                                        '<thead>'+
                                                            '<tr>'+
                                                                '<td>1)</td>'+
                                                                '<td>Name of the pupil in full :</td>'+
                                                                '<td><b>'+data.LC[0].student_name+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>2)</td>'+
                                                                '<td>Mother Name of the pupil:</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].parent_name == null ? '' : data.LC[0].parent_name)+
                                                                   ' </b>'+
                                                                   '<input type="hidden" id="student_profile_id" value="'+student_profile_id+'">'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>3)</td>'+
                                                                '<td>Caste & Sub caste : </td>'+
                                                                '<td><b>'+data.LC[0].student_religion+' - '+
                                                                (data.LC[0].student_cast == null ? '' : data.LC[0].student_cast)+
                                                                '</b>'+
                                                                
                                                                   (data.LC[0].student_cast == null ? '' : (data.LC[0].student_sub_cast == '' ? '' : ' ( '+data.LC[0].student_sub_cast+' ) '))+
                                                                    // '<br>'+
                                                                    // '<small>(Only in the case of pupils belonging to backward classes & category among B.Sc. e.g. S.C./S.T.etc)</small>'+
                                                               ' </td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>4)</td>'+
                                                                '<td>Nationality : </td>'+
                                                                '<td><b>'+data.LC[0].student_nationality+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>5)</td>'+
                                                                '<td>Place of Birth : </td>'+
                                                                '<td><b>'+data.LC[0].student_birth_place+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>6)</td>'+
                                                                '<td>Aadhar Number : </td>'+
                                                                '<td><b>'+data.LC[0].student_adhar_card_number+' </b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>7)</td>'+
                                                                '<td>Date of Birth, Month & Year : <br>'+
                                                                    'According to the Christian Era. : <br>'+
                                                                    '(In words and Figures) :'+
                                                                '</td>'+
                                                                '<td><b>'+stu[2]+'/'+stu[1]+'/'+stu[0]+'</b>'+
                                                                    ' <br> '+data.dob_text+''+
                                                                    ' <br> <span style="text-transform: capitalize;">'+ in_word +'</span>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>8)</td>'+
                                                               ' <td>Last School Attended :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_privious_school_name == null ? student_privious_school_name : data.LC[0].student_privious_school_name)+
                                                               '</b></td>'+
                                                           '</tr>'+
                                                           ' <tr>'+
                                                                '<td>9)</td>'+
                                                                '<td>Date of Admission : </td>'+
                                                                '<td><b>'+amd[2]+'/'+amd[1]+'/'+amd[0]+'</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>10)</td>'+
                                                                '<td>Progress :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_progress == null ? student_progress : data.LC[0].student_progress)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>11)</td>'+
                                                                '<td>Conduct : </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_conduct == null ? student_conduct : data.LC[0].student_conduct)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>12)</td>'+
                                                                '<td>Date of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_date == null ? student_LC_date : data.LC[0].student_LC_date)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>13)</td>'+
                                                                '<td>Standard in which studying & since when :</td>'+
                                                                '<td><b>'+data.LC[0].class_name+' </b>Class since : '+class_since_date+''+
                                                                '</td>'+
                                                           ' </tr>'+
                                                            '<tr>'+
                                                                '<td>14)</td>'+
                                                                '<td>Reason of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_reason == null ? student_LC_reason : data.LC[0].student_LC_reason)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>15)</td>'+
                                                                '<td>Remarks </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_remark == null ? student_remark : data.LC[0].student_remark)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<hr style="margin-top: 5px;margin-bottom: 5px;border-bottom: 1px solid #000;">'+
                                                   ' <p>Certified that above information is in accordance with the School Register.</p>'+
                                                    '<p>'+
                                                        '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                    '</p>'+
                                                   ' <br>'+
                                                    '<table class="table" style="margin-bottom: 0px;">'+
                                                        '<thead>'+
                                                           ' <tr>'+
                                                                '<th>Class Master / Clerk.</th>'+
                                                                '<th>Principal.</th>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<div style="display: block;left:15px;">'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_footer+'" width="100%">'+
                                                   ' </div>'+
                                                '</div>');  
                    
                    $('#certificate_LC1').append('<div class="ibox-content p-xl" style="border-top: 0;">'+
                                                    '<div>'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_header+'" width="100%">'+
                                                    '</div>'+
                                                    '<p style="margin-top: 10px;"><b> Serial No. :  '+data.LC_no+'  </b>'+
                                                        '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                    '</p>'+
                                                    '<center>'+
                                                        '<div style="width:100%;">'+
                                                            '<h4 style="margin-top: 10px;font-family: Edwardian Script ITC;font-size:100px;">Leaving Certificate</h4>'+
                                                        '</div>'+
                                                    '</center>'+
                                                    '<table class="table" style="margin-bottom: 5px;">'+
                                                        '<thead>'+
                                                            '<tr>'+
                                                                '<td>1)</td>'+
                                                                '<td>Name of the pupil in full :</td>'+
                                                                '<td><b>'+data.LC[0].student_name+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>2)</td>'+
                                                                '<td>Mother Name of the pupil:</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].parent_name == null ? '' : data.LC[0].parent_name)+
                                                                   ' </b>'+
                                                                   '<input type="hidden" id="student_profile_id" value="'+student_profile_id+'">'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>3)</td>'+
                                                                '<td>Caste & Sub caste : </td>'+
                                                                '<td><b>'+data.LC[0].student_religion+' - '+
                                                                (data.LC[0].student_cast == null ? '' : data.LC[0].student_cast)+
                                                                '</b>'+
                                                                
                                                                   (data.LC[0].student_cast == null ? '' : (data.LC[0].student_sub_cast == '' ? '' : ' ( '+data.LC[0].student_sub_cast+' ) '))+
                                                                    // '<br>'+
                                                                    // '<small>(Only in the case of pupils belonging to backward classes & category among B.Sc. e.g. S.C./S.T.etc)</small>'+
                                                               ' </td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>4)</td>'+
                                                                '<td>Nationality : </td>'+
                                                                '<td><b>'+data.LC[0].student_nationality+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>5)</td>'+
                                                                '<td>Place of Birth : </td>'+
                                                                '<td><b>'+data.LC[0].student_birth_place+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>6)</td>'+
                                                                '<td>Aadhar Number : </td>'+
                                                                '<td><b>'+data.LC[0].student_adhar_card_number+' </b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>7)</td>'+
                                                                '<td>Date of Birth, Month & Year : <br>'+
                                                                    'According to the Christian Era. : <br>'+
                                                                    '(In words and Figures) :'+
                                                                '</td>'+
                                                                '<td><b>'+stu[2]+'/'+stu[1]+'/'+stu[0]+'</b>'+
                                                                    ' <br> '+data.dob_text+''+
                                                                    ' <br> <span style="text-transform: capitalize;">'+ in_word +'</span>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>8)</td>'+
                                                               ' <td>Last School Attended :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_privious_school_name == null ? student_privious_school_name : data.LC[0].student_privious_school_name)+
                                                               '</b></td>'+
                                                           '</tr>'+
                                                           ' <tr>'+
                                                                '<td>9)</td>'+
                                                                '<td>Date of Admission : </td>'+
                                                                '<td><b>'+amd[2]+'/'+amd[1]+'/'+amd[0]+'</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>10)</td>'+
                                                                '<td>Progress :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_progress == null ? student_progress : data.LC[0].student_progress)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>11)</td>'+
                                                                '<td>Conduct : </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_conduct == null ? student_conduct : data.LC[0].student_conduct)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>12)</td>'+
                                                                '<td>Date of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_date == null ? student_LC_date : data.LC[0].student_LC_date)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>13)</td>'+
                                                                '<td>Standard in which studying & since when :</td>'+
                                                                '<td><b>'+data.LC[0].class_name+' </b>Class since : '+class_since_date+''+
                                                                '</td>'+
                                                           ' </tr>'+
                                                            '<tr>'+
                                                                '<td>14)</td>'+
                                                                '<td>Reason of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_reason == null ? student_LC_reason : data.LC[0].student_LC_reason)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>15)</td>'+
                                                                '<td>Remarks </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_remark == null ? student_remark : data.LC[0].student_remark)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<hr style="margin-top: 5px;margin-bottom: 5px;border-bottom: 1px solid #000;">'+
                                                   ' <p>Certified that above information is in accordance with the School Register.</p>'+
                                                    '<p>'+
                                                        '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                    '</p>'+
                                                   ' <br><br>'+
                                                    '<table class="table" style="margin-bottom: 0px;">'+
                                                        '<thead>'+
                                                           ' <tr>'+
                                                                '<th>Class Master / Clerk.</th>'+
                                                                '<th>Principal.</th>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<div style="display: block;left:15px;">'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_footer+'" width="100%">'+
                                                   ' </div>'+
                                                '</div>');    
                    
                },'json');

                // $('#PDF_LC_download').click();
                $('#PDF_LC_download').removeClass('hidden');
                $('#PDF_LC').addClass('hidden');

            });

            $('#PDF_LC_download').click(function() {

                var student_profile_id = $('#student_profile_id').val();
               
                $('#certificate_LC1').show();
                 var element = $("#certificate_LC1")[0];
                    html2canvas(element).then(function (canvas) {
                        var myImage = canvas.toDataURL();
                        downloadURI(myImage, ""+LC_no+".png");
                    });

                    $.post('<?=site_url('Certification/add_LC')?>',{},function(data1){
                        console.log(data1);
                    },'json');
                $('#certificate_LC1').hide();

            });

            function downloadURI(uri, name) {
                var link = document.createElement("a");

                link.download = name;
                link.href = uri;
                document.body.appendChild(link);
                link.click();
                // clearDynamicLink(link); 
            }

            $('#print_bonafide').click(function() {
                $.post('<?=site_url('Certification/add_bonafide')?>',{},function(data1){
                    console.log(data1);
                },'json');
            });

            // $('#print_LC').click(function() {
            //     $.post('<?=site_url('Certification/add_LC')?>',{},function(data1){
            //         console.log(data1);
            //     },'json');
            // });

            $(document).on('change','.student_class',function(){
                $(".loader").fadeIn("fast");
                $('.student_division').empty();
                $('#certificate').empty();
                $('#certificate_LC').empty();
                $('.student_details1').empty().trigger('change');
                var class_id = $(this).val();
                $.post('<?=site_url('Certification/fetch_class_division')?>',{class_id:class_id},function(data){

                    $('.student_division').append("<option value='' selected disabled>Select Division</option>");
                    $.each(data,function(k,v){
                        $('.student_division').append("<option value="+v.division_id+">"+v.division_name+"</option>")
                    });
                },'json');

                $.post('<?=site_url('Certification/fetch_class_division_student')?>',{class_id:class_id},function(data){
                    // console.log(data);
                    // $('.student_details1').html('<option value="" disabled>Select Student</option>');
                    $.each(data,function(k,v){
                        $('.student_details1').append('<option value="'+v.student_profile_id+'">'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</option>');
                    });
                },'json');
                $(".loader").fadeOut("slow");
                $(".select2_demo").select2({
                    placeholder: "Select a Student Name",
                    allowClear: true,
                }); 
                $('.select2-container--above').hide();
                $('.select2-container--below').hide();
            });

            $(document).on('change','.student_division',function(){
                $(".loader").fadeIn("fast");
                $('.student_details1').empty().trigger('change');
                $('#certificate').empty();
                $('#certificate_LC').empty();
                var division_id = $(this).val();
                var class_id = $('.student_class').val();
                $.post('<?=site_url('Certification/fetch_division_class_student')?>',{class_id:class_id,division_id:division_id},function(data){
                    // console.log(data);
                    // $('.student_details1').html('<option value="" disabled>Select Student</option>');
                    $.each(data,function(k,v){
                        $('.student_details1').append('<option value="'+v.student_profile_id+'">'+v.student_first_name+' '+v.student_middle_name+' '+v.student_last_name+'</option>');
                    });
                },'json');
                $(".loader").fadeOut("slow");
                $(".select2_demo").select2({
                    placeholder: "Select a Student Name",
                    allowClear: true,
                }); 
                $('.select2-container--above').hide();
                $('.select2-container--below').hide();
            });

            $(document).on('change','#student_details_bonafide',function(){
                // $(".loader").fadeIn("fast");
                var student_profile_id = $(this).val();
                // alert(student_profile_id);
                $.post('<?=site_url('Certification/student_bonafide')?>',{student_profile_id:student_profile_id},function(data){
                    $('#certificate').empty();
                    $('#certificate1').empty();
                    console.log(data);
                    REF_no = data.ref_no;
                    $('#btn').show();
                    $('#example').show();
                    // $.each(data.bonafide, function(k,v){

                    $('#certificate').append('<div class="ibox-content " style="border-top: 0;">'+
                                                '<div>'+
                                                    '<img src="'+data.bonafide[0].school_bonafied_certificate_header+'" width="100%">'+
                                                '</div>'+
                                                '<p style="margin-top: 10px;"><b> REF NO. :  '+data.ref_no+'  </b>'+
                                                    '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                '</p>'+
                                                '<center>'+
                                                    '<div style="width:100%;">'+
                                                        '<h4 style="margin-top: 10px;font-family: Edwardian Script ITC;font-size:50px;">Bonafide Certificate</h4>'+
                                                    '</div>'+
                                                '</center>'+
                                                '<hr style="margin-top: 5px;margin-bottom: 15px;">'+
                                                '<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                                                    'This is to certify that <b><i>'+data.bonafide[0].student_name+'</i></b>  Son/daughter of <b> '+data.bonafide[0].parent_name+'</b> residing at <b>'+data.bonafide[0].student_permament_town+'</b> Tal – <b>'+data.bonafide[0].student_permament_tal+'</b> Dist – '+data.bonafide[0].student_permament_dist+'  is/was a bonafide student of this school. </p>'+
                                                '<p>'+
                                                   ' His / Her birth date is <b>'+data.date_in_text +'</b> and birth place is -<b>'+data.bonafide[0].student_birth_place+'</b> His / Her General Register No. in school is -<b>'+data.bonafide[0].student_GRN+'</b> and was studying in -<b>'+data.bonafide[0].class_name+' </b> Class. His / Her Nationality is -<b>'+data.bonafide[0].student_nationality+'</b></p>'+

                                                    '<div style="border: 1px solid #000;height: 80px;width: 80px;float:  right;margin-right: 50px;"></div>'+
                                                '<p>'+
                                                    '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                '</p>'+

                                               ' <table class="table" style="margin-bottom: 0px;">'+
                                                   ' <thead>'+
                                                        '<tr>'+
                                                           ' <th>Place :</th>'+
                                                           ' <th>Clerk.</th>'+
                                                           ' <th>Principal.</th>'+
                                                            '<th>School Seal.</th>'+
                                                       ' </tr>'+
                                                    '</thead>'+
                                               ' </table>'+
                                               ' <div style="display: block;left:15px;">'+
                                                    '<img src="'+data.bonafide[0].school_bonafied_certificate_footer+'" width="100%">'+
                                                '</div>'+
                                                '</div> ');

                    $('#certificate1').append('<div class="ibox-content " style="border-top: 0;padding:35px">'+
                                                '<br>'+
                                                '<div>'+
                                                    '<img src="'+data.bonafide[0].school_bonafied_certificate_header+'" width="100%">'+
                                                '</div>'+
                                                '<p style="margin-top: 10px;"><b> REF NO. :  '+data.ref_no+'  </b>'+
                                                    '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                '</p>'+
                                                '<center>'+
                                                    '<div style="width:100%;">'+
                                                        '<h4 style="margin-top: 10px;font-family: Edwardian Script ITC;font-size:107px;">Bonafide Certificate</h4>'+
                                                    '</div>'+
                                                '</center>'+
                                                '<hr style="margin-top: 5px;margin-bottom: 15px;border-bottom: 1px solid #000;">'+
                                                '<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                                                    'This is to certify that <b><i>'+data.bonafide[0].student_name+'</i></b>  Son/daughter of <b> '+data.bonafide[0].parent_name+'</b> residing at <b>'+data.bonafide[0].student_permament_town+'</b> Tal – <b>'+data.bonafide[0].student_permament_tal+'</b> Dist – '+data.bonafide[0].student_permament_dist+'  is/was a bonafide student of this school. </p>'+
                                                '<p>'+
                                                   ' His / Her birth date is <b>'+data.date_in_text +'</b> and birth place is -<b>'+data.bonafide[0].student_birth_place+'</b> His / Her General Register No. in school is -<b>'+data.bonafide[0].student_GRN+'</b> and was studying in -<b>'+data.bonafide[0].class_name+' </b> Class. His / Her Nationality is -<b>'+data.bonafide[0].student_nationality+'</b></p>'+

                                                    '<div style="border: 1px solid #000;height: 120px;width: 120px;float:  right;margin-right: 50px;"></div>'+
                                                '<p>'+
                                                    '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                '</p>'+

                                               ' <table class="table" style="margin-bottom: 0px;">'+
                                                   ' <thead>'+
                                                        '<tr>'+
                                                           ' <th>Place :</th>'+
                                                           ' <th>Clerk.</th>'+
                                                           ' <th>Principal.</th>'+
                                                            '<th>School Seal.</th>'+
                                                       ' </tr>'+
                                                    '</thead>'+
                                               ' </table>'+
                                               ' <div style="display: block;left:15px;">'+
                                                    '<img src="'+data.bonafide[0].school_bonafied_certificate_footer+'" width="100%">'+
                                                '</div>'+
                                                '</div> ');
                    // });
                },'json');
                // $(".loader").fadeOut("slow"); 
             });

            $(document).on('change','#student_details_LC',function(){
                // $(".loader").fadeIn("fast");
                var student_profile_id = $(this).val();

                $.post('<?=site_url('Certification/student_details_LC')?>',{student_profile_id:student_profile_id},function(data){
                        $('#certificate_LC').empty();
                        $('#certificate_LC1').empty();
                        var stu = data.LC[0].student_DOB.split('-');
                        var amd = data.LC[0].student_admission_date.split('-');
                        var wMonths=['january','february','march','april','may','june','july','august','september','october','november','december'];
                        var in_word  = toWords(stu[2]) + " " + wMonths[parseInt(stu[1])-1] + " " + toWords(stu[0]);   
                        // alert(final);

                        console.log(data.dob_text);
                        console.log(data);
                        $('#btn_LC').show();
                        $('#example_LC').show();
                        LC_no = data.LC_no; 
                    $('#certificate_LC').append('<div class="ibox-content" style="border-top: 0;padding: 1px;">'+
                                                    '<div>'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_header+'" width="100%">'+
                                                    '</div>'+
                                                    '<p style="margin: 10px 0px 0px 0px;"><b> Serial No. :  '+data.LC_no+'  </b>'+
                                                        '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                    '</p>'+
                                                    '<center>'+
                                                        '<div style="width:100%;">'+
                                                            '<h4 style="margin: 1px 0px 5px 0px;font-family: Edwardian Script ITC;font-size:45px;">Leaving Certificate</h4>'+
                                                        '</div>'+
                                                    '</center>'+
                                                    '<table class="table" style="margin-bottom: 5px;">'+
                                                        '<thead>'+
                                                            '<tr>'+
                                                                '<td>1)</td>'+
                                                                '<td>Name of the pupil in full :</td>'+
                                                                '<td><b>'+data.LC[0].student_name+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>2)</td>'+
                                                                '<td>Mother Name of the pupil :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].parent_name == null ? '' : data.LC[0].parent_name)+
                                                                   ' </b>'+
                                                                   '<input type="hidden" id="student_profile_id" value="'+student_profile_id+'">'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>3)</td>'+
                                                                '<td>Caste & Sub caste : </td>'+
                                                                '<td><b>'+data.LC[0].student_religion+' - '+
                                                                (data.LC[0].student_cast == null ? '' : data.LC[0].student_cast)+
                                                                '</b>'+
                                                                
                                                                   (data.LC[0].student_cast == null ? '' : (data.LC[0].student_sub_cast == '' ? '' : ' ( '+data.LC[0].student_sub_cast+' ) '))+
                                                                    // '<br>'+
                                                                    // '<small>(Only in the case of pupils belonging to backward classes & category among B.Sc. e.g. S.C./S.T.etc)</small>'+
                                                               ' </td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>4)</td>'+
                                                                '<td>Nationality : </td>'+
                                                                '<td><b>'+data.LC[0].student_nationality+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>5)</td>'+
                                                                '<td>Place of Birth : </td>'+
                                                                '<td><b>'+data.LC[0].student_birth_place+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>6)</td>'+
                                                                '<td>Aadhar Number : </td>'+
                                                                '<td><b>'+data.LC[0].student_adhar_card_number+' </b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>7)</td>'+
                                                                '<td>Date of Birth, Month & Year : <br>'+
                                                                    'According to the Christian Era. : <br>'+
                                                                    '(In words and Figures) :'+
                                                                '</td>'+
                                                                '<td><b>'+stu[2]+'/'+stu[1]+'/'+stu[0]+'</b>'+
                                                                    ' <br> '+data.dob_text+''+
                                                                    ' <br> <span style="text-transform: capitalize;">'+ in_word +'</span>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>8)</td>'+
                                                               ' <td>Last School Attended :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_privious_school_name == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_privious_school_name"></textarea>' : data.LC[0].student_privious_school_name)+
                                                               '</b></td>'+
                                                           '</tr>'+
                                                           ' <tr>'+
                                                                '<td>9)</td>'+
                                                                '<td>Date of Admission : </td>'+
                                                                '<td><b>'+amd[2]+'/'+amd[1]+'/'+amd[0]+'</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>10)</td>'+
                                                                '<td>Progress :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_progress == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_progress"></textarea>' : data.LC[0].student_progress)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>11)</td>'+
                                                                '<td>Conduct : </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_conduct == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_conduct"></textarea>' : data.LC[0].student_conduct)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>12)</td>'+
                                                                '<td>Date of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_date == null ? '<input type="text" class="date" style="border: none;width: 100%;" id="student_LC_date">' : data.LC[0].student_LC_date)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>13)</td>'+
                                                                '<td>Standard in which studying & since when :</td>'+
                                                                '<td><b>'+data.LC[0].class_name+' </b>Class since : <span><input type="text" style="border: none;" id="class_since_date"></span>'+
                                                                '</td>'+
                                                           ' </tr>'+
                                                            '<tr>'+
                                                                '<td>14)</td>'+
                                                                '<td>Reason of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_reason == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_LC_reason"></textarea>' : data.LC[0].student_LC_reason)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>15)</td>'+
                                                                '<td>Remarks </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_remark == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_remark"></textarea>' : data.LC[0].student_remark)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<hr style="margin-top: 5px;margin-bottom: 5px;border-bottom: 1px solid #000;">'+
                                                   ' <p>Certified that above information is in accordance with the School Register.</p>'+
                                                    '<p>'+
                                                        '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                    '</p>'+
                                                   ' <br>'+
                                                    '<table class="table" style="margin-bottom: 0px;">'+
                                                        '<thead>'+
                                                           ' <tr>'+
                                                                '<th>Class Master / Clerk.</th>'+
                                                                '<th>Principal.</th>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<div style="display: block;left:15px;">'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_footer+'" width="100%">'+
                                                   ' </div>'+
                                                '</div>');  
                    
                     $('#certificate_LC1').append('<div class="ibox-content p-xl" style="border-top: 0;">'+
                                                    '<div>'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_header+'" width="100%">'+
                                                    '</div>'+
                                                    '<p style="margin-top: 10px;"><b> Serial No. :  '+data.LC_no+'  </b>'+
                                                        '<span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>'+
                                                    '</p>'+
                                                    '<center>'+
                                                        '<div style="width:100%;">'+
                                                            '<h4 style="margin-top: 10px;font-family: Edwardian Script ITC;font-size:100px;">Leaving Certificate</h4>'+
                                                        '</div>'+
                                                    '</center>'+
                                                    '<table class="table" style="margin-bottom: 5px;">'+
                                                        '<thead>'+
                                                            '<tr>'+
                                                                '<td>1)</td>'+
                                                                '<td>Name of the pupil in full :</td>'+
                                                                '<td><b>'+data.LC[0].student_name+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>2)</td>'+
                                                                '<td>Mother Name of the pupil :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].parent_name == null ? '' : data.LC[0].parent_name)+
                                                                   ' </b>'+
                                                                   '<input type="hidden" id="student_profile_id" value="'+student_profile_id+'">'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>3)</td>'+
                                                                '<td>Caste & Sub caste : </td>'+
                                                                '<td><b>'+data.LC[0].student_religion+' - '+
                                                                (data.LC[0].student_cast == null ? '' : data.LC[0].student_cast)+
                                                                '</b>'+
                                                                
                                                                   (data.LC[0].student_cast == null ? '' : (data.LC[0].student_sub_cast == '' ? '' : ' ( '+data.LC[0].student_sub_cast+' ) '))+
                                                                    // '<br>'+
                                                                    // '<small>(Only in the case of pupils belonging to backward classes & category among B.Sc. e.g. S.C./S.T.etc)</small>'+
                                                               ' </td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>4)</td>'+
                                                                '<td>Nationality : </td>'+
                                                                '<td><b>'+data.LC[0].student_nationality+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>5)</td>'+
                                                                '<td>Place of Birth : </td>'+
                                                                '<td><b>'+data.LC[0].student_birth_place+' </b></td>'+
                                                            '</tr>'+
                                                            ' <tr>'+
                                                                '<td>6)</td>'+
                                                                '<td>Aadhar Number : </td>'+
                                                                '<td><b>'+data.LC[0].student_adhar_card_number+' </b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>7)</td>'+
                                                                '<td>Date of Birth, Month & Year : <br>'+
                                                                    'According to the Christian Era. : <br>'+
                                                                    '(In words and Figures) :'+
                                                                '</td>'+
                                                                '<td><b>'+stu[2]+'/'+stu[1]+'/'+stu[0]+'</b>'+
                                                                    ' <br> '+data.dob_text+''+
                                                                    ' <br> <span style="text-transform: capitalize;">'+ in_word +'</span>'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>8)</td>'+
                                                               ' <td>Last School Attended :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_privious_school_name == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_privious_school_name"></textarea>' : data.LC[0].student_privious_school_name)+
                                                               '</b></td>'+
                                                           '</tr>'+
                                                           ' <tr>'+
                                                                '<td>9)</td>'+
                                                                '<td>Date of Admission : </td>'+
                                                                '<td><b>'+amd[2]+'/'+amd[1]+'/'+amd[0]+'</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>10)</td>'+
                                                                '<td>Progress :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_progress == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_progress"></textarea>' : data.LC[0].student_progress)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>11)</td>'+
                                                                '<td>Conduct : </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_conduct == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_conduct"></textarea>' : data.LC[0].student_conduct)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td>12)</td>'+
                                                                '<td>Date of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_date == null ? '<input type="text" class="date" style="border: none;width: 100%;" id="student_LC_date">' : data.LC[0].student_LC_date)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>13)</td>'+
                                                                '<td>Standard in which studying & since when :</td>'+
                                                                '<td><b>'+data.LC[0].class_name+' </b>Class since :'+
                                                                '</td>'+
                                                           ' </tr>'+
                                                            '<tr>'+
                                                                '<td>14)</td>'+
                                                                '<td>Reason of leaving school :</td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_LC_reason == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_LC_reason"></textarea>' : data.LC[0].student_LC_reason)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                           ' <tr>'+
                                                                '<td>15)</td>'+
                                                                '<td>Remarks </td>'+
                                                                '<td><b>'+
                                                                   (data.LC[0].student_remark == null ? '<textarea rows="1" cols="50" style="border: none;width: 100%;" id="student_remark"></textarea>' : data.LC[0].student_remark)+
                                                                '</b></td>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<hr style="margin-top: 5px;margin-bottom: 5px;border-bottom: 1px solid #000;">'+
                                                   ' <p>Certified that above information is in accordance with the School Register.</p>'+
                                                    '<p>'+
                                                        '<b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>'+
                                                    '</p>'+
                                                   ' <br><br>'+
                                                    '<table class="table" style="margin-bottom: 0px;">'+
                                                        '<thead>'+
                                                           ' <tr>'+
                                                                '<th>Class Master / Clerk.</th>'+
                                                                '<th>Principal.</th>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                    '</table>'+
                                                    '<div style="display: block;left:15px;">'+
                                                        '<img src="'+data.LC[0].school_leaving_certificate_footer+'" width="100%">'+
                                                   ' </div>'+
                                                '</div>');    

                                $('.date').datepicker({
                                format:"yyyy-mm-dd",
                                todayBtn: "linked",
                                keyboardNavigation: false,
                                forceParse: false,
                                calendarWeeks: true,
                                autoclose: true
                            });
                    
                },'json');
                // $(".loader").fadeOut("slow"); 
            });


            // $(document).on('click','.create_bonafide',function(){
            //     var class_id = $('.student_class').val();
            //     var division = $('.student_division').val();

            //         $.post('<?=site_url('Certification/class_division_bonafide')?>',{class_id:class_id,division:division},function(data){
            //             $('#stu_bonafide_data').empty();
                        
            //             $.each(data, function(k,v){

            //                 $('#stu_bonafide_data').append('<tr>'+
            //                     '<td>'+v.student_GRN+'</td>'+                                                  
            //                     '<td>'+v.student_name+'</td>'+                                                  
            //                     '<td>'+v.student_gender+'</td><td>'+v.parent_mobile_number+'</td>'+                                                  
            //                     '<td>'+v.class_name+'</td><td>'+v.division_name+'</td>'+ 
            //                     // '<td><button class="btn-info btn btn-xs" title="'+v.Student_profile_id+'">Create</button></td>'+    
            //                     '<td><a target="_blank"  href="<?=site_url("Certification/print_bonafide/'+v.Student_profile_id+'") ?>""><i class="fa fa-print"></i></a></td>'+                                           
            //                     '</tr>');
            //             });
            //              $('.dataTables-example').DataTable({
            //                     pageLength: 10,
            //                     responsive: true,
            //                     dom: '<"html5buttons"B>lTfgitp',
            //                     buttons: [  ]

            //                 });
            //     },'json');
            // });

            $(document).on('click','#bonafide,#leaving',function(){
                $('.student_division').empty();
                $('.student_details1').empty().trigger('change');
                $('#certificate').empty();

                $('#certificate_LC').empty();
                $('#btn_LC').hide();
                $('.select2-container--default').hide();
                $(".select2_demo").select2({
                    placeholder: "Select a Student Name",
                    allowClear: true,
                }); 
            });

            $(".select2_demo").select2({
                placeholder: "Select a Student Name",
                allowClear: true,
            }); 

        
            // $('.dataTables-example').DataTable({
            //     pageLength: 10,
            //     responsive: true,
            //     dom: '<"html5buttons"B>lTfgitp',
            //     buttons: [  ]

            // });

        });
    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>