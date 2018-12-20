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
    <!--<script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>-->
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/jquery-ui.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/pdfmake.min.js"></script> -->

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

     <!-- Date range picker -->
    <script src="<?=base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="<?=base_url()?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- clockpicker -->
     <script src="<?=base_url()?>assets/js/plugins/clockpicker/clockpicker.js"></script>
    
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>
    <script>
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');

        if (activeTab) {
           $('a[href="' + activeTab + '"]').tab('show');
        }
        $.validator.setDefaults({
            submitHandler: function (form) {    
                form.submit();
            }
        });

        <?php if($report == 'fee'){?>
             $('#fee').addClass('active');
             document.title = "eSchool | Accounting Reports"
        <?php } ?>

        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });

        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });

//////////////////////////////////////////////////////////////Total Fee Report /////////////////////////////////////////////////////////////////////////////////
    // $(document).on('click','.total_fee_report',function(){
        // $.fn.dataTable.ext.search.pop();
    $.post('<?=site_url('Reports/total_fee_report')?>',{},function(data){
        $(".loader_half").fadeIn("slow");

        var total_fee_report_data = data.total_fee_report;
        // console.log("total_fee_report"+total_fee_report_data);
        var total_fee_report = $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            sScrollX: false,
            data: total_fee_report_data,
            columns:[
                {title: "GRN No.",data:"student_GRN","width":"4%"},
                {title: "Student Name",data:"student_name","width":"4%"},
                // {title: "Father Name",data:"parent_name","width":"4%"},
                // {title: "Gender",data:"student_gender","width":"4%"},
                {title: "Mobile No.",data:"parent_mobile_number","width":"4%"},
                {title: "Class",data:"class_name","width":"4%"},
                {title: "Division",data:"division_name","width":"4%"},
                {title: "Total Fee Amount",data:"total_fee_amount","width":"4%"},
                {title: "Total Fee Waiver Amount",data:"fee_waiver_amount","width":"4%"},
                {title: "Paid Amount",data:"fee_amount","width":"4%"},
                {title: "Balance",data:"balance","width":"4%"},
            ],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    "extend": 'print',
                    title:'',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    },

                    // footer:true,
                    customize: function ( win ) {
                      $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Total Fee Reports</td></center></tr>')
                    },
                    
                },
                {
                            "extend": 'excel',
                            title: '<img src="<?php echo $school_report_header ?>"> <br> Total Fee Reports',
                },
            ],
        });
        $('.dataTables-example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
        } );
        var total_fee_report = $('.dataTables-example').DataTable();
     
        // Apply the search
        total_fee_report.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        $(".loader_half").fadeOut("slow");
    },'json');
    // });

      

