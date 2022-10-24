<?php
class AdminModel extends DB{
    public function test_login($email,$password){
        $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $this->con->query($query);
       
        if($result->rowCount() >0){
            $row = $result->fetch();
        }
        return json_encode($row);
    }
}
?>