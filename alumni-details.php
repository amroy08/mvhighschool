<?php
include "db.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM alumni WHERE id=$id"));
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $data['name']; ?> | Alumni Details</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">

<style>
.detail-container {
    max-width: 900px;
    margin: 40px auto;
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
}

/* FIXED — No cropping */
.detail-photo {
    width: 100%;
    max-height: 450px;
    height: auto;
    object-fit: contain;
    background: #f3f4f6;    /* light background so empty areas look clean */
    border-radius: 16px;
    padding: 10px;          /* keeps spacing around contained image */
    margin-bottom: 20px;
}

.detail-title {
    font-size: 28px;
    font-weight: 800;
    text-align: center;
}

.detail-info {
    margin-top: 15px;
    font-size: 18px;
    line-height: 1.6;
    color: #374151;
}

.back-btn {
    display: inline-block;
    padding: 10px 18px;
    background: #2563eb;
    color: #fff;
    border-radius: 8px;
    margin-bottom: 20px;
    text-decoration: none;
}
</style>

</head>

<body>

<header></header>
<script src="load-header.js"></script>

<div class="detail-container">

    <a href="alumni.php" class="back-btn">← Back to Alumni</a>

    <img src="assets/<?= $data['photo']; ?>" class="detail-photo">

    <h2 class="detail-title"><?= $data['name']; ?></h2>

    <div class="detail-info">
        <p><strong>Batch:</strong> <?= $data['passing_year']; ?></p>
        <p><strong>Achievement:</strong> <?= $data['achievement']; ?></p>
        <p><strong>Message:</strong> "<?= $data['message']; ?>"</p>
    </div>

</div>

</body>
</html>
