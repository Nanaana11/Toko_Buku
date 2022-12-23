<?php
session_start();
include '_config/functions.php';

if(isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"]) ) {
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
   }

   $error = true;

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
    <title>Login</title>
</head>
<body class="m-5">
    <h1 class="mb-4">Login</h1>
    <?php if(isset($error) ) : ?>
        <p class="text-danger fw-bold">HANDS UP!!! WHO ARE YOU?!!</p>
    <?php endif; ?>
    <form action="" method="post"> 
        <div class="mb-3 col-3">
            <label for="username" class="form-label">username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="mb-3 col-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3 col-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-3 col-3">
            <a href="registrasi.php">Not have a account?</a>
        </div>
        <input type="submit" class="btn btn-primary" name="login" value="Login">
    </form>
</body>
</html>