<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center"><a class="text-link1" href="index.php?url=Home/index">Home</a> > <a class="text-link1" href="index.php?url=Home/product">Shop</a> > Product detail</p>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container-cover">
        <div class="row mt-5">
            <div  class="col-xl-5 col-lg-6">
                <div class="product_detail_cover">
                    <?php
                    if(isset($data['product_detail'])){ ?>
                        <div class="image_primary_product_detail">
                            <img id="zoom" src="./public/uploads/<?php echo $data['product_detail']->image[0]; ?>" alt="">
                        </div>
                   <?php } ?>
                    <ul class="product_detail_list">
                        <?php
                            if(isset($data['product_detail'])){
                                foreach($data['product_detail']->image as $image){ ?>
                                    <li><img src="./public/uploads/<?php echo $image; ?>" alt=""></li>
                        <?php } } ?>


                    </ul>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 ">
                <h5 class="product_detail_name"><?php echo isset($data['product_detail'])?$data['product_detail']->name:"" ?></h5>
                <ul class="product_detail_start">
                    <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                    <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                    <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                    <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                    <li><span><i  class="fa fa-star-half-o" aria-hidden="true"></i></span></li>
                </ul>
                <h5 class=" display-5"><?php echo ($data['product_detail']->price_promotion!=0)?number_format($data['product_detail']->price_promotion):number_format($data['product_detail']->price_unit); ?>đ</h5>
                <div class="message_success">

                </div>
                <p class="product_detail_description"><?php echo isset($data['product_detail'])?$data['product_detail']->description:"" ?></p>
                <hr>
                <h5>Available Options</h5>
                <p class="product_detail_in_stock my-3"><?php echo isset($data['product_detail'])?$data['product_detail']->quantity:"" ?> IN STOCK</p>
                <p>Quantity</p>
                <div class="d-flex">
                    <input value="1" min="1" class="btn2 input_product_detail product_detail_input_quantity" type="number">
                    <button id="<?php echo $data['product_detail']->id ?>" class="btn2 btn_product_detail product_detail_btn_quantity">Add to cart</button>
                </div>
                <div class="product_detail_like my-4">
                    <a href="">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>  Add to wishlist
                    </a>
                </div>
                <hr>
                <div class="product_detail_category my-4">
                    <span>Danh mục: </span>
                    <a href="index.php?url=Home/category/<?php echo $data['product_detail']->cat_id ?>"><?php echo isset($data['product_detail'])?$data['product_detail']->cat_name:"" ?></a>
                </div>
            </div>
        </div>

        <div class="product_detail_description">
            <nav class="d-flex justify-content-center">
                <div class="nav" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DESCRIPTION</a>
                    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">REVIEW</a>
                </div>
            </nav>
            <!-- <hr> -->
            <div class="tab-content border p-4 " id="nav-tabContent">
                <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p class="tab_description"><?php echo isset($data['product_detail'])?$data['product_detail']->description:""; ?></p>
                    <p class="tab_description">
                        <?php echo isset($data['product_detail'])?$data['product_detail']->description:"" ?>
                    </p>
                </div>
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="comment-item d-flex mb-3">
                        <div class="row">
                            <div class="col-sm-1 col-12">
                                <div class="comment-img pr-xl-0 pr-lg-2 pr-2">
                                    <img src="./images/product/default-9.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-11 col-12">
                                <div class="comment-content pl-4">
                                    <p class="user_name">Keadyn Fraser</p>
                                    <p class="user_comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam,
                                        voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque
                                        nam quod sint provident modi alias culpa, inventore deserunt accusantium amet
                                        earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo
                                        comment-item                            enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe
                                        repellat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="comment-item d-flex mb-3">
                        <div class="row">
                            <div class="col-sm-1 col-12">
                                <div class="comment-img pr-xl-0 pr-lg-2 pr-2">
                                    <img src="./images/product/default-9.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-11 col-12">
                                <div class="comment-content pl-4">
                                    <p class="user_name">Keadyn Fraser</p>
                                    <p class="user_comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam,
                                        voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque
                                        nam quod sint provident modi alias culpa, inventore deserunt accusantium amet
                                        earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo
                                        comment-item                            enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe
                                        repellat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="comment-item d-flex mb-3">
                        <div class="row">
                            <div class="col-sm-1 col-12">
                                <div class="comment-img pr-xl-0 pr-lg-2 pr-2">
                                    <img src="./images/product/default-9.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-sm-11 col-12">
                                <div class="comment-content pl-4">
                                    <p class="user_name">Keadyn Fraser</p>
                                    <p class="user_comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam,
                                        voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque
                                        nam quod sint provident modi alias culpa, inventore deserunt accusantium amet
                                        earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo
                                        comment-item                            enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe
                                        repellat.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div >
                        <h6 style="color: #000; font-size: 16px;">ADD TO REVIEW</h6>
                        <form action="">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Your name *</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Your email *</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Your review</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn2 text-center btn_review btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Product related -->
<div class="container-fluid">
    <div class="container-cover">
        <div data-aos="fade-right" data-aos-duration="2000">
            <h5 class="text-left mt-5">RELATED PRODUCTS</h5>
            <span class="text-left mb-5 d-block">Browse the collection of our related products</span>
        </div>
        <div class="row">
            <?php
                if(isset($data['list_product_relate'])){
                    foreach($data['list_product_relate'] as $product_relate){ ?>
                        <div class="col-xl-3 my-5 col-lg-4 col-sm-6 product-cover">
                            <div class="product-item">
                                <a href="index.php?url=Home/product_detail/<?php echo $product_relate->id ?>">
                                    <img class="img-pro-primary" src="./public/uploads/<?php echo $product_relate->image[0]; ?>" alt="">
                                </a>
                                <div class="add_to_cart">
                                    <span id="<?php echo $product_relate->id ?>" class="btn_add_one_cart">Add to cart</span>
                                    <span><i class="fa fa-heart"></i></span>
                                </div>
                                <div class="product_info">
                                    <a href="index.php?url=Home/product_detail/<?php echo $product_relate->id ?>"><?php echo $product_relate->name ?></a>
                                    <span><?php echo ($product_relate->price_promotion!=0)?number_format($product_relate->price_promotion):number_format($product_relate->price_unit) ?>đ</span>
                                </div>
                            </div>
                        </div>
            <?php } } ?>


        </div>

    </div>
</div>