<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';

$id_au = $_GET["id_au"];

    if(deletePenulis($id_au) > 0 ) {
        echo "<script>
            alert('Data deleted successfully');
            document.location.href = 'penulis.php';
        </script>";
    } else {
        echo "<script>
            alert('Data was not successfully deleted');
            document.location.href = 'penulis.php';
        </script>";
    }
?>