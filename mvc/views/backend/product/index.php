<div class="title_left">
    <h3>Danh sách sản phẩm</h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
        
            <div class="x_title">
                <?php 
                    if(isset($data['message'])){ ?>
                        <h5 class="alert alert-success text-white"><?php echo $data['message']; ?></h5>
                    <?php } ?>
                <a href="index.php?url=Product/create">
                    <button class="btn btn-primary">Thêm mới <i class="fa fa-plus"></i></button>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá gốc</th>
                            <th>Giá khuyến mãi</th>
                            <th>Trạng thái</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($data['productes'])){
                                foreach($data['productes'] as $key => $product){ ?>
                        <tr>
                            <th scope="row"><?php echo ($key+1); ?></th>
                            <td width="150"><?php echo $product->name; ?></td>
                            <td><?php echo $product->price_unit; ?></td>
                            <td><?php echo $product->price_promotion; ?></td>
                            <td><span id="<?php echo $product->id ?>" class="badge btn_status_product<?php echo $product->id ?> btn_status_product badge-sm <?php echo ($product->status==1)?'badge-danger':'badge-secondary'  ?>"><?php echo ($product->status==1)?"Hiển thị":"Không hiển thị"; ?></span></td>
                            <td><?php echo $product->quantity; ?></td>
                            <td>
                               <?php
                                    foreach($product->image as $image){ ?>
                                    <img class="mb-2" src="./public/uploads/<?php echo $image; ?>" width="50" height="50" style="object-fit: cover;" alt="">
                                <?php    }  ?>
                            </td>
                            <td><?php echo $product->cat_name; ?></td>
                            <td class="text-center">
                                <a href="index.php?url=Product/edit/<?php echo $product->id; ?>" class="btn btn-sm btn-danger">Edit</a>
                                <button class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#btn_delete_product<?php echo $product->id ?>">Delete</button>

                                <div class="modal fade" id="btn_delete_product<?php echo $product->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Xóa sản phẩm </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Bạn chắc chắn muốn xóa sản phẩm này</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="index.php?url=Product/delete">
                                                    <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
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
                <div class="dataTables_paginate paging_simple_numbers" id="datatable-checkbox_paginate">
                    <ul class="pagination">
                        <?php 
                            for($i=1;$i<=$data['page_number'];$i++){ ?>
                                    <li class="paginate_button active" ><a <?php if(isset($data['page_index']) && $data['page_index']==$i){ ?> style="color: #fff;" <?php }?> href="index.php?url=Product/index/page=<?php echo $i ?>" aria-controls="datatable-checkbox" data-dt-idx="1" tabindex="0"><?php echo ($i) ?></a></li>
                           <?php  }  ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>