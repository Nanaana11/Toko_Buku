<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';

$id_buku = $_GET["id_buku"];

    if(delete($id_buku) > 0 ) {
        echo "<script>
            alert('Data deleted successfully');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data was not successfully deleted');
            document.location.href = 'index.php';
        </script>";
    }
?>