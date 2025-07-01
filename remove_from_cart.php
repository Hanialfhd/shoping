<?php
session_start();
include('coon.php');

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if(isset($_GET['id'])) {
    $cart_id = intval($_GET['id']);
    mysqli_query($con, "DELETE FROM cart WHERE id = $cart_id");
}

header('Location: cart.php');
exit;
?>
