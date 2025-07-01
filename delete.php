<?php
session_start();
include('coon.php');

// التحقق من تسجيل دخول الموظف
if (!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // تحويل المعرف إلى عدد صحيح لتجنب حقن SQL

    // حذف المنتج من قاعدة البيانات
    $delete = mysqli_query($con, "DELETE FROM pro WHERE id = $id");

    if ($delete) {
        // إعادة التوجيه بعد الحذف
        header('Location: prod.php');
        exit;
    } else {
        // طباعة رسالة الخطأ في حالة فشل الحذف
        echo "حدث خطأ أثناء الحذف: " . mysqli_error($con);
    }
} else {
    echo "لم يتم تحديد المنتج.";
}
?>
