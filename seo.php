<?php
$siteName = "M.V. High School";
$baseUrl = "https://mvhighschool.in";

if (!isset($seoTitle)) {
    $seoTitle = "M.V. High School | Charni Road, Mumbai";
}

if (!isset($seoDescription)) {
    $seoDescription = "M.V. High School, Charni Road, Mumbai offers English Medium education from Nursery to 10th and Hindi Medium for Secondary 8th to 10th with strong academics, activities, and student development.";
}

if (!isset($seoKeywords)) {
    $seoKeywords = "M.V. High School, school in Charni Road, school in Mumbai, English medium school, Hindi medium school, admissions open Mumbai";
}

if (!isset($seoCanonical)) {
    $seoCanonical = $baseUrl . "/";
}

if (!isset($seoImage)) {
    $seoImage = $baseUrl . "/assets/PamphletImage.jpg";
}

if (!isset($seoType)) {
    $seoType = "website";
}

if (!isset($seoSchema)) {
    $seoSchema = [
        "@context" => "https://schema.org",
        "@type" => "School",
        "name" => "M.V. High School",
        "url" => "https://mvhighschool.in/",
        "logo" => "https://mvhighschool.in/favicon.png",
        "image" => "https://mvhighschool.in/assets/PamphletImage.jpg",
        "description" => "M.V. High School in Charni Road, Mumbai offers English Medium education from Nursery to 10th and Hindi Medium for Secondary 8th to 10th with interactive learning, sports, smart classrooms, and holistic development.",
        "telephone" => "+91-22-47836669, +91-22-23865845",
        "email" => "principalmvhs70@gmail.com",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj",
            "addressLocality" => "Mumbai",
            "addressRegion" => "Maharashtra",
            "postalCode" => "400004",
            "addressCountry" => "IN"
        ],
        "sameAs" => [
            "https://www.facebook.com/",
            "https://www.instagram.com/mvhs979/"
        ]
    ];
}
?>

<title><?= htmlspecialchars($seoTitle, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta name="keywords" content="<?= htmlspecialchars($seoKeywords, ENT_QUOTES, 'UTF-8') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="<?= htmlspecialchars($seoCanonical, ENT_QUOTES, 'UTF-8') ?>">

<meta property="og:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="<?= htmlspecialchars($seoImage, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($seoCanonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="<?= htmlspecialchars($seoType, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:site_name" content="M.V. High School">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($seoImage, ENT_QUOTES, 'UTF-8') ?>">

<meta name="robots" content="index, follow, max-image-preview:large">

<script type="application/ld+json">
<?= json_encode($seoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>