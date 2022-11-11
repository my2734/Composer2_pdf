<div class="title_left">
    <h3>Danh sách đơn hàng</h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            
            <div class="x_content">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Người nhận hàng</th>
                                <th class="text-center">Thông tin sản phẩm</th>
                                <th class="text-center">Địa chỉ giao hàng</th>
                                <th class="text-center">Ngày đặt hàng</th>
                                <th class="text-center">Tình trạng đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($data['list_order'])){ 
                                    foreach($data['list_order'] as $key => $order){ ?>
                            <tr>
                                <th scope="row"><?php echo ($key+1); ?></th>
                                <td><?php echo $order['full_name'] ?><br><a href="index.php?url=Order/print_order/<?php echo $order['id']; ?>"><i class="fa fa-print" aria-hidden="true"></i> In đơn hàng<a></td>
                                <td>
                                    <?php
                                        $total =0;
                                            foreach($order['order_detail'] as $order_detail){  
                                                    $total += $order_detail['pro_price']*$order_detail['pro_quantity'];
                                                ?>
                                    <span>
                                    <span><?php echo $order_detail['pro_name']; ?></span>
                                    </span><br>
                                    <span>
                                    <img height="50" width="50" src="./public/uploads/<?php echo $order_detail['pro_image'] ?>" alt="">
                                    <span class="float-right text-secondary"><?php echo number_format($order_detail['pro_price']) ?>vnđ x <?php echo $order_detail['pro_quantity'] ?></span>
                                    </span><br>
                                    <?php } ?>
                                    <p class="font-weight-bold mt-3">Thanh toán <span class="float-right "><?php echo number_format($total); ?>vnđ</span></p>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">Quốc gia</div>
                                        <div class="col-md-6"><?php echo $order['country'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Tỉnh/Thành phố</div>
                                        <div class="col-md-6"><?php echo $order['conscious'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Quận/Huyện</div>
                                        <div class="col-md-6"><?php echo $order['district'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Xã/Thị xã</div>
                                        <div class="col-md-6"><?php echo $order['commune'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"> Địa chỉ chi tiết</div>
                                        <div class="col-md-6"><?php echo $order['address_detail'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Số điện thoại</div>
                                        <div class="col-md-6"><?php echo $order['email'] ?></div>
                                    </div>
                                </td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td class="text-center">
                                    <?php 
                                        $string_status = "";
                                        if($order['status']==0)  $string_status = "Xác nhận";
                                        elseif($order['status']==1) $string_status = "Đang giao hàng";
                                        else  $string_status = "Đã nhận hàng";       
                                    ?>
                                    <span id="<?php echo $order['id']; ?>" style="cursor:pointer" class="order_status_confirm<?php echo $order['id']; ?> <?php if($order['status']==0) echo 'btn btn-sm btn-primary'; ?> btn_confirm_order"><?php echo $string_status; ?></span>
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
                                    <li class="paginate_button active"><a <?php if(isset($data['page_index']) && $data['page_index']==$i){ ?> style="color: #fff;" <?php }?>  href="index.php?url=Order/index/page=<?php echo $i ?>" aria-controls="datatable-checkbox" data-dt-idx="1" tabindex="0"><?php echo ($i) ?></a></li>
                        <?php  }  ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>