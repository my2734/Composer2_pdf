<?php
class UserModel extends DB{
    public function insert($user_name,$full_name,$email,$phone,$country,$conscious,$district,$commune,$address_detail,$password,$created_at,$updated_at){
        $query= "INSERT INTO user values ('','$user_name','$full_name','$email','$phone','$country','$conscious','$district','$commune','$address_detail','$password','$created_at','$updated_at',null)";
        $result = false;
        if($this->con->query($query)){
            $result = true;
        }
        return json_encode($result);
    }

    public function test_login($email,$password){
        $query = "SELECT * FROM user where email='$email' AND password = '$password'";
        $result = false;
        $kq = $this->con->query($query);
        if($kq->rowCount() > 0){
            $result = $kq->fetch();
        }
        return json_encode($result);
    }

    public function getList(){
        $query = "SELECT * FROM user";
        $result = $this->con->query($query);
        $arr = array();
        if($result->rowCount() >0){
            while($row = $result->fetch()){
                array_push($arr,$row);
            }
        }
        return json_encode($arr);
    }

    public function getId($id){
        $query = "SELECT * FROM user WHERE id = '$id'";
        $result = $this->con->query($query);
        if($result->rowCount() > 0){
            $row = $result->fetch();
        }
        return json_encode($row);
        
    }

    public function update($user_name,$full_name,$email,$phone,$country,$conscious,$district,$commune,$address_detail,$updated_at,$image,$id){
        $query = "UPDATE user SET user_name='$user_name', full_name='$full_name',email='$email',phone='$phone',country='$country',conscious='$conscious', district='$district',commune='$commune',address_detail='$address_detail', updated_at='$updated_at',image = '$image' WHERE id = '$id'";
        $result = false;
        if($this->con->query($query)){
            $result = true;
        }
        return json_encode($result);
    }

    public function count_user(){
        $query = "SELECT * from user";
        $result = $this->con->query($query);
        return json_encode($result->rowCount());
    }
}
