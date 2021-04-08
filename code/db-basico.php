<?php

$db_name = "registro2";
$db_user = "registro-user";
$db_pass = "user1";

try  {
    $dsn = "mysql:host=localhost;dbname=$db_name";
    $db = new PDO($dsn, $db_pass, $db_user);
}catch(PDOException $e){
    echo $e->getMessage();
}