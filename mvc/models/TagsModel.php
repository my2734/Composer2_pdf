<?php 
    class TagsModel extends DB{
        public function insert($name,$status,$created_at,$updated_at){
            $query = "INSERT INTO tags VALUES(null,'$name','$status','$created_at','$updated_at')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getList(){
            $query = "SELECT * FROM tags ORDER BY updated_at DESC";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }

        public function delete($id){
            $query = "DELETE FROM tags WHERE id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getId($id){
            $query = "SELECT * FROM tags WHERE id = '$id'";
            $result = $this->con->query($query);
            if($result->rowCount() >0){
                $row = $result->fetch();
            }
            return json_encode($row);
        }

        public function update($id,$name,$status,$updated_at){
            $query = "UPDATE tags SET name = '$name', status = '$status', updated_at = '$updated_at' WHERE id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function update_status($id,$status,$updated_at){
            $query = "UPDATE tags SET status = '$status', updated_at = '$updated_at' WHERE id = '$id'";
            $this->con->query($query);
        }
    }
?>