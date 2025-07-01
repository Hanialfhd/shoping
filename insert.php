<?php
session_start();
if(!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit;
}
include('coon.php');

if(isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($img);

        if(move_uploaded_file($tmp, $target_file)) {
            mysqli_query($con, "INSERT INTO pro(name, price, image, description, category) VALUES('$name', '$price', '$img', '$desc', '$cat')");
            
            // إعادة التوجيه إلى صفحة المتجر بعد نجاح الرفع
            header("Location: prod.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء رفع الصورة";
        }
    } else {
        $error = "يرجى اختيار صورة للمنتج";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>رفع منتج</title>
</head>
<body>
    <div class="main">
        <h2>واجهة رفع منتج</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="اسم المنتج" required><br>
            <input type="text" name="price" placeholder="السعر" required><br>
            <textarea name="description" placeholder="وصف المنتج" required></textarea><br>
            <select name="category" required>
                <option value="الكترونيات">الكترونيات</option>
                <option value="شاشات">شاشات</option>
                <option value="هواتف">هواتف</option>
                <option value="كمبيوتر">كمبيوتر</option>
                <option value="أواني منزلية">أواني منزلية</option>
                <option value="ملابس رجالية">ملابس رجالية</option>
                <option value="ملابس نسائية">ملابس نسائية</option>
                <option value="ملابس أطفال">ملابس أطفال</option>
                <option value="الصحة والجمال">الصحة والجمال</option>
                <option value="الألعاب والأطفال">الألعاب والأطفال</option>
            </select><br><br>
            <input type="file" name="image" required><br><br>
            <button name="upload">رفع المنتج</button>
        </form>
    </div>
</body>
</html>
