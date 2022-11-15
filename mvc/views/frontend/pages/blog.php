<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center"><a class="text-link1" href="index.php?url=Home/index">Home</a>  > <?php
                if(isset($data['list_categoryofblog'])) echo "Blog";
                elseif(isset($data['list_blog_of_category'])) echo "Danh mục(Blog)";
                elseif(isset($data['list_blog_of_tags'])) echo "Thẻ(Blog)";
                ?></p>
        </div>
    </div>
</div>
<div class="container-fluid">
<div class="container-cover">
    <div class="row">
        <!-- Start Category -->
        <div  class="col-lg-3 col-md-12" style="margin-bottom: 200px">
            <h5>Categories</h5>
            <hr class="separate_category">
            <div class="list_category">
                <?php
                    if(isset($data['list_categoryofblog'])){
                        foreach($data['list_categoryofblog'] as $categoryofblog){ ?>
                <p><a href="index.php?url=Home/categoryofblog/<?php echo $categoryofblog->id ?>" class="text_link" href=""><?php echo $categoryofblog->name ?></a></p>
                <?php } } ?>
            </div>
            <h5 class="mt-5">Tags Blog</h5>
            <hr class="separate_category">
            <?php
                if(isset($data['list_tags'])){
                    foreach($data['list_tags'] as $tags){ ?>
            <a style="text-decoration: none" href="index.php?url=Home/tags/<?php echo $tags->id ?>" class="tags_blog"><?php echo $tags->name ?></a>
            <?php } } ?>
        </div>
        <!-- End Category -->
        <div class="col-lg-9">
            <div class="row">
                <?php
                    if(isset($data['list_blog'])){
                        foreach($data['list_blog'] as $blog){ ?>
                <div class="col-lg-6 col-md-6 mb-5">
                    <div class="card custom_card">
                        <a href="index.php?url=Home/blog_detail/<?php echo $blog->id; ?>">
                        <img class="card-img-top" src="./public/uploads/<?php echo $blog->image ?>" alt="Card image cap">
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
                <?php } }elseif (isset($data['list_blog_of_category'])){
                    foreach($data['list_blog_of_category'] as $blog){ ?>
                <div class="col-lg-6 col-md-6 mb-5">
                    <div class="card custom_card">
                        <a href="index.php?url=Home/blog_detail/<?php echo $blog->id; ?>">
                        <img class="card-img-top" src="./public/uploads/<?php echo $blog->image ?>" alt="Card image cap">
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
                <?php }  }elseif(isset($data['list_blog_of_tags'])){
                    foreach($data['list_blog_of_tags'] as $blog){ ?>
                <div class="col-lg-6 col-md-6 mb-5">
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
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php 
                                for($i=1;$i<=$data['total_page_number'];$i++){ ?>
                            <li class="page-item mx-1" ><a class="page-link" <?php if($data['page_index']==$i){ ?> style="background-color: #b19361; color: #fff;" <?php } ?> href="index.php?url=Home/blog/page=<?php echo $i ?>"><?php echo $i ?></a></li>
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