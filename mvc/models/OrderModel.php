<?php 
    class OrderModel extends DB{
        public function insert($user_id,$full_name,$country,$conscious,$district,$commune,$address_detail,$phone,$email,$order_note,$status,$created_at,$updated_at){
            $query = "INSERT INTO tbl_order VALUES(null,'$user_id','$full_name','$country','$conscious','$district','$commune','$address_detail','$phone','$email','$order_note','$status','$created_at','$updated_at')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            if($result){
                return json_encode($this->con->lastInsertId());
            }
        }

        public function getList(){
            $query = "SELECT * FROM tbl_order order by created_at DESC";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    $row['order_detail'] = array();
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }

        public function delete_order_id($order_id){
            $query = "DELETE FROM tbl_order WHERE id = '$order_id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getId($order_id){
            $query = "SELECT * FROM tbl_order WHERE id = '$order_id' order by updated_at DESC";
            $result = $this->con->query($query);
            if($result->rowCount() >0){
               $row = $result->fetch();
                $row['order_detail'] = array();
            }
            return json_encode($row);
        }

        public function getUser_id($user_id){
            $query = "SELECT * FROM tbl_order WHERE user_id = '$user_id' order by updated_at DESC";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    $row['order_detail'] = array();
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }

        public function update($id,$name,$status,$updated_at){
            $query = "UPDATE tags SET name = '$name', status = '$status', updated_at = '$updated_at' WHERE id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function update_status($order_id){
            $query = "UPDATE tbl_order SET status = '1'  WHERE id = '$order_id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function update_status_nhan_hang($order_id){
            $query = "UPDATE tbl_order SET status = '2'  WHERE id = '$order_id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function count_order(){
            $query = "SELECT * from tbl_order";
            $result = $this->con->query($query);
            return json_encode($result->rowCount());
        }

        public function getListLimit($start_in,$number_display){
            $query = "SELECT * FROM tbl_order order by created_at DESC limit $start_in,$number_display";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    $row['order_detail'] = array();
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);
        }

    }
?>