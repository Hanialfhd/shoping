<?php
session_start();
include('coon.php');

// التحقق من أن المستخدم مسجل الدخول
if (!isset($_SESSION['user_id'])) {
    header('Location: login_user.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// التحقق من وجود معرف المنتج في الرابط
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // التحقق ما إذا كان المنتج موجودًا مسبقًا في عربة المستخدم
    $check = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    
    if (mysqli_num_rows($check) == 0) {
        // إذا لم يكن المنتج موجودًا مسبقًا، يتم إدخاله في العربة
        $insert = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($con, $insert);
    }
}

// إعادة التوجيه إلى صفحة العربة
header('Location: cart.php');
exit;
?>
