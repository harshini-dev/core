<?php 
session_start();


unset($_SESSION['user']);
unset($_SESSION['password']);
unset($_SESSION['id']);
unset($_SESSION['name']);

// header("location:login.php");
header("location:index.php");
?>