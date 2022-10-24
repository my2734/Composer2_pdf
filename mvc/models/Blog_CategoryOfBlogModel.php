<?php
    class Blog_CategoryOfBlogModel extends DB{
        public function insert($blog_id,$cat_id){
            $query = "INSERT INTO blog_categoryofblog VALUES('','$blog_id','$cat_id')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function delete_by_blog_id($blog_id){
            $query = "DELETE FROM blog_categoryofblog WHERE blog_id = '$blog_id'";
            $result = $this->con->query($query);
            return json_encode($result);
        }

        public function delete_by_categoryofblog_id($categoryofblog_id){
            $query = "DELETE FROM blog_categoryofblog WHERE cat_id = '$categoryofblog_id'";
            $result = $this->con->query($query);
            return json_encode($result);
        }

        public function list_blog_categoryofblog_by_cat_id($id){

            $query = "SELECT * FROM blog_categoryofblog WHERE cat_id = '$id'";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount()>0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }
    }
?>