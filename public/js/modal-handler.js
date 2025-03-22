// Password Modal Handling
let currentAction = "";
let currentUserId = null;

function showPasswordModal(action, userId) {
    currentAction = action;
    currentUserId = userId;
    document.getElementById("passwordModal").classList.remove("hidden");
    document.getElementById("passwordError").classList.add("hidden");
    document.getElementById("passwordInput").value = "";
    document.getElementById("passwordInput").focus();
}

function closePasswordModal() {
    document.getElementById("passwordModal").classList.add("hidden");
}

// Delete Modal Handling
let deleteUserId = null;

function showDeleteModal(button) {
    // Extract user data from button attributes
    const userId = button.getAttribute("data-user-id");
    const name = button.getAttribute("data-name");
    const email = button.getAttribute("data-email");
    const role = button.getAttribute("data-role");
    const status = button.getAttribute("data-status");

    // Populate modal fields
    document.querySelector('[data-field="name"]').textContent = name;
    document.querySelector('[data-field="email"]').textContent = email;
    document.querySelector('[data-field="role"]').textContent = role;
    document.querySelector('[data-field="status"]').textContent = status;

    // Store user ID for deletion
    deleteUserId = userId;

    // Show the modal
    document.getElementById("deleteModal").classList.remove("hidden");
}

function closeDeleteModal() {
    document.getElementById("deleteModal").classList.add("hidden");
}

// Document ready function to ensure DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Handle Password Verification
    const passwordForm = document.getElementById("passwordForm");
    if (passwordForm) {
        passwordForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const password = document.getElementById("passwordInput").value;
            const errorDiv = document.getElementById("passwordError");
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            try {
                const response = await fetch("/admin/verify-password", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        password,
                    }),
                });

                const data = await response.json();

                if (data.valid) {
                    if (currentAction === "view") {
                        window.location.href = `/admin/users/${currentUserId}`;
                    } else if (currentAction === "edit") {
                        window.location.href = `/admin/users/${currentUserId}/edit`;
                    }
                } else {
                    errorDiv.textContent =
                        "Invalid password. Please try again.";
                    errorDiv.classList.remove("hidden");
                    document
                        .getElementById("passwordInput")
                        .classList.add("border-red-500");
                    setTimeout(() => {
                        document
                            .getElementById("passwordInput")
                            .classList.remove("border-red-500");
                    }, 3000);
                }
            } catch (error) {
                errorDiv.textContent = "An error occurred. Please try again.";
                errorDiv.classList.remove("hidden");
            }
        });
    }

    // Handle Delete Confirmation
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", () => {
            if (deleteUserId) {
                document.getElementById(`deleteForm-${deleteUserId}`).submit();
            }
            closeDeleteModal();
        });
    }

    // Close modals when clicking outside
    window.addEventListener("click", (e) => {
        const passwordModal = document.getElementById("passwordModal");
        const deleteModal = document.getElementById("deleteModal");

        if (e.target === passwordModal) {
            closePasswordModal();
        }

        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });
});

// Make functions globally accessible
window.showPasswordModal = showPasswordModal;
window.closePasswordModal = closePasswordModal;
window.showDeleteModal = showDeleteModal;
window.closeDeleteModal = closeDeleteModal;
