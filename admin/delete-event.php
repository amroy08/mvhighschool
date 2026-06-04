<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

if (!isset($_GET['id'])) {
    header("Location: manage-events.php");
    exit();
}

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM events WHERE id = $id");

header("Location: manage-events.php");
exit();
?>
