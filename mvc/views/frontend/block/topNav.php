<div id="header1">
    <nav  class="navbar navbar-expand-lg navbar-light bg-light position-fixed fixed-top px-5" style="box-shadow: 0 0 10px rgba(0,0,0,0.3);">
        <a href="index.php" class="navbar-brand" href="#"><img src="./public/frontend/images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?url=Home">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item nav_item_down">
                    <a class="nav-link" href="index.php?url=Home/product">Sản phẩm<span><i class="fa fa-chevron-down icon_navbar" aria-hidden="true"></i></span>
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
                    <a class="nav-link" href="index.php?url=Home/contact">Liên hệ</a>
                </li>
                 <li class="ml-4" style="position: relative;">
                    <form method="POST" action="index.php?url=Home/search_product">
                        <div class="input-group" style="width: 200px;">
                            <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-default ml-2" type="button">Search</button>
                            </span>
                        </div>
                    </form>
                </li>       
            </ul>
            <ul id="box_search"  style="display: none;position: absolute; background-color: white;left: 35%; top: 100%; padding: 20px;width: 300px;" >
                <!-- <li style="display:block;" class="mt-3">
                    <img height="50" width="50" class="float-left mr-3" src="https://cdn.zsofa.vn/wp-content/uploads/2020/10/sofa-da-cao-cap-3.jpg" alt="">
                    <span >
                        <a class="">Hello ca nha yeu</a><br>
                        <span class="info_search_item">2022-09-21 22:23:40</span>
                    </span>
                </li>
                <li style="display:block;" class="mt-3">
                    <img height="50" width="50" class="float-left mr-3" src="https://cdn.zsofa.vn/wp-content/uploads/2020/10/sofa-da-cao-cap-3.jpg" alt="">
                    <span >
                        <a class="">Hello ca nha yeu</a><br>
                        <span class="info_search_item">2022-09-21 22:23:40</span>
                    </span>
                </li> -->
            </ul>
           
            <ul class="nav-list-icon" style="list-style: none;">
                <li class="hover_login">
                    <a  href="" style="position: relative;">
                    <?php 
                        if(isset($_SESSION['user_login'])){ ?>
                            <div style="width: 30px; height: 30px; display: inline-block;">
                                <?php  
                                    if(isset($_SESSION['user_login']['avatar'])){ ?>
                                        <img style="object-fit: cover; width: 100%; height: 100%;border-radius:50%; " src="./public/uploads/<?php echo $_SESSION['user_login']['avatar'] ?>">
                                    <?php }else{ ?>
                                        <img style="object-fit: cover; width: 100%; height: 100%;border-radius:50%; " src="https://i.pinimg.com/280x280_RS/2e/45/66/2e4566fd829bcf9eb11ccdb5f252b02f.jpg">
                                    <?php }  ?>
                            </div>
                        <?php }else{ ?>
                            <i  class="fa fa-user"></i>
                        <?php } ?>
                        <?php echo isset($_SESSION['user_login']['name'])?$_SESSION['user_login']['name']:""; ?>
                    </a>
                    <div class="box_login text-center p-2" style="width: 200px;">
                        <!-- <p class="text-center">Login</p> -->
                        <?php
                            if(isset($_SESSION['user_login'])) { ?>
                                <a href="index.php?url=Home/get_user_info" style="cursor: pointer" class="text-center mt-3 ">Thông tin cá nhân</a><br>
                                <hr class="my-1">
                                <a href="index.php?url=History_Order/index" style="cursor: pointer" class="text-center mt-3 ">Lịch sử mua hàng</a><br>
                                <hr class="my-1">
                                <a href="index.php?url=User_Login/logout" style="cursor: pointer" class="text-center mt-3 ">Đăng xuất</a>
                        <?php }else{ ?>
                                <a href="index.php?url=User_Login/login" style="cursor: pointer" class="text-center mt-3 ">Đăng nhập</a>
                        <?php } ?>

                    </div>
                </li>
                <li><a href="" style="position: relative;" class="fa fa-heart"></a><span class="quantity">100</span></li>
                <li><a href="index.php?url=Cart/shopping_cart" class="fa fa-shopping-cart"></a><span class="quantity quantity_total_cart"><?php echo isset($data['total_cart'])?$data['total_cart']:"0"; ?></span></li>
            </ul>

        </div>
    </nav>
    
</div>
