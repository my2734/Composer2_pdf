<?php 
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

        $list_order = json_decode($this->order->getList(),true);
        
        foreach($list_order as $key => $order){
            $list_order_detail = json_decode($this->order_detail->getList_by_orderid($order['id']),true);
            $list_order[$key]['order_detail'] = $list_order_detail;
        }

        $this->view('backend/layout/master',[
            'page'          => 'backend/Order/index',
            'list_order' => $list_order
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