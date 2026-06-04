<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

// Load mission, vision, values
$mission = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='mission'"));
$vision  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='vision'"));
$values  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='values'"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $missionText = mysqli_real_escape_string($conn, $_POST['mission']);
    $visionText  = mysqli_real_escape_string($conn, $_POST['vision']);
    $valuesText  = mysqli_real_escape_string($conn, $_POST['values']);

    mysqli_query($conn, "UPDATE about_mvv SET content='$missionText' WHERE type='mission'");
    mysqli_query($conn, "UPDATE about_mvv SET content='$visionText'  WHERE type='vision'");
    mysqli_query($conn, "UPDATE about_mvv SET content='$valuesText'  WHERE type='values'");

    header("Location: manage-mvv.php?updated=1");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Mission / Vision / Values</title>
  <link rel="stylesheet" href="../styles.css">

  <style>
    .container {
      max-width: 900px;
      margin: 40px auto;
      background:white;
      padding:20px;
      border-radius:8px;
      box-shadow:0 2px 8px rgba(0,0,0,0.1);
    }
    textarea {
      width:100%;
      height:120px;
      padding:10px;
      border-radius:6px;
      border:1px solid #ccc;
      margin-bottom:20px;
      resize:vertical;
    }
    label {
      font-weight:600;
      margin-bottom:6px;
      display:block;
    }
    .btn-primary {
      background:#007bff;
      color:white;
      padding:10px 16px;
      border:none;
      border-radius:4px;
      cursor:pointer;
      margin-top:10px;
    }
    .alert {
      background:#d4edda;
      color:#155724;
      padding:10px;
      border-radius:5px;
      margin-bottom:20px;
    }
  </style>
</head>

<body>

<a href="dashboard.php" style="margin:16px;">← Back to Dashboard</a>

<div class="container">

  <h2>Mission / Vision / Values</h2>

  <?php if(isset($_GET['updated'])){ ?>
      <div class="alert">Updated successfully!</div>
  <?php } ?>

  <form method="POST">

    <label>Mission</label>
    <textarea name="mission"><?php echo htmlspecialchars($mission['content']); ?></textarea>

    <label>Vision</label>
    <textarea name="vision"><?php echo htmlspecialchars($vision['content']); ?></textarea>

    <label>Values</label>
    <textarea name="values"><?php echo htmlspecialchars($values['content']); ?></textarea>

    <button class="btn-primary">Save Changes</button>
  </form>

</div>

</body>
</html>
