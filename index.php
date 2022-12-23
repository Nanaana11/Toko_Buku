<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

include '_config/functions.php';

$book = "SELECT * FROM buku INNER JOIN penulis ON buku.id_au = penulis.id_au INNER JOIN penerbit ON buku.id_pener = penerbit.id_pener";
$query = mysqli_query($conn, $book);

if(isset($_POST["search"]) ) {
    $book = search($_POST["keyword"]);
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
    <title>Imprinty Store</title>
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
        <h1 class="mb-4">Book Data</h1>
        <a href="tambah.php" class="btn btn-primary mb-4">Add Data</a>
        <form action="" method="post" class="d-flex mb-4 col-4" role="search">
            <input class="form-control me-2" type="text" name="keyword" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Type of Book</th>
                    <th scope="col">Title</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Author</th>
                    <th scope="col">Publisher</th>
                    <th scope="col">Price</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <?php $i = 1 ; ?>
            <?php while($data = mysqli_fetch_array($query) ) : ?>
            <tbody>
                <tr>
                    <td><?= $i ;?></td>
                    <td><?= $data['nama_tipe']; ?></td>
                    <td><?= $data['nama_buku']; ?></td>
                    <td><?= $data['genre']; ?></td>
                    <td><?= $data['nama_au']; ?></td>
                    <td><?= $data['nama_pener']; ?></td>
                    <td><?= $data['harga']; ?></td>
                    <td>
                        <a class="btn btn-success" href="change.php?id_buku=<?= $data["id_buku"]; ?>" onclick="return confirm('Are you sure you want to change?')">Change</a> 
                        <a class="btn btn-danger" href="delete.php?id_buku=<?= $data["id_buku"]; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php $i++; ?>
            <?php endwhile; ?>
        </table>
    </section>
</body>
</html>
