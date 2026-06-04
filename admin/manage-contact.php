<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";

// Fetch current values
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school_contact WHERE id=1"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE school_contact SET 
        address='$address',
        phone='$phone',
        email='$email'
    WHERE id=1");

    $success = "Contact info updated successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Contact | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
<h2>Manage Contact Information</h2>

<?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

<form method="POST">

  <label>Address:</label>
  <textarea name="address" rows="4" required><?= $data['address'] ?></textarea>

  <label>Phone:</label>
  <input type="text" name="phone" value="<?= $data['phone'] ?>" required>

  <label>Email:</label>
  <input type="email" name="email" value="<?= $data['email'] ?>" required>

  <button class="btn primary">Update</button>
</form>

</div>

</body>
</html>
