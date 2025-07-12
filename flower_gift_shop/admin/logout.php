<?php
session_start();

// Xoá toàn bộ session (admin)
session_unset();
session_destroy();

// Chuyển hướng về trang đăng nhập admin
header("Location: login.php");
exit;
?>
