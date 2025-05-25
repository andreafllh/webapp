<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // مقادیر تستی
    if ($username === 'andria' && $password === '1234') {
        setcookie('is_logged', 'true', time() + 3600, '/');
        setcookie('username', $username, time() + 3600, '/');

        header("Location: /user_panel.php");
        exit;
    } else {
        $error = "نام کاربری یا رمز اشتباه است!"; // اضافه کردن خطای ناشی از ورود نامعتبر
         $username = $_POST['username'];
      }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ورود به وبلاگ</title>
  <link rel="stylesheet" href="/statics/styl.css">
  <style>
    body {
      font-family: sans-serif;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 300px;
      text-align: center;
    }
    h2 {
      margin-bottom: 1rem;
      font-size: 24px;
      color: #0077cc;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      background-color: #fafafa;
    }
    input[type="submit"] {
      background-color: #0077cc;
      color: white;
      border: none;
      padding: 0.8rem;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #005fa3;
    }
    .footer {
      font-size: 0.8rem;
      margin-top: 1.5rem;
      color: #555;
    }
    .error {
      color: red;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>ورود به وبلاگ</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="نام کاربری" required>
      <input type="password" name="password" placeholder="رمز عبور" required>
      <input type="submit" value="ورود">
    </form>
    <p class="footer">اگر حسابی ندارید <a href="/register.php">ثبت‌نام کنید</a></p>
   
    <?php 
     $message = "";
    if (isset($username)) {
    echo "<p class='footer'><a href='/forget_password.php?username='.$username.''>رمزتان را فراموش کردین؟</a></p>";
       } else {
    echo '<a href="/forget_password.php">رمزتان را فراموش کردین؟</a>';
}
?>
      <p><a href="reset_password.php"> ریست پسوورد</a></p>
     <p><a href="#" onclick="logout()">خروج</a></p>
       
     <?php
if (array_key_exists('msg', $_GET)) {
 
    $message = $_GET['msg'];
    }
     if (!empty($error)): ?>
  <p><?php echo $message; ?></p>
  <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

  </div>

  <script>
  // تابع برای پاک کردن کوکی
  function deleteCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
  }

  // تابع لاگ‌اوت
  function logout() {
    deleteCookie('is_logged');
    deleteCookie('username');
    setTimeout(() => {
      window.location.href = '/login.php';  // رفتن به صفحه ورود
    }, 500);
  }
</script>

</body>
</html>

