<?php
include "db.php";
include "config.php";

/* ---- DB — unchanged ---- */
$data = null;
if (isset($conn) && $conn) {
    $res = mysqli_query($conn, "SELECT * FROM school_bank WHERE id=1");
    if ($res) {
        $data = mysqli_fetch_assoc($res);
    }
}

$seoTitle    = "Support Our School | Donate to M.V. High School";
$seoCanonical = BASE_URL . "/donate.php";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($seoTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Support M.V. High School through a donation. View our bank account details to contribute to the school's growth.">
  <link rel="canonical" href="<?= $seoCanonical ?>">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css?v=7">
  <link rel="stylesheet" href="main.css?v=7">
</head>
<body>

<header></header>
<script src="load-header.js?v=7" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Donate page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Support Us</span>
    </nav>
    <h1>Support Our School</h1>
    <p class="lead">Your generosity helps us provide a better learning environment for every student.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <div style="max-width:640px;margin:0 auto;">
      <div class="section-header" style="margin-bottom:24px;">
        <div class="eyebrow">Bank Transfer</div>
        <h2 style="color:var(--navy);">Bank Account Details</h2>
        <p class="lead" style="font-size:0.95rem;">
          Donations directly support the school's infrastructure, programmes and student development.
        </p>
      </div>

      <div class="donate-card">
        <h3>💳 Transfer Details</h3>
        <?php if($data): ?>
          <p><strong>Bank Name:</strong> <?= htmlspecialchars($data['bank_name']) ?></p>
          <p><strong>Account Holder:</strong> <?= htmlspecialchars($data['account_holder']) ?></p>
          <p><strong>Account Number:</strong> <?= htmlspecialchars($data['account_number']) ?></p>
          <p><strong>IFSC Code:</strong> <?= htmlspecialchars($data['ifsc_code']) ?></p>
        <?php else: ?>
          <p>Bank details are being updated. Please contact the school directly for donation information.</p>
        <?php endif; ?>
      </div>

      <div style="margin-top:22px;text-align:center;">
        <a href="contact.php" class="btn btn-ghost">Contact School for More Info →</a>
      </div>
    </div>

  </div>
</section>

</main>

<script src="footer.js?v=7" defer></script>
</body>
</html>
