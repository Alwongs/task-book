<?php

class TaskModel extends Model 
{
    public function getCountTasks() 
    {        
        $sql = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(); 
    }

    public function getLimitTasks($leftLimit, $rightLimit, $orderBy, $sortDirect) 
    {
        $sql = "SELECT * FROM tasks ORDER BY " .$orderBy. " " .$sortDirect. " LIMIT :leftLimit, :rightLimit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":leftLimit", $leftLimit, PDO::PARAM_INT);
        $stmt->bindValue(":rightLimit", $rightLimit, PDO::PARAM_INT);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getOneTask($id) 
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);        
    }

    public function saveTask($fullName, $email, $task, $createdAt) 
    {
        $sql = "INSERT INTO tasks (full_name, email, task, created_at) VALUES (:fullName, :email, :task, :createdAt)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":fullName", $fullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":task", $task, PDO::PARAM_STR);
        $stmt->bindValue(":createdAt", $createdAt, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateTask($task, $status, $id) 
    {
        $sql = "UPDATE tasks SET task = :task, status = :status WHERE id = :id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":task", $task, PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        return $stmt->execute();
    } 
}