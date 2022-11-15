<?php 
    class Comment_ProModel extends DB{

        public function insert($user_id,$pro_id,$content,$created_at,$updated_at){
            $query = "INSERT INTO comment_pro VALUES(null,'$user_id','$pro_id','$content','$created_at','$updated_at')";
            $kq = false;
            if($this->con->query($query)){
                $kq = true;
            }
            // return json_encode($kq);
            return json_encode($kq);
        }

        public function getList($pro_id){
            $query = "SELECT * FROM comment_pro WHERE product_id = '$pro_id' ORDER BY updated_at DESC";
            
            $result = $this->con->query($query);
            $categories = array();
            while($row = $result->fetch()){
                //Xu li phan user_name, avatar
                    $user_id = $row['user_id'];
                    $query_user = "SELECT * FROM user WHERE id = '$user_id'";
                    $result_user = $this->con->query($query_user);
                    $row_user = $result_user->fetch();
                $row['user_name'] = $row_user['user_name'];
                $row['image'] = ($row_user['image']!="")?$row_user['image']:"https://www.keytechinc.com/wp-content/uploads/2020/05/avatar.png";
                
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
            $query = "DELETE FROM comment_pro WHERE id = '$id'";
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