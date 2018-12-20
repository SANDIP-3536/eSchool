<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:23:03 GMT -->
<head>
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/img/logo.gif"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eSchool | Forgot Password</title>

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
     <!-- Sweet Alert -->
    <link href="<?=base_url();?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">



    <style>
    @media (min-width: 1200px) {
        #log {
            margin-top: -455px;  
        }
    }

    @media (min-width: 980px) and (max-width: 1199px)  {
    #log {
            margin-top: -480px;  
        }
    }
    @media (min-width: 768px) and (max-width: 979px) {
         #log {
            margin-top: -450px;  
        }
    }
   @media  (max-width: 767px) {
        #log {
            margin-top: -435px;  
        }
    } 
   .alert {
    padding: 5px 20px;
    margin-bottom: 8px !important;
    border: 1px solid transparent;
    border-radius: 4px;
    }
    .alert-dismissable, .alert-dismissible {
    padding-right: 35px;
}
 </style>
</head>
<?php $path = base_url('assets')."/img/login_background.gif";
$path1 = base_url('assets')."/img/login_logo.gif";

 ?>
<body class="gray-bg" style="background: url('<?php echo $path;?>') no-repeat center center fixed;background-size: cover;" >
    <div style=" padding-top: 4%;">
        <center>
        <div class="middle-box text-center loginscreen animated fadeInDown" id="log" style=" background: #ffffff;padding: 20px;border-radius: 20px;border: 1px solid #000;width: 100%;margin-top: 0%;box-shadow: 3px 2px;">
             <img src="<?php echo $path1; ?>" style="padding-bottom: 20px;height:10%;width:100%;">
             <form method="post" action="<?=site_url('Welcome/forgot_password_form')?>" id="forgot_password"> 
                <div class="form-group">
                    <input type="text" class="form-control username" placeholder="Please Enter Username" name="credential_username" required="">
                    <label class="mobile_verification" hidden="" style="color:#cc5965; padding-top: -10px;"></label>
                </div>
                <button type="submit" class="btn btn-info full-width m-b enableOnInput">Sent OTP</button>
              
            </form>
             <h4 class="m-t"><small style="color:#000000;"><b><br>Designed & Developed By <a href="http://www.syntech.co.in" target="_blank"><u>Syntech Solution </u></a>&copy; 2017-18 </b></small></p>
        </div>
    </div>
    <div style="border:none; backgorund:none repeat scroll 0 0 #cde7a6 !important;padding:10px 20px;right:0;left:0;bottom:0;position: fixed;">
        <div class="row">
            <div class="col-sm-4">
                <div class="pull-left">
                    <strong><!-- Copyright --> </strong><a href="http://www.syntech.co.in" target="_blank"> <img src="<?=base_url()?>assets/img/syntech1.png" style="height:22px;"></a><strong><!--  &copy; 2017-2018 --> </strong>  
                </div>
            </div>
            <div class="pull-right">
                <i class="fa fa-phone-square" aria-hidden="true"></i><strong> 020-24269021 / 7030578612</strong> | <i class="fa fa-envelope" aria-hidden="true"></i> <strong>contact@syntech.co.in </strong> 
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
     <!-- Sweet alert -->
    <script src="<?= base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/js/plugins/validate/additional-methods.min.js"></script>
 <script>

        $(document).ready(function(){
            <?php if(isset($flash['active']) && $flash['active'] == 1) {?>

                swal({
                    title: "<?=$flash['title']?>",
                    text: "<?=$flash['text']?>",
                    type: "<?=$flash['type']?>"
                });

            <?php } ?>
         });

        $('.enableOnInput').prop('disabled', true);
        $(document).on('keyup','.username',function(){
            var username = $(this).val();
            $.post('<?=site_url('Welcome/valid_user_or_not')?>',{username:username},function(data){
                console.log(data);
                if(data != 0){
                        $('.mobile_verification').hide();
                        $('.enableOnInput').prop('disabled', false);
                        $('.mobile_verification').text('');
                    }
                    else{
                        $('.mobile_verification').show();
                        $('.enableOnInput').prop('disabled', true);
                        $('.mobile_verification').text('Username Does not Exists.');
                    }
            })
            // alert(username);
        });

        
 </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Sep 2016 12:23:03 GMT -->
</html>
