<?php

function connectDB()
{
    $db_name = "registro";
    $db_user = "user1";
    $db_pass = "user1";

    try  { 
        $dsn = "mysql:host=localhost;dbname=$db_name";
        $db = new PDO($dsn, $db_user, $db_pass);
        return $db;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}