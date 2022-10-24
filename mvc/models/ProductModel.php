<?php
class ProductModel extends DB{
    public function insert($id,$name,$price_unit,$price_promotion,$description,$status,$quantity,$image,$cat_id,$created_at,$updated_at){
        $query = "INSERT INTO productes VALUES('$id','$name','$price_unit','$price_promotion','$description','$status','$quantity','$image','$cat_id','$created_at','$updated_at')";
        $result = false;
        if($this->con->query($query)){
            $result = true;
        }
        return json_encode($result);
    }

    public function getList_limit(){
        $query = "SELECT * FROM productes ORDER BY id DESC Limit 8";
        $result = $this->con->query($query);
        $arr = array();
        if($result->rowCount() > 0){
            while($row =  $result->fetch()){
                $row['image'] = array();
                // select image of product
                $id = $row['id'];
                $cat_id = $row['cat_id'];
                $query_select_image = "SELECT * FROM product_image where product_id = '$id'";
                $result_select_image = $this->con->query($query_select_image);
                if($result_select_image->rowCount() > 0){
                    while($row_select_image = $result_select_image->fetch()){
                        $image_of_product = $row_select_image['image'];
                        array_push($row['image'],$image_of_product);
                    }
                }
                // get category name of product
                $query_select_category = "SELECT * FROM categories WHERE id = '$cat_id'";
                $result_select_category =  $this->con->query($query_select_category);
                if($result_select_category->rowCount() > 0){
                    $row_select_category = $result_select_category->fetch();
                    $row['cat_name'] =  $row_select_category['name'];
                }
                array_push($arr,$row);

            }
        }
//         echo json_encode($arr);
//         die();
        return json_encode($arr);

    }


    public function getList(){
         $query = "SELECT * FROM productes ORDER BY id DESC";
         $result = $this->con->query($query);
         $arr = array();
         if($result->rowCount() > 0){
             while($row =  $result->fetch()){
                 $row['image'] = array();
                 // select image of product
                 $id = $row['id'];
                 $cat_id = $row['cat_id'];
                 $query_select_image = "SELECT * FROM product_image where product_id = '$id'";
                 $result_select_image = $this->con->query($query_select_image);
                 if($result_select_image->rowCount() > 0){
                     while($row_select_image = $result_select_image->fetch()){
                         $image_of_product = $row_select_image['image'];
                         array_push($row['image'],$image_of_product);
                     }
                 }
                 // get category name of product
                 $query_select_category = "SELECT * FROM categories WHERE id = '$cat_id'";
                 $result_select_category =  $this->con->query($query_select_category);
                 if($result_select_category->rowCount() > 0){
                     $row_select_category = $result_select_category->fetch();
                         $row['cat_name'] =  $row_select_category['name'];
                 }
                 array_push($arr,$row);
             }
         }
//         echo json_encode($arr);
//         die();
         return json_encode($arr);
    }



    public function delete($id){

        // Xoa product
        $query = "DELETE FROM productes WHERE id = '$id'";
        $result = false;
        if($this->con->query($query)){
            $result = true;
        }
//        // Xoa table product_category
//        $query_product_category = "DELETE FROM product_category WHERE product_id = '$id'";
//        mysqli_query($this->con,$query_product_category);
//        // Xoa table product_image
//        $query_product_image = "DELETE FROM product_image where product_id = '$id'";
//        mysqli_query($this->con,$query_product_image);

        return json_encode($result);
    }



    public function getById($id){
        $query = "SELECT * FROM productes WHERE id = '$id'";
        $result = $this->con->query($query);
        if($result->rowCount() >0){
            $row = $result->fetch();
            $row['image'] = array();


            // select image of product
            $id = $row['id'];
            $query_select_image = "SELECT * FROM product_image where product_id = '$id'";
            $result_select_image = $this->con->query($query_select_image);
            if($result_select_image->rowCount() > 0){
                while($row_select_image = $result_select_image->fetch()){
                    $image_of_product = $row_select_image['image'];
                    array_push($row['image'],$image_of_product);
                }
            }

            $product_edit = $row;
        }
        return json_encode($product_edit);
    }

    public function getBy_CatId($id){
        $query = "SELECT * FROM productes WHERE cat_id = '$id'";
        $result = $this->con->query($query);
        $arr = array();
        if($result->rowCount()>0){
            while($row =   $result->fetch(PDO::FETCH_ASSOC)){
                $row['image'] = array();
                // select image of product
                $id = $row['id'];
                $cat_id = $row['cat_id'];
                $query_select_image = "SELECT * FROM product_image where product_id = '$id'";
                $result_select_image = $this->con->query($query_select_image);
                if($result_select_image->rowCount() > 0){
                    while($row_select_image = $result_select_image->fetch()){
                        $image_of_product = $row_select_image['image'];
                        array_push($row['image'],$image_of_product);
                    }
                }
                // get category name of product
                $query_select_category = "SELECT * FROM categories WHERE id = '$cat_id'";
                $result_select_category = $this->con->query($query_select_category);
                if($result_select_category->rowCount() > 0){
                    $row_select_category = $result_select_category->fetch();
                    $row['cat_name'] =  $row_select_category['name'];
                }
                array_push($arr,$row);
            }
        }
//         echo json_encode($arr);
//         die();
        return json_encode($arr);
    }

    public function getById_only_product($id){
        $query = "SELECT * FROM productes WHERE id = '$id'";
        $result = mysqli_query($this->con,$query);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
        }
        return json_encode($row);
    }

    public function update($id,$name,$price_unit,$price_promotion,$description,$status,$quantity,$image,$cat_id,$updated_at){
        $query = "UPDATE productes SET name = '$name', price_unit = '$price_unit', price_promotion = '$price_promotion', description = '$description', status = '$status', quantity = '$quantity', image = '$image', cat_id = '$cat_id',updated_at = '$updated_at' WHERE id = '$id'";
        $result = false;
        if($this->con->query($query)){
            $result = true;
        }
        return json_encode($result);

    }


    public function update_status($id,$status,$updated_at){
        $query = "UPDATE productes SET status = '$status',updated_at = '$updated_at' WHERE id = '$id'";
        $this->con->query($query);
    }

    public function qty_product_by_cat($id){
        $query =  "SELECT * FROM productes where cat_id = '$id'";
        $result =  $this->con->query($query);
        return $result->rowCount();
    }

    public function get_list_relate($id,$cat_id){
        $query = "SELECT * FROM productes where id != '$id' AND cat_id = '$cat_id' ORDER BY id DESC LIMIT 8";
        $result = $this->con->query($query);
        $arr = array();
        if($result->rowCount() > 0){
            while($row =  $result->fetch()){
                $row['image'] = array();
                // select image of product
                $id = $row['id'];
                $cat_id = $row['cat_id'];
                $query_select_image = "SELECT * FROM product_image where product_id = '$id'";
                $result_select_image = $this->con->query($query_select_image);
                if($result_select_image->rowCount() > 0){
                    while($row_select_image = $result_select_image->fetch()){
                        $image_of_product = $row_select_image['image'];
                        array_push($row['image'],$image_of_product);
                    }
                }
                // get category name of product
                $query_select_category = "SELECT * FROM categories WHERE id = '$cat_id'";
                $result_select_category =  $this->con->query($query_select_category);
                if($result_select_category->rowCount() > 0){
                    $row_select_category = $result_select_category->fetch();
                    $row['cat_name'] =  $row_select_category['name'];
                }
                array_push($arr,$row);
            }
        }
//         echo json_encode($arr);
//         die();
        return json_encode($arr);
    }
}
?>