<div id="header1">
    <nav  class="navbar navbar-expand-lg navbar-light bg-light position-fixed fixed-top px-5" style="box-shadow: 0 0 10px rgba(0,0,0,0.3);">
        <a href="index.php" class="navbar-brand" href="#"><img src="./public/frontend/images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?url=Home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item nav_item_down">
                    <a class="nav-link" href="index.php?url=Home/product">Shop<span><i class="fa fa-chevron-down icon_navbar" aria-hidden="true"></i></span>
                        <div class="sub_navlink">
                            <?php
                                if(isset($data['categories'])){
                                    foreach($data['categories'] as $category){ ?>
                                        <a href="index.php?url=Home/category/<?php echo $category->id; ?>"><?php echo $category->name; ?></a>
                            <?php }  } ?>


                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=Home/blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?url=Home/contact">Contact Us</a>
                </li>

            </ul>
            <ul class="nav-list-icon" style="list-style: none;">
                <li class="hover_login">
                    <a  href="" style="position: relative;"><i  class="fa fa-user"></i><?php echo isset($_SESSION['user_login']['name'])?$_SESSION['user_login']['name']:""; ?></a>
                    <div class="box_login text-center">
                        <!-- <p class="text-center">Login</p> -->
                        <?php
                            if(isset($_SESSION['user_login'])) { ?>
                                <a href="index.php?url=User_Login/logout" style="cursor: pointer" class="text-center mt-3 ">Logout</a>
                        <?php }else{ ?>
                                <a href="index.php?url=User_Login/login" style="cursor: pointer" class="text-center mt-3 ">Login</a>
                        <?php } ?>

                    </div>
                </li>
                <li><a href="" style="position: relative;" class="fa fa-heart"></a><span class="quantity">100</span></li>
                <li><a href="index.php?url=Cart/shopping_cart" class="fa fa-shopping-cart"></a><span class="quantity quantity_total_cart"><?php echo isset($data['total_cart'])?$data['total_cart']:"0"; ?></span></li>
            </ul>

        </div>
    </nav>
</div>