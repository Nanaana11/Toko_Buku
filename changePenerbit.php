<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';

$id_pener = $_GET["id_pener"];

$au_Data = query("SELECT * FROM penerbit WHERE id_pener = $id_pener")[0]; 

if(isset($_POST["submit"]) ) {
    if(change($_POST) > 0 ) {
        echo "<script>
            alert('Data change successfully');
            document.location.href = 'penerbit.php';
        </script>";
    } else {
        echo "<script>
            alert('Data was not successfully change');
            document.location.href = 'penerbit.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Change Publisher</title>
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
        <h1 class="mb-5">Change Publisher</h1>
        <form action="" method="post">
        <input type="hidden" name="id_pener" value="<?= $au_Data["id_pener"]; ?>">
            <div class="row mb-3">
                <label for="nama_pener" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama_pener" id="nama_pener" required value="<?= $au_Data["nama_pener"]; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email_pener" class="col-sm-1 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" name="email_pener"  id="email_pener"  required value="<?= $au_Data["email_pener"]; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pener_call" class="col-sm-1 col-form-label">Call</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="pener_call" id="pener_call"  required value="<?= $au_Data["pener_call"]; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pener_address" class="col-sm-1 col-form-label">Address</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="pener_address" id="pener_address"  required value="<?= $au_Data["pener_address"]; ?>">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Change">
        </form>
    </section>
</body>
</html>