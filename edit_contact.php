
<?php
require_once 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$contact = $stmt->get_result()->fetch_assoc();

if (!$contact) {
    http_response_code(404);
    exit('Contact not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact | Contactly</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">◈ Contact<span>ly</span></a>
    <nav class="nav-links">
        <a href="index.php">Dashboard</a>
        <a href="add_contact.php" class="btn btn-primary">+ Add Contact</a>
    </nav>
</header>

<main class="container">
    <div class="card form-card">
        <p class="eyebrow">UPDATE CONNECTION</p>
        <h1 style="font-size:32px">Edit Contact</h1>
        <p class="subtitle" style="margin-bottom:28px">
            Update the contact information below.
        </p>

        <form action="update_contact.php" method="POST" id="contactForm">
            <input type="hidden" name="id"
                   value="<?= (int)$contact['id'] ?>">

            <div class="form-group">
                <label for="name">Full Name *</label>
                <input id="name" name="name" type="text" required
                       maxlength="100"
                       value="<?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input id="phone" name="phone" type="tel" required
                           maxlength="20"
                           value="<?= htmlspecialchars($contact['phone'], ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input id="email" name="email" type="email" required
                           maxlength="150"
                           value="<?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="4"><?= htmlspecialchars($contact['address'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div style="display:flex;gap:12px;flex-wrap:wrap">
                <button type="submit" class="btn btn-primary">
                    ✓ Update Contact
                </button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</main>

<footer class="footer">CONTACTLY · YOUR CONNECTIONS, ORGANIZED.</footer>
</body>
</html>