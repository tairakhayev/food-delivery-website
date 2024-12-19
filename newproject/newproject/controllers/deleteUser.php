<?php
$userId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if (!$userId) {
        header("Location: ../index.php");
        die();
    }

    include_once "../php/conn.php";

    $sql = "DELETE FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);

?>
