<?php
include "db.php";
include "config.php";

$seoTitle       = "Admissions Open " . CURRENT_AY_LABEL . " | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Admissions open at M.V. High School for " . CURRENT_AY_LABEL . ". English Medium (Nursery–Grade 10) and Hindi Medium Secondary (Grade 8–10). View eligibility, process, documents and submit your enquiry.";
$seoKeywords    = "M.V. High School admissions, school admissions Mumbai, admissions open Charni Road, English medium school admission, Hindi medium school admission";
$seoCanonical   = BASE_URL . "/admissions.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$eligibility = "";
$process     = "";
$documents   = "";

$q = mysqli_query($conn, "SELECT * FROM admissions_content");
while($row = mysqli_fetch_assoc($q)) {
    if($row["section_name"] == "eligibility") $eligibility = $row["content"];
    if($row["section_name"] == "process")     $process     = $row["content"];
    if($row["section_name"] == "documents")   $documents   = $row["content"];
}

/* Check referral source for success/error banner */
$fromAdmissions = true;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php include "seo.php"; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="styles.css">

  <style>
  /* ============ ADMISSIONS PAGE SPECIFIC ============ */

  /* Process steps */
  .process-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 0;
    margin-top: 24px;
    position: relative;
  }

  .process-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 24px 14px;
    position: relative;
    background: var(--surface);
    border: 1px solid var(--border);
    border-right: none;
    transition: var(--transition);
  }

  .process-step:last-child { border-right: 1px solid var(--border); }

  .process-step:hover {
    background: var(--blue-bg);
    z-index: 1;
    box-shadow: var(--shadow);
  }

  .process-step:first-child { border-radius: var(--radius) 0 0 var(--radius); }
  .process-step:last-child  { border-radius: 0 var(--radius) var(--radius) 0; }

  .step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    color: var(--ink);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 16px;
    margin-bottom: 10px;
    box-shadow: var(--shadow-gold);
  }

  .step-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .step-desc {
    font-size: 11px;
    color: var(--text-secondary);
    line-height: 1.4;
  }

  /* Info cards */
  .info-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 22px;
    margin-top: 24px;
  }

  .info-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 26px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    border-top: 3px solid var(--gold);
  }

  .info-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }

  .info-card h2 {
    font-size: 1.1rem;
    color: var(--navy);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .info-card h2::after { display: none; }

  .info-card p {
    font-size: 14px;
    line-height: 1.8;
    color: var(--text-secondary);
    white-space: pre-line;
  }

  /* Enquiry form section */
  .enquiry-section {
    background: var(--blue-bg);
  }

  .enquiry-form-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 36px;
    box-shadow: var(--shadow-lg);
    max-width: 860px;
    margin: 0 auto;
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  .form-full { grid-column: 1 / -1; }

  .status-banner {
    background: linear-gradient(135deg, var(--gold-soft), var(--blue-bg));
    border: 1px solid var(--gold-soft-md);
    border-radius: var(--radius-sm);
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
  }

  .status-banner .status-icon { font-size: 1.5rem; }

  .status-banner h3 {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 2px;
  }

  .status-banner p { font-size: 13px; color: var(--text-secondary); }

  @media (max-width: 768px) {
    .process-steps { grid-template-columns: 1fr 1fr; }
    .process-step { border-right: 1px solid var(--border); border-bottom: none; }
    .process-step:nth-child(odd) { border-radius: 0; }
    .process-step:first-child { border-radius: var(--radius) 0 0 0; }
    .process-step:last-child { border-radius: 0 0 var(--radius) var(--radius); }
    .form-grid { grid-template-columns: 1fr; }
    .enquiry-form-wrap { padding: 22px 18px; }
  }

  @media (max-width: 480px) {
    .process-steps { grid-template-columns: 1fr; }
    .process-step { border-right: 1px solid var(--border); }
    .process-step:first-child { border-radius: var(--radius) var(--radius) 0 0; }
    .process-step:last-child  { border-radius: 0 0 var(--radius) var(--radius); }
  }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Admissions hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Admissions</span>
    </nav>
    <h1>Admissions Open</h1>
    <p class="lead">
      Join the M.V. High School family. Admissions are open for Academic Year <?= CURRENT_AY_LABEL ?>.
      English Medium (Nursery–Grade 10) and Hindi Medium (Grade 8–10).
    </p>
  </div>
</section>

<main id="main-content">

<!-- Hidden SEO content -->
<div class="seo-hidden-content" aria-hidden="true">
  Admissions at M.V. High School, Charni Road, Mumbai are open for English Medium (Nursery–10th) and Hindi Medium Secondary (8th–10th).
  <a href="about.php">About Us</a> | <a href="academics.php">Academics</a> | <a href="contact.php">Contact Us</a>
</div>

<!-- ADMISSION STATUS BANNER -->
<section class="section-sm" style="background:var(--surface);">
  <div class="container">
    <div class="status-banner">
      <div class="status-icon">✅</div>
      <div>
        <h3>Admissions Are Open — <?= CURRENT_AY_LABEL ?></h3>
        <p>We welcome students into a nurturing, academically excellent environment. Apply now to secure your child's place.</p>
      </div>
    </div>

    <!-- PROCESS STEPS -->
    <div class="section-header" style="margin-bottom:16px;">
      <div class="eyebrow">How to Apply</div>
      <h2 style="color:var(--navy);margin-bottom:0;" id="process-heading">Admission Process</h2>
    </div>

    <div class="process-steps" role="list" aria-label="Admission process steps">
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">1</div>
        <div class="step-label">Submit Enquiry</div>
        <div class="step-desc">Fill and submit the online enquiry form below</div>
      </div>
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">2</div>
        <div class="step-label">School Contact</div>
        <div class="step-desc">Our team will call to guide you further</div>
      </div>
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">3</div>
        <div class="step-label">Form Submission</div>
        <div class="step-desc">Submit the admission form with documents</div>
      </div>
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">4</div>
        <div class="step-label">Interaction</div>
        <div class="step-desc">Student interaction / meeting with faculty</div>
      </div>
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">5</div>
        <div class="step-label">Confirmation</div>
        <div class="step-desc">Receive admission confirmation from school</div>
      </div>
      <div class="process-step" role="listitem">
        <div class="step-number" aria-hidden="true">6</div>
        <div class="step-label">Fee Payment</div>
        <div class="step-desc">Complete fee submission to confirm seat</div>
      </div>
    </div>
  </div>
</section>

<!-- INFO CARDS (DB driven) -->
<section class="section" style="background:var(--ivory);" aria-labelledby="info-heading">
  <div class="container">
    <div class="eyebrow">Admission Details</div>
    <h2 id="info-heading" style="color:var(--navy);margin-bottom:8px;">What You Need to Know</h2>
    <div class="info-cards-grid">
      <article class="info-card" id="eligibility">
        <h2>📋 Eligibility Criteria</h2>
        <p><?= nl2br(htmlspecialchars($eligibility ?: 'Eligibility criteria information coming soon.')) ?></p>
      </article>

      <article class="info-card" id="process">
        <h2>📝 Admission Process</h2>
        <p><?= nl2br(htmlspecialchars($process ?: 'Detailed admission process information coming soon.')) ?></p>
      </article>

      <article class="info-card" id="documents">
        <h2>📁 Documents Required</h2>
        <p><?= nl2br(htmlspecialchars($documents ?: 'Document requirements coming soon.')) ?></p>
      </article>
    </div>
  </div>
</section>

<!-- ENQUIRY FORM — field names, action and method UNCHANGED -->
<section class="section enquiry-section" aria-labelledby="form-heading">
  <div class="container">
    <div class="enquiry-form-wrap">
      <div class="section-header" style="margin-bottom:24px;">
        <div class="eyebrow">Apply Now</div>
        <h2 id="form-heading" style="color:var(--navy);margin-bottom:8px;">Admission Enquiry</h2>
        <p class="lead" style="font-size:0.9rem;margin-bottom:0;">
          Fill in the details below and our admissions team will contact you within 24 hours.
          Fields marked <span style="color:var(--error);font-weight:700;">*</span> are required.
        </p>
      </div>

      <form
        method="POST"
        action="save-enquiry.php"
        id="admissionsForm"
        novalidate
        aria-label="Admission enquiry form"
      >
        <div class="form-grid">

          <div class="form-group">
            <label for="adm_student">Student&rsquo;s Full Name <span class="required">*</span></label>
            <input
              type="text"
              name="student"
              id="adm_student"
              placeholder="Student's full name"
              required
              autocomplete="name"
              aria-required="true"
            >
          </div>

          <div class="form-group">
            <label for="adm_parent">Parent / Guardian Name <span class="required">*</span></label>
            <input
              type="text"
              name="parent"
              id="adm_parent"
              placeholder="Parent or guardian name"
              required
              autocomplete="name"
              aria-required="true"
            >
          </div>

          <div class="form-group">
            <label for="adm_year">Expected Admission Year <span class="required">*</span></label>
            <select name="academic_year" id="adm_year" required aria-required="true">
              <option value="">Select Academic Year</option>
              <option value="<?= CURRENT_AY ?>"><?= CURRENT_AY ?></option>
            </select>
          </div>

          <div class="form-group">
            <label for="adm_class">Grade Seeking Admission <span class="required">*</span></label>
            <select name="class" id="adm_class" required aria-required="true">
              <option value="">Select Grade</option>
              <option value="Nursery">Nursery</option>
              <option value="Jr. KG">Jr. KG</option>
              <option value="Sr. KG">Sr. KG</option>
              <option value="Grade 1">Grade 1</option>
              <option value="Grade 2">Grade 2</option>
              <option value="Grade 3">Grade 3</option>
              <option value="Grade 4">Grade 4</option>
              <option value="Grade 5">Grade 5</option>
              <option value="Grade 6">Grade 6</option>
              <option value="Grade 7">Grade 7</option>
              <option value="Grade 8">Grade 8 (Hindi Medium available)</option>
              <option value="Grade 9">Grade 9 (Hindi Medium available)</option>
              <option value="Grade 10">Grade 10 (Hindi Medium available)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="adm_phone">Contact Number <span class="required">*</span></label>
            <input
              type="tel"
              name="phone"
              id="adm_phone"
              placeholder="+91 XXXXX XXXXX"
              required
              autocomplete="tel"
              inputmode="tel"
              aria-required="true"
              pattern="[0-9+\-\s]{7,15}"
            >
          </div>

          <div class="form-group">
            <label for="adm_email">Email Address <span class="required">*</span></label>
            <input
              type="email"
              name="email"
              id="adm_email"
              placeholder="parent@example.com"
              required
              autocomplete="email"
              aria-required="true"
            >
          </div>

          <div class="form-group form-full">
            <label for="adm_message">Message / Query (Optional)</label>
            <textarea
              name="message"
              id="adm_message"
              rows="4"
              placeholder="Any specific question or query you have about admissions"
              aria-label="Optional message or query"
            ></textarea>
          </div>

          <div class="form-full" style="display:flex;gap:14px;align-items:center;flex-wrap:wrap;">
            <button
              type="submit"
              class="btn btn-primary btn-lg"
              id="admissionsSubmitBtn"
            >
              Submit Enquiry
            </button>
            <p style="font-size:12px;color:var(--muted);margin:0;">
              Your details are kept confidential and used only for admissions enquiry.
            </p>
          </div>

        </div>
      </form>
    </div>
  </div>
</section>

<!-- CONTACT ADMISSIONS OFFICE -->
<section class="section-sm" style="background:var(--surface);">
  <div class="container">
    <div style="text-align:center;max-width:600px;margin:0 auto;">
      <h2 style="color:var(--navy);font-size:1.35rem;margin-bottom:10px;">Need Help with Admissions?</h2>
      <p style="color:var(--text-secondary);margin-bottom:20px;">
        Our admissions team is available Monday to Saturday, 7:30 AM – 2:00 PM.
        Call us or visit the school directly.
      </p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
        <a href="tel:+912247836669" class="btn btn-primary">📞 Call School</a>
        <a href="contact.php" class="btn btn-ghost">View Full Contact →</a>
      </div>
    </div>
  </div>
</section>

</main>

<script src="footer.js" defer></script>
<script>
(function() {
  /* ---- Duplicate submit prevention ---- */
  const form = document.getElementById('admissionsForm');
  const btn  = document.getElementById('admissionsSubmitBtn');
  if (form && btn) {
    form.addEventListener('submit', function(e) {
      // Basic front-end validation
      const required = form.querySelectorAll('[required]');
      let valid = true;
      required.forEach(field => {
        field.classList.remove('error');
        if (!field.value.trim()) {
          field.classList.add('error');
          valid = false;
        }
      });

      if (!valid) {
        e.preventDefault();
        const firstError = form.querySelector('.error');
        if (firstError) firstError.focus();
        return;
      }

      // Prevent double submit
      btn.disabled = true;
      btn.textContent = 'Submitting...';
      btn.classList.add('loading');
    });

    /* Remove error class on input */
    form.querySelectorAll('input, select, textarea').forEach(field => {
      field.addEventListener('input', function() {
        this.classList.remove('error');
      });
    });
  }
})();
</script>
</body>
</html>