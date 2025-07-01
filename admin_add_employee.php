<?php
include('coon.php');

// تنفيذ العملية عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_code = $_POST['emp_code'];
    $name = $_POST['name'];
    $password = $_POST['password']; // ⚠️ ملاحظة: يتم حفظ كلمة المرور كنص صريح (بدون تشفير)

    // تجهيز الاستعلام باستخدام الـ prepared statement
    $stmt = mysqli_prepare($con, "INSERT INTO employees (emp_code, name, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $emp_code, $name, $password);
    mysqli_stmt_execute($stmt);

    echo "<p>✅ تم إضافة الموظف بنجاح</p>";
}
?>
    <style>

            /* تنسيق عام للصفحة */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f7f9fc;
    direction: rtl;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* صندوق النموذج */
.container {
    background-color: #fff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    width: 400px;
}

/* عنوان الصفحة */
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
    font-weight: 700;
}

/* حقول الإدخال */
input[type="text"],
input[type="password"],
input[type="email"],
select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 18px;
    border: 1.8px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

/* تفاعل الحقول عند التركيز */
input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
select:focus {
    border-color: #5a8dee;
    outline: none;
}

/* زر الإضافة */
button {
    width: 100%;
    background-color: #5a8dee;
    color: #fff;
    padding: 14px;
    font-size: 1.1rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* تأثير عند تحويم الماوس على الزر */
button:hover {
    background-color: #466fc7;
}

/* رسائل الخطأ والنجاح */
.message {
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 0.95rem;
}

.error {
    color: #e74c3c;
}

.success {
    color: #27ae60;
}

/* رابط العودة */
.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #5a8dee;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
}

.back-link:hover {
    text-decoration: underline;
}

    </style>
<!-- نموذج إدخال بيانات الموظف -->
<form method="POST">
    <input type="text" name="name" placeholder="اسم الموظف" required><br>
    <input type="text" name="emp_code" placeholder="معرّف الموظف" required><br>
    <input type="text" name="password" placeholder="كلمة المرور" required><br>
    <button type="submit">إضافة الموظف</button>
    <a href="index.php">الرجوع للرئيسية</a>
</form>
