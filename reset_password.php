<?php  
include 'header.php';
include __DIR__ . '/db.php';
include __DIR__ . '/function.php';

$error = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;

    $sql = "UPDATE  users set password = '$password' where username = '$username'";
      $result = mysqli_query($conn, $sql);

  if ($result === true) {
              $sql = "UPDATE users SET token = NULL WHERE username = '$username'";
                 $token_null = mysqli_query($conn, $sql);
                 header("Location: login.php?msg=The new password has been set successfully");            
        }
    }
if (array_key_exists('token', $_GET)) {
 
    $token = $_GET['token'];
     $sql = "SELECT * FROM users WHERE token = '$token'";
      $result = mysqli_query($conn, $sql);

    
  
  if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $token_result = true;

  }
}

if (isset($token_result) === true) { ?>

    <form action="reset_password.php" method="POST">
      <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">

      <div>
        <label>رمز عبور جدید:</label>
        <input type="password" name="password" required>
      </div>
      <input type="submit" value="تغییر رمز عبور ">
    </form>

<?php } else {
    echo 'The provided token is not valid or expired, <a href="/login.php">go back</a>';
}

include 'footer.php';

?>