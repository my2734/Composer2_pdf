<?php 
    class History_Order extends Controller{
        public $order;
        public $order_detail;
        public $slider;
        public $product;
        public $category;
        public $blog;
        public $categoryofblog;
        public $tags;
        public $blog_categoryofblog;
        public $blog_tags;

        public function __construct(){
           $this->order = $this->model('OrderModel');
           $this->order_detail = $this->model('Order_DetailModel');
           $this->slider = $this->model('SliderModel');
           $this->product = $this->model('ProductModel');
           $this->category = $this->model('CategoryModel');
           $this->blog = $this->model('BlogModel');
           $this->categoryofblog = $this->model('CategoryBlogModel');
           $this->tags = $this->model('TagsModel');
           $this->blog_categoryofblog = $this->model('Blog_CategoryOfBlogModel');
           $this->blog_tags = $this->model('Blog_TagsModel');
        }

        public function index(){
            $categories = json_decode($this->category->getList());

            $user_id = $_SESSION['user_login']['id'];
            $list_order = json_decode($this->order->getUser_id($user_id),true);
            
            foreach($list_order as $key => $order){
                $list_order_detail = json_decode($this->order_detail->getList_by_orderid($order['id']),true);
                $list_order[$key]['order_detail'] = $list_order_detail;
            }


            $this->view('frontend/layout/master',[
                'page' => 'frontend/pages/history_order',
                'list_order' => $list_order,
                'categories'    => $categories
            ]);
        }
    }
?>