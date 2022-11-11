<div class="title_left">
    <h3><?php echo isset($data['blog_edit'])?"Cập nhật Blog":"Thêm mới Blog" ?></h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tạo mới</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                    if(isset($data['message_error'])){?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5><?php echo $data['message_error']; ?></h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php }  ?>

                <form <?php if(isset($data['blog_edit'])){  ?>
                    action="index.php?url=Blog/update/<?php echo $data['blog_edit']->id ?>"
              <?php  }else{ ?>
                    action="index.php?url=Blog/store"
               <?php } ?> method="POST" class="form-label-left input_mask" enctype="multipart/form-data">
                    <div class="col-md-6 col-sm-6  form-group">
                        <label style="font-size: 16px" for="" class="form-label">Tên danh mục (<span class="text-danger">*</span>)</label>
                        <input type="text" class="form-control" value="<?php
                            if(isset($data['blog_edit'])) echo $data['blog_edit']->title;
                            else{
                                if(isset($data['result_old']) && isset($data['result_old']['title'])){
                                    echo $data['result_old']['title'];
                                }
                            }
                        ?>" name="title" placeholder="Nhập tên Blog" >

                        <span class="text-danger">
                            <?php
                               echo isset($data['error']) && isset($data['error']['title']) && isset($data['error']['title'][0])?$data['error']['title'][0]:"";
                            ?>
                        </span>
                    </div>
                    <div class="col-md-6 col-sm-6  form-group">
                        <div class="form-group">
                            <label style="font-size: 16px" for="" class="form-label">Hình ảnh (<span class="text-danger">*</span>)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label form-control" for="exampleInputFile"><?php echo isset($data['blog_edit'])?"Tồn tại ảnh":"Chọn ảnh" ?></label>
                                </div>
                            </div>
                            <span class="text-danger">
                                <?php
                                    echo isset($data['error']) && isset($data['error']['image']) && isset($data['error']['image'][0])?$data['error']['image'][0]:"";
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label style="font-size: 16px" for="" class="form-label">Danh mục</label>
                        <br>
                        <div class="ml-4">
                            <?php
                                if(isset($data['categories'])){
                                    foreach ($data['categories'] as $category){ ?>
                            <input type="checkbox" <?php
                                    if(isset($data['blog_edit'])){
                                        if(in_array($category->id,$data['blog_edit']->cat_ids)){ ?>
                                            checked
                                     <?php   }
                                    }else{
                                        if(isset($data['result_old']) && isset($data['result_old']['cat_ids'])){
                                            if(in_array($category->id,$data['result_old']['cat_ids'])) { ?>
                                                checked
                                            <?php } }
                                    }
                                     ?> name="cat_ids[]" value="<?php echo $category->id ?>" class="form-check-input">
                            <label class="form-check-label mr-5" style="font-size: 14px"><?php echo $category->name ?></label>
                                    <?php  } } ?>
                        </div>
                        <span class="text-danger">
                            <?php
                                echo isset($data['error']) && isset($data['error']['cat_ids']) && isset($data['error']['cat_ids'][0])?$data['error']['cat_ids'][0]:"";
                            ?>
                        </span>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group">
                        <label style="font-size: 16px" for="" class="form-label">Thẻ Blog</label>
                        <br>
                        <div class="ml-4">
                            <?php
                                if(isset($data['tags'])){
                                    foreach($data['tags'] as $tags){ ?>
                                        <input type="checkbox"  <?php
                                        if(isset($data['blog_edit'])){
                                            if(in_array($tags->id,$data['blog_edit']->tags_ids)){ ?>
                                                checked
                                            <?php   }
                                        }else{
                                            if(isset($data['result_old']) && isset($data['result_old']['tags_ids'])){
                                                if(in_array($tags->id,$data['result_old']['tags_ids'])) { ?>
                                                    checked
                                                <?php } }
                                        }
                                             ?> name="tags_ids[]" value="<?php echo $tags->id ?>" class="form-check-input">
                                        <label class="form-check-label mr-5" style="font-size: 14px"><?php echo $tags->name ?></label>
                            <?php } } ?>


                        </div>
                        <span class="text-danger">
                            <?php
                                echo isset($data['error']) && isset($data['error']['tags_ids']) && isset($data['error']['tags_ids'][0])?$data['error']['tags_ids'][0]:"";
                            ?>
                        </span>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <label style="font-size: 16px" for="" class="form-label">Mở đầu bài viết</label>
                        <textarea rows="5" name="detail_header" class="form-control"><?php
                                if(isset($data['blog_edit']) && isset($data['blog_edit']->detail_header)){
                                    echo $data['blog_edit']->detail_header;
                                }else{
                                    if(isset($data['result_old']) && isset($data['result_old']['detail_header'])){
                                        echo $data['result_old']['detail_header'];
                                    }
                                }
                            ?></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <label style="font-size: 16px" for="" class="form-label">Nội dung bài viết</label>
                        <textarea rows="5" name="detail_body" class="form-control"><?php
                            if(isset($data['blog_edit']) && isset($data['blog_edit']->detail_body)){
                                echo $data['blog_edit']->detail_body;
                            }else{
                                if(isset($data['result_old']) && isset($data['result_old']['detail_body'])){
                                    echo $data['result_old']['detail_body'];
                                }
                            }
                            ?>
                        </textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <label style="font-size: 16px" for="" class="form-label">Cuối bài viết</label>
                        <textarea rows="5" name="detail_footer" class="form-control"><?php
                                if(isset($data['blog_edit'])  && isset($data['blog_edit']->detail_footer)){
                                    echo $data['blog_edit']->detail_footer;
                                }else{
                                    if(isset($data['result_old']) && isset($data['result_old']['detail_footer'])){
                                        echo $data['result_old']['detail_footer'];
                                    }
                                }
                            ?>
                        </textarea>
                    </div>
                    <div class="col-md-12 mt-4 col-sm-12 ">
                        <div class="checkbox">
                            <label style="font-size: 16px">
                                <input name="status" value="1" <?php
                                if(isset($data['blog_edit']) && $data['blog_edit']->status==1) { ?>
                                    checked
                                 <?php }else{
                                    if(isset($data['result_old']) && isset($data['result_old']['status'])) { ?>
                                        checked
                                 <?php   } } ?> type="checkbox" value=""> Trạng thái
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="http://127.0.0.1:8000/trang-admin/bai-viet"><button type="button" class="btn btn-primary">Cancel</button></a>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
<!--                    <input type="hidden" name="_token" value="DMk50zxxLpu1K9ZGOF2IejakwZePjikGhCWji9Mj">-->
                </form>
            </div>
        </div>
    </div>
</div>
