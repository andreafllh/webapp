<?php  
include 'header.php';
include __DIR__ . '/statics/db.php';
include __DIR__ . '/function.php';

$error = '';
$message = '';

if (array_key_exists('token', $_GET)) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM users WHERE token = '$token'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $token_result = true;
    }
}

if (isset($token_result) && $token_result === true): ?>
    <form action="reset_password.php" method="POST">
      <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">

      <div>
        <label>رمز عبور جدید:</label>
        <input type="password" name="password" required>
      </div>

      <div>
        <label>تکرار رمز عبور:</label>
        <input type="password" name="confirm" required>
      </div>

      <input type="submit" value="تغییر رمز عبور">
    </form>
<?php else: ?>
    <div class="error">The provided token is not valid</div>
<?php endif; ?>

<?php
// نمایش پیغام موفقیت یا خطا
if (!empty($error)) {
    echo '<div class="error">' . htmlspecialchars($error) . '</div>';
} elseif (!empty($message)) {
    echo '<div class="success">' . htmlspecialchars($message) . '</div>';
}
?>

<?php include 'footer.php'; ?>


