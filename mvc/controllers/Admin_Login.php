<?php
    class Admin_Login extends Controller {
        public $admin;
        public function __construct()
        {
            $this->admin = $this->model('AdminModel');
        }

        public function login(){
            $this->view('backend/login/login');
        }

        public function post_login(){
            $test_validate = false;
            $error = array();
            $result_old = array();

            //1. email
            $error['email'] = array();
            if($_POST['email']==""){
                $test_validate = true;
                array_push($error['email'],"Vui lòng nhập email");
            }else{
                $result_old['email'] = $_POST['email'];
            }

            //2 password
            $error['password'] = array();
            if(!isset($_POST['password']) || $_POST['password']==""){
                $test_validate = true;
                array_push($error['password'],'Vui lòng nhập password');
            }else{
                $result_old['password'] = $_POST['password'];
            }

            if($test_validate){

                $this->view('backend/login/login',[
                    'error' => $error,
                    'result_old' => $result_old
                ]);
            }else{
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $result =  json_decode($this->admin->test_login($email,$password));
                if($result){

                    $_SESSION["admin_login"]['id']= $result->id;
                    $_SESSION["admin_login"]['email'] = $result->email;
                    $this->view('backend/layout/master',[
                        'page'              => 'backend/index',
                        'message_success'   => 'Bạn đã đăng nhập thành công'
                    ]);
                }else{
                    $this->view('backend/login/login',[
                        'message_error' => "Đăng nhập không thành công"
                    ]);
                }
            }
        }

        public function logout(){
            unset($_SESSION['admin_login']);
            $this->view('backend/login/login');
        }
    }
?>