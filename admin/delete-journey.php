<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  mysqli_query($conn, "DELETE FROM about_journey WHERE id=$id");
}

header("Location: manage-journey.php");
exit();
