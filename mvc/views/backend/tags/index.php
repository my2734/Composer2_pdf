<div class="title_left">
    <h3>Danh sách danh mục</h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <?php  if(isset($data['message'])){ ?>
                    <h5 class="alert alert-success text-white"><?php echo $data['message']; ?></h5>
                <?php }  ?>
                <?php  if(isset($data['message_error'])){ ?>
                    <h5 class="alert alert-danger text-white"><?php echo $data['message_error']; ?></h5>
                <?php }  ?>
                <a href="index.php?url=Tags/create">
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
                            <th >ID</th>
                            <th>Tên Tags</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($data['tagses'])){
                                foreach($data['tagses'] as $key => $tags){ ?>
                            <tr>
                            <th scope="row"><?php echo $tags->id ?></th>
                            <td><?php echo $tags->name ?></td>
                            <td><span id="<?php echo $tags->id; ?>" class="badge btn_status_tags btn_status_tags<?php echo $tags->id ?> badge-sm <?php echo ($tags->status==1)?'badge-danger':'badge-secondary' ?>"><?php echo ($tags->status==1)?"Hiển thị":"Không hiển thị"; ?></span></td>
                            <td class="text-center">
                                <a href="index.php?url=Tags/edit/<?php echo $tags->id ?>" class="btn btn-sm btn-danger">Edit</a>
                                <button class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#btn_delete_tags<?php echo $tags->id ?>">Delete</button>
                                
                                <div class="modal fade" id="btn_delete_tags<?php echo $tags->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Xóa Tags bài viết </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Bạn chắc chắn muốn xóa tags này</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="index.php?url=Tags/delete">
                                            <input type="hidden" name="tags_id" value="<?php echo $tags->id ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                               
                            </td>
                        </tr>
                        <?php } } ?>
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>