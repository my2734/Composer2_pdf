<?php 
    class Tbl_StatisticalModel extends DB{
        public function insert($order_date,$sales,$profit,$quantity,$total_order){
            $query = "INSERT INTO tbl_statistical VALUES(null,'$order_date','$sales','$profit','$quantity','$total_order')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function getList($ngaybatdau,$ngayketthuc){
            $query = "SELECT * FROM tbl_statistical WHERE order_date >= '$ngaybatdau' AND order_date <= '$ngayketthuc' ORDER BY order_date ASC";
            
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() >0){
                while($row = $result->fetch()){
                    array_push($arr,$row);
                }
            }
            return json_encode($arr);

        }

        public function get_order_date($order_date){
            $query = "SELECT * FROM tbl_statistical WHERE order_date ='$order_date'";
            
            $result = $this->con->query($query);
            $row = null;
            if($result->rowCount() >0){
                $row = $result->fetch();
            }
            return json_encode($row);
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

        public function update_order_date($sales,$profit,$quantity,$total_order,$id_statistical){
            $query = "UPDATE tbl_statistical SET  sales = '$sales', profit = '$profit', quantity = '$quantity',total_order = '$total_order' WHERE id_statistical = '$id_statistical'";
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