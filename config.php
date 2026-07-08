<?php
/* ============================================================
   M.V. HIGH SCHOOL — SITE CONFIGURATION
   Single source of truth for configurable values.
   Do NOT hardcode these in individual pages.
   ============================================================ */

if (!defined('CURRENT_AY')) {
    define('CURRENT_AY', 'AY 2026-2027');
}
if (!defined('CURRENT_AY_LABEL')) {
    define('CURRENT_AY_LABEL', '2026–2027');
}

// School identity
if (!defined('SCHOOL_NAME')) {
    define('SCHOOL_NAME', 'M.V. High School');
}
if (!defined('SCHOOL_TRUST')) {
    define('SCHOOL_TRUST', 'Marwari Vidyalaya Sanchalit Trust');
}
if (!defined('SCHOOL_LOCATION')) {
    define('SCHOOL_LOCATION', 'Charni Road, Mumbai');
}
if (!defined('SCHOOL_FULL_NAME')) {
    define('SCHOOL_FULL_NAME', 'M.V. High School, Charni Road, Mumbai');
}
if (!defined('BASE_URL')) {
    define('BASE_URL', 'https://mvhighschool.in');
}

// Contact (fallback values — actual data comes from school_contact table)
if (!defined('SCHOOL_PHONE_1')) {
    define('SCHOOL_PHONE_1', '022-47836669');
}
if (!defined('SCHOOL_PHONE_2')) {
    define('SCHOOL_PHONE_2', '022-23865845');
}
if (!defined('SCHOOL_EMAIL')) {
    define('SCHOOL_EMAIL', 'principalmvhs70@gmail.com');
}
if (!defined('SCHOOL_ADDRESS')) {
    define('SCHOOL_ADDRESS', "S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj,\nMumbai, Maharashtra 400004");
}

// Social media
if (!defined('INSTAGRAM_URL')) {
    define('INSTAGRAM_URL', 'https://www.instagram.com/mvhs979?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==');
}
if (!defined('FACEBOOK_URL')) {
    define('FACEBOOK_URL', 'https://www.facebook.com/profile.php?id=100057434679919');
}
if (!defined('YOUTUBE_URL')) {
    define('YOUTUBE_URL', 'https://www.youtube.com/@marwarividyalaya');
}

// Note: No WhatsApp number verified — do not add WhatsApp link
// Note: No Privacy Policy or Terms pages exist — do not add footer links for them
