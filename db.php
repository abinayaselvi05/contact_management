
<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "contact_db"
);

if ($conn->connect_error) {
    die("Database connection failed. Please check MySQL and db.php.");
}

$conn->set_charset("utf8mb4");
?>