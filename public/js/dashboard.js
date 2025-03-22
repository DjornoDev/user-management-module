// public/js/dashboard.js
class DashboardManager {
    constructor() {
        this.currentPage = 1;
        this.pageSize = 5;
        this.searchTerm = "";
        this.sortColumn = "name";
        this.sortDirection = "asc";
        this.activeFilterType = null;
        this.activeFilterValue = null;
        this.abortController = null;

        this.initializeElements();
        this.initializeEventListeners();
        this.fetchUsers();
    }

    initializeElements() {
        this.elements = {
            searchInput: document.getElementById("searchInput"),
            sortDropdown: document.getElementById("sortDropdown"),
            userTableBody: document.getElementById("userTableBody"),
            prevButton: document.getElementById("prevButton"),
            nextButton: document.getElementById("nextButton"),
            shownCount: document.getElementById("shownCount"),
            totalCount: document.getElementById("totalCount"),
            filterButtons: document.querySelectorAll("[data-filter-type]"),
            sortHeaders: document.querySelectorAll(".sortable[data-column]"),
            loadingIndicator: this.createLoadingIndicator(),
        };
    }

    createLoadingIndicator() {
        const indicator = document.createElement("div");
        indicator.className = "loading-indicator";
        indicator.textContent = "Loading...";
        document.body.appendChild(indicator);
        return indicator;
    }

    initializeEventListeners() {
        // Search with debounce
        this.elements.searchInput.addEventListener(
            "input",
            this.debounce(() => this.handleSearch(), 300)
        );

        // Sort dropdown
        this.elements.sortDropdown.addEventListener("change", (e) =>
            this.handleSortChange(e.target.value)
        );

        // Pagination
        this.elements.prevButton.addEventListener("click", () =>
            this.handlePagination(-1)
        );
        this.elements.nextButton.addEventListener("click", () =>
            this.handlePagination(1)
        );

        // Filter buttons
        this.elements.filterButtons.forEach((button) =>
            button.addEventListener("click", (e) =>
                this.handleFilter(e.currentTarget)
            )
        );

        // Header sorting
        this.elements.sortHeaders.forEach((header) =>
            header.addEventListener("click", () =>
                this.handleHeaderSort(header)
            )
        );
    }

    debounce(func, wait) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    async fetchUsers() {
        try {
            // Cancel previous request
            if (this.abortController) this.abortController.abort();
            this.abortController = new AbortController();

            this.showLoading(true);

            const params = new URLSearchParams({
                page: this.currentPage,
                pageSize: this.pageSize,
                search: this.searchTerm,
                sortColumn: this.sortColumn,
                sortDirection: this.sortDirection,
                statusFilter:
                    this.activeFilterType === "status"
                        ? this.activeFilterValue
                        : "",
                roleFilter:
                    this.activeFilterType === "role"
                        ? this.activeFilterValue
                        : "",
            });

            const response = await fetch(`/admin/users/data?${params}`, {
                signal: this.abortController.signal,
            });

            if (!response.ok) throw new Error("Network response was not ok");

            const data = await response.json();
            this.updateTable(data);
            this.updatePagination(data);
            this.updateActiveFilters();
            this.updateSortIndicators();
        } catch (error) {
            if (error.name !== "AbortError") {
                console.error("Fetch error:", error);
                this.showError();
            }
        } finally {
            this.showLoading(false);
        }
    }

    showLoading(isLoading) {
        this.elements.loadingIndicator.style.display = isLoading
            ? "block"
            : "none";
        this.elements.userTableBody.parentElement.classList.toggle(
            "opacity-50",
            isLoading
        );
        document
            .querySelectorAll("button, select, input")
            .forEach((el) => el.toggleAttribute("disabled", isLoading));
    }

    showError() {
        this.elements.userTableBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center p-4 text-red-600">
                    Error loading data. Please try again.
                </td>
            </tr>
        `;
    }

    updateTable(data) {
        if (data.users.length === 0) {
            this.elements.userTableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        No users found matching your criteria
                    </td>
                </tr>
            `;
            return;
        }

        this.elements.userTableBody.innerHTML = data.users
            .map(
                (user) => `
            <tr class="hover:bg-blue-50">
                <td class="py-4 px-4">${this.escapeHTML(user.name)}</td>
                <td class="py-4 px-4">${this.escapeHTML(user.email)}</td>
                <td class="py-4 px-4">${this.escapeHTML(user.role)}</td>
                <td class="py-4 px-4">${this.escapeHTML(user.phone)}</td>
                <td class="py-4 px-4">
                    <span class="status-pill ${user.status.toLowerCase()}">
                        ${this.escapeHTML(user.status)}
                    </span>
                </td>
                <td class="py-4 px-4">${user.action}</td>
            </tr>
        `
            )
            .join("");
    }

    escapeHTML(str) {
        return str
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    updatePagination(data) {
        this.elements.shownCount.textContent = data.users.length;
        this.elements.totalCount.textContent = data.total;

        this.elements.prevButton.disabled = this.currentPage === 1;
        this.elements.nextButton.disabled =
            this.currentPage * this.pageSize >= data.total;
    }

    updateActiveFilters() {
        this.elements.filterButtons.forEach((button) => {
            const isActive =
                button.dataset.filterType === this.activeFilterType &&
                button.dataset.filterValue === this.activeFilterValue;
            button.classList.toggle("bg-blue-600", isActive);
            button.classList.toggle("text-white", isActive);
        });

        const allButton = document.getElementById("filterAll");
        allButton.classList.toggle("bg-blue-600", !this.activeFilterType);
        allButton.classList.toggle("text-white", !this.activeFilterType);
    }

    updateSortIndicators() {
        this.elements.sortHeaders.forEach((header) => {
            const icon = header.querySelector(".sort-icon");
            if (header.dataset.column === this.sortColumn) {
                icon.style.transform =
                    this.sortDirection === "asc"
                        ? "rotate(180deg)"
                        : "rotate(0deg)";
            } else {
                icon.style.transform = "rotate(0deg)";
            }
        });
    }

    handleSearch() {
        this.searchTerm = this.elements.searchInput.value.trim();
        this.currentPage = 1;
        this.fetchUsers();
    }

    handleSortChange(value) {
        [this.sortColumn, this.sortDirection] = value.split("_");
        this.currentPage = 1;
        this.fetchUsers();
    }

    handlePagination(direction) {
        this.currentPage += direction;
        this.fetchUsers();
    }

    handleFilter(button) {
        const filterType = button.dataset.filterType;
        const filterValue = button.dataset.filterValue;

        if (
            this.activeFilterType === filterType &&
            this.activeFilterValue === filterValue
        ) {
            // Clear filter if same button clicked
            this.activeFilterType = null;
            this.activeFilterValue = null;
        } else {
            this.activeFilterType = filterType;
            this.activeFilterValue = filterValue;
        }

        this.currentPage = 1;
        this.fetchUsers();
    }

    handleHeaderSort(header) {
        const column = header.dataset.column;

        if (this.sortColumn === column) {
            this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
        } else {
            this.sortColumn = column;
            this.sortDirection = "asc";
        }

        this.currentPage = 1;
        this.fetchUsers();
    }
}

// Initialize when ready
document.addEventListener("DOMContentLoaded", () => new DashboardManager());
