<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'functions.php';

$users = getAllUsers();
$userCount = countUsers();
$userStats = getUserStats();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Hồ Sơ Người Dùng</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <div class="admin-title"><h1>Quản Lý Hồ Sơ Người Dùng</h1></div>
    <p>Tổng số người dùng: <?php echo $userCount; ?></p>
    <p>Số lượng tài khoản đăng ký trong 24 giờ qua: <?php echo $userStats['users_last_24_hours']; ?></p>
    <p>Số lượng tài khoản đăng ký trong 7 ngày qua: <?php echo $userStats['users_last_7_days']; ?></p>
    <p>Số lượng tài khoản đăng ký trong 30 ngày qua: <?php echo $userStats['users_last_30_days']; ?></p>
    <a href="register.php" class="btn">Thêm Người Dùng</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Đăng Nhập</th>
            <th>Email</th>
            <th>Thời gian tạo</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['created_at']?></td>
            <td>
                <a style="background-color: orange;" class="btn" href="edit.php?id=<?php echo $user['id']; ?>">Sửa</a> | 
                <a style="background-color: red;" class="btn" href="delete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a style="background-color: green;" href="logout.php" class="btn">Đăng Xuất</a>
</body>
</html>
