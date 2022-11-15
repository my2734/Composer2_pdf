<?php 
    class CommentPro extends Controller{
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
        public $comment_pro;

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
           $this->comment_pro = $this->model('Comment_ProModel');
        }

        public function store(){
            $user_id = $_SESSION['user_login']['id'];
            $pro_id = $_POST['pro_id'];
            $content = $_POST['content'];
            $created_at = Date('Y-m-d H:i:s');
            $updated_at = Date('Y-m-d H:i:s');

            $ketqua = $this->comment_pro->insert($user_id,$pro_id,$content,$created_at,$updated_at);
            header("location: index.php?url=Home/product_detail/".$pro_id);
        }

        public function delete($id){
            $ketqua = $this->comment_pro->delete($id);
            header("location: index.php?url=Home/product_detail/".$id);
        }

       
    }
?>