<?php 
    class CategoryBlog extends Controller{
        public $categoryblog;
        public $blog_categoryofblog;

        function __construct()
        {
            $this->categoryblog = $this->model("CategoryBlogModel");
            $this->blog_categoryofblog = $this->model('Blog_CategoryOfBlogModel');
        }
        public function index(){
            $categoryblogs = $this->categoryblog->getList();
            $categoryblogs = json_decode($categoryblogs);
            $this->view('backend/layout/master',[
                'page'          => 'backend/categoryblog/index',
                'categoryblogs' => $categoryblogs
            ]);
        }

        public function create(){
            $this->view('backend/layout/master',[
                'page'          => 'backend/categoryblog/create'
            ]);
        }

        public function store(){
            // VALDATE name
            $error = array();
            $test_validate = false;
            if(!isset($_POST['name']) || $_POST['name']==""){
                array_push($error,"Vui lòng nhập tên danh mục Blog");
                $test_validate = true;
            }
            if($test_validate ==  false){
                $name       = $_POST['name'];
                $status     = isset($_POST['status'])?1:0;
                $created_at = date('Y-m-d H:i:s');
                $updated_at = date('Y-m-d H:i:s');
                $result = $this->categoryblog->insert($name,$status,$created_at,$updated_at);
               
                $message = ($result=="true")?"Thêm mới danh mục Blog thành công":"";
                $categoryblogs = $this->categoryblog->getList();
                $categoryblogs = json_decode($categoryblogs);
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/index',
                    'message'       => $message,
                    'categoryblogs' => $categoryblogs
                ]);
                header('location: index.php?url=CategoryBlog');
            }else{
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/create',
                    'error'         => $error
                ]);
            }

           
        }

        public function delete(){
            $id = $_POST['categoryofblog_id'];
            //1 Xoa record blog_categoryofblog
            $result_delte_blog_category = $this->blog_categoryofblog->delete_by_categoryofblog_id($id);
            //2 Xoa categoryofblog
            $result = $this->categoryblog->delete($id);
            $categoryblogs = $this->categoryblog->getList();
            $categoryblogs = json_decode($categoryblogs);
            if($result == "true"){
                $message = "Xóa danh mục Blog thành công";
                $message = ($result=="true")?"Xoá danh mục Blog thành công":"";
                
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/index',
                    'message'       => $message,
                'categoryblogs' => $categoryblogs
                ]);
                header('location: index.php?url=CategoryBlog');
            }else{
                $message_error = "Xóa danh mục không thành công";
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/index',
                    'message_error'       => $message_error,
                    'categoryblogs' => $categoryblogs
                ]);
            }
        }

        public function edit($id){
            $categoryblog_edit = $this->categoryblog->getId($id);
            $categoryblog_edit = json_decode($categoryblog_edit);
            // print_r($categoryblog_edit);
            // die();
            $this->view('backend/layout/master',[
                'page'                  => 'backend/categoryblog/create',
                'categoryblog_edit'     => $categoryblog_edit
            ]);
        }

        public function update($id){
            $categoryblog_edit = $this->categoryblog->getId($id);
            $categoryblog_edit = json_decode($categoryblog_edit);
            $error = array();
            $test_validate = false;
            if(!isset($_POST['name']) || $_POST['name']==""){
                array_push($error,"Vui lòng nhập tên danh mục Blog");
                $test_validate = true;
            }
            if($test_validate ==  false){
                $name       = isset($_POST['name'])?$_POST['name']:$categoryblog_edit->name;
                $status     = isset($_POST['status'])?1:0;
                $updated_at = date('Y-m-d H:i:s');
                $result = $this->categoryblog->update($id,$name,$status,$updated_at);
               
                $message = ($result=="true")?"Cập nhật danh mục Blog thành công":"";
                $categoryblogs = $this->categoryblog->getList();
                $categoryblogs = json_decode($categoryblogs);
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/index',
                    'message'       => $message,
                    'categoryblogs' => $categoryblogs
                ]);
                header('location: index.php?url=CategoryBlog');
            }else{
                
                $this->view('backend/layout/master',[
                    'page'          => 'backend/categoryblog/create',
                    'error'         => $error
                ]);
            }
        }

        public function change_status(){
            $categoryofblog_id = $_GET['categoryofblog_id'];
            $categoryofblog_edit = json_decode($this->categoryblog->getId($categoryofblog_id));
            $data = array();
            $data['categoryofblog_id'] = $categoryofblog_edit->id;
            if($categoryofblog_edit->status == 0){
                $categoryofblog_edit->status = 1;
                $data['status'] = "Hiển thị";
                $data['num_status'] = 1;
            }else{
                $categoryofblog_edit->status = 0;
                $data['status'] = "Không hiển thị";
                $data['num_status'] = 0;
            }
            $updated_at = date('Y-m-d H:i:s');
            $this->categoryblog->update_status($categoryofblog_edit->id,$categoryofblog_edit->status,$updated_at);
            echo json_encode($data);
        }


    }
?>