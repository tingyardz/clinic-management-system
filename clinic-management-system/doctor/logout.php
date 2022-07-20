<?php
    session_start();
    unset($_SESSION['system-login']);
    header("Location:index.php");
    exit();
?>