<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "PHP OK<br>";

include "../db.php";
echo "DB file included<br>";

$result = mysqli_query($conn, "SHOW TABLES");
if(!$result){ die("DB error: ".mysqli_error($conn)); }
echo "DB OK<br>";
