<?php 
require_once('./mvc/helper/process_url.php');
class Order extends Controller{
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

    public function index(){
        // $list_order = json_decode($this->order->getList(),true);
        
        $count_order  = json_decode($this->order->count_order());
        $number_display = 6;
        $total_page_number = ceil($count_order/$number_display);
        $process_url = new process_url();
        $is_page = json_decode($process_url->is_page($_GET['url']));
        // url chua page
        if($is_page){
            $page_index =  json_decode($process_url->index_page($_GET['url']));
            $start_in = ($page_index-1)*$number_display;
            $list_order = json_decode($this->order->getListLimit($start_in,$number_display),true);
        }else{ //url khong chua page
            $start_in = 0;
            $list_order = json_decode($this->order->getListLimit($start_in,$number_display),true);
        }

        foreach($list_order as $key => $order){
            $list_order_detail = json_decode($this->order_detail->getList_by_orderid($order['id']),true);
            $list_order[$key]['order_detail'] = $list_order_detail;
        }

        $this->view('backend/layout/master',[
            'page'          => 'backend/Order/index',
            'list_order' => $list_order,
            'total_page_number' => $total_page_number
        ]);
    }

    public function change_status(){
        $order_id = $_GET['order_id'];
        $result = json_decode($this->order->update_status($order_id));
        $data['order_id'] = $order_id;
        $data['string_status'] = "Đang giao hàng";
        echo json_encode($data);
    }

    public function change_status_nhan_hang(){
        $order_id = $_GET['order_id'];
        $result = json_decode($this->order->update_status_nhan_hang($order_id));
        $data['order_id'] = $order_id;
        $data['string_status'] = "Đã nhận hàng";
        echo json_encode($data);
    }

}

  ?>