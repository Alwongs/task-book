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

    public function saveAccount($login, $fullName, $email, $password) 
    {
        $sql = "INSERT INTO users (login, full_name, email, password) VALUES (:login, :fullName, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":fullName", $fullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getUser($id) 
    {
        $sql = "SELECT * FROM users WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);;
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}