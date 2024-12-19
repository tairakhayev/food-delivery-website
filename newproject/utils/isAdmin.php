<?php 
    require_once("session.php");
    require_once("conn.php");

    // get current user id
    $userId = $_SESSION['id'];

    // get current user role
    $sql = "SELECT is_admin FROM users WHERE id = '$userId'";
    // if admin return true
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['is_admin'] == 1) {
        return true;
    }
    // if not admin return false
    return false;


?>