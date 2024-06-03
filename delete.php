<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'functions.php';

if (isset($_GET['id'])) {
    deleteUser($_GET['id']);
}

header("Location: admin.php");
exit();
?>
