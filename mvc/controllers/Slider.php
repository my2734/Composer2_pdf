<?php
    class Slider extends Controller{
        public $slider;
        public function __construct(){
            $this->slider = $this->model('SliderModel');
        }

        public function index(){
            $list_slider =  json_decode($this->slider->getList());

            $this->view('backend/layout/master',[
                'page'          => 'backend/slider/index',
                'list_slider'   => $list_slider
            ]);
        }

        public function create(){
            $this->view('backend/layout/master',[
               'page'           => 'backend/slider/create'
            ]);
        }

        public function store(){
//            print_r($_FILES['image']);
//            die();
            //validation
            $test_validate = false;
            //1. Image
            if($_FILES['image']['name'] == ""){
                $test_validate = true;
            }

            if($test_validate) {
                $this->view('backend/layout/master', [
                    'page' => 'backend/slider/create',
                    'message_error' => 'Vui lòng nhập ảnh'
                ]);
            }else{
                $status         = isset($_POST['status'])?1:0;
                $image = "";
                //xu li image
                $allowTypes = array('jpg','png','jpeg','gif','image/jpeg');
                $path = "./public/uploads/";
                if($_FILES['image']['name']){
                    if(in_array($_FILES['image']['type'],$allowTypes)){
                        $file_name = $_FILES['image']['name'];
                        $image = $file_name;
                        move_uploaded_file($_FILES['image']['tmp_name'],$path.$file_name);
                    }
                }

                $result = $this->slider->insert($image,$status);
                if($result==true){
                    $list_slider =  json_decode($this->slider->getList());
                    $this->view('backend/layout/master',[
                        'page'              => 'backend/slider/index',
                        'list_slider'       => $list_slider,
                        'message_success'   =>  'Tạo mới thành công slider'
                    ]);
                    header('location: index.php?url=Slider');
                }
            }


        }
        public function delete(){
            $slider_id = $_POST['slider_id'];
            $result = $this->slider->delete($slider_id);
            $list_slider =  json_decode($this->slider->getList());
            if($result=="true"){
                $this->view('backend/layout/master',[
                    'page'              => 'backend/slider/index',
                    'message_success'   =>  'Xoá thành công slider',
                    'list_slider'   => $list_slider
                ]);
                header('location: index.php?url=Slider');
            }
        }
    }
?>