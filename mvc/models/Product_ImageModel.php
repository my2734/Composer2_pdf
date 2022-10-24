<?php 
    class Product_ImageModel extends DB{
        public function insert($product_id,$image){
            $query = "INSERT INTO product_image VALUES(null,'$product_id','$image')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function delete($product_id){
            $query = "DELETE FROM product_image WHERE product_id = '$product_id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getImage($product_id){
            $query = "SELECT * FROM product_image WHERE product_id = '$product_id'";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }
    }
?>