<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />
        <title>TRANG QUẢN TRỊ THERANKME SHOP! | </title>
        <!-- <base href="localhost/"> -->
        
        <!-- Bootstrap -->
        <link href="./public/backend/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="./public/backend/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="./public/backend/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="./public/backend/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="./public/backend/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="./public/backend/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="./public/backend/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="./public/backend/assets/build/css/custom.min.css" rel="stylesheet">
        <style>
            .btn_status_category,
            .btn_status_product,
            .btn_status_tags,
            .btn_status_categoryofblog{
                cursor: pointer;
            }
        </style>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.php?url=Admin" class="site_title"><i class="fa fa-paw"></i> <span>THERANKME SHOP ADMIN!</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="./public/backend/assets/images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>Admin</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <?php
                            include('./mvc/views/backend/block/leftMenu.php'); 
                        ?>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- top navigation -->
               <?php
                include('./mvc/views/backend/block/topNav.php'); 
               ?>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                   <?php 
                        if(isset($data['page'])){
                            include('./mvc/views/'.$data['page'].'.php');
                        }
                   ?>
                </div>
                <!-- /page content -->
                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        THERANKME shop admin
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
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
        <script src="./public/backend/assets/vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="./public/backend/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="./public/backend/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="./public/backend/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="./public/backend/assets/vendors/moment/min/moment.min.js"></script>
        <script src="./public/backend/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="./public/backend/assets/build/js/custom.min.js"></script>
        <script>
            $(document).ready(function(){
                // $('.btn_status_category').click(function(){
                //     const category_id = $(this).attr('id');
                   

                //     $.get({
                //        url: "index.php?url=Category/change_status_2",
                //        data: {category_id:category_id},
                //        success: function(data){
                //         //    data = $.parseJSON(data);
                //         //    $('.btn_status_category'+data['category_id']).html(data['status']);
                //         //    if(data['num_status']==1){
                //         //        $('.btn_status_category'+data['category_id']).removeClass('badge-secondary');
                //         //        $('.btn_status_category'+data['category_id']).addClass('badge-danger');
                //         //    }else{
                //         //        $('.btn_status_category'+data['category_id']).removeClass('badge-danger');
                //         //        $('.btn_status_category'+data['category_id']).addClass('badge-secondary');
                //         //    }
                //        }
                //     });
                // });

                $('.btn_status_product').click(function(){
                    const product_id = $(this).attr('id');
                    $.get({
                        url: "index.php?url=Product/change_status",
                        data:{product_id:product_id},
                        success: function(data){
                            data = $.parseJSON(data);
                            $('.btn_status_product'+data['product_id']).html(data['status']);
                            if(data['num_status']==1){
                                $('.btn_status_product'+data['product_id']).removeClass('badge-secondary');
                                $('.btn_status_product'+data['product_id']).addClass('badge-danger');
                            }else{
                                $('.btn_status_product'+data['product_id']).removeClass('badge-danger');
                                $('.btn_status_product'+data['product_id']).addClass('badge-secondary');
                            }
                        }
                    });
                });

                $('.btn_status_tags').click(function(){
                    const tags_id = $(this).attr('id');
                    $.get({
                        url: "index.php?url=Tags/change_status",
                        data:{ tags_id : tags_id},
                        success: function(data){
                            data = $.parseJSON(data);
                            $('.btn_status_tags'+data['tags_id']).html(data['status']);
                            if(data['num_status']==1){
                                $('.btn_status_tags'+data['tags_id']).removeClass('badge-secondary');
                                $('.btn_status_tags'+data['tags_id']).addClass('badge-danger');
                            }else{
                                $('.btn_status_tags'+data['tags_id']).removeClass('badge-danger');
                                $('.btn_status_tags'+data['tags_id']).addClass('badge-secondary');
                            }
                        }
                    });
                });

                $('.btn_status_categoryofblog').click(function(){
                    const categoryofblog_id = $(this).attr('id');
                    $.get({
                       url: "index.php?url=CategoryBlog/change_status",
                       data: {categoryofblog_id : categoryofblog_id},
                       success: function(data){
                            data = $.parseJSON(data);
                            $('.btn_status_categoryofblog'+data['categoryofblog_id']).html(data['status']);
                            if(data['num_status']==1){
                                $('.btn_status_categoryofblog'+data['categoryofblog_id']).removeClass('badge-secondary');
                                $('.btn_status_categoryofblog'+data['categoryofblog_id']).addClass('badge-danger');
                            }else{
                                $('.btn_status_categoryofblog'+data['categoryofblog_id']).removeClass('badge-danger');
                                $('.btn_status_categoryofblog'+data['categoryofblog_id']).addClass('badge-secondary');
                            }
                       }
                    });
                });

                $('.btn_status_blog').click(function(){
                    const blog_id = $(this).attr('id');
                    $.get({
                        url:"index.php?url=Blog/change_status",
                        data:{blog_id:blog_id},
                        success: function(data){
                            data = $.parseJSON(data);
                            $('.btn_status_blog'+data['blog_id']).html(data['status']);
                            if(data['num_status']==1){
                                $('.btn_status_blog'+data['blog_id']).removeClass('badge-secondary');
                                $('.btn_status_blog'+data['blog_id']).addClass('badge-danger');
                            }else{
                                $('.btn_status_blog'+data['blog_id']).removeClass('badge-danger');
                                $('.btn_status_blog'+data['blog_id']).addClass('badge-secondary');
                            }

                        }
                    });
                });

                $('.btn_confirm_order').click(function(){
                    const order_id = $(this).attr('id');
                    $.get({
                        url:"index.php?url=Order/change_status",
                        data:{order_id:order_id},
                        success: function(data){
                            data = $.parseJSON(data);
                            $('.order_status_confirm'+data['order_id']).html(data['string_status']);
                            $('.order_status_confirm'+data['order_id']).removeClass('btn').removeClass('btn-primary').removeClass('btn-sm');
                        }
                    })
                });

            });
        </script>
    </body>
</html>