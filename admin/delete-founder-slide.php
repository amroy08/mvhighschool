<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM about_founder_slider WHERE id=$id");

header("Location: manage-founder-slider.php");
?>
