<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == " ") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (registerUser($username, $password, $email)) {
        echo "Đăng ký thành công!";
    } else {
        echo "Đăng ký thất bại!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng Ký</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <div class="register-title"><h1>Đăng ký</h1></div>
    <form method="post" action="register.php">
        <div class="register-border">
            <label>Tên Đăng Nhập:</label><br>
            <input type="text" name="username"><br>
            <label>Mật Khẩu:</label><br>
            <input type="password" name="password"><br>
            <label>Email:</label><br>
            <input type="email" name="email"><br>
            <input class="register-submit" type="submit" value="Đăng Ký">
        </div>
    </form>
</body>
</html>
