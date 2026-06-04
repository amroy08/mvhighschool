<?php
session_start();
include "../db.php";

// ✅ Validate & sanitize ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("Invalid Alumni ID");
}

// ✅ Fetch existing record safely
$stmt = $conn->prepare("SELECT * FROM alumni WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    die("Alumni record not found!");
}

// ✅ Handle update
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = trim($_POST['name'] ?? "");
    $year = trim($_POST['passing_year'] ?? "");
    $ach  = trim($_POST['achievement'] ?? "");
    $msg  = trim($_POST['message'] ?? "");

    // ✅ Keep old photo if not changed
    $photo = $data['photo'];

    // ✅ If new photo uploaded
    if (!empty($_FILES["photo"]["name"])) {

        $allowed = ["jpg", "jpeg", "png", "webp"];
        $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            die("Only JPG, JPEG, PNG, WEBP files allowed!");
        }

        $photo = time() . "-" . basename($_FILES["photo"]["name"]);
        $targetPath = "../assets/" . $photo;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetPath)) {
            die("Photo upload failed!");
        }
    }

    // ✅ Prepared statement UPDATE (NO SQL breaking on apostrophes)
    $update = $conn->prepare("
        UPDATE alumni SET 
            name = ?,
            passing_year = ?,
            achievement = ?,
            message = ?,
            photo = ?
        WHERE id = ?
    ");

    $update->bind_param("sssssi", $name, $year, $ach, $msg, $photo, $id);

    if ($update->execute()) {
        $update->close();
        header("Location: manage-alumni.php?updated=1");
        exit();
    } else {
        die("Update failed: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Alumni</title>
<link rel="stylesheet" href="../styles.css">

<style>
.form-box {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    width: 70%;
    margin-top: 30px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}
.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.preview-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-top: 10px;
}
</style>

</head>
<body>

<a href="manage-alumni.php" class="back-btn">← Back</a>

<div class="container">
<div class="form-box">

<h2>Edit Alumni</h2>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>
</div>

<div class="form-group">
    <label>Passing Year</label>
    <input type="text" name="passing_year" value="<?= htmlspecialchars($data['passing_year']); ?>">
</div>

<div class="form-group">
    <label>Achievement</label>
    <input type="text" name="achievement" value="<?= htmlspecialchars($data['achievement']); ?>">
</div>

<div class="form-group">
    <label>Message</label>
    <textarea name="message"><?= htmlspecialchars($data['message']); ?></textarea>
</div>

<div class="form-group">
    <label>Current Photo</label><br>
    <?php if (!empty($data['photo'])) { ?>
        <img src="../assets/<?= htmlspecialchars($data['photo']); ?>" class="preview-img" alt="Current Photo">
    <?php } else { ?>
        <p>No photo uploaded</p>
    <?php } ?>
</div>

<div class="form-group">
    <label>Change Photo</label>
    <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp">
</div>

<button class="btn primary" type="submit">Update</button>

</form>

</div>
</div>

</body>
</html>
