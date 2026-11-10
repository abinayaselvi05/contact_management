
<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: index.php?success=deleted');
    exit;
}

http_response_code(500);
echo "Unable to delete contact. Please try again.";
?>