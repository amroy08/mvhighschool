<?php include "db.php"; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Faculty | M.V. High School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="premium-header.css">

  <style>
    /* ==============================
       FACULTY - PREMIUM TABS UI
       ============================== */

    .tabs-wrap{
      margin-top: 18px;
      background: rgba(255,255,255,.75);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 10px;
      box-shadow: var(--shadow);
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      position: sticky;
      top: 78px; /* works nicely under your header */
      z-index: 5;
      backdrop-filter: blur(10px);
    }

    .tab-btn{
      appearance: none;
      border: 1px solid var(--border);
      background: #fff;
      color: var(--primary);
      font-weight: 800;
      padding: 10px 14px;
      border-radius: 14px;
      cursor: pointer;
      transition: .25s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      user-select: none;
    }

    .tab-btn:hover{
      transform: translateY(-1px);
      border-color: var(--gold);
    }

    .tab-btn.active{
      background: linear-gradient(135deg, rgba(255,215,0,.20), rgba(0,0,0,0.02));
      border-color: var(--gold);
      box-shadow: 0 10px 22px rgba(0,0,0,.08);
    }

    .tab-pill{
      font-size: 12px;
      font-weight: 900;
      padding: 3px 10px;
      border-radius: 999px;
      border: 1px solid var(--border);
      color: var(--muted);
      background: rgba(255,255,255,.8);
    }

    .panel{
      display: none;
      margin-top: 18px;
      animation: fadeUp .25s ease both;
    }

    .panel.active{ display:block; }

    @keyframes fadeUp{
      from{ opacity:0; transform: translateY(8px); }
      to{ opacity:1; transform: translateY(0); }
    }

    /* Grid */
    .faculty-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 24px;
      margin-top: 12px;
    }

    /* Card */
    .faculty-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 20px;
      box-shadow: var(--shadow);
      transition: .3s ease;
    }

    .faculty-card:hover {
      transform: translateY(-6px);
      border-color: var(--gold);
    }

    .faculty-photo {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: var(--radius);
      margin-bottom: 12px;
    }

    .faculty-card h3 {
      font-size: 18px;
      font-weight: 900;
      margin-bottom: 6px;
      color: var(--primary);
      text-transform: uppercase;
      letter-spacing: .2px;
    }

    .faculty-card p { margin: 4px 0; }
    .muted { color: var(--muted); font-size: 14px; }

    .empty-note {
      padding: 14px;
      background: #fff;
      border: 1px dashed var(--border);
      border-radius: 12px;
      color: var(--muted);
      margin-top: 14px;
    }

    /* Small screens */
    @media(max-width: 640px){
      .tabs-wrap{ top: 70px; }
      .tab-btn{ width: 100%; justify-content: space-between; }
    }
  </style>
</head>

<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">

    <h2>Our Faculty</h2>
    <p class="lead">Dedicated educators shaping minds and inspiring excellence.</p>

    <?php
      function countStaff($conn, $type){
        $safeType = mysqli_real_escape_string($conn, $type);
        $q = mysqli_query($conn, "SELECT COUNT(*) AS c FROM faculty WHERE staff_type='$safeType'");
        $r = mysqli_fetch_assoc($q);
        return (int)$r['c'];
      }

      $teachingCount = countStaff($conn, "Teaching");
      $nonTeachingCount = countStaff($conn, "Non-Teaching");
    ?>

    <!-- Tabs -->
    <div class="tabs-wrap" role="tablist" aria-label="Faculty tabs">
      <button class="tab-btn active" id="tab-teaching" data-target="panel-teaching" type="button" role="tab" aria-selected="true">
        Teaching Staff
        <span class="tab-pill"><?= $teachingCount ?></span>
      </button>

      <button class="tab-btn" id="tab-nonteaching" data-target="panel-nonteaching" type="button" role="tab" aria-selected="false">
        Non-Teaching Staff
        <span class="tab-pill"><?= $nonTeachingCount ?></span>
      </button>
    </div>

    <!-- Teaching Panel -->
    <div class="panel active" id="panel-teaching" role="tabpanel" aria-labelledby="tab-teaching">

      <div class="faculty-grid">
        <?php
          $res = mysqli_query($conn, "SELECT * FROM faculty WHERE staff_type='Teaching' ORDER BY id ASC");
          if(mysqli_num_rows($res) == 0){
            echo "<div class='empty-note'>No Teaching Staff added yet.</div>";
          } else {
            while($f = mysqli_fetch_assoc($res)){
              $img = $f['image']; // e.g. uploads/faculty/xxx.jpg
              echo "
              <article class='faculty-card'>
                ".(!empty($img) ? "<img src='{$img}' class='faculty-photo' onerror=\"this.style.display='none'\">" : "")."
                <h3>{$f['name']}</h3>
                <p><strong>{$f['designation']}</strong></p>
                <p class='muted'>{$f['qualification']}</p>
                <p class='muted'>{$f['experience']}</p>
              </article>
              ";
            }
          }
        ?>
      </div>
    </div>

    <!-- Non-Teaching Panel -->
    <div class="panel" id="panel-nonteaching" role="tabpanel" aria-labelledby="tab-nonteaching">

      <div class="faculty-grid">
        <?php
          $res2 = mysqli_query($conn, "SELECT * FROM faculty WHERE staff_type='Non-Teaching' ORDER BY id ASC");
          if(mysqli_num_rows($res2) == 0){
            echo "<div class='empty-note'>No Non-Teaching Staff added yet.</div>";
          } else {
            while($f = mysqli_fetch_assoc($res2)){
              $img = $f['image'];
              echo "
              <article class='faculty-card'>
                ".(!empty($img) ? "<img src='{$img}' class='faculty-photo' onerror=\"this.style.display='none'\">" : "")."
                <h3>{$f['name']}</h3>
                <p><strong>{$f['designation']}</strong></p>
                <p class='muted'>{$f['qualification']}</p>
                <p class='muted'>{$f['experience']}</p>
              </article>
              ";
            }
          }
        ?>
      </div>
    </div>

  </div>
</section>

<script src="footer.js"></script>

<script>
  // ==========================
  // Tabs logic + URL hash support
  // ==========================
  const tabs = document.querySelectorAll(".tab-btn");
  const panels = document.querySelectorAll(".panel");

  function activate(tabId, updateHash=true){
    tabs.forEach(t => {
      const active = (t.id === tabId);
      t.classList.toggle("active", active);
      t.setAttribute("aria-selected", active ? "true" : "false");
    });

    panels.forEach(p => p.classList.remove("active"));

    const tab = document.getElementById(tabId);
    const target = tab.getAttribute("data-target");
    document.getElementById(target).classList.add("active");

    if(updateHash){
      const hash = tabId === "tab-nonteaching" ? "#nonteaching" : "#teaching";
      history.replaceState(null, "", hash);
    }

    // Smooth scroll to tabs on mobile
    document.querySelector(".tabs-wrap").scrollIntoView({behavior:"smooth", block:"start"});
  }

  tabs.forEach(t => t.addEventListener("click", () => activate(t.id)));

  // If someone opens directly with hash
  const hash = window.location.hash.toLowerCase();
  if(hash === "#nonteaching"){
    activate("tab-nonteaching", false);
  } else if(hash === "#teaching"){
    activate("tab-teaching", false);
  }
</script>

</body>
</html>
