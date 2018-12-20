<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/logo.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSchool | Certification</title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
</head>
<style type="text/css">
   @media print {
    body {
        /*font-size: 80px;*/
    }
    h1 {
        /*font-size: 100px;*/
    }
}
@page {
  size: A4;
  margin: 0;
}
/*@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
}*/
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
    border: none;
}

</style>

<body class="top-navigation">

<div id="content">
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
                <?php foreach ($bonafide as $key) { ?>
            <div class="ibox-content p-xl" style="border-top: 0;">
                <div class="row">
                    <img src="<?=base_url()?>profile_photo/lbd_School_Header.png" width="100%">
                </div>
                <!-- </div> -->
                <p style="margin-top: 10px;"><b> REF NO. :  <?=$ref_no; ?>  </b>
                    <span style="float:  right;margin-right: 0px;"> <b> Date :  <?php echo date('d/m/Y'); ?>  </b></span>
                </p>
                <center>
                    <div style="width:100%;">
                        <h4 style="margin-top: 10px;font-family: Edwardian Script ITC;font-size:50px;">Bonafide Certificate</h4>
                    </div>
                </center>
                <hr style="margin-top: 5px;margin-bottom: 15px;">
                <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    This is to certify that <b><i><?=$key['student_name'] ?></i></b> 
                    Son/daughter of <b> <?=$key['parent_name'] ?></b> 
                    residing at <b><?=$key['student_permament_town'] ?></b> 
                    Tal – <b><?=$key['student_permament_tal'] ?></b> 
                    Dist – <?=$key['student_permament_dist'] ?>  
                    is/was a bonafide student of this school. </p>
                
                <p>
                    His / Her birth date is <b><?=$date_in_text ?></b> 
                    and birth place is -<b><?=$key['student_birth_place'] ?></b> 
                    His / Her General Register No. in school is -<b><?=$key['student_GRN'] ?></b> 
                    and was studying in -<b><?=$key['class_name'] ?> </b> 
                    Class. His / Her Nationality is -<b><?=$key['student_nationality'] ?></b></p>
                <br>
                <p>
                    <b> Date :  <?php echo date("l\, jS \of F Y"); ?>  </b>
                    <span style="float:  right;margin-right: 150px;"> <b> Place : </b></span>
                </p>
            <br><br>
            <table class="table" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th>School Seal.</th>
                        <th>Clerk.</th>
                        <th>Principal.</th>
                    </tr>
                </thead>
            </table>
            <div style="display: block;position: fixed;bottom: 0;left:15px;">
                <!-- <img src="<?=$key['school_bonafied_certificate_footer'] ?>" width="100%"> -->
                <img src="<?=base_url()?>profile_photo/lbd_School_Footer.png" width="100%">
            </div>
            </div>    
        </div>
                <?php } ?>
        </div>
    </div>
</div>
<!-- <button class="btn-info btn btn-xs" id="PDF">Create</button> -->


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js" integrity="sha384-CchuzHs077vGtfhGYl9Qtc7Vx64rXBXdIAZIPbItbNyWIRTdG0oYAqki3Ry13Yzu" crossorigin="anonymous"></script>
   <!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf.js"></script>
    <script src="<?=base_url()?>assets/js/from_html.js"></script>
    <script src="<?=base_url()?>assets/js/split_text_to_size.js"></script>
    <script src="<?=base_url()?>assets/js/standard_fonts_metrics.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <script type="text/javascript">
        // window.print();
    var pdfdoc = new jsPDF();
    var specialElementHandlers = {
        '#PDF': function (element, renderer) {
            return true;
        }
    };

     

    $(document).ready(function(){
        $("#PDF").click(function(){
                pdfdoc.fromHTML($('#content').html(), 15, 15, {
            'width': 110,
                           'elementHandlers': specialElementHandlers

        });
        pdfdoc.save('bonafide.pdf');
        var pdf =pdfdoc.output();
        var data = new FormData();
        data.append("data" , pdf);
        // var xhr = new XMLHttpRequest();
        // xhr.open( 'post', '<?=site_url('Certification/upload')?>', true ); //Post to php Script to save to server
        // xhr.send(data);

        $.post('<?=site_url('Certification/upload')?>',{data1:data},function(data){
        },'json');

    });
    });

    // $(document).ready(function(){
       
    //     $("#PDF").click(function(){
    //         var table = document.getElementById("content");
    //         var tbl = window.sessionStorage.getItem("tbl");
    //         var cols = [],
    //             data = [];

    //         function html() {
    //             var doc = new jsPDF('p', 'pt');
    //             var res = doc.autoTableHtmlToJson(table, true);
    //             doc.autoTable(res.columns, res.data);
    //             doc.save( tbl+".pdf");
    //         }
    //         html();
    //     });

    // });
    

        // window.print();

        // alert("hii");


       // $(function () {
 
         //    var specialElementHandlers = {
         //        '#editor': function (element,renderer) {
         //            return true;
         //        }
         //    };
         // $('#PDF').click(function () {
         //        var doc = new jsPDF();
         //        doc.fromHTML($('#content').html(), 15, 15, {
         //            'width': 170,'elementHandlers': specialElementHandlers
         //        });
         //        doc.save('sample-file.pdf');
         //        alert("run");
         //    });  
        // });


        // var doc = new jsPDF();          
        // var elementHandler = {
        //   '#PDF': function (element, renderer) {
        //     return true;
        //   }
        // };
        // var source = window.document.getElementsByTagName("body")[0];
        // doc.fromHTML(
        //     source,
        //     15,
        //     15,
        //     {
        //       'width': 180,'elementHandlers': elementHandler
        //     });

        // doc.output("dataurlnewwindow");


        // $(document).on("click", "#PDF", function () {
        //     var table = document.getElementById("content");
        //     var tbl = window.sessionStorage.getItem("tbl");
        //     var cols = [],
        //         data = [];

        //     function html() {
        //         var doc = new jsPDF('p', 'pt');
        //         var res = doc.autoTableHtmlToJson(table, true);
        //         doc.autoTable(res.columns, res.data);
        //         doc.save( tbl+".pdf");
        //     }
        //     html();
        // });

     
    // });


    </script>



</body>
</html>
