<?php
    class App{
        protected $controller = "Home";
        protected $action = "index";
        protected $params = [];

        function __construct()
        {
//            if(isset($_SESSION['cart'])){
//                unset($_SESSION['cart']);
//            }
            //Controller cần Middleware
            $array_need_middleware_admin = ['Admin','Blog','Category','CategoryBlog','Product','Slider','Tags','Order'];
            $array_need_middleware_user = ['Cart','History_Order','CommentPro'];
            $arr = $this->UrlProcess();
            // Controller
            if(isset($arr[0])){
                if(file_exists('./mvc/controllers/'.$arr[0].'.php')){
                    $this->controller = $arr[0];
                    unset($arr[0]);
                }
            }


            if(in_array($this->controller,$array_need_middleware_admin) && !isset($_SESSION['admin_login'])){
                require_once('./mvc/controllers/Admin_Login.php');
                $this->controller = "Admin_Login";
                $this->action = "login";
                $this->controller = new  $this->controller;
                call_user_func_array([$this->controller, $this->action], $this->params );
            }elseif(in_array($this->controller,$array_need_middleware_user) && !isset($_SESSION['user_login'])){
                require_once('./mvc/controllers/User_Login.php');
                $this->controller = "User_Login";
                $this->action = "login";
                $this->controller = new  $this->controller;
                call_user_func_array([$this->controller, $this->action], $this->params );
            }else{
                require_once('./mvc/controllers/'.$this->controller.'.php');
                $this->controller = new $this->controller;

                // Action
                if(isset($arr[1])){
                    if(method_exists($this->controller,$arr[1])){
                        $this->action = $arr[1];
                    }
                    unset($arr[1]);
                }

                // param
                $this->params = $arr?array_values($arr):[];
                // call_user_func_array([$this->controller, $this->action],  $this->params);
                call_user_func_array([$this->controller, $this->action], $this->params );
            }

        }

        function UrlProcess(){
            if(isset($_GET['url'])){
                return explode('/',filter_var(trim($_GET['url'],'/')));
            }
        }
    }
?>