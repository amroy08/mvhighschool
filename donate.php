<?php
include "db.php";
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school_bank WHERE id=1"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Donate Us | M.V. High School</title>
<link rel="icon" type="image/png" href="/favicon.png">

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">
</head>
<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
<div class="container">

<h2>Support Our School</h2>

<div class="donate-card">
  <h3>Bank Account Details</h3>

  <p><strong>Bank Name:</strong> <?= $data['bank_name'] ?></p>
  <p><strong>Account Holder Name:</strong> <?= $data['account_holder'] ?></p>
  <p><strong>Account Number:</strong> <?= $data['account_number'] ?></p>
  <p><strong>IFSC Code:</strong> <?= $data['ifsc_code'] ?></p>
</div>

</div>
</section>

<script src="footer.js"></script>
</body>
</html>
