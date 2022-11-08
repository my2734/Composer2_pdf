<?php 
    require_once('./mvc/controllers/Mail.php');
    require_once('./mvc/helper/process_url.php');
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
            $this->user = $this->model('UserModel');
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

            //pagination products
            $count_product  = json_decode($this->product->count_product());
            
            $number_display = 8;
            $total_page_number = ceil($count_product/$number_display);
           
            $process_url = new process_url();
        
            if(!isset($_GET['url'])){
                $_GET['url'] = "Home/index";
            }
            $is_page = json_decode($process_url->is_page($_GET['url']));
            // url chua page
            if($is_page){
                $page_index =  json_decode($process_url->index_page($_GET['url']));
                $start_in = ($page_index-1)*$number_display;
                $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
            }else{ //url khong chua page
                $page_index=1;
                $start_in = 0;
                $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
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
                'total_cart'    => $total_cart,
                'total_page_number' => $total_page_number,
                'page_index'        => $page_index
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
            // $list_product = json_decode($this->product->getBy_CatId($id));
            $category_item = json_decode($this->category->getId($id));
           
            $list_blog = json_decode($this->blog->getList());
//            echo $this->category->getId($id);
//            die();

            //pagination 
             $count_product  = json_decode($this->product->count_product());
            
             $number_display = 9;
             $total_page_number = ceil($count_product/$number_display);
            
             $process_url = new process_url();
             $is_page = json_decode($process_url->is_page($_GET['url']));
             // url chua page
             if($is_page){
                 $page_index =  json_decode($process_url->index_page($_GET['url']));
                 $start_in = ($page_index-1)*$number_display;
                 $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
             }else{ //url khong chua page
                 $page_index=1;
                 $start_in = 0;
                 $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
             }


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
                'total_cart'            => $total_cart,
                'total_page_number'     => $total_page_number,
                'page_index'            => $page_index
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


            //pagination 
             $count_blog  = json_decode($this->blog->count_blog());
            
             $number_display = 1;
             $total_page_number = ceil($count_blog/$number_display);
            
             $process_url = new process_url();
             $is_page = json_decode($process_url->is_page($_GET['url']));
             // url chua page
             if($is_page){
                 $page_index =  json_decode($process_url->index_page($_GET['url']));
                 $start_in = ($page_index-1)*$number_display;
                 $list_blog = json_decode($this->blog->getListlimit($start_in,$number_display));
             }else{ //url khong chua page
                 $page_index=1;
                 $start_in = 0;
                 $list_blog = json_decode($this->blog->getListlimit($start_in,$number_display));
             }
            


            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/blog',
                'categories'            => $categories,
                'list_blog'             => $list_blog,
                'list_categoryofblog'   => $list_categoryofblog,
                'list_tags'             => $list_tags,
                'total_cart'    => $total_cart,
                'total_page_number' => $total_page_number,
                'page_index'        => 1
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
                'total_cart'    => $total_cart,
                'total_page_number' => 2,
                'page_index'        => 1
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
            $list_blog = json_decode($this->blog->getList());

            //pagination products
            $count_product  = json_decode($this->product->count_product());
            
            $number_display = 9;
            $total_page_number = ceil($count_product/$number_display);
           
            $process_url = new process_url();
            $is_page = json_decode($process_url->is_page($_GET['url']));
            // url chua page
            if($is_page){
                $page_index =  json_decode($process_url->index_page($_GET['url']));
                $start_in = ($page_index-1)*$number_display;
                $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
            }else{ //url khong chua page
                $page_index=1;
                $start_in = 0;
                $list_product = json_decode($this->product->getListlimit($start_in,$number_display));
            }


            
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart,
                'total_page_number' => $total_page_number,
                'page_index'        => $page_index
            ]);
        }

        public function low_to_high_product(){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            // $list_product = json_decode($this->product->list_low_to_high_product());
            $list_blog = json_decode($this->blog->getList());
            
            //pagination
            $count_product  = json_decode($this->product->count_product());
           
            $number_display = 9;
            $total_page_number = ceil($count_product/$number_display);
        
            $process_url = new process_url();
            $is_page = json_decode($process_url->is_page($_GET['url']));
            // url chua page
            if($is_page){
                $page_index =  json_decode($process_url->index_page($_GET['url']));
                $start_in = ($page_index-1)*$number_display;
                $list_product = json_decode($this->product->list_low_to_high_product_limit($start_in,$number_display));
            }else{ //url khong chua page
                $page_index=1;
                $start_in = 0;
                $list_product =json_decode($this->product->list_low_to_high_product_limit($start_in,$number_display));
            }

          
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart,
                'message_success'       => 'Kết quả của sắp xếp từ thấp đến cao theo giá',
                'total_page_number'     => $total_page_number,
                'page_index'            => $page_index
            ]);
        }

        public function high_to_low_product(){
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            // $list_product = json_decode($this->product->list_high_to_low_product());
            $list_blog = json_decode($this->blog->getList());

             //pagination
             $count_product  = json_decode($this->product->count_product());
           
             $number_display = 9;
             $total_page_number = ceil($count_product/$number_display);
         
             $process_url = new process_url();
             $is_page = json_decode($process_url->is_page($_GET['url']));
             // url chua page
             if($is_page){
                 $page_index =  json_decode($process_url->index_page($_GET['url']));
                 $start_in = ($page_index-1)*$number_display;
                 $list_product = json_decode($this->product->list_high_to_low_product_limit($start_in,$number_display));
             }else{ //url khong chua page
                 $page_index=1;
                 $start_in = 0;
                 $list_product = json_decode($this->product->list_high_to_low_product_limit($start_in,$number_display));
             }
            
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart,
                'message_success'       => 'Kết quả của sắp xếp từ cao đến thấp theo giá'
            ]);
        }

        public function low_to_high_category($id){
            $category_item = json_decode($this->category->getId($id));
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            
            $list_blog = json_decode($this->blog->getList());
            
            //pagination
            $count_product  = json_decode($this->product->count_product());
           
            $number_display = 9;
            $total_page_number = ceil($count_product/$number_display);
        
            $process_url = new process_url();
            $is_page = json_decode($process_url->is_page($_GET['url']));
            // url chua page
            if($is_page){
                $page_index =  json_decode($process_url->index_page($_GET['url']));
                $start_in = ($page_index-1)*$number_display;
                $list_product = json_decode($this->product->low_to_high_category_limit($start_in,$number_display,$id));
            }else{ //url khong chua page
                $page_index=1;
                $start_in = 0;
                $list_product =json_decode($this->product->low_to_high_category_limit($start_in,$number_display,$id));
            }

          
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/category',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart,
                'message_success'       => 'Kết quả của sắp xếp từ thấp đến cao theo giá '.$category_item->name,
                'total_page_number'     => $total_page_number,
                'page_index'            => $page_index
            ]);
        }

        public function high_to_low_category(){

        }


        public function contact_sendMail(){
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $mail = new Mail();
            $mail->contact_sendMail($full_name,$email,$content);
            header('location: index.php');
        }

        public function review_search(){
            $search_key = $_GET['search_key'];
            $list_product_need_find = json_decode($this->product->list_product_need_find($search_key));
            $html = "";
            foreach($list_product_need_find as $product){
                $html.='<li style="display:block;" class="mt-3"><a href="index.php?url=Home/product_detail/'.$product->id.'"><img height="50" width="50" class="float-left mr-3" src="./public/uploads/'.$product->image[0].'" alt=""></a><span ><a href="index.php?url=Home/product_detail/'.$product->id.'" class="">'.$product->name.'</a><br><span class="info_search_item">'.$product->created_at.'</span></span></li>';
            }
            echo $html;
        }

        public function search_product(){
            $search_key = $_POST['search_key'];
            $total_cart = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cart){
                    $total_cart+=$cart['quatity'];
                }
            }
            $categories = json_decode($this->category->getList());
            $list_product = json_decode($this->product->list_product_need_find($search_key));
            $list_blog = json_decode($this->blog->getList());
            
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/product',
                'categories'            => $categories,
                'list_product'          => $list_product,
                'list_blog'             => $list_blog,
                'total_cart'            => $total_cart,
                'message_success'       => 'Kết quả tìm kiếm "'.$search_key.'"',

            ]);
        }

        public function get_user_info(){
            $categories = json_decode($this->category->getList());
            $user_id = $_SESSION['user_login']['id'];
            
            $user_login = json_decode($this->user->getId($user_id));
           
            $this->view('frontend/layout/master',[
                'page'                  => 'frontend/pages/user_info',
                'categories'            => $categories,
                'user_login'             => $user_login
            ]);
        }

        public function update_user_info(){
            $categories = json_decode($this->category->getList());
            $user_id = $_SESSION['user_login']['id'];
            $user_login = json_decode($this->user->getId($user_id));
           
            
            $user_name = $_POST['user_name'];
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $country = $_POST['country'];
            $conscious = $_POST['conscious'];
            $district = $_POST['district'];
            $commune = $_POST['commune'];
            $address_detail = isset($_POST['address_detail'])?$_POST['address_detail']:"";
            $updated_at = Date('Y-m-d H:i:s');
            $image = $user_login->image;

            if($_FILES['image']['name']!=""){
               
                //Xoa anh cu
                //neu ton tai anh cu
                if($user_login->image != ""){
                    $path_image_user = './public/uploads/'.$user_login->image;
                    if(file_exists($path_image_cat)){
                        unlink($path_image_cat);
                    }
                }


                //upload anh moi
                $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                $path = "./public/uploads/";
                if($_FILES['image']['name']){
                    if(in_array($_FILES['image']['type'],$allowTypes)){
                        $file_name = $_FILES['image']['name'];
                        $array = explode('.',$file_name);
                        $new_name = $array[0].rand(0,999).'.'.$array[1];
                        $image = $new_name;
                        move_uploaded_file($_FILES['image']['tmp_name'],$path.$new_name);
                    }
                }
            }
            
            

            $result = json_decode($this->user->update($user_name,$full_name,$email,$phone,$country,$conscious,$district,$commune,$address_detail,$updated_at,$image,$user_login->id));
            $_SESSION['user_login']['id'] = $user_id;
            $_SESSION['user_login']['name'] = $user_name;
            $_SESSION['user_login']['avatar'] = $image;
            
            
            if($result){
                header("Location: index.php?url=Home/get_user_info");
            }
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