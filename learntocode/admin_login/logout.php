<?php session_start(); ?>

<?php 
    $_SESSION['admin_username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;

    header("Location: login.php");
?>