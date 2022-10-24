<?php 
    class CategoryModel extends DB{

        public function insert($name,$image,$status,$created_at,$updated_at){
            $query = "INSERT INTO categories VALUES(null,'$name','$image','$status','$created_at','$updated_at')";
            $kq = false;
            if($this->con->query($query)){
                $kq = true;
            }
            echo json_encode($kq);
        }

        public function getList(){
            $query = "SELECT * FROM categories ORDER BY updated_at DESC";
            $result = $this->con->query($query);
            $categories = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                array_push($categories,$row);
            }
            return json_encode($categories);
        }

        public function getListLimit4(){
            $query = "SELECT * FROM categories limit 4";
            $result = $this->con->query($query);
            $categories = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    array_push($categories,$row);
                }
            }
            return json_encode($categories);
        }

        public function delete($id){
            $query = "DELETE FROM categories WHERE id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getId($id){
            $query = "SELECT * FROM categories WHERE id = '$id'";
            $result = $this->con->query($query);
            if($result->rowCount() >0){
                $category_edit = $result->fetch();
            }
            return json_encode($category_edit);
        }

        public function update($id,$name,$status,$updated_at){
            $query = "UPDATE categories SET name = '$name', status = '$status', updated_at = '$updated_at' where id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true; 
            }
            return json_encode($result);
        }

        public function update_status($id,$status,$updated_at){
            $query = "UPDATE categories SET status = '$status', updated_at = '$updated_at' where id = '$id'";
            $this->ccon->query($query);
        }
    }
?>