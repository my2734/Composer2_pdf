<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <?php
            if(isset($data['message_success'])){ ?>
                <h5 class="alert alert-success text-white"><?php echo $data['message_success'] ?></h5>
            <?php } ?>

            <a href="index.php?url=Slider/create" class="btn btn-primary">Thêm mới <i class="fa fa-plus"></i></a>
            <div class="x_title">
                <h2>Danh sách slider</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(isset($data['list_slider'])){
                            foreach($data['list_slider'] as $key => $slider){ ?>
                                <tr>
                                    <th scope="row"><?php echo ($key+1) ?></th>
                                    <td><img height="100px;" src="./public/uploads/<?php echo $slider->image; ?>"></td>
                                    <td><?php echo ($slider->status==1)?"Hiển thị":"Không hiển thị" ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#btn_delete_slider<?php echo $slider->id ?>">Delete</button>

                                        <div class="modal fade" id="btn_delete_slider<?php echo $slider->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Xóa hình ảnh </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Bạn chắc chắn muốn xóa hình ảnh này</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="index.php?url=Slider/delete">
                                                            <input type="hidden" name="slider_id" value="<?php echo $slider->id ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                    <?php }  } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>