<?php 
    class Category extends Controller{
        public $category;
        public $product;
        public $product_image;
        public function __construct()
        {
            $this->category = $this->model('CategoryModel');
            $this->product  = $this->model('ProductModel');
            $this->product_image = $this->model('Product_ImageModel');
        }

        public function index(){
            $categories = $this->category->getList();
            $categories = json_decode($categories);
            $this->view('backend/layout/master',[
                'page'          => 'backend/category/index',
                'categories'    =>  $categories
            ]);
        }

        public function create(){
            $this->view('backend/layout/master',[
                'page'  => 'backend/category/create',
            ]);
        }

        public function store(){

            if(isset($_POST['btnStoreCategory'])){
                $test_validate = false;
                $error = array();
                $result_old = array();
                //name
                $error['name'] = array();
                if($_POST['name']==""){
                    $test_validate=true;
                    array_push($error['name'],"Vui lòng nhập tên danh mục");
                }else{
                    $result_old['name'] = $_POST['name'];
                }

                //image
                $error['image'] = array();
                if($_FILES['image']['name']==""){
                    $test_validate=true;
                    array_push($error['image'],"Vui lòng nhập ảnh danh mục");
                }

                if($test_validate){
                    $this->view('backend/layout/master',[
                        'page'          => 'backend/category/create',
                        'error'         => $error,
                        'result_old'    => $result_old
                    ]);
                }else{
                    $name = $_POST['name'];
                    $status = isset($_POST['status'])?1:0;
                    $created_at = date("Y-m-d H:i:s");
                    $updated_at = date('Y-m-d H:i:s');
                    $image = "";
                    //xu li image

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

                    $result = $this->category->insert($name,$image,$status,$created_at,$updated_at);
                    if($result == 'true'){
                        $categories = $this->category->getList();
                        $categories = json_decode($categories);
                        $this->view('backend/layout/master',[
                            'page'          => 'backend/category/index',
                            'categories'    =>  $categories,
                            'message'       =>  'Thêm mới danh mục thành công'
                        ]);
                    }else{
                        $this->view('backend/layout/master',[
                            'page'          => 'backend/category/create',
                            'result_old'    => $result_old,
                            'message_error' => "Thêm mới danh mục không thành công"
                        ]);
                    }
                }

            }

        }

        public function delete(){
            $id = $_POST['category_id'];
            //Xoa cac san pham lien quan
            $list_product_delete = json_decode($this->product->getBy_CatId($id));

            foreach($list_product_delete as $product_delete){
                //1. Xoa anh trong thu muc uploads
                $list_image = $product_delete->image;
                foreach($list_image as $image_want_delete){
                    $path_image = './public/uploads/'.$image_want_delete;
                    if(file_exists($path_image)){
                        unlink($path_image);
                    }
                }
                //2. Xoa cac anh trong table product_image
                $this->product_image->delete($product_delete->id);
                //3. Xoa product
                $this->product->delete($product_delete->id);
            }
            //Xoa danh muc
            //1. Xoa anh category tren thu muc uploads
            $category_delete = json_decode($this->category->getId($id));
            $path_image_cat = './public/uploads/'.$category_delete->image;
            if(file_exists($path_image_cat)){
                unlink($path_image_cat);
            }

            $result = $this->category->delete($id);///chua xong///
            $categories = $this->category->getList();
            $categories = json_decode($categories);
            if($result=='true'){
                $message = "Xóa danh mục thành công";
            }
            $this->view('backend/layout/master',[
                'page'          => 'backend/category/index',
                'categories'    =>  $categories,
                'message'       => $message
            ]);
            header('location: index.php?url=Category');
            
        }

        public function edit($id){
            $category_edit = $this->category->getId($id);
            $category_edit = json_decode($category_edit);
            // print_r($category_edit);
            $this->view('backend/layout/master',[
                'page'          => 'backend/category/create',
                'category_edit' =>  $category_edit
            ]);
        }

        public function update($id){
            
            if(isset($_POST['btnStoreCategory'])){
                // validate
                if($_POST['name']==""){
                    $this->view('backend/layout/master',[
                        'page'  => 'backend/category/create',
                        'error_category' => 'Vui lòng nhập tên danh mục'
                    ]);
                }else{
                    $category_edit = json_decode($this->category->getId($id));
                    $id = $id;
                    $name = $_POST['name'];
                    $status = isset($_POST['status'])?1:0;
                    $updated_at = date('Y-m-d H:i:s');
                    $image = $category_edit->image;

                    //xu li image
                    if($_FILES['image']['name']!=""){
                        //Xoa anh cu
                        $path_image_cat = './public/uploads/'.$category_edit->image;
                        if(file_exists($path_image_cat)){
                            unlink($path_image_cat);
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

                    $result = $this->category->update($id,$name,$image,$status,$updated_at);
                    $kq = json_decode($result);
                    if($result == 'false'){
                        $category_edit = $this->category->getId($id);
                        $category_edit = json_decode($category_edit);
                        $this->view('backend/layout/master',[
                            'page'          => 'backend/category/create',
                            'category_edit' =>  $category_edit
                        ]);

                    }else{
                        $categories = $this->category->getList();
                        $categories = json_decode($categories);
                        $this->view('backend/layout/master',[
                            'page'          => 'backend/category/index',
                            'categories'    =>  $categories,
                            'message'       => 'Cập nhật danh mục thành công'
                        ]);
                        header('location: index.php?url=Category');
                    }                   
                }
            }
        }

        public function change_status(){
            
            $category_id = $_GET['category_id'];
            $category_edit = json_decode($this->category->getID($category_id));
           
            $data = array();
            $data['category_id'] = $category_id;
            if($category_edit->status==0){
                $category_edit->status = 1;
                $data['status'] = 'Hiển thị';
                $data['num_status'] = 1;
            }else{
                $category_edit->status = 0;
                $data['status'] = "Không hiển thị";
                $data['num_status'] = 0;
            }
            $updated_at =  $updated_at = date('Y-m-d H:i:s');
            $this->category->update_status($category_edit->id,$category_edit->status,$updated_at);
            echo json_encode();
        }

        public function change_status_2(){
            $category_id = $_GET['category_id'];
            $category_edit = json_decode($this->category->getID($category_id));

            $data1 = array();
            $data1['category_id'] = $category_id;
            if($category_edit->status==0){
                $category_edit->status = 1;
                $data1['status'] = 'Hiển thị';
                $data1['num_status'] = 1;
            }else{
                $category_edit->status = 0;
                $data1['status'] = "Không hiển thị";
                $data1['num_status'] = 0;
            }
            $updated_at =  $updated_at = date('Y-m-d H:i:s');
            $this->category->update_status($category_edit->id,$category_edit->status,$updated_at);
            echo json_encode($data1['category_id']);

        }
    }
?>