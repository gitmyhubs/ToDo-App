<?php 
    include('connect.php');

    $id = $_GET['id'];
    $q = "DELETE FROM users WHERE id = $id ";
    mysqli_query($conn, $q);
    header('location:index.php');

?>