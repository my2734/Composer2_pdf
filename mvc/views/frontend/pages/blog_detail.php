<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid mb-5" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center"><a class="text-link1" href="index.php?url=Home/index">Home</a> > <a class="text-link1" href="index.php?url=Home/blog">Blog</a> > Blog Detail</p>
        </div>
    </div>
</div>
<div class="container-fluid my-5">
    <div class="container-cover">
        <div class="row">
            <div  class="col-lg-3 col-md-12" style="margin-bottom: 200px">
                <h5>Categories</h5>
                <hr class="separate_category">
                <div class="list_category">
                    <?php
                    if(isset($data['list_categoryofblog'])){
                        foreach($data['list_categoryofblog'] as $categoryofblog){ ?>
                            <p><a class="text_link" href=""><?php echo $categoryofblog->name ?></a></p>
                        <?php } } ?>


                </div>

                <h5 class="mt-5">Tags Blog</h5>
                <hr class="separate_category">
                <?php
                if(isset($data['list_tags'])){
                    foreach($data['list_tags'] as $tags){ ?>
                        <a class="tags_blog"><?php echo $tags->name ?></a>
                    <?php } } ?>


            </div>
            <!-- End Category -->
            <div class="col-lg-9" >
                <div class="row">
                    <div class="blog_detail_img">
                        <img src="./public/uploads/<?php echo $data['blog_detail']->image; ?>" alt="">
                    </div>
                    <h5 class="blog_detail_name"> <?php echo $data['blog_detail']->title; ?> </h5>
                    <div class="blog_detail_content">
                        <p><?php echo $data['blog_detail']->detail_header ?>
                        </p>
                        <p class="blog_detail_content_sub"><?php echo $data['blog_detail']->detail_body; ?>
                        </p>
                        <p><?php echo $data['blog_detail']->detail_footer; ?>
                        </p>
                    </div>
                    <div class="w-100">
                        <p>
                            <span class="font-weight-bold mr-3">Tags:    </span>
                            <?php
                                if(isset($data['blog_detail'])){
                                    foreach($data['blog_detail']->tags_names as $key => $tags_name){
                                        if($key!=0){
                                            echo ",";
                                        }
                                        echo $tags_name.' ';

                                    }
                                }
                            ?>
                        </p>
                        <p>
                            <span class="font-weight-bold mr-3">Category:    </span>
                            <?php
                            if(isset($data['blog_detail'])){
                                foreach($data['blog_detail']->catofblog_names as $key => $catofblog_name){
                                    if($key!=0){
                                        echo ",";
                                    }
                                    echo $catofblog_name.' ';

                                }
                            }
                            ?>
                        </p>
                    </div>
                    <div class="">
                        <h3>3 Comments</h3>
                    </div>
                    <br>
                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="comment-item d-flex mb-3">
                            <div class="row">
                                <div class="col-sm-1 col-12">
                                    <div class="comment-img pr-xl-0 pr-lg-4 pr-2">
                                        <img src="./images/product/default-9.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-11 col-12">
                                    <div class="comment-content pl-4 pl-lg-4">
                                        <p class="user_name">Keadyn Fraser</p>
                                        <p class="user_comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam,
                                            voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque
                                            nam quod sint provident modi alias culpa, inventore deserunt accusantium amet
                                            earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo
                                            comment-item                            enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe
                                            repellat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="comment-item d-flex mb-3">
                            <div class="row">
                                <div class="col-sm-1 col-12">
                                    <div class="comment-img pr-xl-0 pr-lg-4 pr-2">
                                        <img src="./images/product/default-9.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-11 col-12">
                                    <div class="comment-content pl-4 pl-lg-4">
                                        <p class="user_name">Keadyn Fraser</p>
                                        <p class="user_comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam,
                                            voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque
                                            nam quod sint provident modi alias culpa, inventore deserunt accusantium amet
                                            earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo
                                            comment-item                            enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe
                                            repellat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
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
</div>