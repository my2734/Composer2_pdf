<?php
    require_once('./mvc/controllers/Mail.php');
    require_once('./mvc/controllers/Payment.php');

    class Checkout extends Controller{
        public $slider;
        public $product;
        public $category;
        public $blog;
        public $categoryofblog;
        public $tags;
        public $blog_categoryofblog;
        public $blog_tags;
        public $order;
        public $order_detail;
        
        public function __construct()
        {
            $this->slider = $this->model('SliderModel');
            $this->product = $this->model('ProductModel');
            $this->category = $this->model('CategoryModel');
            $this->blog = $this->model('BlogModel');
            $this->categoryofblog = $this->model('CategoryBlogModel');
            $this->tags = $this->model('TagsModel');
            $this->blog_categoryofblog = $this->model('Blog_CategoryOfBlogModel');
            $this->blog_tags = $this->model('Blog_TagsModel');
            $this->order = $this->model('OrderModel');
            $this->order_detail = $this->model('Order_DetailModel');
        }

        public function destroy($order_id){
            $result = json_decode($this->order->delete_order_id($order_id));
            if($result){
                $this->order_detail->delete_order_id($order_id);
            }
            header('location: index.php?url=History_Order');

        }

       public function store(){
        $error = array();
        $test_validate = false;
        $result_old = array();
        //1. user_name
        $error['user_name'] = array();
        if($_POST['user_name']==""){
            $test_validate = true;
            array_push($error['user_name'],'Vui lòng nhập username');
        }else{
            $result_old['user_name'] = $_POST['user_name'];
        }

        //2. full_name
        $error['full_name'] = array();
        if($_POST['full_name']==""){
            $test_validate = true;
            array_push($error['full_name'],'Vui lòng nhập họ và tên');
        }else{
            $result_old['full_name'] = $_POST['full_name'];
        }

        //3. email
        $error['email'] = array();
        if($_POST['email']=="") {
            $test_validate = true;
            array_push($error['email'],'Vui lòng nhập email');
        }else{
            $result_old['email'] = $_POST['email'];
        }

        //4. phone
        $error['phone'] = array();
        if($_POST['phone']==""){
            $test_validate = true;
            array_push($error['phone'],'Nhập số điện thoại');
        }else{
            $result_old['phone'] = $_POST['phone'];
        }

        //5. country
        $error['country'] = array();
        if($_POST['country']==""){
            $test_validate = true;
            array_push($error['country'],'Vui lòng nhập tên quốc gia');
        }else{
            $result_old['country'] = $_POST['country'];
        }

        //6. conscious
        $error['conscious'] =array();
        if($_POST['conscious']==""){
            $test_validate = true;
            array_push($error['conscious'],'Vui lòng nhập tên tỉnh/thành phố');
        }else{
            $result_old['conscious'] = $_POST['conscious'];
        }

        //7. district
        $error['district']=array();
        if($_POST['district']==""){
            $test_validate = true;
            array_push($error['district'],'Vui lòng nhập tên quận/huyện');
        }else{
            $result_old['district'] = $_POST['district'];
        }

        //8. commune
        $error['commune'] = array();
        if($_POST['commune']==""){
            $test_validate = true;
            array_push($error['commune'],'Vui lòng nhập tên xã/thị xã');
        }else{
            $result_old['commune'] = $_POST['commune'];
        }
            
        if($test_validate){
            $this->view('frontend/login/register',[
                'error'         => $error,
                'result_old'    => $result_old
            ]);
        }else{
            
            $user_id = $_SESSION['user_login']['id'];
            $full_name = $_POST['full_name'];
            $country = $_POST['country'];
            $conscious = $_POST['conscious'];
            $district = $_POST['district'];
            $commune = $_POST['commune'];
            $address_detail = isset($_POST['address_detail'])?$_POST['address_detail']:"";
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $order_note = isset($_POST['order_note'])?$_POST['order_note']:"";
            $status = 0;
            $created_at = Date('Y-m-d H:i:s');
            $updated_at = Date('Y-m-d H:i:s');
            $order_id = json_decode($this->order->insert($user_id,$full_name,$country,$conscious,$district,$commune,$address_detail,$phone,$email,$order_note,$status,$created_at,$updated_at));
           
            if(isset($order_id)){
                $list_cart = $_SESSION['cart'];
                $total = 0;
                foreach($list_cart as $key => $cart){
                    
                    $order_id = $order_id;
                    $user_id = $user_id;
                    $pro_id = $key;
                    $pro_name = $cart['pro_name'];
                    $pro_image = $cart['image'];
                    $pro_price = $cart['pro_price'];
                    $pro_quantity = $cart['quatity'];
                    $created_at = $created_at;
                    $updated_at = $updated_at;
                    $total += (int)$pro_price*$pro_quantity;
                    $result = json_decode($this->order_detail->insert($order_id,$user_id,$pro_id,$pro_name,$pro_image,$pro_price,$pro_quantity,$created_at,$updated_at));
                }
            }
            //Gui email
            $order_info = json_decode($this->order->getId($order_id),true);
            $order_info['order_detail'] = json_decode($this->order_detail->getList_by_orderid($order_id),true);
           
        
            
            $mail = new Mail();
            $mail->sendMail_Order($order_info);
            if($_POST['method_payment']==1){
                $payment =  new Payment();
                unset($_SESSION['cart']);
                $payment->proccess_momo($total);
            }elseif($_POST['method_payment']==2){
                $payment =  new Payment();
                unset($_SESSION['cart']);
                $payment->proccess_vnpay($total);
            }


            
            

            if(isset($order_id)){
                // unset($_SESSION['cart']);
                header('location: index.php?url=History_Order');
            }
        }


    }
    }
?>