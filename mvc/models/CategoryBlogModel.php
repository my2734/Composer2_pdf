<?php 
    class CategoryBlogModel extends DB{
        public function insert($name,$status,$created_at,$updated_at){
            $query = "INSERT INTO category_of_blog VALUES(null,'$name','$status','$created_at','$updated_at')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getList(){
            $query = "SELECT * FROM category_of_blog ORDER BY updated_at DESC";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() > 0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }

        public function delete($id){
            $query = "DELETE FROM category_of_blog WHERE id = '$id' ";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getId($id){
            $query = "SELECT * FROM category_of_blog WHERE id = '$id'";
            $result = $this->con->query($query);
            if($result->rowCount() > 0){
                $row = $result->fetch();
            }
            return json_encode($row);
        }

        public function update($id,$name,$status,$updated_at){
            $query = "UPDATE category_of_blog SET name = '$name', status = '$status',updated_at = '$updated_at' WHERE id = '$id'";
            $result =  false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function update_status($id,$status,$updated_at){
            $query = "UPDATE category_of_blog SET status = '$status',updated_at = '$updated_at' WHERE id = '$id'";
            $this->con->query($query);
        }
    }
?>