<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';
$authorData = "SELECT * FROM penulis";
$query = mysqli_query($conn, $authorData);
if(isset($_POST["search_au"]) ) {
    $authorData = search_au($_POST["keyword_au"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="_config/style.css">
    <title>Imprinty Author</title>
</head>
<body class="d-flex flex-column flex-md-row">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?=base_url('index.php')?>">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('penulis.php')?>">Author</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('penerbit.php')?>">Publisher</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="m-5 ps-0 flex-grow-1">
        <h1 class="mb-4">Author Data</h1>
        <a href="tambahPenulis.php" class="btn btn-primary mb-4">Add Data</a>
        <form action="" method="post" class="d-flex mb-4 col-4" role="search">
            <input class="form-control me-2" type="text" name="keyword_au" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="search_au">Search</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                <th scope="col">No.</th>                                                                        
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Call</th>
                <th scope="col">Address</th>
                <th scope="col">Option</th>
            </tr>
            </thead>
            <?php $i = 1 ; ?>
            <?php while($data = mysqli_fetch_array($query) ) : ?>
            <tbody>
                <tr>
                    <td><?= $i ;?></td>
                    <td><?= $data['nama_au']; ?></td>
                    <td><?= $data['au_email']; ?></td>
                    <td><?= $data['au_call']; ?></td>
                    <td><?= $data['au_address']; ?></td>
                    <td>
                        <a class="btn btn-success" href="changePenulis.php?id_au=<?= $data["id_au"]; ?>" onclick="return confirm('Are you sure you want to change?')">Change</a> 
                        <a class="btn btn-danger" href="deletePenulis.php?id_au=<?= $data["id_au"]; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php $i++; ?>
            <?php endwhile; ?>
        </table>
    </section>
</body>
</html>