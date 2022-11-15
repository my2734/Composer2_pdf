<div class="container-fluid mb-5" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center"><a class="text-link1" href="index.php?url=Home/index">Home</a> > <a class="text-link1" href="index.php?url=Home/product">Shop</a> > Shopping Cart</p>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 200px;margin-top: 100px;">
    <div class="container-cover container-cover-cart">
        <div>
            <a href="index.php?url=History_Order" style="text-decoration:none;margin-top: 80px;" class="btn2  product_detail_btn_quantity text-white float-right mb-4">Lịch sử mua hàng<a>
        </div>
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
        <table class="table text-center table-bordered table_cart">
            <thead >
                <tr >
                    <th scope="col">Delete</th>
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
                        foreach ($data['list_cart'] as $key =>  $cart){ ?>
                <tr>
                    <th><a href="index.php?url=Cart/delete_product/<?php echo $key; ?>"><span style="margin-top: 40px;"><i class="fa fa-trash-o"></i></span></a></th>
                    <td class="text-center">
                        <div class="cart_img">
                            <img src="./public/uploads/<?php echo $cart['image'] ?>" alt="">
                        </div>
                    </td>
                    <td><a href=""><?php echo $cart['pro_name']; ?></a></td>
                    <td><?php echo number_format($cart['pro_price']) ?>đ</td>
                    <td>
                        <input id="<?php echo $key ?>" value="<?php echo $cart['quatity'] ?>" min="1" class="update_quantity_shoppingcart input_product_detail product_detail_input_quantity" type="number">
                    </td>
                    <td class="total_price<?php echo $key; ?>"><?php echo number_format($cart['pro_price']*$cart['quatity']); ?>đ</td>
                </tr>
                <?php }  } ?>
                <tr>
                    <th colspan="5">Tổng tiền</th>
                    <td class="total_price"><?php echo isset($data['total_price'])?number_format($data['total_price']):0; ?>đ</td>
                </tr>
            </tbody>
        </table>
        <a href="index.php?url=Cart/checkout" style="text-decoration: none" class="btn2 product_detail_btn_quantity text-white float-right">Thanh toán<a>
    </div>
</div>