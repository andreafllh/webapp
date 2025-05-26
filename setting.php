<?php
include __DIR__ . '/db.php';
session_start();
// چک می‌کنیم که کوکی لاگین وجود داره یا نه
$is_logged = $_SESSION['is_logged'] ?? null;
$username = $_SESSION['username'] ?? null;

if (!$is_logged || empty($username)) {

    // اگر کاربر وارد نشده باشه، به صفحه ورود هدایت میشه
    $login_link = '<a href="login.php">ورود</a>';
} else {
    // اگر وارد شده باشه، نام کاربری نمایش داده میشه
    $login_link = '<a href="login.php">خروج (' . htmlspecialchars($username) . ')</a>';
}

try {
            
            $sql = "SELECT * FROM `users` WHERE user_id = " . $_SESSION['user_id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            print_r($row);

    } catch (mysqli_sql_exception $e) {
            $error = "خطا در ثبت‌نام: " . $e->getMessage();
        }
    
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>وبلاگ من</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }
    header {
      background-color: #0077cc;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    nav {
      background: #eee;
      padding: 0.5rem;
      text-align: center;
    }
    nav a {
      margin: 0 10px;
      color: #0077cc;
      text-decoration: none;
    }
    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 0 1rem;
    }
    .post {
      background: white;
      padding: 1rem;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }
    .post h2 {
      margin-top: 0;
    }
    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.8rem;
      background-color: #eee;
      margin-top: 2rem;
    }
  </style>
  <link rel="stylesheet" href="/statics/styl.css">
</head>

<body>

  <header>
    <h1>وبلاگ اندرِیا</h1>
    <p>تنظیمات پنل کاربری</p>
  </header>

  <nav>
    <a href="#">خانه</a>
    <a href="setting.php">تنظیمات</a>
    <?php echo $login_link; ?>
  
  <footer>
    © 2025 وبلاگ اندرِیا — همه‌ی حقوق محفوظ است.
  </footer>

</body>
</html>
