<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Hồ Sơ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Quản Lý Hồ Sơ</h2>
    <p>Tên Đăng Nhập: <?php echo $user['username']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <a href="logout.php">Đăng Xuất</a>
</body>
</html>
