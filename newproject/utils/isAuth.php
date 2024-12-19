<?php 
    require_once("session.php");

    // check if user authed
    if(!isset($_SESSION['id'])) {
        header("Location: index.php");
        die();
    }
?>