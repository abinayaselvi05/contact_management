
document.addEventListener("DOMContentLoaded", function () {

    // Live search contacts without refreshing the page
    const searchInput = document.getElementById("searchInput");
    const contactGrid = document.getElementById("contactGrid");
    const noResults = document.getElementById("noResults");

    if (searchInput && contactGrid) {
        searchInput.addEventListener("input", function () {
            const query = this.value.toLowerCase().trim();
            const cards = contactGrid.querySelectorAll(".contact-card");
            let visibleCount = 0;

            cards.forEach(function (card) {
                const matches = card.textContent
                    .toLowerCase()
                    .includes(query);

                card.hidden = !matches;

                if (matches) visibleCount++;
            });

            if (noResults) {
                noResults.hidden = visibleCount !== 0;
            }
        });
    }

    // Confirm before deleting a contact
    document.querySelectorAll(".delete-form").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const confirmed = window.confirm(
                "Are you sure you want to permanently delete this contact?"
            );

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });

    // Basic front-end form validation
    const contactForm = document.getElementById("contactForm");

    if (contactForm) {
        contactForm.addEventListener("submit", function (event) {
            const name = document.getElementById("name");
            const phone = document.getElementById("phone");
            const email = document.getElementById("email");

            if (!name.value.trim() ||
                !phone.value.trim() ||
                !email.value.trim()) {
                event.preventDefault();
                alert("Please fill in all required fields.");
                return;
            }

            if (!email.validity.valid) {
                event.preventDefault();
                alert("Please enter a valid email address.");
                email.focus();
            }
        });
    }

});