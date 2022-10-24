<?php 
    class Controller{
        public function model($model){
           if(file_exists('./mvc/models/'.$model.'.php')){
            require_once "./mvc/models/".$model.".php";
            return new $model;
           }
        }
        public function view($view,$data=[]){
            require_once('./mvc/views/'.$view.'.php');
        }
    }
?>