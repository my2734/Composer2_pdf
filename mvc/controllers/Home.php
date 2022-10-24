<?php 
    require_once('./mvc/controllers/Mail.php');
    class Home extends Controller{
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
            $this->slider = $this->model('SliderModel');
            $this->product = $this->model('ProductModel');
            $this->category = $this->model('CategoryModel');
            $this->blog = $this->model('BlogModel');
            $this->categoryofblog = $this->model('CategoryBlogModel');
            $this->tags = $this->model('TagsModel');
            $this->blog_categoryofblog = $this->model('Blog_CategoryOfBlogModel');
            $this->blog_tags = $this->model('Blog_TagsModel');
        }

        function index(){
            $list_slider = json_decode($this->slider->getList());
            $list_product = json_decode($this->product->getList_limit());
            $list_category = json_decode($this->category->getListLimit4());
            $categories = json_decode($this->category->getList());

            $list_blog = json_decode($this->blog->getList());
            foreach($list_category as $category){
                $category->qty_product = json_decode($this->product->qty_product_by_cat($category->id));
            }

            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }


//            foreach($list_product as $product){
//                echo $product->image[0];
//            }

            $this->view('frontend/layout/master',[
                'page'  => 'frontend/pages/home',
                'list_slider' => $list_slider,
                'list_product'  => $list_product,
                'list_category' => $list_category,
                'list_blog'     => $list_blog,
                'categories'    => $categories,
                'total_cart'    => $total_cart
            ]);
        }

        public function product_detail($id){

            $product_detail = json_decode($this->product->getById($id));
//            foreach($product_detail->image as $image){
//                echo $image;
//            }
//            die();
            $category_of_product_detail = json_decode($this->category->getId($product_detail->cat_id));
            $product_detail->cat_name = $category_of_product_detail->name;
            $list_product_relate = json_decode($this->product->get_list_relate($id,$category_of_product_detail->id));
            $categories = json_decode($this->category->getList());

            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }

            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product_detail',
                'product_detail'        => $product_detail,
                'list_product_relate'   => $list_product_relate,
                'categories'            => $categories,
                'total_cart'    => $total_cart
            ]);
        }

        public function category($id){
            $categories = json_decode($this->category->getList());
            $list_product = json_decode($this->product->getBy_CatId($id));
            $category_item = json_decode($this->category->getId($id));
            $list_blog = json_decode($this->blog->getList());
//            echo $this->category->getId($id);
//            die();

            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/category',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'category_item'         => $category_item,
                'list_blog'             => $list_blog,
                'total_cart'    => $total_cart
            ]);

        }

        public function blog(){
            $categories = json_decode($this->category->getList());
            $list_blog = json_decode($this->blog->getList());
            $list_categoryofblog = json_decode($this->categoryofblog->getList());
            $list_tags = json_decode($this->tags->getList());
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }

            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/blog',
                'categories'            => $categories,
                'list_blog'             => $list_blog,
                'list_categoryofblog'   => $list_categoryofblog,
                'list_tags'             => $list_tags,
                'total_cart'    => $total_cart
            ]);
        }

        public function categoryofblog($id){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $list_blog_categoryofblog = json_decode($this->blog_categoryofblog->list_blog_categoryofblog_by_cat_id($id));
            $list_blog_of_category = array();
            foreach($list_blog_categoryofblog as $blog_categoryofblog){
                $blog_item = json_decode($this->blog->getId($blog_categoryofblog->blog_id));
                array_push($list_blog_of_category,$blog_item);
            }



            $categories = json_decode($this->category->getList());
            $list_categoryofblog = json_decode($this->categoryofblog->getList());
            $list_tags = json_decode($this->tags->getList());
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/blog',
                'categories'            => $categories,
                'list_categoryofblog'   => $list_categoryofblog,
                'list_tags'             => $list_tags,
                'list_blog_of_category' => $list_blog_of_category,
                'total_cart'    => $total_cart
            ]);
        }

        public function tags($id){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $list_blog_tags = json_decode($this->blog_categoryofblog->list_blog_categoryofblog_by_cat_id($id));

            $list_blog_of_tags = array();
            foreach($list_blog_tags as $blog_tags){
                $blog_item = json_decode($this->blog->getId($blog_tags->blog_id));
                array_push($list_blog_of_tags,$blog_item);
            }

            $categories = json_decode($this->category->getList());
            $list_categoryofblog = json_decode($this->categoryofblog->getList());
            $list_tags = json_decode($this->tags->getList());
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/blog',
                'categories'            => $categories,
                'list_categoryofblog'   => $list_categoryofblog,
                'list_tags'             => $list_tags,
                'list_blog_of_tags'     => $list_blog_of_tags,
                'total_cart'    => $total_cart
            ]);

        }

        public function blog_detail($id){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $blog_detail = json_decode($this->blog->getId($id));
            $categories = json_decode($this->category->getList());
            $list_categoryofblog = json_decode($this->categoryofblog->getList());
            $list_tags = json_decode($this->tags->getList());
            $blog_detail->tags_names = array();
            foreach($blog_detail->tags_ids as $tags_id){
                $tags_detail_by_id = json_decode($this->tags->getId($tags_id));
                array_push($blog_detail->tags_names,$tags_detail_by_id->name);
            }
            $blog_detail->catofblog_names = array();
            foreach($blog_detail->cat_ids as $cat_id){
                $catofblog_detail_by_id = json_decode($this->categoryofblog->getId($cat_id));
                array_push($blog_detail->catofblog_names,$catofblog_detail_by_id->name);
            }


            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/blog_detail',
                'categories'            => $categories,
                'list_categoryofblog'   => $list_categoryofblog,
                'list_tags'             => $list_tags,
                'blog_detail'           => $blog_detail,
                'total_cart'    => $total_cart

            ]);
        }

        public function contact(){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/contact',
                'categories'            => $categories,
                'total_cart'    => $total_cart
            ]);
        }

        public function product(){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            $list_product = json_decode($this->product->getList());
            $list_blog = json_decode($this->blog->getList());

            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart
            ]);
        }

        public function contact_sendMail(){
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $mail = new Mail();
            $mail->contact_sendMail($full_name,$email,$content);
            header('location: index.php');
        }



        function SayHi(){
            echo "Home - SayHi";
        }

        function show(){
            $teo = $this->model('SinhVienModel');
            echo $teo->getSV();
        }
        
        function aodep(){
            $students = $this->model('SinhVienModel');
            $this->view('aodep',[
                'page'  => 'about',
                'color' => 'green',
                'students' => $students->getListSV()
            ]);
        }

        function aoxau(){
            $this->view('aodep',[
                'page'  => 'contact',
                'color' => 'red'
            ]);
        }


    }
?>