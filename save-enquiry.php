<?php
include("db.php");

/* =========================
   GET FORM DATA
========================= */

$student       = trim($_POST["student"] ?? "");
$academic_year = trim($_POST["academic_year"] ?? "");
$class         = trim($_POST["class"] ?? "");
$parent        = trim($_POST["parent"] ?? "");
$phone         = trim($_POST["phone"] ?? "");
$email         = trim($_POST["email"] ?? "");
$message       = trim($_POST["message"] ?? "");

/* =========================
   VALIDATION
========================= */

if (
    empty($student) ||
    empty($academic_year) ||
    empty($class) ||
    empty($parent) ||
    empty($phone) ||
    empty($email)
) {
    header("Location: index.php?error=missing");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=email");
    exit;
}

/* =========================
   SAVE IN WEBSITE DATABASE
========================= */

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO admission_enquiries
    (student_name, parent_name, class, academic_year, phone, email, message)
    VALUES (?, ?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
    header("Location: index.php?error=db");
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "sssssss",
    $student,
    $parent,
    $class,
    $academic_year,
    $phone,
    $email,
    $message
);

$db_saved = mysqli_stmt_execute($stmt);

/* =========================
   SEND TO ETHER ERP API
   PRODUCTION
========================= */

$erp_url = "https://api.enrol.etherapp.in/enrol/api/lead/form/submit";

/* PRODUCTION X-CODE */
$x_code = "6c4a1cf520c6d760a2c60ffe3605c7c555fbf497af5ebb472aa3c531d267329";

$postData = [
    "student_name"   => $student,
    "class"          => $class,
    "parent"         => $parent,
    "mobile_number"  => $phone,
    "email"          => $email,
    "message"        => $message,
    "school_code"    => "MVHS",
    "lead_source"    => "website",
    "utm_source"     => "website",
    "academic_year"  => $academic_year
];

$erp_success = false;

if ($db_saved) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $erp_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "x-code: " . $x_code,
        "source: mvhs"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    
    file_put_contents(
    "erp-log.txt",
    date("Y-m-d H:i:s") .
    "\nHTTP CODE: " . $httpCode .
    "\nRESPONSE: " . $response .
    "\nCURL ERROR: " . $curlError .
    "\nPOST DATA: " . print_r($postData, true) .
    "\n-------------------------\n",
    FILE_APPEND
);

    curl_close($ch);

    if ($httpCode == 200) {
        $erp_success = true;
    }
}

mysqli_stmt_close($stmt);

/* =========================
   FINAL REDIRECT RESPONSE
========================= */

if ($db_saved && $erp_success) {
    header("Location: index.php?success=1");
    exit;
}

if ($db_saved && !$erp_success) {
    header("Location: index.php?success=1&erp=failed");
    exit;
}

header("Location: index.php?error=db");
exit;
?>