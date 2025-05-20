  <?php
$host = 'localhost';     // آدرس سرور دیتابیس
$user = 'root';          // نام کاربری دیتابیس
$password = 'ria1998';          // رمز عبور دیتابیس
$database = 'blog_db';     // نام دیتابیس

// ایجاد اتصال
$conn = new mysqli($host, $user, $password, $database);

// بررسی اتصال
if ($conn->connect_error) {
    die("اتصال ناموفق بود: " . $conn->connect_error);
}

//echo "اتصال با موفقیت انجام شد!";

// در پایان اتصال رو ببند

?>

