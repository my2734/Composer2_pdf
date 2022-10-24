<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid mb-5" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center">Home > Shop > Shopping Cart</p>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 200px;margin-top: 100px;">
    <div class="container-cover container-cover-cart">
        <div class="update_message_success"></div>
        <?php
            if(isset($data['message_success'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $data['message_success'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php }  ?>
        <div class="row">
            <div class="col-sm-6">
                <form action="index.php?url=Checkout/store" method="POST" enctype="application/x-www-form-urlencoded" class="border_form">
                    <h2 class="text-center mb-4">Thông tin</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User name <span class="text-danger">*</span></label>
                                <input type="text" name="user_name" value="<?php echo isset($data['user_login']->user_name)?$data['user_login']->user_name:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" value="<?php echo isset($data['user_login']->full_name)?$data['user_login']->full_name:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?php echo isset($data['user_login']->email)?$data['user_login']->email:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="<?php echo isset($data['user_login']->phone)?$data['user_login']->phone:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quốc gia <span class="text-danger">*</span></label>
                                <input type="text" name="country" value="<?php echo isset($data['user_login']->country)?$data['user_login']->country:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                <input type="text" name="conscious" value="<?php echo isset($data['user_login']->conscious)?$data['user_login']->conscious:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Huyện/Quận <span class="text-danger">*</span></label>
                                <input type="text" name="district" value="<?php echo isset($data['user_login']->district)?$data['user_login']->district:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Xã/Thị xã <span class="text-danger">*</span></label>
                                <input type="text" name="commune" value="<?php echo isset($data['user_login']->commune)?$data['user_login']->commune:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ chi tiết</label>
                        <input type="text" name="address_detail" value="<?php echo isset($data['user_login']->address_detail)?$data['user_login']->address_detail:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span class="text-danger" style="font-size: 14px;"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ghi chú</label>
                        <input type="text" name="order_note" value="<?php echo isset($data['order_note']->address_detail)?$data['order_note']->address_detail:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span class="text-danger" style="font-size: 14px;"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chọn phương thức thanh toán</label>
                        <select name="method_payment" class="form-control">
                            <option value="0">Thanh toán khi nhận hàng</option>
                            <option value="1">Thanh toán online - MOMO</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn2 btn_login btn-primary mr-4">Đặt hàng</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <table class="table text-center table-bordered table_cart">
                    <thead >
                        <tr >
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($data['list_cart'])){
                                $i=0;
                                foreach ($data['list_cart'] as $key =>  $cart){ 
                                    ?>
                        <tr>
                            <th><?php echo ($i+1) ?></th>
                            <td class="text-center">
                                <div class="cart_img">
                                    <img src="./public/uploads/<?php echo $cart['image'] ?>" alt="">
                                </div>
                            </td>
                            <td><a href=""><?php echo $cart['pro_name']; ?></a></td>
                            <td>$<?php echo $cart['pro_price'] ?></td>
                            <td>
                                <span><?php echo $cart['quatity'] ?></span>
                            </td>
                            <td class="total_price<?php echo $key; ?>">$<?php echo ($cart['pro_price']*$cart['quatity']); ?></td>
                        </tr>
                        <?php }  } ?>
                        <tr>
                            <th colspan="5">Tổng tiền</th>
                            <td class="total_price">$<?php echo isset($data['total_price'])?$data['total_price']:0; ?></td>
                        </tr>
                    </tbody>
                </table>
                <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="index.php?url=Payment/proccess_momo">
                    <input type="submit" class="btn2 text-center btn_review btn-primary" value="Thanh toán bằng trực tuyến MOMO">
                </form>
            </div>
        </div>
    </div>
</div>