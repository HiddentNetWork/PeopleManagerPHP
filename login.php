<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = loginUser($username, $password);
    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: admin.php");
        exit();
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="login-title"><h1>Đăng nhập</h1></div>
    <form method="post" action="login.php">
        <div class="login-border">
            <label>Tên Đăng Nhập:</label><br>
            <input type="text" name="username"><br>
            <label>Mật Khẩu:</label><br>
            <input type="password" name="password"><br>
            <input type="submit" value="Đăng Nhập">
        </div>
    </form>
</body>
</html>
