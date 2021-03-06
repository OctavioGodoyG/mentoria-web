<?php
require "util/db.php";

session_start();
if(!isset($_SESSION['nombre'])){
    header("location:index.php");
}

$valido = 0;
if (isset($_POST['send-button'])) {

    $db = connectDB();

    //$idregistro = $_POST["id"];
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $password = password_hash($password, PASSWORD_DEFAULT);

    //preparar consulta
    $sql = "INSERT INTO users
				(full_name, email, user_name, password)
				VALUES
				(:full_name, :email, :user_name, :password);";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':full_name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_name', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $target_dir = "uploads/";
    $nameImage = $username . ".jpg";
    //$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    //print_r($target_file);
    $target_file = $target_dir . $nameImage;
    //print_r($_FILES["imagen"]);
    //print_r($target_file);

    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        $message =  "The file " . htmlspecialchars(basename($_FILES["imagen"]["name"])) . " has been uploaded.";
    } else {
        $message =  "Sorry, there was an error uploading your file.";
    }

    $valido = 1;
    //$message = "Registro creado con éxito";
}
?>


<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>List of User</title>

</head>

<body class="d-flex flex-column h-100">

    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="create.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://pisyek.com/contact">Help</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Create New User</h1>
            <?php if ($valido == 1) : ?>
                <font color="green"><?= $message; ?></font>
            <?php endif; ?>
            <form action="create.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <!-- <?php
                    $rutaImagen = "uploads/" . $users['id'] ?? '0' . ".jpg";
                    ?>
                    <img src="<?= $rutaImagen; ?>"> -->
                </div>

                <div class="form-group">
                    <!-- <img src="<?= $rutaImagen; ?>"> -->
                    <label for="upload">Upload</label>
                    <input type="file" class="form-control" name="imagen" id="upload">
                </div>


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="User-name" placeholder="Enter User">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter mail">
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" name="password" id="pass" placeholder="Enter pass">
                </div>

                <button type="submit" class="btn btn-primary" name="send-button">Submit</button>
            </form>

        </div>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container pb-5">
            <hr>
            <span class="text-muted">
                Copyright &copy; 2019 | <a href="https://pisyek.com">Pisyek.com</a>
            </span>
        </div>
    </footer>


    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>