<?php
    class Cart extends Controller{
        public $category;
        public $user_login;
        public function __construct(){
            $this->category = $this->model('CategoryModel');
            $this->user_login = $this->model('UserModel');
        }
        public function shopping_cart(){
            
            // unset($_SESSION['cart']);
          
//            echo json_encode($_SESSION['cart']);
            $total_cart = 0;
            $total_price = 0;
            $categories = json_decode($this->category->getList());
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                    $total_price+=$cart['pro_price']*$cart['quatity'];
                }
            }
            if(isset($_SESSION['user_login'])){
                $list_cart = array();
                if(isset($_SESSION['cart'])){
                    $list_cart = $_SESSION['cart'];
                }

                $this->view('frontend/layout/master',[
                    'page' => 'frontend/pages/shopping_cart',
                    'categories'            => $categories,
                    'list_cart'     => $list_cart,
                    'total_cart'    => $total_cart,
                    'total_price'   => $total_price
                ]);
            }
        }

        public function update_to_cart()
        {
            $pro_id = $_GET['pro_id'];
            $qty = $_GET['qty'];
            $cart = $_SESSION['cart'];
            $cart[$pro_id]['quatity'] = $qty;
            $total_price_item = $cart[$pro_id]['quatity']*$cart[$pro_id]['pro_price'];
            $_SESSION['cart'] = $cart;
            $total = 0;
            $total_price=0;
            foreach ($_SESSION['cart'] as $cart) {
                $total += $cart['quatity'];
                $total_price+=$cart['pro_price']*$cart['quatity'];
            }
            $data = array();
            $data['total_qty'] = $total;
            $data['total_price_item'] =$total_price_item;
            $data['id'] = $pro_id;
            $data['total_price'] = $total_price;
            echo json_encode($data);
        }

        public function delete_product($id){
            $list_cart = $_SESSION['cart'];
            foreach($list_cart as $key => $cart){
                if($id==$key){
                    unset($list_cart[$id]);
                }
            }
            // echo json_encode($list_cart);
            // die();
            $_SESSION['cart'] = $list_cart;

            $total_cart = 0;
            $total_price = 0;
            $categories = json_decode($this->category->getList());
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                    $total_price+=$cart['pro_price']*$cart['quatity'];
                }
            }
            if(isset($_SESSION['user_login'])){
                $this->view('frontend/layout/master',[
                    'page' => 'frontend/pages/shopping_cart',
                    'categories'            => $categories,
                    'list_cart'  => $_SESSION['cart'],
                    'total_cart'    => $total_cart,
                    'message_success' => 'Xóa sản phẩm thành công',
                    'total_price'   => $total_price
                ]);
            }
        }

        public function checkout(){
            $id = $_SESSION['user_login']['id'];
           
            $user_login = json_decode($this->user_login->getId($id));


            $total_cart = 0;
            $total_price = 0;
            $categories = json_decode($this->category->getList());
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                    $total_price+=$cart['pro_price']*$cart['quatity'];
                }
            }
           
            if(isset($_SESSION['user_login'])){
                $this->view('frontend/layout/master',[
                    'page' => 'frontend/pages/checkout',
                    'categories'            => $categories,
                    'list_cart'  => $_SESSION['cart'],
                    'total_cart'    => $total_cart,
                    'total_price'   => $total_price,
                    'user_login'    => $user_login
                ]);
            }
        }

        public function hello(){
            echo "hello";
        }


    }
?>