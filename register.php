
<?php
include 'header.php';
include 'statics/db.php';
include __DIR__ . 'statics/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // اینجا می‌تونی اطلاعات ثبت‌نام رو پردازش کنی

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $error = "این نام کاربری قبلاً ثبت شده است. لطفاً نام دیگری انتخاب کنید.";
    } else {
        try {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);

            if ($result === true) {
                header("Location: /user_panel.php?msg=ثبت‌نام با موفقیت انجام شد");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $error = "خطا در ثبت‌نام: " . $e->getMessage();
        }
    }
}
?>
<?php if (!empty($error)): ?>
  <div style="color:red; margin:10px 0;"><?php echo $error; ?></div>
<?php endif; ?>

<form action="register.php" method="POST">
  <div><input type="text" name="username" placeholder="نام کاربری" required></div>
  <div><input type="password" name="password" placeholder="رمز عبور" required></div>
  <div><input type="email" name="email" placeholder="ایمیل" required></div>
  <input type="submit" value="ثبت‌نام">

  <a href='statics/login.php'>you have already an account</a>
</form>

<?php
include 'footer.php';
?>
