<?php 
    class Order_DetailModel extends DB{
        public function insert($order_id,$user_id,$pro_id,$pro_name,$pro_image,$pro_price,$pro_quantity,$created_at,$updated_at){
           
            $query = "INSERT INTO tbl_order_detail VALUES(null,'$order_id','$user_id','$pro_id','$pro_name','$pro_image','$pro_price','$pro_quantity','$created_at','$updated_at')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getList_by_orderid($order_id){
            $query = "SELECT * FROM tbl_order_detail WHERE order_id = '$order_id'";
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
           return json_encode($arr);
        }

        public function delete_order_id($order_id){
            $query = "DELETE FROM tbl_order_detail WHERE order_id = '$order_id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }
    }
?>