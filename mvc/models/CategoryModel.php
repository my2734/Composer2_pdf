<?php 
    class CategoryModel extends DB{

        public function insert($name,$image,$status,$created_at,$updated_at){
            $query = "INSERT INTO categories VALUES(null,'$name','$image','$status','$created_at','$updated_at')";
            $kq = false;
            if($this->con->query($query)){
                $kq = true;
            }
            return json_encode($kq);
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
                   
                    $query_count_product = "SELECT COUNT(id) FROM productes WHERE cat_id = '$row[0]'";
                    $result_count_product = $this->con->query($query_count_product);
                    $count_product =  $result_count_product->fetch()[0];
                    $row['count_product'] = $count_product;
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

        public function update($id,$name,$image,$status,$updated_at){
            $query = "UPDATE categories SET name = '$name',image = '$image', status = '$status', updated_at = '$updated_at' where id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true; 
            }
            return json_encode($result);
        }

        public function update_status($id,$status,$updated_at){
            echo "hello 123";
            die();
            $query = "UPDATE categories SET status = '$status', updated_at = '$updated_at' where id = '$id'";
            $this->ccon->query($query);
        }
    }
?>