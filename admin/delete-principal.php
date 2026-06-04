<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];

  // (Optional) Delete image file — not doing here to keep simple
  mysqli_query($conn, "DELETE FROM about_principal WHERE id=$id");
}

header("Location: manage-principal.php");
exit();
