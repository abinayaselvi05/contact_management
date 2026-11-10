
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact | Contactly</title>
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
        <p class="eyebrow">NEW CONNECTION</p>
        <h1 style="font-size:32px">Add Contact</h1>
        <p class="subtitle" style="margin-bottom:28px">
            Enter the details to save a new contact.
        </p>

        <form action="save_contact.php" method="POST" id="contactForm">
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input id="name" name="name" type="text"
                       placeholder="Enter full name"
                       maxlength="100" required>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input id="phone" name="phone" type="tel"
                           placeholder="Enter phone number"
                           maxlength="20" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input id="email" name="email" type="email"
                           placeholder="name@example.com"
                           maxlength="150" required>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="4"
                          placeholder="Enter home or office address"></textarea>
            </div>

            <div style="display:flex;gap:12px;flex-wrap:wrap">
                <button type="submit" class="btn btn-primary">
                    ✓ Save Contact
                </button>
                <a href="index.php" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>

<footer class="footer">CONTACTLY · YOUR CONNECTIONS, ORGANIZED.</footer>
</body>
</html>