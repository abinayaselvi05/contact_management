
<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');

if (!$id || $id < 1 || $name === '' || $phone === '' || $email === '') {
    exit('Please provide a valid contact ID and fill in all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Please enter a valid email address.');
}

$stmt = $conn->prepare(
    "UPDATE contacts
     SET name = ?, phone = ?, email = ?, address = ?
     WHERE id = ?"
);
$stmt->bind_param("ssssi", $name, $phone, $email, $address, $id);

if ($stmt->execute()) {
    header('Location: index.php?success=updated');
    exit;
}

http_response_code(500);
echo "Unable to update contact. Please try again.";
?>