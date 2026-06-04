<?php
session_start();
if(!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

include("../db.php");

$id = $_GET["id"];

mysqli_query($conn, "DELETE FROM admission_enquiries WHERE id=$id");

echo "<script>
        alert('Enquiry deleted successfully.');
        window.location.href='enquiry-list.php';
      </script>";
?>
