<?php
    class Blog_TagsModel extends DB{
        public function insert($id_blog,$tags_id){
            $query = "INSERT INTO blog_tags VALUES('','$id_blog','$tags_id')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function delete_by_blogid($blog_id){
            $query = "DELETE FROM blog_tags WHERE blog_id = '$blog_id'";
            $result = $this->con->query($query);
            return json_encode($result);

        }

        public function delete_by_tags_id($tags_id){
            $query = "DELETE FROM blog_tags WHERE tags_id = '$tags_id'";
            $result = $this->con->query();
            return json_encode($result);

        }

        public function list_blog_tags_by_tags_id($tags_id){
            $query = "SELECT * FROM blog_tags WHERE  tags_id = '$tags_id'";
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