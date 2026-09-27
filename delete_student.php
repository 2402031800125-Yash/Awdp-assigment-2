<?php
session_start();
include 'config.php';
if(!isset($_SESSION['admin_logged_in'])) { header("Location: index.php"); exit; }

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM students WHERE id = $id");
}
header("Location: dashboard.php");
?>