//////////////////////////////////////////////////////////////Due Fee Report /////////////////////////////////////////////////////////////////////////
    $(document).on('click','.fee_due_report',function(){
        // $.fn.dataTable.ext.search.pop();

        if (!$.fn.DataTable.isDataTable('.dataTables-example1'))
        {
            $(".loader_half").fadeIn("slow");
            $.post('<?=site_url('Reports/fee_due_report')?>',{},function(data){
                // console.log("data"+data.fee_due_report);
                // console.log("data"+data.fee_due_report_balance[0]);
                var due_fee_report_data = data.fee_due_report;
                var due_fee_report = $('.dataTables-example1').DataTable({
                    pageLength: 10,
                    responsive: true,
                    autoWidth: true,
                    data: due_fee_report_data,
                    columns:[
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        {title: "Mobile No.",data:"parent_mobile_number"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Total Fee Amount",data:"total_fee_amount"},
                        {title: "Total Fee Waiver Amount",data:"fee_waiver_amount"},
                        {title: "Paid Amount",data:"fee_amount"},
                        {title: "Balance",data:"balance"},
                        {title: "",data:null,defaultContent:"<center><button class='btn btn-xs btn-info' style='color: #000;'>Send Remainder</button></center>"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Fee Due Reports</td></center></tr>')
                            },
                        },
                        {
                            "extend": 'excel',

                            title: '<img src="<?php echo $school_report_header ?>"> <br> Fee Balance Amount Reports',
                        },
                    ],
                });

                $('.dataTables-example1 tbody').on( 'click', 'button', function () {
                    var data1 = due_fee_report.row( $(this).parents('tr') ).data();
                    var Student_profile_id = data1.Student_profile_id;
                    var balance = data1.balance;
                    $(this).remove();
                    
                    console.log(data1);
                    console.log(Student_profile_id);

                    $.post('<?=site_url('Reports/send_fee_sms')?>',{Student_profile_id:Student_profile_id,balance:balance},function(data){
                    },'json');

                } );

                var x=data.fee_due_report_balance[0]['balance'];
                x=x.toString();
                var lastThree = x.substring(x.length-3);
                var otherNumbers = x.substring(0,x.length-3);
                if(otherNumbers != '')
                    lastThree = ',' + lastThree;
                var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

                $(".dataTables_length").append('<b style="font-size:20px;vertical-align: middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Balance Amount : Rs.'+res+'</b>');
                $('.dataTables-example1 tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;width:100%;" placeholder="'+title+'" />' );
                } );
                var due_fee_report = $('.dataTables-example1').DataTable();
             
                // Apply the search
                due_fee_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            },'json');

            $(".loader_half").fadeOut("slow");
        }
        
    });

       

//////////////////////////////////////////////////////////////Paid Fee Report /////////////////////////////////////////////////////////////////////////////////
    $(document).on('click','.paid_fee_report',function(){
            // $.fn.dataTable.ext.search.pop();
        if (!$.fn.DataTable.isDataTable('.dataTables-example_paid'))
        {
            $(".loader_half").fadeIn("slow");
            $.post('<?=site_url('Reports/paid_fee_report')?>',{},function(data){
            

                var paid_fee_report_data = data.paid_fee_report;
                console.log("paid_fee_report"+paid_fee_report_data);
                var paid_fee_report = $('.dataTables-example_paid').DataTable({
                    pageLength: 10,
                    responsive: true,
                    data: paid_fee_report_data,
                    columns:[
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        // {title: "Father Name",data:"parent_name"},
                        // {title: "Gender",data:"student_gender"},
                        {title: "Mobile No.",data:"parent_mobile_number"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Total Fee Amount",data:"total_fee_amount"},
                        {title: "Total Fee Waiver Amount",data:"fee_waiver_amount"},
                        {title: "Paid Amount",data:"fee_amount"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Paid Fee Reports</td></center></tr>')
                            },
                        },
                    ],
                });
                $('.dataTables-example_paid tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
                } );
                var paid_fee_report = $('.dataTables-example_paid').DataTable();
             
                // Apply the search
                paid_fee_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );

            },'json');
            $(".loader_half").fadeOut("slow");
        }    
    });



//////////////////////////////////////////////////////////////Category wise Fee Report /////////////////////////////////////////////////////////////////////////////////
    $(document).on('click','.fee_category_report',function(){
            // $.fn.dataTable.ext.search.pop();
        if (!$.fn.DataTable.isDataTable('.dataTables-example_category'))
        {
            $(".loader_half").fadeIn("slow");
             // alert("hii");
            $.post('<?=site_url('Reports/fee_category_report')?>',{},function(data){
            

            var fee_category_report_data = data.fee_category_report;
            console.log("fee_category_report"+fee_category_report_data);
                var fee_category_report = $('.dataTables-example_category').DataTable({
                    pageLength: 10,
                    responsive: true,
                    data: fee_category_report_data,
                    columns:[
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        // {title: "Father Name",data:"parent_name"},
                        // {title: "Gender",data:"student_gender"},
                        {title: "Mobile No.",data:"parent_mobile_number"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Fee Type name",data:"fees_type_name"},
                        {title: "Fee Category",data:"fee_category_name"},
                        {title: "Fee Type Amount",data:"total_fee_amount"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Fee Category Reports</td></center></tr>')
                            },
                        },
                    ],
                });
                $('.dataTables-example_category tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
                } );
                var fee_category_report = $('.dataTables-example_category').DataTable();
             
                // Apply the search
                fee_category_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            },'json');
            $(".loader_half").fadeOut("slow");
        }
    });

    

