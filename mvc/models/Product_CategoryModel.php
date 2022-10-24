<?php 
    class Product_CategoryModel extends DB{
        public function insert($product_id,$cat_id){
            $query = "INSERT INTO product_category VALUES(null,'$product_id','$cat_id')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function delete($product_id){
            $query = "DELETE FROM product_category WHERE product_id = '$product_id'";
            $resutl = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($resutl);
        }

    }
?>