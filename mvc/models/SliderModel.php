<?php
    class SliderModel extends DB{
        public function insert($image,$status){
            $query = "INSERT INTO slider VALUES ('','$image','$status')";
            $result = $this->con->query($query);
            return json_encode($result);

        }

        public function getList(){
            $query = "SELECT * FROM slider order by id desc ";
            $result = $this->con->query($query);
            $slider = array();
            if($result->rowCount() >0){
                while($row= $result->fetch()){
                    array_push($slider,$row);
                }
            }
            return json_encode($slider);
        }

        public function delete($slider_id){
            $query = "DELETE FROM slider WHERE id = '$slider_id'";
            $result = $this->con->query($query);
            return json_encode($result);
        }

    }

?>