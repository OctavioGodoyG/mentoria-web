<?php

use PDO;

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
// $sql = "INSERT INTO users
//         (full_name, email, user_name, password)
//         VALUES
//         (:full_name, :email, :user_name, :password);";

// //statement
// $stmt = $db->prepare($sql);

// $full_name = 'Juan PErez';
// $email = 'juan.perez@segic.usach.cl';
// $user_name = 'juan.perez';
// $password = 'juan123';

// $stmt->bindParam(':full_name',$full_name);
// $stmt->bindParam(':email',$email);
// $stmt->bindParam(':user_name',$user_name);
// $stmt->bindParam(':password',$password);

// $stmt->execute();


// $id=3;
// $stmt = $db->prepare("DELETE FROM users where id=:id");
// $stmt->bindParam(':id',$id);
// $stmt->execute();


// $sql = "SELECT id, full_name, email, user_name FROM users;";
// $result = $db->prepare($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["full_name"]. " " . $row["email"]. " " . $row["user_name"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }


try {

    $sql = "SELECT id, full_name, email, user_name FROM users;";
    $result = $db->prepare($sql);
    $stmt->execute();
  
    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $user) {
        echo "id: " . $user["id"] . "<br>";
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }