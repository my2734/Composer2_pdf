<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <a href="index.php?url=Blog/create" class="btn btn-primary">Thêm mới <i class="fa fa-plus"></i></a>
            <div class="x_title">
                <h2>Danh sách Blog</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                     if(isset($data['message_success'])){ ?>
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <h5><strong><?php echo $data['message_success']; ?></strong></h5>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                <?php } ?>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Tags</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                    </thead>
                        <tbody>
                            <?php
                                if(isset($data['list_blog'])){
                                    foreach($data['list_blog'] as $key => $blog){ ?>
                            <tr>
                                <th scope="row"><?php echo $blog->id ?></th>
                                <td><?php echo $blog->title; ?></td>
                                <td><img height="100px;" src="./public/uploads/<?php echo $blog->image; ?>"></td>
                                <td>
                                    <?php
                                        if(isset($blog->cat_name)){
                                            foreach($blog->cat_name as $cat_name){ ?>
                                                <span class="badge badge-sm badge-primary"><?php echo $cat_name; ?></span>
                                    <?php } } ?>
                                </td>
                                <td>
                                    <?php
                                    if(isset($blog->tags_name)){
                                        foreach($blog->tags_name as $tags_name){ ?>
                                            <span class="badge badge-sm badge-primary"><?php echo $tags_name; ?></span>
                                    <?php }  } ?>
                                </td>
                                <td><span id="<?php echo $blog->id; ?>" class="badge btn_status_blog<?php echo $blog->id ?> btn_status_blog badge-sm <?php echo ($blog->status==1)?'badge-danger':'badge-secondary'; ?>"><?php echo ($blog->status==1)?"Hiển thị":"Không hiển thị" ?></span></td>
                                <td>
                                    <a href="index.php?url=Blog/edit/<?php echo $blog->id ?>" class="btn btn-sm btn-warning text-white">Edit</a>
                                    <button class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#btn_delete_blog<?php echo $blog->id ?>">Delete</button>

                                    <div class="modal fade" id="btn_delete_blog<?php echo $blog->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Xóa bài viết </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>Bạn chắc chắn muốn xóa bài viết này</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="index.php?url=Blog/delete">
                                                        <input type="hidden" name="blog_id" value="<?php echo $blog->id ?>">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <?php } } ?>
                        </tbody>
                </table>
            </div>
            <div class="dataTables_paginate paging_simple_numbers float-right" id="datatable-checkbox_paginate">
                <ul class="pagination">
                    <?php 
                        for($i=1;$i<=$data['total_page_number'];$i++){ ?>
                                <li class="paginate_button active"><a <?php if(isset($data['page_index']) && $data['page_index']==$i){ ?> style="color: #fff;" <?php }?> href="index.php?url=Blog/index/page=<?php echo $i ?>" aria-controls="datatable-checkbox" data-dt-idx="1" tabindex="0"><?php echo ($i) ?></a></li>
                    <?php  }  ?>
                </ul>
            </div>
        </div>
    </div>
</div>