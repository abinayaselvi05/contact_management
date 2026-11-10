
<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_contact.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');

if ($name === '' || $phone === '' || $email === '') {
    exit('Please fill in all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Please enter a valid email address.');
}

$stmt = $conn->prepare(
    "INSERT INTO contacts (name, phone, email, address)
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $name, $phone, $email, $address);

if ($stmt->execute()) {
    header('Location: index.php?success=added');
    exit;
}

http_response_code(500);
echo "Unable to save contact. Please try again.";
?>