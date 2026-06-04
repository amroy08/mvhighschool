

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

$id = $_GET['id'];
$faculty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM faculty WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $staff_type = $_POST['staff_type']; // NEW
    $slug = strtolower(str_replace(" ", "-", $name));

    if (!empty($_FILES['image']['name'])) {
        $filename = time() . "-" . basename($_FILES['image']['name']);

        // Ensure folder exists
        $uploadDir = "../uploads/faculty/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imagePath = "uploads/faculty/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
    } else {
        $imagePath = $faculty['image'];
    }

    mysqli_query($conn,
        "UPDATE faculty SET
         name='$name',
         designation='$designation',
         qualification='$qualification',
         experience='$experience',
         image='$imagePath',
         slug='$slug',
         staff_type='$staff_type'
         WHERE id=$id"
    );

    header("Location: manage-faculty.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Faculty | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Edit Staff Member</h2>

<form method="POST" enctype="multipart/form-data">

<label>Staff Type</label>
<select name="staff_type" required>
  <option value="Teaching" <?= ($faculty['staff_type']=="Teaching") ? "selected" : "" ?>>Teaching Staff</option>
  <option value="Non-Teaching" <?= ($faculty['staff_type']=="Non-Teaching") ? "selected" : "" ?>>Non-Teaching Staff</option>
</select>

<label>Full Name</label>
<input type="text" name="name" value="<?= $faculty['name'] ?>" required>

<label>Designation</label>
<input type="text" name="designation" value="<?= $faculty['designation'] ?>" required>

<label>Qualification</label>
<input type="text" name="qualification" value="<?= $faculty['qualification'] ?>" required>

<label>Experience Summary</label>
<textarea name="experience" rows="3" required><?= $faculty['experience'] ?></textarea>

<label>Photo</label>
<input type="file" name="image">

<?php if(!empty($faculty['image'])): ?>
  <img src="../<?= $faculty['image'] ?>" width="150" style="margin-top:10px;border-radius:8px;">
<?php endif; ?>

<button class="btn primary" style="margin-top:20px;">Update</button>

</form>
</div>
</body>
</html>

