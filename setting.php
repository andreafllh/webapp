<?php
include __DIR__ . '/db.php';
session_start();


$is_logged = $_SESSION['is_logged'] ?? null;
$username = $_SESSION['username'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if (!$is_logged || empty($username)) {

    // اگر کاربر وارد نشده باشه، به صفحه ورود هدایت میشه
    $login_link = '<a href="login.php">ورود</a>';
} else {
    // اگر وارد شده باشه، نام کاربری نمایش داده میشه
    $login_link = '<a href="login.php">خروج (' . htmlspecialchars($username) . ')</a>';
}
if (!isset($_SESSION['user_id'])) {
    

try {
            
            $sql = "SELECT * FROM `users` WHERE user_id = " . $_SESSION['user_id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            print_r($row);

    } catch (mysqli_sql_exception $e) {
            $error = "خطا در ثبت‌نام: " . $e->getMessage();
        }
        
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
    form input, form textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    form button {
      background-color: #0077cc;
      color: white;
      padding: 10px;
      border: none;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    form button:hover {
      background-color: #005fa3;
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
  </nav>

  <div class="container">
    <div class="post">
      <h2>فرم ویرایش اطلاعات</h2>
     <form action="update_user.php" method="POST">
    <input type="hidden" name="user_id" value="<?= $user_information['user_id']; ?>">

    <label for="first_name">اسم:</label>
    <input type="text" id="first_name" name="first_name"value="<?= $user_information['first_name']; ?> required>

    <label for="last_name">فامیل:</label>
    <input type="text" id="last_name" name="last_name"value="<?= $user_information['last_name']; ?> required>

    <label for="username">نام کاربری جدید:</label>
    <input type="text" id="username" name="username" value="<?= $user_information['username']; ?>disabled>

    <label for="email">ایمیل:</label>
    <input type="email" id="email" name="email"value="<?= $user_information['email']; ?> disabled>

    <label for="password">رمز عبور جدید:</label>
    <input type="password" id="password" name="password" placeholder="خالی بگذارید اگر نمی‌خواهید تغییر دهید">

    <label for="bio">بایو:</label>
    <textarea id="bio" name="bio" value="<?= $user_information['bio']; ?> rows="4" placeholder="توضیحاتی درباره‌ی خودتان..."></textarea>

    <button type="submit">ذخیره تغییرات</button>
</form>

    </div>
  </div>

  <footer>
    © 2025 وبلاگ اندرِیا — همه‌ی حقوق محفوظ است.
  </footer>

</body>
</html>