//////////////////////////////////////////////////////////////Waiver Fee Report /////////////////////////////////////////////////////////////////////////////////
    $(document).on('click','.fee_waiver_report',function(){
            // $.fn.dataTable.ext.search.pop();
        if (!$.fn.DataTable.isDataTable('.dataTables-example_waiver'))
        {
            $(".loader_half").fadeIn("slow");
            $.post('<?=site_url('Reports/fee_waiver_report')?>',{},function(data){


                var fee_waiver_report_data = data.fee_waiver_report;
                console.log("fee_waiver_report"+fee_waiver_report_data);
                var fee_waiver_report = $('.dataTables-example_waiver').DataTable({
                    pageLength: 10,
                    responsive: true,
                    data: fee_waiver_report_data,
                    columns:[
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Fee Waiver Amount",data:"total_fee_amount"},
                        {title: "Fee Waiver Amount",data:"fee_waiver_amount"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Fee Waiver Reports</td></center></tr>')
                            },
                        },
                    ],
                });
                $('.dataTables-example_waiver tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
                } );
                var fee_waiver_report = $('.dataTables-example_waiver').DataTable();
             
                // Apply the search
                fee_waiver_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            },'json');
            $(".loader_half").fadeOut("slow");
        }
    });

      

//////////////////////////////////////////////////////////////Daily payment Report /////////////////////////////////////////////////////////////////////////////////

        var pdfImg = '';
        const toDataURL = url => fetch(url)
          .then(response => response.blob())
          .then(blob => new Promise((resolve, reject) => {
            const reader = new FileReader()
            reader.onloadend = () => resolve(reader.result)
            reader.onerror = reject
            reader.readAsDataURL(blob)
        }));

        toDataURL('<?php echo $school_report_header ?>')
        .then(dataUrl => {
            pdfImg = ''+dataUrl+'';
        });

    $(document).on('click','.view_daily_payment_report',function(){

        if (!$.fn.DataTable.isDataTable('.dataTables-example_daily'))
        {
            $(".loader_half").fadeIn("slow");
            $.post('<?=site_url('Reports/daily_report_data')?>',{},function(data){
                console.log(data.fee_amount[0].fee_amount);
                $('.total_amount').empty().append(data.fee_amount[0].fee_amount);
                var daily_report_data = data.daily_report;

                // console.log("daily_report_data"+daily_report_data);
                var daily_payment_report = $('.dataTables-example_daily').DataTable({
                    pageLength: 10,
                    responsive: true,
                    data: daily_report_data,
                    columns:[
                        {title: "SR No.",data:"serial_number"},
                        {title: "Date",data:"date"},
                        {title: "Time",data:"time"},
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Amount",data:"fee_amount"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Daily Received Amount Reports</td></center></tr>')
                              $(win.document.body).append('<h3 class="pull-right">Total Amount : '+data.fee_amount[0].fee_amount+'</h3>');
                            },
                        },
                        {
                            "extend": 'excel',
                            title: '<img src="<?php echo $school_report_header ?>"> <br> Daily Received Amount Reports',
                        },
                        {
                            "extend": 'pdf',
                            title: 'Daily Received Amount Reports',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                            },
                            pageSize: 'A4',
                            sWidth: '1200px',
                            customize : function(doc) {
                                doc.content[2].widths = [ '100%', '12%', '12%', '18%', '28%', '10%', '10%'];
                            },
                            customize: function ( doc ) {
                                // Splice the image in after the header, but before the table
                                doc.content.splice( 0, 0, {
                                    margin: 0,
                                    alignment: 'center',
                                    image: ''+pdfImg+'',
                                    width: 500,
                                    height: 50, 
                                });
                                doc.content[2].margin = [ 40, 0, 0, 0 ]
                            }
                        },
                    ],
                });
                $('.dataTables-example_daily tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
                } );
                var daily_payment_report = $('.dataTables-example_daily').DataTable();
             
                // Apply the search
                daily_payment_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            },'json');
            $(".loader_half").fadeOut("slow");

        }
    });

    $(document).on('click','.view_datewise_daily_payment_report',function(){
        $(".loader_half").fadeIn("slow");
        var start_date = $('#day_book_from').val();
        var end_date = $('#day_book_to').val();
        $('.dataTables-example_daily').DataTable().destroy();
        $('.dataTables-example_daily tbody').empty();

        $.post('<?=site_url('Reports/fetch_daily_payment_daterange')?>',{start_date:start_date,end_date:end_date},function(data){
                // console.log(data.fee_amount[0].fee_amount);
                var daily_report_data = data.daily_report;
                $('.total_amount').empty().append(data.fee_amount[0].fee_amount);

                console.log(data);

                var daily_payment_report = $('.dataTables-example_daily').DataTable({
                    pageLength: 10,
                    responsive: true,
                    data: daily_report_data,
                    columns:[
                        {title: "SR No.",data:"serial_number"},
                        {title: "Date",data:"date"},
                        {title: "Time",data:"time"},
                        {title: "GRN No.",data:"student_GRN"},
                        {title: "Student Name",data:"student_name"},
                        {title: "Class",data:"class_name"},
                        {title: "Division",data:"division_name"},
                        {title: "Amount",data:"fee_amount"},
                    ],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {
                            "extend": 'print',
                            title:'',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                            },
                            // footer:true,
                            customize: function ( win ) {
                              $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"><img src="<?php echo $school_report_header ?>"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;">Daily Received Amount Reports</td></center></tr>')
                              $(win.document.body).append('<h3 class="pull-right">Total Amount : '+data.fee_amount[0].fee_amount+'</h3>');
                            },
                        },
                        {
                            "extend": 'excel',

                            title: '<img src="<?php echo $school_report_header ?>"> <br> Daily Received Amount Reports',
                             // customize: function ( win ) {
                             //          $(win.document.body).find( 'thead' ).prepend('<tr><center><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"></td></tr><tr><td colspan="12" style="font-size:24px;text-align:center;border:none !important;"> All Fee Reports</td></center></tr>')
                             //        },
                        },
                            // 
                        {
                            "extend": 'pdf',

                            title: 'Daily Received Amount Reports',
                            exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                            },
                            pageSize: 'A4',
                            sWidth: '1200px',
                            customize : function(doc) {
                                doc.content[2].widths = [ '100%', '12%', '12%', '18%', '28%', '10%', '10%'];
                            },
                            customize: function ( doc ) {
                                // Splice the image in after the header, but before the table
                                doc.content.splice( 0, 0, {
                                    margin: 0,
                                    alignment: 'center',
                                    image: ''+pdfImg+'',
                                    width: 500,
                                    height: 50, 
                                });
                                doc.content[2].margin = [ 40, 0, 0, 0 ]
                            }
                        },
                    ],
                    // "language": {
                    //     "emptyTable": "<img src='http://eschool.syntech.co.in/eschool/assets/img/No-record-found.png'> "
                    // },
                   
                });
                
                $('.dataTables-example_daily tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" style="border: none;" placeholder="'+title+'" />' );
                } );
                var daily_payment_report = $('.dataTables-example_daily').DataTable();
             
                // Apply the search
                daily_payment_report.columns().every( function () {
                    var that = this;
                    $( 'input', this.footer() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );

        },'json');
            $(".loader_half").fadeOut("slow");

    });
        

    </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/dashboard_4.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:30:16 GMT -->
</html>