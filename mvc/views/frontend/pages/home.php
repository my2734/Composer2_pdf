<div id="carousel" style="margin-top: 64px;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./public/frontend/images/slider/logo1.jpg" alt="First slide">

            </div>
            <?php
                if(isset($data['list_slider'])){
                    foreach($data['list_slider'] as $slider){ ?>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./public/uploads/<?php echo $slider->image; ?>" alt="Second slide">
                        </div>
                <?php } } ?>


        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="container mt-5">
    <?php
        if(isset($data['message_success'])){ ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $data['message_success']; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php } ?>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="transport-item" data-aos="fade-up"  data-aos-duration="1000">
                <img src="./public/frontend/images/icons/service-promo-1.png" alt="">
                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="transport-item" data-aos="fade-up"  data-aos-duration="1000">
                <img src="./public/frontend/images/icons/service-promo-2.png" alt="">
                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="transport-item" data-aos="fade-up"  data-aos-duration="1000">
                <img src="./public/frontend/images/icons/service-promo-3.png" alt="">
                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="transport-item" data-aos="fade-up"  data-aos-duration="1000">
                <img src="./public/frontend/images/icons/service-promo-4.png" alt="">
                <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
            </div>
        </div>
    </div>
</div>

<div id="product-feature">
    <div class="container-fluid">
        <div class="container-cover">
            <div data-aos="fade-right" data-aos-duration="2000">
                <h5 class="text-left mt-5">SẢN PHẨM MỚI</h5>
                <span class="text-left mb-5 d-block">Sản phẩm được đảm bảo chính hãng</span>
            </div>
            <div class="row">
                <?php
                    if(isset($data['list_product'])){
                        foreach($data['list_product'] as $product){ ?>
                            <div  class="col-lg-3  mt-5 col-md-6 col-sm-6 product-cover" data-aos="fade-up"  data-aos-duration="1000" >
                                <div class="product-item">
                                    <a href="index.php?url=Home/product_detail/<?php echo $product->id; ?>">
                                        <img class="img-pro-primary" src="./public/uploads/<?php echo $product->image[0]; ?>" alt="">
                                    </a>
                                    <div class="add_to_cart">
                                        <span id="<?php echo $product->id; ?>" class="btn_add_one_cart">Add to cart</span>
                                        <span ><i class="fa fa-heart"></i></span>
                                    </div>
                                    <div class="product_info">
                                        <a href="index.php?url=Home/product_detail/<?php echo $product->id; ?>">
                                            <?php echo $product->name ?>
                                        </a>
                                        <span><?php echo number_format($product->price_unit) ?>đ<?php
                                                if($product->price_promotion!=0){ ?>
                                                    -<?php echo number_format($product->price_promotion) ?>
                                              <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php }  } ?>

            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php 
                                for($i=1;$i<=$data['total_page_number'];$i++){ ?>
                                    <li class="page-item mx-1" ><a class="page-link" <?php if($data['page_index']==$i){ ?> style="background-color: #b19361; color: #fff;" <?php } ?> href="index.php?url=Home/index/page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php }
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="col"></div>

            </div>
        </div>
    </div>




</div>

<div id="banner">
    <div class="container-fluid">
        <div class="row">
            <?php
                if(isset($data['list_category'])){
                    foreach($data['list_category'] as $category){ ?>
                        <div class="col-md-3 col-sm-6 bg_general bg-primary p-0" data-aos="fade-up" data-aos-duration="1000" style="height: 500px;">
                            <a href="index.php?url=Home/category/<?php echo $category->id; ?>"><img class="bg_general_image" src="./public/uploads/<?php echo $category->image ?>" alt=""><a>
                            <div class="bg_info_banner">
                                <h3><?php echo $category->name; ?></h3>
                                <p><?php echo $category->count_product; ?> products</p>
                                <span class="arrow_icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                            </div>
                            <div class="cover_bg1"></div>
                            <div class="cover_bg2"></div>
                        </div>
            <?php } } ?>


        </div>
    </div>
</div>

<!-- Blog -->
<div id="blog">
    <div id="product-feature">
        <div class="container-fluid">
            <div class="container-cover">

                <div data-aos="fade-right" data-aos-duration="2000">
                    <h5 class="text-left mt-5">BLOG MỚI NHẤT</h5>
                    <span class="text-left mb-5 d-block">Trang trí nhà đẹp giúp tạo nên không gian sống thoải mái</span>
                </div>
                <div class="row">
                    <?php
                        if(isset($data['list_blog'])){
                            foreach($data['list_blog'] as $blog){ ?>
                                <div class="col-lg-4 col-sm-6 mb-5">
                                    <div class="card custom_card">
                                        <a href="index.php?url=Home/blog_detail/<?php echo $blog->id; ?>">
                                            <a href="index.php?url=Home/blog_detail/<?php echo $blog->id ?>">
                                                <img class="card-img-top" src="./public/uploads/<?php echo $blog->image ?>" alt="Card image cap">
                                            </a>
                                        </a>
                                        <div class="card-body">
                                            <h6><a class="text_link" style="font-size:20px;" href="index.php?url=Home/blog_detail/<?php echo $blog->id ?>" ><?php echo $blog->title ?></a></h6>
                                            <p class="card-text"><?php echo $blog->detail_header; ?>
                                            </p>
                                        </div>
                                        <a href="index.php?url=Home/blog_detail/<?php echo $blog->id; ?>" class="text_link">
                                            <h6 class="read_more">read more <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span> </h6>
                                        </a>
                                    </div>
                                </div>
                    <?php } } ?>


                </div>

            </div>
        </div>

    </div>
</div>