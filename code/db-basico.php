<?php

$db_name = "registro";
$db_user = "user1";
$db_pass = "user1";

try  { 
    $dsn = "mysql:host=localhost;dbname=$db_name";
    $db = new PDO($dsn, $db_pass, $db_user);
}catch(PDOException $e){
    echo $e->getMessage();
}

//preparar consulta
$sql = "INSERT INTO users
        (full_name, email, user_name, password)
        VALUES
        (:full_name, :email, :user_name, :password);";

//statement
$stmt = $db->prepare($sql);

$full_name = 'Juan PErez';
$email = 'juan.perez@segic.usach.cl';
$user_name = 'juan.perez';
$password = 'juan123';

$stmt->bindParam(':full_name',$full_name);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':user_name',$user_name);
$stmt->bindParam(':password',$password);

$stmt->execute();
