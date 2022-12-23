<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';

if(isset($_POST["submit"]) ) {
    if(tambah($_POST) > 0 ) {
        echo "<script>
            alert('Data added successfully');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data was not successfully added');
            document.location.href = 'index.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Add Data</title>
    <link rel="stylesheet" href="_config/style.css">
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
        <h1 class="mb-5">Add Data</h1>
        <form action="" method="post">
            <div class="row mb-3">
                <label for="nama_tipe" class="col-sm-2 col-form-label">Type of Book</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama_tipe" id="nama_tipe" placeholder="type of book">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama_buku" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama_buku"  id="nama_buku" placeholder="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="genre" id="genre" placeholder="genre">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama_au" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-5">
                    <select class="form-select" aria-label="Default select example" name="nama_au" id="nama_au">
                        <option selected value="">- author -</option>
                        <?php
                            $sql_penulis = mysqli_query($conn, "SELECT * FROM penulis") or die (mysqli_error($conn));
                            while($data = mysqli_fetch_array($sql_penulis) ) {
                                echo '<option value="'.$data['id_au'].'">'.$data['nama_au'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama_pener" class="col-sm-2 col-form-label">Publisher</label>
                <div class="col-sm-5">
                    <select class="form-select" aria-label="Default select example" name="nama_pener" id="nama_pener">
                        <option selected value="">- publisher -</option>
                        <?php
                            $sql_penerbit = mysqli_query($conn, "SELECT * FROM penerbit") or die (mysqli_error($conn));
                            while($data = mysqli_fetch_array($sql_penerbit) ) {
                                echo '<option value="'.$data['id_pener'].'">'.$data['nama_pener'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="harga" id="harga" placeholder="price">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </form>
    </section>
</body>
</html>