<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid mb-5" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center">Home > Shop > Lịch sử đơn hàng</p>
        </div>
    </div>
</div>
<div class="container-fluid my-5">
    <div class="container-cover">
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
                        <td><?php echo $order['full_name'] ?></td>
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
                            <span class="float-right text-secondary"><?php echo number_format($order_detail['pro_price']) ?>đ x <?php echo $order_detail['pro_quantity'] ?></span>
                            </span><br>
                            <?php } ?>
                            <p class="font-weight-bold mt-3">Thanh toán <span class="float-right "><?php echo number_format($total); ?>đ</span></p>
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
                                        if($order['status']==0)  $string_status = "Chờ xác nhận";
                                        elseif($order['status']==1) $string_status = "Nhận hàng";
                                        else  $string_status = "Đã nhận hàng";       
                                    ?>
                                    <span id="<?php echo $order['id']; ?>" style="cursor:pointer" class="order_status_nhan_hang_confirm<?php echo $order['id']; ?> <?php if($order['status']==1) echo 'btn2 btn_nhan_hang'; ?> btn_confirm_order"><?php echo $string_status; ?></span>
                                    <br>
                                    <?php 
                                        if($order['status']==0){ ?>
                                            <a href="index.php?url=Checkout/destroy/<?php echo $order['id'] ?>" style="cursor:pointer" class="badge badge-danger">Hủy đơn hàng <i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                    
                                
                                </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>