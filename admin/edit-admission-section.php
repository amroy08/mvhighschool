<?php
include("../db.php");
session_start();

if(!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM admissions_content WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if(isset($_POST["update"])) {
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    mysqli_query($conn, "UPDATE admissions_content SET content='$content' WHERE id=$id");
    header("Location: manage-admissions.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Edit Admission Section</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Edit: <?php echo ucfirst($data["section_name"]); ?></h2>

    <form method="POST">
        <label>Content</label><br>
        <textarea name="content" rows="10" style="width:100%;"><?php echo $data["content"]; ?></textarea>
        <br><br>
        <button class="btn primary" type="submit" name="update">Save Changes</button>
    </form>
</div>

</body>
</html>
