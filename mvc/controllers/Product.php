<?php
    class Product extends Controller{
        public $product;
        public $category;
        public $product_image;
        public $product_category;

        function __construct(){
            $this->product  = $this->model('ProductModel');
            $this->category = $this->model('CategoryModel');
            $this->product_image = $this->model('Product_ImageModel');
            $this->product_category = $this->model('Product_CategoryModel');
        }

        public function index(){
             $productes = $this->product->getList();
             $productes = json_decode($productes);

            $this->view('backend/layout/master',[
                'page'          => 'backend/product/index',
                 'productes'     => $productes
            ]);
        }

        public function create(){
            $categories = $this->category->getList();
            $categories = json_decode($categories);
            $this->view('backend/layout/master',[
                'page'          => 'backend/product/create',
                'categories'    => $categories
            ]);
        }

        public function store(){
            if(isset($_POST['btnStoreProduct'])){
                //VALIDATE 
                $test_validate = false;
                $error = array();
                $result_old = array();
                    //1. name
                $error['name'] = array();
                if(!isset($_POST['name']) || $_POST['name']==""){
                    array_push($error['name'],"Vui lòng nhập tên sản phẩm");
                    $test_validate = true;
                }else{
                    $result_old['name'] = $_POST['name'];
                }

                    //2. price_unit
                $error['price_unit'] = array();
                if(!isset($_POST['price_unit']) || $_POST['price_unit']==""){
                    array_push($error['price_unit'],"Vui lòng nhập giá sản phẩm");
                    $test_validate = true;
                }else{
                    if(!is_numeric($_POST['price_unit'])){
                        array_push($error['price_unit'],"Giá sản phẩm nhập sai định dạng");
                        $test_validate = true;
                    }else{
                        $result_old['price_unit'] = $_POST['price_unit'];
                    }
                }
                    //3.price_promotion
                $error['price_promotion'] = array();
                if(isset($_POST['price_promotion']) && $_POST['price_promotion']!=""){
                    if(!is_numeric($_POST['price_promotion'])){
                        array_push($error['price_promotion'],"Giá khuyến mãi nhập sai định dạng");
                        $test_validate = true;
                    }else{
                        $result_old['price_promotion'] = $_POST['price_promotion'];
                    }
                }
               
                    //4.quantity
                $error['quantity'] = array();
                if(!isset($_POST['quantity']) || $_POST['quantity']==""){
                    array_push($error['quantity'],"Vui lòng nhập số lượng sản phẩm");
                    $test_validate = true;
                }else{
                    if(!is_numeric($_POST['quantity'])){
                        array_push($error['quantity'],"Số lượng sản phẩm nhập sai định dạng");
                        $test_validate = true;
                    }else{
                        $result_old['quantity'] = $_POST['quantity'];
                    }
                }      
                    //5 image
                $error['image'] = array();
                if($_FILES['image']['name'][0] == ""){
                    array_push($error['image'],"Vui lòng chọn hình ảnh");
                    $test_validate = true;
                }
//                echo json_encode($error);
//                die();
                    //6. cat_id
                $error['cat_id'] = array();
                if(!isset($_POST['cat_id'])){
                    array_push($error['cat_id'],"Vui lòng chọn danh mục");
                    $test_validate = true;
                }else{
                    $result_old['cat_id'] = $_POST['cat_id'];
                }

                // echo json_encode($test_validate);
                // echo "<pre>";
                // print_r($error);
                // die();
                if($test_validate == false){
                    $name               = $_POST['name'];
                    $price_unit         = $_POST['price_unit'];
                    $price_promotion    = isset($_POST['price_promotion']) ? $_POST['price_promotion'] : 0;
                    $description        = isset($_POST['description']) ? $_POST['description']:"";
                    $status             = isset($_POST['status']) ? 1 : 0;
                    $cat_id             = $_POST['cat_id'];
                    $quantity            = $_POST['quantity'];
                    $created_at         = date('Y-m-d H:i:s');
                    $updated_at         = date('Y-m-d H:i:s');
                    $image              = "";

                    $date = date_create();
                    $id = date_timestamp_get($date);    //id san pham
                    // table product_image----
                    $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                    $path = "public/uploads/";
                    foreach($_FILES['image']['name'] as $key => $file){
                        if(in_array($_FILES['image']['type'][$key],$allowTypes)){
                            if($_FILES['image']['error'][$key]==0){
                                $file_name = $_FILES['image']['name'][$key];
                                $array = explode('.',$file_name);
                                $new_name = $array[0].rand(0,999).'.'.$array[1];

                                $image              = $new_name;
                                $product_id = $id;
                                $result_insert_product_image = $this->product_image->insert($product_id,$new_name);
                                if(json_decode($result_insert_product_image) == 'true'){
                                    move_uploaded_file($_FILES['image']['tmp_name'][$key],$path.$new_name);
                                }
                            }
                        }
                    }


                    $result =  $this->product->insert($id,$name,$price_unit,$price_promotion,$description,$status,$quantity,$image,$cat_id,$created_at,$updated_at);
                    $productes = $this->product->getList();
                    $productes = json_decode($productes);
                    $message = ($result=='true')?"Thêm mới sản phẩm thành công":"Lỗi thêm mới sản phẩm";
                    $this->view('backend/layout/master',[
                        'page'          => 'backend/product/index',
                        'productes'     => $productes,
                        'message'       => $message
                    ]);
                    header('location: index.php?url=Product');
                }else{

                    $categories = $this->category->getList();
                    $categories = json_decode($categories);
                    $message_error = "Tạo mới sản phẩm không thành công";
                    $this->view('backend/layout/master',[
                        'page'                  => 'backend/product/create',
                        'categories'            => $categories,
                        'message_error'         => $message_error,
                        'error'                 => $error,
                        'result_old'            => $result_old
                    ]); 
                }

                
            }
        }

        public function delete(){
            $id = $_POST['product_id'];
            $product_delete = json_decode($this->product->getById($id));

            //Xoa anh trong thu muc uploads
            foreach ($product_delete->image as $item_image) {
                $path_image_old = './public/uploads/'.$item_image;
                if(file_exists($path_image_old)){
                    unlink($path_image_old);
                }
           }
            //Xoa anh trong table product_image
            $kq = $this->product_image->delete($id);
            $result = $this->product->delete($id);
            $message = ($result=='true')?"Xóa sản phẩm thành công":"Xóa sản phẩm thất bại";
            $productes = $this->product->getList();
            $productes = json_decode($productes);
            $this->view('backend/layout/master',[
                'page'          => 'backend/product/index',
                'productes'     => $productes,
                'message'       => $message
            ]);
            header('location: index.php?url=Product');
        }

        public function edit($id){
            $product_edit = $this->product->getById($id);
            $product_edit = json_decode($product_edit);
            // print_r($product_edit->cat_id);
            // die();
            $categories = $this->category->getList();
            $categories = json_decode($categories);
            $this->view('backend/layout/master',[
                'page'          => 'backend/product/create',
                'categories'    => $categories,
                'product_edit'  => $product_edit
            ]);
        }

        public function update($id){
            $product_edit = $this->product->getById($id);
            $product_edit = json_decode($product_edit);
            $name               = isset($_POST['name'])?$_POST['name']:$product_edit->name;
            $price_unit         = isset($_POST['price_unit'])?$_POST['price_unit']:$product_edit->price_unit;
            $price_promotion    = isset($_POST['price_promotion']) ? $_POST['price_promotion'] : $product_edit->price_promotion;
            $description        = isset($_POST['description']) ? $_POST['description']:$product_edit->description;
            $cat_id             = isset($_POST['cat_id'])? $_POST['cat_id']:$product_edit->cat_id;
            $status             = isset($_POST['status']) ? 1 : 0;
            $quantity           = isset($_POST['quantity'])?$_POST['quantity']:$product_edit->quantity;
            $updated_at         = date('Y-m-d H:i:s');

            // xu li image
            if($_FILES['image']['name'][0] != ""){
                $product_id     = $id;

                //Xoa anh trong thu muc uploads
                foreach ($product_edit->image as $item_image) {
                    $path_image_old = './public/uploads/'.$item_image;
                    if(file_exists($path_image_old)){
                        unlink($path_image_old);
                    }
                }

                // Xoa nhung file anh co san trong table
                $result_delete_image = $this->product_image->delete($product_id); 
                
                // Xu li anh moi them vao
                $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                $path = "public/uploads/";
                foreach($_FILES['image']['name'] as $key => $file){
                    if(in_array($_FILES['image']['type'][$key],$allowTypes)){
                        if($_FILES['image']['error'][$key]==0){
                            $file_name = $_FILES['image']['name'][$key];
                            $array = explode('.',$file_name);
                            $new_name = $array[0].rand(0,999).'.'.$array[1];
                            $image              =   $new_name;
                            $product_id = $id;
                            $result_insert_product_image = $this->product_image->insert($product_id,$new_name);
                            if(json_decode($result_insert_product_image) == 'true'){
                                move_uploaded_file($_FILES['image']['tmp_name'][$key],$path.$new_name);
                            }
                        }
                    }else{
                        die('Lỗi type ảnh');
                    }
                }
            }else{
                $image = $product_edit->image;
            }


            // print_r($updated_at);
            $result =  $this->product->update($id,$name,$price_unit,$price_promotion,$description,$status,$quantity,$image,$cat_id,$updated_at);
            if($result == "true"){
                $productes = $this->product->getList();
                $productes = json_decode($productes);
                $message = ($result=='true')?"Cập nhật sản phẩm thành công":"Lỗi cập nhật sản phẩm";
                $this->view('backend/layout/master',[
                    'page'          => 'backend/product/index',
                    'productes'     => $productes,
                    'message'       => $message
                ]);
                header('location: index.php?url=Product');
            }else{
                header('location: index.php?url=Product/edit/'.$product_edit);
            }
        }

        public function change_status(){
            $product_id = $_GET['product_id'];
            $product_edit = json_decode($this->product->getById($product_id));
            $data = array();
            $data['product_id'] = $product_edit->id;
            if($product_edit->status==0){
                $product_edit->status = 1;
                $data['status'] = "Hiển thị";
                $data['num_status'] = 1;
            }else{
                $product_edit->status = 0;
                $data['status'] = "Không hiển thị";
                $data['num_status'] = 0;
            }
            $updated_at         = date('Y-m-d H:i:s');
            $this->product->update_status($product_edit->id,$product_edit->status,$updated_at);
            echo json_encode($data);
        }

    }
?>