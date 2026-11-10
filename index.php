
<?php
require_once 'db.php';

// Get all contacts
$result = $conn->query(
    "SELECT * FROM contacts ORDER BY id DESC"
);

// Contact statistics
$total = $conn->query(
    "SELECT COUNT(*) AS total FROM contacts"
)->fetch_assoc()['total'];

$withEmail = $conn->query(
    "SELECT COUNT(*) AS total FROM contacts WHERE email <> ''"
)->fetch_assoc()['total'];

$withPhone = $conn->query(
    "SELECT COUNT(*) AS total FROM contacts WHERE phone <> ''"
)->fetch_assoc()['total'];

// Success messages
$message = '';

if (isset($_GET['success'])) {
    $messages = [
        'added' => 'Contact added successfully!',
        'updated' => 'Contact updated successfully!',
        'deleted' => 'Contact deleted successfully!'
    ];

    $message = $messages[$_GET['success']] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contactly | Contact Management</title>

    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
</head>

<body>

<!-- Navigation -->
<header class="navbar">

    <a href="index.php" class="logo">
        ◈ Contact<span>ly</span>
    </a>

    <nav class="nav-links">
        <a href="index.php">Dashboard</a>

        <a href="add_contact.php"
           class="btn btn-primary">
            + Add Contact
        </a>
    </nav>

</header>

<main class="container">

    <!-- Welcome section -->
    <section class="hero">

        <p class="eyebrow">
            YOUR PERSONAL DIRECTORY
        </p>

        <h1>Contact Management</h1>

        <p class="subtitle">
            Keep your connections organized, all in one place.
        </p>

    </section>

    <!-- Success message -->
    <?php if ($message !== ''): ?>

        <div class="message">
            ✓ <?= htmlspecialchars($message) ?>
        </div>

    <?php endif; ?>

    <!-- Statistics -->
    <section class="stats">

        <div class="stat-card">
            <p>👥 Total Contacts</p>
            <strong><?= (int)$total ?></strong>
        </div>

        <div class="stat-card">
            <p>✉️ Email Addresses</p>
            <strong><?= (int)$withEmail ?></strong>
        </div>

        <div class="stat-card">
            <p>📞 Phone Numbers</p>
            <strong><?= (int)$withPhone ?></strong>
        </div>

    </section>

    <!-- Contact list -->
    <section>

        <div class="toolbar">

            <div>
                <h2>Your Contacts</h2>

                <p class="muted">
                    Manage your saved connections.
                </p>
            </div>

            <input
                class="search"
                type="search"
                id="searchInput"
                placeholder="⌕ Search name, phone or email..."
                aria-label="Search contacts"
            >

        </div>

        <div class="contact-grid" id="contactGrid">

            <?php if ($result && $result->num_rows > 0): ?>

                <?php while ($contact = $result->fetch_assoc()): ?>

                    <article class="contact-card">

                        <!-- Contact avatar -->
                        <div class="avatar">
                            <?= htmlspecialchars(
                                strtoupper(substr($contact['name'], 0, 1))
                            ) ?>
                        </div>

                        <h3>
                            <?= htmlspecialchars($contact['name']) ?>
                        </h3>

                        <div class="contact-info">

                            <p>
                                📞
                                <?= htmlspecialchars($contact['phone']) ?>
                            </p>

                            <p>
                                ✉️
                                <?= htmlspecialchars($contact['email']) ?>
                            </p>

                            <p>
                                📍
                                <?= nl2br(htmlspecialchars(
                                    $contact['address'] ?? 'No address added'
                                )) ?>
                            </p>

                        </div>

                        <!-- Edit and Delete -->
                        <div class="contact-actions">

                            <a
                                class="btn btn-edit"
                                href="edit_contact.php?id=<?= (int)$contact['id'] ?>"
                            >
                                ✎ Edit
                            </a>

                            <form
                                action="delete_contact.php"
                                method="POST"
                                class="delete-form"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int)$contact['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    ✕ Delete
                                </button>

                            </form>

                        </div>

                    </article>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty">

                    <div class="icon">◎</div>

                    <h3>No contacts yet</h3>

                    <p style="margin: 12px 0 20px">
                        Add your first contact to get started.
                    </p>

                    <a
                        href="add_contact.php"
                        class="btn btn-primary"
                    >
                        + Create Contact
                    </a>

                </div>

            <?php endif; ?>

        </div>

        <p id="noResults" class="empty" hidden>
            No matching contacts found. Try another search.
        </p>

    </section>

</main>

<!-- Footer -->
<footer class="footer">
    CONTACTLY · YOUR CONNECTIONS, ORGANIZED.
</footer>

</body>
</html>

