<?php
session_start();



session_start();           // شروع سشن
session_unset();           // پاک کردن تمام متغیرهای سشن
session_destroy();         // بستن کامل سشن

header("Location: login.php");  // هدایت کاربر به صفحه ورود
exit;


?>