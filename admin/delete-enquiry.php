<?php
include("../db.php");
session_start();

if(!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM admission_enquiries WHERE id=$id");

header("Location: manage-enquiries.php");
exit;
?>
