<?php

class UserModel extends Model 
{
    public function checkUser($login, $password) 
    {
        $sql = "SELECT * FROM users WHERE `login` = :login AND `password` = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}