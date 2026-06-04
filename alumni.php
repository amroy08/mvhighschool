<?php
include "db.php";
$alumni = mysqli_query($conn,"SELECT * FROM alumni ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Alumni | M.V. High School</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">


</head>

<body>
<header></header>
<script src="load-header.js"></script>

<section class="alumni-section container">

    <h2 class="page-title">Our Proud Alumni</h2>

  <div class="alumni-grid">

<?php while($row = mysqli_fetch_assoc($alumni)) { ?>
 <a href="alumni-details.php?id=<?= $row['id']; ?>" class="alumni-card-link">
    <div class="alumni-card">
        <img src="assets/<?= $row['photo']; ?>" class="alumni-photo">

        <h3><?= $row['name']; ?></h3>
        <p class="year">(Batch: <?= $row['passing_year']; ?>)</p>
        <p class="achievement"><?= $row['achievement']; ?></p>
        <p class="message">"<?= $row['message']; ?>"</p>
    </div>
</a>

<?php } ?>

</div>

</section>


</body>
</html>
