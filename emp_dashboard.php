<?php
session_start();

// التأكد من أن الموظف مسجل الدخول
if (!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit;
}

include('coon.php');

// عند إرسال النموذج
if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // رفع الصورة إلى مجلد images
    move_uploaded_file($tmp, "images/" . $img);

    // إدخال بيانات المنتج إلى قاعدة البيانات
    mysqli_query($con, "INSERT INTO pro(name, price, image, description, category) VALUES('$name', '$price', '$img', '$desc', '$cat')");

    echo "✅ تم رفع المنتج بنجاح";
}
?>
<html>
    <style>
            /* تنسيق عام للصفحة */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

/* تنسيق العنوان */
h2 {
    text-align: center;
    margin: 30px 0 20px;
    color: #5a4d3a;
    font-weight: 700;
}

/* تنسيق النموذج */
form {
    width: 90%;
    max-width: 500px;
    margin: 0 auto 40px;
    background-color: #fff;
    padding: 25px 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-radius: 10px;
}

/* مدخلات النموذج */
form input[type="text"],
form input[type="file"],
form textarea,
form select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

/* تفاعل عند التركيز على الحقول */
form input[type="text"]:focus,
form input[type="file"]:focus,
form textarea:focus,
form select:focus {
    border-color: #c8ad78;
    outline: none;
}

/* نصوص المنطقة */
form textarea {
    resize: vertical;
    min-height: 80px;
}

/* زر الرفع */
form button[name="upload"] {
    background-color: #c8ad78;
    color: white;
    border: none;
    padding: 14px;
    width: 100%;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button[name="upload"]:hover {
    background-color: #a88e50;
}

/* رسالة الخطأ */
.error {
    color: #e74c3c;
    margin-bottom: 15px;
    text-align: center;
}

/* رسالة النجاح */
.success {
    color: #27ae60;
    margin-bottom: 15px;
    text-align: center;
}

    </style>
</html>
<!-- واجهة لوحة الموظف -->
<h2>مرحباً <?= htmlspecialchars($_SESSION['emp_name']) ?>!</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="اسم المنتج" required><br>
    <input type="text" name="price" placeholder="السعر" required><br>
    <textarea name="description" placeholder="الوصف" required></textarea><br>
    
    <select name="category" required>
        <option value="الكترونيات">الكترونيات</option>
        <option value="أواني منزلية">أواني منزلية</option>
        <option value="ملابس رجالية">ملابس رجالية</option>
        <option value="ملابس نسائية">ملابس نسائية</option>
        <option value="ملابس أطفال">ملابس أطفال</option>
    </select><br>
    
    <input type="file" name="image" required><br>
    <button name="upload">رفع المنتج</button>
    <!-- زر للانتقال إلى صفحة تعديل المنتجات -->
<div style="text-align: center; margin-top: 20px;">
    <a href="prod.php" style="
        display: inline-block;
        padding: 12px 25px;
        background-color: #c8ad78;
        color: white;
        text-decoration: none;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#a88e50'" onmouseout="this.style.backgroundColor='#c8ad78'">
        تعديل المنتجات
    </a>
</div>

    
</form>
