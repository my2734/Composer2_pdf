<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gentelella Alela! | </title>
    <!-- Bootstrap -->
    <link href="./public/backend/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./public/backend/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./public/backend/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./public/backend/assets/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="./public/backend/assets/build/css/custom.min.css" rel="stylesheet">
</head>
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php
                    if(isset($data['message_error'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $data['message_error']; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php } ?>


                <form action="index.php?url=Admin_Login/post_login" method="POST">
                    <h1>Login Form</h1>
                    <div>
                        <span class="text-danger"><?php echo isset($data['error']['email'][0])?$data['error']['email'][0]:""; ?></span>
                        <input type="email" class="form-control" value="<?php echo isset($data['result_old']['email'])?$data['result_old']['email']:''; ?>" name="email" placeholder="Email"/>

                    </div>
                    <div>
                        <span class="text-danger"><?php echo isset($data['error']['password'][0])?$data['error']['password'][0]:""; ?></span>
                        <input type="password" class="form-control" value="<?php echo isset($data['result_old']['password'])?$data['result_old']['password']:''; ?>" name="password" placeholder="Password"/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary submit" >Log in</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>

                </form>
            </section>
        </div>

    </div>
</div>
<!-- jQuery -->
<script src="./public/backend/assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="./public/backend/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="./public/backend/assets/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="./public/backend/assets/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="./public/backend/assets/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="./public/backend/assets/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="./public/backend/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="./public/backend/assets/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="./public/backend/assets/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="./public/backend/assets/vendors/Flot/jquery.flot.js"></script>
<script src="./public/backend/assets/vendors/Flot/jquery.flot.pie.js"></script>
<script src="./public/backend/assets/vendors/Flot/jquery.flot.time.js"></script>
<script src="./public/backend/assets/vendors/Flot/jquery.flot.stack.js"></script>
<script src="./public/backend/assets/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="./public/backend/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="./public/backend/assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="./public/backend/assets/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="./public/backend/assets/vendors/DateJS/./public/backend/assets/build/date.js"></script>
<!-- JQVMap -->
<script src="./public/backend/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="./public/backend/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="./public/backend/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="./public/backend/assets/vendors/moment/min/moment.min.js"></script>
<script src="./public/backend/assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="./public/backend/assets/build/js/custom.min.js')}}"></script>
</body>
</html>
