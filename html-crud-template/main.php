<?php
require "util/db.php";

session_start();
if(!isset($_SESSION['nombre'])){
    header("location:index.php");
}

$valido = 0;
$db = connectDB();

$sql = "SELECT * FROM users";
//statement
$stmt = $db->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["btnEliminar"])) {

    $id = $_POST["id"];

    //echo "paso por aqui";
    $sql = "DELETE FROM users where id= :id";

    //statement
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $message = "Se procedio a Eliminar";
    $valido = 1;
    header("location:main.php");
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

    <title>Lista de Usuarios</title>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="main.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
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
                    <a href="logout.php">Logout</a>
                </form>

            </div>
        </nav>
    </div>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Lista de Usuarios</h1>

            <?php if ($valido == 1) : ?>
                <font color="red"><?= $message; ?></font>
            <?php endif; ?>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Full Namme</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['full_name'] ?></td>
                            <td><?= $user['user_name'] ?></td>
                            <td><?= $user['email'] ?? 'Sin correo' ?></td>
                            <td>
                                <a href="view.php?id=<?= $user['id'] ?>"><button class="btn btn-primary btn-sm">View</button></a>
                                <a href="edit.php?id=<?= $user['id'] ?>"><button class="btn btn-outline-primary">Edit</button></a>
                            <td>
                                <form method="POST" action="main.php">
                                    <input type="hidden" name="id" value=" <?= $user['id']; ?> ">
                                    <!-- <button class="btn btn-sm" name="btnEliminar">Delete</button> -->
                                    <button class="btn btn-danger" onclick="return confirm('Esta seguro que desea borrar el archivo?');" name="btnEliminar">Delete</button>
                                </form>
                            </td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
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