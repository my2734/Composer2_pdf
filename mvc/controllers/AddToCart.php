<?php
    class AddToCart extends Controller{
        public $product;
        public function __construct(){
            $this->product = $this->model('ProductModel');
        }
        public function add_to_cart(){
            $pro_id = $_GET['pro_id'];
            $qty = $_GET['qty'];
            $id = $pro_id;
            $product_detail = json_decode($this->product->getById($pro_id));

            //set session cart
            if (!isset($_SESSION["cart"])) {
                $cart = array(
                    $id => array(
                        'pro_name' => $product_detail->name,
                        'pro_price' => ($product_detail->price_promotion!=0)?$product_detail->price_promotion:$product_detail->price_unit,
                        'image' => $product_detail->image[0],
                        'quatity' => $qty
                    )
                );
            } else {
                $cart = $_SESSION['cart'];
                if (array_key_exists($id, $cart)) {
                    $cart[$id] = array(
                        'pro_name' => $product_detail->name,
                        'pro_price' => ($product_detail->price_promotion!=0)?$product_detail->price_promotion:$product_detail->price_unit,
                        'image' => $product_detail->image[0],
                        'quatity' => $cart[$id]["quatity"] + $qty
                    );
                } else {
                    $cart[$id] = array(
                        'pro_name' => $product_detail->name,
                        'pro_price' => ($product_detail->price_promotion!=0)?$product_detail->price_promotion:$product_detail->price_unit,
                        'image' => $product_detail->image[0],
                        'quatity' => $qty
                    );
                }
            }
            $_SESSION['cart'] = $cart;

            $total = 0;
            foreach($_SESSION['cart'] as $cart){
                $total+=$cart['quatity'];
            }
            // echo json_encode($_SESSION['cart']);
            echo $total;

        }
    }
?>