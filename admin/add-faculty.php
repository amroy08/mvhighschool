
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $staff_type = $_POST['staff_type']; // NEW
    $slug = strtolower(str_replace(" ", "-", $name));

    // Create upload folder if not exists
    $uploadDir = "../uploads/faculty/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // OPTIONAL IMAGE (since you commented it earlier)
    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $filename = time() . "-" . basename($_FILES['image']['name']);
        $imagePath = "uploads/faculty/" . $filename; // stored in DB
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
    }

    mysqli_query($conn,
        "INSERT INTO faculty (name, designation, qualification, experience, image, slug, staff_type)
         VALUES ('$name', '$designation', '$qualification', '$experience', '$imagePath', '$slug', '$staff_type')"
    );

    header("Location: manage-faculty.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Faculty | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Add Staff Member</h2>

<form method="POST" enctype="multipart/form-data">

<label>Staff Type</label>
<select name="staff_type" required>
  <option value="Teaching">Teaching Staff</option>
  <option value="Non-Teaching">Non-Teaching Staff</option>
</select>

<label>Full Name</label>
<input type="text" name="name" required>

<label>Designation</label>
<input type="text" name="designation" required>

<label>Qualification</label>
<input type="text" name="qualification" required>

<label>Experience Summary</label>
<textarea name="experience" rows="2" required></textarea>

<label>Photo (Optional)</label>
<input type="file" name="image" accept="image/*">

<button class="btn primary" style="margin-top:20px;">Save</button>

</form>
</div>

</body>
</html>
