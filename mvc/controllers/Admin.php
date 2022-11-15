<?php 
    class Admin extends Controller{

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
        public $user;

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
            $this->user = $this->model('UserModel');
            $this->tbl_statistical = $this->model('Tbl_StatisticalModel');
        }

        public function index(){
            $total_order = json_decode($this->order->count_order());
            $total_user = json_decode($this->user->count_user());
            $total_product = json_decode($this->product->count_product());
            $total_blog = json_decode($this->blog->count_blog());
           
            $this->view('backend/layout/master',[
                'page'              => 'backend/index',
                'total_order'       => $total_order,
                'total_user'       => $total_user,
                'total_product'       => $total_product,
                'total_blog'       => $total_blog,
            ]);
        }

        public function thongke(){
            $ngaybatdau = $_POST['ngaybatdau'];
            $ngayketthuc = $_POST['ngayketthuc'];
            $list_date_order = json_decode($this->tbl_statistical->getList($ngaybatdau,$ngayketthuc));

            foreach ($list_date_order as $key => $val) {
                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity'   => $val->quantity
                );
            }

            echo $data = json_encode($chart_data);
        }
    }
?>