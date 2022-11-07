<?php
    class User_Login extends Controller{
        public $user;
        public $slider;
        public $product;
        public $category;
        public $blog;
        public $categoryofblog;
        public $tags;
        public $blog_categoryofblog;
        public $blog_tags;
        public function __construct()
        {
            $this->user = $this->model('UserModel');
            $this->slider = $this->model('SliderModel');
            $this->product = $this->model('ProductModel');
            $this->category = $this->model('CategoryModel');
            $this->blog = $this->model('BlogModel');
            $this->categoryofblog = $this->model('CategoryBlogModel');
            $this->tags = $this->model('TagsModel');
            $this->blog_categoryofblog = $this->model('Blog_CategoryOfBlogModel');
            $this->blog_tags = $this->model('Blog_TagsModel');
        }

       

        public function login(){
            $this->view('frontend/login/login');
        }

        public function logout(){

            if(isset($_SESSION['user_login'])){
                unset($_SESSION['user_login']);
            }
            $this->view('frontend/login/login');
            header('location index.php?url=User_Login/login');

        }

        public function post_login(){
            $test_validate = false;
            $result_old =  array();
            $error = array();
            //1 email
            $error['email'] = array();
            if($_POST['email']==""){
                $test_validate = true;
                array_push($error['email'],'Vui lòng nhập email');
            }else{
                $result_old['email'] = $_POST['email'];
            }

            //2 password
            $error['password'] = array();
            if($_POST['password']==""){
                $test_validate = true;
                array_push($error['password'],'Vui lòng nhập password');
            }else{
                $result_old['password'] = $_POST['password'];
            }
            if($test_validate){
                $this->view('frontend/login/login',[
                    'error'         => $error,
                    'result_old'    => $result_old
                ]);
            }else{
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $result = json_decode($this->user->test_login($email,$password));
//                header('location: index.php?url=User_Login/login');
                if(!$result){
                    $this->view('frontend/login/login',[
                        'error'         => $error,
                        'result_old'    => $result_old,
                        'message_error' => 'Đăng nhập thất bại'
                    ]);

                }else{
                    $_SESSION['user_login']['id'] = $result->id;
                    $_SESSION['user_login']['name'] = $result->user_name;
                    if($result->image != ""){
                        $_SESSION['user_login']['avatar'] = $result->image;
                    }

                    $list_slider = json_decode($this->slider->getList());
                    $list_product = json_decode($this->product->getList_limit());
                    $list_category = json_decode($this->category->getListLimit4());
                    $categories = json_decode($this->category->getList());

                    $list_blog = json_decode($this->blog->getList());
                    foreach($list_category as $category){
                        $category->qty_product = json_decode($this->product->qty_product_by_cat($category->id));
                    }


                    $this->view('frontend/layout/master',[
                        'page'  => 'frontend/pages/home',
                        'list_slider' => $list_slider,
                        'list_product'  => $list_product,
                        'list_category' => $list_category,
                        'list_blog'     => $list_blog,
                        'categories'    => $categories,
                        'message_success'=> 'Đăng nhập thành công'
                    ]);
                    header('location: index.php?url=Home');
                }

            }

        }

        public function register(){
            $this->view('frontend/login/register');
        }



        public function post_register(){

//            echo json_encode($_POST);
//            die();
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

            //9 password
            $error['password'] = array();
            if($_POST['password']==""){
                $test_validate = true;
                array_push($error['password'],'Vui lòng nhâp password');
            }
            //10 password_confirm
            $error['password_confirm'] = array();
            if($_POST['password_confirm']==""){
                $test_validate = true;
                array_push($error['password_confirm'],'Vui lòng nhập password confirm');
            }


            if($test_validate){

                $this->view('frontend/login/register',[
                    'error'         => $error,
                    'result_old'    => $result_old
                ]);
            }else{
                if($_POST['password'] != $_POST['password_confirm']){
                    $this->view('frontend/login/register',[
                        'error'         => $error,
                        'result_old'    => $result_old,
                        'message_error' => "Mật khẩu không chính xác"
                    ]);
                }else{
                    $user_name = $_POST['user_name'];
                    $full_name = $_POST['full_name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $country = $_POST['country'];
                    $conscious = $_POST['conscious'];
                    $district = $_POST['district'];
                    $commune = $_POST['commune'];
                    $address_detail = isset($_POST['address_detail'])?$_POST['address_detail']:"";
                    $password = md5($_POST['password']);
                    $created_at = Date('Y-m-d H:i:s');
                    $updated_at = Date('Y-m-d H:i:s');
                    $result = json_decode($this->user->insert($user_name,$full_name,$email,$phone,$country,$conscious,$district,$commune,$address_detail,$password,$created_at,$updated_at));
                    if($result){
                        $this->view('frontend/login/login',[
                            'message_success' => 'Bạn đã tạo tài khoản thành công'
                        ]);
                    }else{

                    }
                }

            }
        }

    }
?>