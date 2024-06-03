<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'functions.php';

if (isset($_GET['id'])) {
    $user = getUserById($_GET['id']);
} else {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    if (updateUser($user['id'], $username, $email)) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Cập nhật thất bại!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Thông Tin Người Dùng</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Sửa Thông Tin Người Dùng</h2>
    <form method="post" action="edit.php?id=<?php echo $user['id']; ?>">
        <label>Tên Đăng Nhập:</label><br>
        <input type="text" name="username" value="<?php echo $user['username']; ?>"><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
        <input type="submit" value="Cập Nhật">
    </form>
</body>
</html>
