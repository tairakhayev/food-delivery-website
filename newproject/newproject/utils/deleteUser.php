<?php
include_once "utils/session.php";
include_once "php/conn.php";

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Assuming the current user is an admin
$admin_id = $_SESSION['id'];
$user_id_to_delete = $_GET['id'];

// Check if the current user is an admin
$sql = "SELECT is_admin FROM users WHERE id = '$admin_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['is_admin'] != 1) {
    header("Location: index.php");
    exit();
}

// Perform the deletion
$sql_delete = "DELETE FROM users WHERE id = '$user_id_to_delete'";
$result_delete = mysqli_query($conn, $sql_delete);

if ($result_delete) {
    echo "<script>alert('User deleted successfully'); window.location.href = 'usersList.php';</script>";
    exit();
} else {
    echo "<script>alert('User deletion failed'); window.location.href = 'usersList.php';</script>";
    exit();
}
?>
