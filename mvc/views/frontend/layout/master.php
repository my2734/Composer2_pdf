<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang chủ</title>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Plugin js -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Font Awesome 4.7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Custom css Style  -->
    <link rel="stylesheet" href="./public/frontend/css/style.css">
    <style>
        .text_link{
            font-size: 14px;
            font-weight: 700;
            transition: color 0.3s linear;
            color: #333;
            text-decoration: none !important;
        }

        .text_link:hover{
            color: #b19361;
        }



    </style>

</head>
<body style="position: relative;">
<!--<div class="loader_bg">-->
<!--    <div class="loader"></div>-->
<!--</div>-->
<?php
    include('./mvc/views/frontend/block/topNav.php');
?>

<?php
if(isset($data['page'])){
    include('./mvc/views/'.$data['page'].'.php');
}
?>


<?php
include('./mvc/views/frontend/block/footer.php');
?>



<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap 4  -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>






<script>
    AOS.init();
    AOS.refresh();
</script>
<script src="./public/frontend/js/main.js"></script>
<script>
    $(document).ready(function(){
        $('.btn_add_one_cart').click(function(){
           var pro_id = $(this).attr('id');

            $.get({
                url: "index.php?url=AddToCart/add_to_cart",
                data: {pro_id:pro_id,qty:1},
                success: function(data){
                    $('.quantity_total_cart').html(data);
                }
            });

        });

        $('.btn_product_detail').click(function(){
            var pro_id = $(this).attr('id');
            var qty = $('.input_product_detail').val();
            
            $.get({
                url: "index.php?url=AddToCart/add_to_cart",
                data: {pro_id:pro_id,qty:qty},
                success: function(data){
                    $('.quantity_total_cart').html(data);
                    $('.message_success').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thêm vào giỏ hàng thành công</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
                }
            });
        });
        $('.update_quantity_shoppingcart').blur(function(){
            const pro_id = $(this).attr('id');
            const qty = $(this).val();
            $.get({
                url: "index.php?url=Cart/update_to_cart",
                data: {pro_id:pro_id,qty:qty},
                success: function(data){
                    data = JSON.parse(data);

                    $('.quantity_total_cart').html(data['total_qty']);
                    $('.update_message_success').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cập nhật giỏ hàng thành công</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
                   $('.total_price'+data['id']).html('$'+data['total_price_item']);
                   $('.total_price').html('$'+data['total_price']);
                }
            });
        });

        $('.btn_nhan_hang').click(function(){
            const order_id = $(this).attr('id');
            $.get({
                url: "index.php?url=Order/change_status_nhan_hang",
                data: {order_id:order_id},
                success: function(data){
                    data = JSON.parse(data);
                    $('.order_status_nhan_hang_confirm'+data['order_id']).html(data['string_status']);
                    $('.order_status_nhan_hang_confirm'+data['order_id']).removeClass('btn2');
                }
            });
        });
    });
</script>

</body>
</html>