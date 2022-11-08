<?php 
    class User extends Controller{
        public $user;
        public function __construct(){
            $this->user = $this->model('UserModel');
        }

        public function index(){
            $list_user = json_decode($this->user->getList());
            $this->view('backend/layout/master',[
                'page'          => 'backend/User/index',
                'list_user' => $list_user,
                // 'total_page_number' => $total_page_number,
                // 'page_index'    => $page_index
            ]);
        }
    }
?>