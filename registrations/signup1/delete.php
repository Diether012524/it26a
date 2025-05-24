<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        die("Delete Error: " . mysqli_error($conn));
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
