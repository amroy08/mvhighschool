<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";

// Fetch bank details
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school_bank WHERE id=1"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $bank = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $holder = mysqli_real_escape_string($conn, $_POST['account_holder']);
    $number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc = mysqli_real_escape_string($conn, $_POST['ifsc_code']);

    mysqli_query($conn, "UPDATE school_bank SET 
        bank_name='$bank',
        account_holder='$holder',
        account_number='$number',
        ifsc_code='$ifsc'
    WHERE id=1");

    $success = "Bank details updated!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Donate Page | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
<h2>Manage Donation Details</h2>

<?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

<form method="POST">

  <label>Bank Name:</label>
  <input type="text" name="bank_name" value="<?= $data['bank_name'] ?>" required>

  <label>Account Holder:</label>
  <input type="text" name="account_holder" value="<?= $data['account_holder'] ?>" required>

  <label>Account Number:</label>
  <input type="text" name="account_number" value="<?= $data['account_number'] ?>" required>

  <label>IFSC Code:</label>
  <input type="text" name="ifsc_code" value="<?= $data['ifsc_code'] ?>" required>

  <button class="btn primary">Update</button>
</form>

</div>

</body>
</html>
