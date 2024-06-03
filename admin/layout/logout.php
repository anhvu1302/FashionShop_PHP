<?php 
ob_start();
session_start();
include '../inc/config.php'; 
unset($_SESSION[$ss_admin]);
header("location: login.php"); 
?>