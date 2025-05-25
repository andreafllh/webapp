<?php
include 'header.php';
include __DIR__ . '/db.php';
include __DIR__ . '/function.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    // فقط چک کردن یوزرنیم کافی‌ه، چون کاربر رمز رو فراموش کرده
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $random_string = generateRandomString(32);

        $sql_update = "UPDATE users SET token = '$random_string' WHERE username = '$username'";
        $update_result = mysqli_query($conn, $sql_update);

        if ($update_result) {
            $reset_link = "http://localhost/reset_password.php?token=$random_string";
            echo "<p>توکن ساخته شد: <code>$random_string</code></p>";
            echo "<p><a href='$reset_link'>لینک ریست پسورد</a></p>";
            $message = "لینک ریست پسورد به ایمیل {$row['email']} ارسال شد."; // فرض بر اینکه فیلد ایمیل داری
        } else {
            $error = "مشکلی در ذخیره توکن پیش آمد.";
        }
    } else {
        $error = "نام کاربری پیدا نشد.";
    }
}
?>

<!-- فرم ریست رمز -->
<form action="forget_password.php" method="POST">
  <div>
    <input type="text" name="username" placeholder="نام کاربری" 
      value="<?php if(array_key_exists("username", $_GET)) echo htmlspecialchars($_GET["username"]); ?>" 
      required>
  </div>
  <input type="submit" value="Reset">
</form>

<?php if (!empty($error)): ?>
  <div class="error"><?php echo $error; ?></div>
<?php elseif (!empty($message)): ?>
  <div class="success"><?php echo $message; ?></div>
<?php endif; ?>

<?php include 'footer.php'; ?>

