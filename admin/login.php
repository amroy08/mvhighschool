<?php
session_start();

// If already logged in, go straight to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");

    exit();
}

// Handle form submit
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 🔐 Simple hard-coded credentials for now
    // You can change these later
    $validUsername = "admin";
    $validPassword = "mvschool123";

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = "Administrator";
        header("Location: dashboard.php");

        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin Login | M.V. High School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #0f172a;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0f172a;
    }
    .card {
      background: #ffffff;
      width: 100%;
      max-width: 420px;
      border-radius: 16px;
      box-shadow: 0 20px 40px rgba(15,23,42,0.25);
      padding: 28px 28px 30px;
    }
    .logo-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
      gap: 10px;
    }
    .logo-circle {
      width: 40px;
      height: 40px;
      border-radius: 999px;
      background: #dbeafe;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: #1d4ed8;
    }
    h1 {
      font-size: 20px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 4px;
      color: #0f172a;
    }
    .subtitle {
      font-size: 13px;
      text-align: center;
      color: #64748b;
      margin-bottom: 18px;
    }
    label {
      display: block;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 6px;
      color: #0f172a;
    }
    .field {
      margin-bottom: 14px;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid #cbd5f5;
      font-size: 14px;
      outline: none;
      transition: border 0.15s, box-shadow 0.15s;
    }
    input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 2px rgba(37,99,235,0.25);
    }
    .btn {
      width: 100%;
      border: none;
      border-radius: 999px;
      padding: 10px 14px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 4px;
      background: #2563eb;
      color: #ffffff;
      box-shadow: 0 10px 25px rgba(37,99,235,0.35);
      transition: transform 0.1s ease, box-shadow 0.1s ease, background 0.1s ease;
    }
    .btn:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
      box-shadow: 0 12px 28px rgba(37,99,235,0.4);
    }
    .btn:active {
      transform: translateY(0);
      box-shadow: 0 6px 16px rgba(37,99,235,0.3);
    }
    .error {
      margin-top: 8px;
      font-size: 13px;
      color: #b91c1c;
      background: #fee2e2;
      padding: 8px 10px;
      border-radius: 10px;
    }
    .hint {
      margin-top: 14px;
      font-size: 12px;
      color: #94a3b8;
      text-align: center;
    }
    .hint code {
      background: #e2e8f0;
      padding: 2px 6px;
      border-radius: 6px;
      font-size: 11px;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="logo-wrap">
      <div class="logo-circle">MV</div>
      <div style="font-size:14px; font-weight:600; color:#1f2937;">M.V. High School</div>
    </div>
    <h1>Admin Login</h1>
    <p class="subtitle">Sign in to manage Monthly Activities &amp; Events.</p>

    <form method="post" autocomplete="off">
      <div class="field">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required />
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required />
      </div>
      <button type="submit" class="btn">Login</button>

      <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
    </form>

    <p class="hint">
      
    </p>
  </div>
</body>
</html>
