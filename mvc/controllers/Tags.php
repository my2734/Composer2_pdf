<?php 
    class Tags extends Controller{
        public $tags;
        public $blog_tags;
        function __construct()
        {
            $this->tags = $this->model('TagsModel');
            $this->blog_tags = $this->model('Blog_TagsModel');
        }
        public function index(){
            $tagses = $this->tags->getList();
            $tagses = json_decode($tagses);
            $this->view('backend/layout/master',[
                'page'      => 'backend/tags/index',
                'tagses'    => $tagses
            ]);
        }

        public function create(){
            $this->view('backend/layout/master',[
                'page'      => 'backend/tags/create'
            ]);
        }

        public function store(){
            // Validate
            $error = array();
            $test_validate = false;
            if(!isset($_POST['name']) || $_POST['name']==""){
                array_push($error,'Vui lòng nhập tên Tags');
                $test_validate = true;
            }
            
            if($test_validate == false){
                $name       = $_POST['name'];
                $status     = isset($_POST['status'])?1:0;
                $created_at = date('Y-m-d H:i:s');
                $updated_at = date('Y-m-d H:i:s');
                $result = $this->tags->insert($name,$status,$created_at,$updated_at);
                $message = ($result=="true")?"Thêm mới Tag thành công":"";
                $tagses = $this->tags->getList();
                $tagses = json_decode($tagses);
                $this->view('backend/layout/master',[
                    'page'      => 'backend/tags/index',
                    'tagses'    => $tagses,
                    'message'   => $message
                ]);
                header('location: index.php?url=Tags');
            }else{
                $this->view('backend/layout/master',[
                    'page'      => 'backend/tags/create',
                    'error'     =>  $error
                ]);
            }
           
        }

        public function delete(){
            $id = $_POST['tags_id'];
            //1 Xoa record blog_tags có tags_id
            $result_detelete_blog_tags = $this->blog_tags->delete_by_tags_id($id);
            //2. Xoa record tags
            $result =  $this->tags->delete($id);
            $tagses = $this->tags->getList();
            $tagses = json_decode($tagses);

            if($result=="true"){
                $message = "Xóa Tags thành công";
                $this->view('backend/layout/master',[
                    'page'      => 'backend/tags/index',
                    'tagses'    => $tagses,
                    'message'   => $message
                ]);
                header('location: index.php?url=Tags');
            }else{
                $message_error = "Xoá Tags không thành công";
                $this->view('backend/layout/master',[
                    'page'      => 'backend/tags/index',
                    'tagses'    => $tagses,
                    'message_error'   => $message_error
                ]);
            }
        }

        public function edit($id){
            $tags_edit = $this->tags->getId($id);
            $tags_edit = json_decode($tags_edit);
            $this->view('backend/layout/master',[
                'page'      => 'backend/tags/create',
                'tags_edit' => $tags_edit
            ]);
        }

        public function update($id){
            $tags_edit = $this->tags->getId($id);
            $tags_edit = json_decode($tags_edit);
           
            $name = isset($_POST['name'])?$_POST['name']:$tags_edit->name;
            $status = isset($_POST['status'])?1:0;
            $updated_at = date('Y-m-d H:i:s');
            $result = $this->tags->update($id,$name,$status,$updated_at);

            $tagses = $this->tags->getList();
            $tagses = json_decode($tagses);
            if($result=="true"){
                $message = "Cập nhật Tags thành công";
                $this->view('backend/layout/master',[
                    'page'      => 'backend/tags/index',
                    'tagses'    => $tagses,
                    'message'   => $message
                ]);
            }else{
                $message_error = "Cập nhật Tags không thành công";
                $this->view('backend/layout/master',[
                    'page'              => 'backend/tags/create',
                    'tags_edit'         => $tags_edit,
                    'message_error'     => $message_error
                ]);
            }
           
        }

        public function change_status(){
            $tags_id = $_GET['tags_id'];
            $tags_edit = json_decode($this->tags->getId($tags_id));
            $data = array();
            $data['tags_id'] = $tags_edit->id;
            if($tags_edit->status==0){
                $tags_edit->status = 1;
                $data['status'] = "Hiển thị";
                $data['num_status'] = 1;
            }else{
                $tags_edit->status = 0;
                $data['status'] = "Không hiển thị";
                $data['num_status'] = 0;
            }
            $updated_at = date('Y-m-d H:i:s');
            $this->tags->update_status($tags_edit->id,$tags_edit->status,$updated_at);
            echo json_encode($data);
        }
    }
?>