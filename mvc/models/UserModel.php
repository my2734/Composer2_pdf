<?php
class UserModel extends DB{
    public function insert($user_name,$full_name,$email,$phone,$country,$conscious,$district,$commune,$address_detail,$password,$created_at,$updated_at){
        $query= "INSERT INTO user values ('','$user_name','$full_name','$email','$phone','$country','$conscious','$district','$commune','$address_detail','$password','$created_at','$updated_at')";
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

    public function getId($id){
        $query = "SELECT * FROM user WHERE id = '$id'";
        $result = $this->con->query($query);
        if($result->rowCount() > 0){
            $row = $result->fetch();
        }
        return json_encode($row);
        
    }
}
