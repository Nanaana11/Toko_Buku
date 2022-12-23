<?php
session_start();
if(!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include '_config/functions.php';

$id_pener = $_GET["id_pener"];

    if(deletePenerbit($id_pener) > 0 ) {
        echo "<script>
            alert('Data deleted successfully');
            document.location.href = 'penerbit.php';
        </script>";
    } else {
        echo "<script>
            alert('Data was not successfully deleted');
            document.location.href = 'penerbit.php';
        </script>";
    }
?>