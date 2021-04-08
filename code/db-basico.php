<?php

$db_name = "registro";
$db_user = "registro-user";
$db_pass = "user1";

$dsn = "mysql:host=localhost;dbname=$db_name";
$db = new PDO($dsn, $db_pass, $db_user);