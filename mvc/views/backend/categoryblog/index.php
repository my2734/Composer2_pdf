<div class="title_left">
    <h3>Danh sách danh mục(Blog)</h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
               <?php 
                if(isset($data['message'])){?>
                <h5 class="alert alert-success text-white"><?php echo $data['message']; ?></h5>
                <?php }  ?>
                <?php 
                if(isset($data['message_error'])){?>
                <h5 class="alert alert-danger text-white"><?php echo $data['message']; ?></h5>
                <?php } ?>
                
                <a href="index.php?url=CategoryBlog/create">
                    <button class="btn btn-primary">Thêm mới <i class="fa fa-plus"></i></button>
                </a>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục(blog)</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                            if(isset($data['categoryblogs'])){
                                foreach($data['categoryblogs'] as $key => $categoryblog){ ?>
                            <tr>
                                <th scope="row"><?php echo $categoryblog->id; ?></th>
                                <td><?php echo $categoryblog->name; ?></td>
                                <td><span id="<?php echo $categoryblog->id; ?>" class="badge btn_status_categoryofblog btn_status_categoryofblog<?php echo $categoryblog->id ?> badge-sm <?php echo ($categoryblog->status==1)?'badge-danger':'badge-secondary'; ?>"><?php echo ($categoryblog->status==1)?"Hiển thị":"Không hiển thị"; ?></span></td>
                                <td class="text-center">
                                    <a href="index.php?url=CategoryBlog/edit/<?php echo $categoryblog->id; ?>" class="btn btn-sm btn-danger">Edit</a>
                                    <button class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#btn_delete_categoryofblog<?php echo $categoryblog->id ?>">Delete</button>
                                
                                    <div class="modal fade" id="btn_delete_categoryofblog<?php echo $categoryblog->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Xóa danh mục bài viết </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Bạn chắc chắn muốn xóa danh mục này</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="index.php?url=CategoryBlog/delete">
                                                <input type="hidden" name="categoryofblog_id" value="<?php echo $categoryblog->id ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                </div>
                                </td>
                            </tr>

                        <?php }   } ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>