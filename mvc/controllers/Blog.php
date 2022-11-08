<?php 
require_once('./mvc/helper/process_url.php');
    class Blog extends Controller{
        public $blogs;
        public $category_of_blogs;
        public $tags;
        public $product_image;
        public $blog_category;
        public $blog_tags;

        public function __construct(){
            $this->blogs        = $this->model('BlogModel');
            //danh muc blog
            $this->category_of_blogs   = $this->model('CategoryBlogModel');
            $this->tags         = $this->model('TagsModel');
            $this->product_image= $this->model('Product_ImageModel');
            $this->blog_category= $this->model('Blog_CategoryOfBlogModel');
            $this->blog_tags    = $this->model('Blog_TagsModel');
        }
        public function index(){
            // $list_blog = json_decode($this->blogs->getList());

            $count_blog  = json_decode($this->blogs->count_blog());
            $number_display = 6;
            $total_page_number = ceil($count_blog/$number_display);
            $process_url = new process_url();
            $is_page = json_decode($process_url->is_page($_GET['url']));
            // url chua page
            $page_index = 1;
            if($is_page){
                $page_index =  json_decode($process_url->index_page($_GET['url']));
                $start_in = ($page_index-1)*$number_display;
                $list_blog = json_decode($this->blogs->getListLimit($start_in,$number_display));
            }else{ //url khong chua page
                $start_in = 0;
                $list_blog = json_decode($this->blogs->getListLimit($start_in,$number_display));
            }

            $this->view('backend/layout/master',[
                'page'          => 'backend/blog/index',
                'list_blog'     => $list_blog,
                'total_page_number' => $total_page_number,
                'page_index'        => $page_index
            ]);
        }

        public function create(){
            $category_of_blogs = json_decode($this->category_of_blogs->getList());
            $tags       = json_decode($this->tags->getList());
            $this->view('backend/layout/master',[
               'page'           => 'backend/blog/create',
                'categories'    => $category_of_blogs,
                'tags'          => $tags
            ]);
        }

        public function store(){
            //validate
            $test_validate = false;
            $error = array();
            $result_old = array();

                //1.cat_id
            $error['cat_ids'] = array();

            if(!isset($_POST['cat_ids'])){
                array_push($error['cat_ids'],'Vui lòng chọn danh mục bài viết');
                $test_validate = true;
            }else{
                $result_old['cat_ids'] = $_POST['cat_ids']; //array cat_id
            }
                //2. tags_id
            $error['tags_ids'] = array();
            if(!isset($_POST['tags_ids'])){
                array_push($error['tags_ids'],'Vui lòng chọn tags bài viết');
                $test_validate = true;
            }else{
                $result_old['tags_ids'] = $_POST['tags_ids']; //array tags_id
            }
                //3. title
            $error['title'] = array();
            if(!isset($_POST['title']) || $_POST['title']==""){
                array_push($error['title'],'Vui lòng nhập tên bài viết');
                $test_validate = true;
            }else{
                $result_old['title'] = $_POST['title'];
            }
                //4. image
            $error['image'] = array();
            if($_FILES['image']['name'] == ""){
                array_push($error['image'],"Vui lòng chọn hình ảnh");
                $test_validate = true;
            }

            if(isset($_POST['detail_header'])){
                $result_old['detail_header'] = $_POST['detail_header'];
            }

            if(isset($_POST['detail_body'])){
                $result_old['detail_body'] = $_POST['detail_body'];
            }

            if(isset($_POST['detail_footer'])){
                $result_old['detail_footer'] = $_POST['detail_footer'];
            }

            if(isset($_POST['status'])){
                $result_old['status'] = 1;
            }



            if($test_validate == false){
                $cat_id         = isset($_POST['cat_ids'][0])?$_POST['cat_ids'][0]:"";
                $tags_id        = isset($_POST['tags_ids'][0])?$_POST['tags_ids'][0]:"";
                $title          = $_POST['title'];
                $status         = isset($_POST['status'])?1:0;
                $detail_header  = $_POST['detail_header'];
                $detail_body    = $_POST['detail_body'];
                $detail_footer  = $_POST['detail_footer'];
                $created_at     = date('Y-m-d H:i:s');
                $updated_at     = date('Y-m-d H:i:s');
                $image = "";
                //xu li image

                $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                $path = "./public/uploads/";
                if($_FILES['image']['name']){
                    if(in_array($_FILES['image']['type'],$allowTypes)){
                        $file_name = $_FILES['image']['name'];
                        $array = array();
                        $array = explode('.',$file_name);
                        $new_name = $array[0].rand(0,999).'.'.$array[1];

                        $image = $new_name;
                        move_uploaded_file($_FILES['image']['tmp_name'],$path.$new_name);
                    }
                }

                $id_blog = json_decode($this->blogs->insert($cat_id,$tags_id,$title,$status,$detail_header,$detail_body,$detail_footer,$image,$created_at,$updated_at));
                //Xu li table blog_category
                if(isset($_POST['cat_ids'])){
                    foreach ($_POST['cat_ids'] as $cat_id){
                        $result = $this->blog_category->insert($id_blog,$cat_id);
                    }
                }
                //Xu li table blog_tags
                if(isset($_POST['tags_ids'])){
                    foreach($_POST['tags_ids'] as $tags_id){
                        $result = $this->blog_tags->insert($id_blog,$tags_id);
                    }
                }
                if(isset($id_blog)){
                    $list_blog = json_decode($this->blogs->getList());
                    $message_success = "Tạo mới bài viết thành công";
                    $this->view('backend/layout/master',[
                        'page'          => 'backend/blog/index',
                        'list_blog'     => $list_blog,
                        'message_success'  => $message_success
                    ]);
                    header('location: index.php?url=Blog');
                }
            }else{
                $category_of_blogs  = json_decode($this->category_of_blogs->getList());
                $tags               = json_decode($this->tags->getList());
                $message_error      = "Tạo mới bài viết không thành công";
                $this->view('backend/layout/master',[
                    'page'           => 'backend/blog/create',
                    'categories'    => $category_of_blogs,
                    'tags'          => $tags,
                    'message_error' => $message_error,
                    'error'         => $error,
                    'result_old'    => $result_old
                ]);
            }
        }

        public function delete(){

            $blog_id = $_POST['blog_id'];
            $blog_delete =  json_decode($this->blogs->getId($blog_id));
            //1.unlink image in folder uploads
            $path_image_old = './public/uploads/'.$blog_delete->image;
            if(file_exists($path_image_old)){
                unlink($path_image_old);
            }
            //2.Xóa các record có blog_id
            $result =  $this->blog_category->delete_by_blogid($blog_id);

            //3.Xóa blog
            $result = $this->blogs->delete($blog_id);
            if($result == 'true'){
                $list_blog = json_decode($this->blogs->getList());
                $message_success = "Bạn đã xóa thành công bài viết";
                $this->view('backend/layout/master',[
                    'page'          => 'backend/blog/index',
                    'list_blog'     => $list_blog,
                    'message_success'        => $message_success
                ]);
                header('location: index.php?url=Blog');
            }
        }

        public function edit($id){
            $blog_edit = json_decode($this->blogs->getId($id));
            $category_of_blogs = json_decode($this->category_of_blogs->getList());
            $tags       = json_decode($this->tags->getList());
            $this->view('backend/layout/master',[
                'page'              => 'backend/blog/create',
                'blog_edit'         => $blog_edit,
                'categories'    => $category_of_blogs,
                'tags'              => $tags
            ]);
        }

        public function update($id){
            //validate
            $test_validate = false;
            $error = array();
            $result_old = array();

            //1.cat_id
            $error['cat_ids'] = array();

            if(!isset($_POST['cat_ids'])){
                array_push($error['cat_ids'],'Vui lòng chọn danh mục bài viết');
                $test_validate = true;
            }else{
                $result_old['cat_ids'] = $_POST['cat_ids']; //array cat_id
            }
            //2. tags_id
            $error['tags_ids'] = array();
            if(!isset($_POST['tags_ids'])){
                array_push($error['tags_ids'],'Vui lòng chọn tags bài viết');
                $test_validate = true;
            }else{
                $result_old['tags_ids'] = $_POST['tags_ids']; //array tags_id
            }
            //3. title
            $error['title'] = array();
            if(!isset($_POST['title']) || $_POST['title']==""){
                array_push($error['title'],'Vui lòng nhập tên bài viết');
                $test_validate = true;
            }else{
                $result_old['title'] = $_POST['title'];
            }


            if(isset($_POST['detail_header'])){
                $result_old['detail_header'] = $_POST['detail_header'];
            }

            if(isset($_POST['detail_body'])){
                $result_old['detail_body'] = $_POST['detail_body'];
            }

            if(isset($_POST['detail_footer'])){
                $result_old['detail_footer'] = $_POST['detail_footer'];
            }

            if(isset($_POST['status'])){
                $result_old['status'] = 1;
            }

            if($test_validate==false){
                $blog_edit = json_decode($this->blogs->getId($id));
                $cat_id         = isset($_POST['cat_ids'][0])?$_POST['cat_ids'][0]:$blog_edit->cat_id;
                $tags_id        = isset($_POST['tags_ids'][0])?$_POST['tags_ids'][0]:$blog_edit->tags_id;
                $status         = isset($_POST['status'])?1:0;
                $title          = isset($_POST['title'])?$_POST['title']:$blog_edit->title;
                $detail_header  = isset($_POST['detail_header'])?$_POST['detail_header']:$blog_edit->detail_header;
                $detail_body    = isset($_POST['detail_body'])?$_POST['detail_body']:$blog_edit->detail_body;
                $detail_footer  = isset($_POST['detail_footer'])?$_POST['detail_footer']:$blog_edit->detail_footer;
                $image = "";

                // Xu ly image
                if(!$_FILES['image']['name']){
                    $image = $blog_edit->image;
                }else{
                    //Xoa anh cu trong thu muc uploads
                    $path_image_old = './public/uploads/'.$blog_edit->image;
                    if(file_exists($path_image_old)){
                        unlink($path_image_old);
                    }

                    $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                    $path = "./public/uploads/";
                    if($_FILES['image']['name']){
                        if(in_array($_FILES['image']['type'],$allowTypes)){
                            $file_name = $_FILES['image']['name'];
                            $array = array();
                            $array = explode('.',$file_name);
                            $new_name = $array[0].rand(0,999).'.'.$array[1];
                            $image = $new_name;
                            move_uploaded_file($_FILES['image']['tmp_name'],$path.$new_name);
                        }
                    }
                }
                //Xu li cat_id
                if($_POST['cat_ids']){
                    //Xoa cac record trong table blog_cat voi blog_id
                    $this->blog_category->delete_by_blog_id($blog_edit->id);
                    foreach ($_POST['cat_ids'] as $cat_id){
                        $result = $this->blog_category->insert($blog_edit->id,$cat_id);
                    }
                }
                //Xu li tags_id
                if($_POST['tags_ids']){
                    //Xoa cac record trong table blog_tag voi blog_id
                    $this->blog_tags->delete_by_blogid($blog_edit->id);
                    foreach($_POST['tags_ids'] as $tags_id){
                        $result = $this->blog_tags->insert($blog_edit->id,$tags_id);
                    }
                }
                $updated_at = Date("Y-m-d H:i:s");
//                echo $image;
//                die();
                $result = $this->blogs->update($cat_id,$tags_id,$title,$status,$detail_header,$detail_body,$detail_footer,$image,$updated_at,$blog_edit->id);
                if($result == "true"){
                    $list_blog = json_decode($this->blogs->getList());
                    $this->view('backend/layout/master',[
                        'page'          => 'backend/blog/index',
                        'list_blog'     => $list_blog,
                        'message_success'   => "Cập nhật bài viết thành công"
                    ]);
                    header('location: index.php?url=Blog');
                }else{
                    $category_of_blogs  = json_decode($this->category_of_blogs->getList());
                    $tags               = json_decode($this->tags->getList());
                    $message_error      = "Cập nhật bài viết không thành công";
                    $this->view('backend/layout/master',[
                        'page'           => 'backend/blog/create',
                        'categories'    => $category_of_blogs,
                        'tags'          => $tags,
                        'message_error' => $message_error,
                        'error'         => $error,
                        'result_old'    => $result_old
                    ]);
                }
            }else{
                $category_of_blogs  = json_decode($this->category_of_blogs->getList());
                $tags               = json_decode($this->tags->getList());
                $message_error      = "Cập nhật bài viết không thành công";
                $this->view('backend/layout/master',[
                    'page'           => 'backend/blog/create',
                    'categories'    => $category_of_blogs,
                    'tags'          => $tags,
                    'message_error' => $message_error,
                    'error'         => $error,
                    'result_old'    => $result_old
                ]);
            }


        }

        public function change_status(){
            $blog_id = $_GET['blog_id'];
            $blog_edit = json_decode($this->blogs->getId($blog_id));
            $data = array();
            $data['blog_id'] = $blog_edit->id;
            if($blog_edit->status==0){
                $blog_edit->status = 1;
                $data['status'] = "Hiển thị";
                $data['num_status'] = 1;
            }else{
                $blog_edit->status = 0;
                $data['status'] = "Không hiển thị";
                $data['num_status'] = 0;
            }
            $updated_at     = date('Y-m-d H:i:s');
            $this->blogs->update_status($blog_edit->id,$blog_edit->status,$updated_at);
            echo json_encode($data);
        }
    }
?>