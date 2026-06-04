<?php
include "../db.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM alumni WHERE id=$id");
header("Location: manage-alumni.php");
?>
