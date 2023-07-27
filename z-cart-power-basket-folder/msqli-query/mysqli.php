<?php

echo '<pre>';

$connection = new mysqli("127.0.0.1", "root", "", "test-task");

$result = $connection->query("SELECT * FROM tasks");

for($tasks = array(); $row = $result->fetch_assoc(); $tasks[] = $row);

$connection->close();

foreach($tasks as $task) {
    echo $task['name'] . ": " . $task['email'] . "<br>";
}