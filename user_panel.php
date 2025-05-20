
<?php
// چک می‌کنیم که کوکی لاگین وجود داره یا نه
$is_logged = $_COOKIE['is_logged'] ?? null;
$username = $_COOKIE['username'] ?? null;

if ($is_logged !== 'true' || empty($username)) {
    // اگر کاربر وارد نشده باشه، به صفحه ورود هدایت میشه
    $login_link = '<a href="/statics/login.php">ورود</a>';
} else {
    // اگر وارد شده باشه، نام کاربری نمایش داده میشه
    $login_link = '<a href="/statics/login.php">خروج (' . htmlspecialchars($username) . ')</a>';
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
    <p>اینجا جاییه برای نوشتن و یاد گرفتن...</p>
  </header>

  <nav>
    <a href="#">خانه</a>
    <a href="#">درباره</a>
    <?php echo $login_link; ?>
  </nav>

  <div class="container">
    <div class="post">
      <h2>اولین پست من</h2>
      <p>سلام دنیا! این اولین پست منه توی وبلاگ. قراره اینجا چیزای باحال بنویسم درباره‌ی ترید، امنیت و کد زدن!</p>
    </div>

    <div class="post">
      <h2>پست دوم</h2>
      <p>امروز داشتم Apache و PHP رو روی مک نصب می‌کردم. با چند تا خطا مواجه شدم اما یاد گرفتم چطوری کنترلشون کنم...</p>
    </div>
  </div>

  <footer>
    © 2025 وبلاگ اندرِیا — همه‌ی حقوق محفوظ است.
  </footer>

</body>
</html>
