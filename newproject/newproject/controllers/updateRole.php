<?php
$userId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    if (!$userId) {
        header("Location: ../index.php");
        die();
    }

    include_once "../php/conn.php";

    // update user role, if 1 make 0, if 0 make 1
    $sql = "UPDATE users SET is_admin = IF(is_admin = 1, 0, 1) WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);


    // update session if the user is updating his own role
    include_once "../utils/session.php";
    if ($userId == $_SESSION['id']) {
        $_SESSION['is_admin'] = $_SESSION['is_admin'] == 1 ? 0 : 1;
    }

    header("Location: ../usersList.php");
    die();

?>
