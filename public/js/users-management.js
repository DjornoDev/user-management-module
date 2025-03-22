document.addEventListener("DOMContentLoaded", function () {
    // State variables
    let currentPage = 1;
    let totalPages = 1;
    const pageSize = 5;
    let searchTerm = "";
    let sortColumn = "name";
    let sortDirection = "asc";
    let activeFilterType = null;
    let activeFilterValue = null;

    // DOM Elements
    const searchInput = document.getElementById("searchInput");
    const sortDropdown = document.getElementById("sortDropdown");
    const userTableBody = document.getElementById("userTableBody");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");
    const shownCount = document.getElementById("shownCount");
    const totalCount = document.getElementById("totalCount");
    let isHeaderSort = false;
    const sortableHeaders = document.querySelectorAll(".sortable[data-column]");
    const pageButtons = document.querySelectorAll(".pagination-button");

    // Fetch users function
    async function fetchUsers() {
        const params = new URLSearchParams({
            page: currentPage,
            pageSize: pageSize,
            search: searchTerm,
            sortColumn: sortColumn,
            sortDirection: sortDirection,
            statusFilter:
                activeFilterType === "status" ? activeFilterValue : "",
            roleFilter: activeFilterType === "role" ? activeFilterValue : "",
        });

        try {
            const response = await fetch(`/admin/users/data?${params}`);
            const data = await response.json();
            updateTable(data);
            updatePagination(data);
            updateActiveFilters(); // Add this function
        } catch (error) {
            console.error("Error fetching users:", error);
        }
    }

    // Update active filters
    function updateActiveFilters() {
        // Update filter button states
        document.querySelectorAll("[data-filter-type]").forEach((button) => {
            const isActive =
                button.dataset.filterType === activeFilterType &&
                button.dataset.filterValue === activeFilterValue;
            button.classList.toggle("bg-blue-600", isActive);
            button.classList.toggle("text-white", isActive);
            button.classList.toggle("bg-gray-200", !isActive);
            button.classList.toggle("text-gray-700", !isActive);
        });

        // Update All button
        const allButton = document.getElementById("filterAll");
        const isAllActive = !activeFilterType && !activeFilterValue;
        allButton.classList.toggle("bg-blue-600", isAllActive);
        allButton.classList.toggle("text-white", isAllActive);
        allButton.classList.toggle("bg-gray-200", !isAllActive);
        allButton.classList.toggle("text-gray-700", !isAllActive);
    }

    // Update table with data
    function updateTable(data) {
        userTableBody.innerHTML = "";
        data.users.forEach((user) => {
            const row = document.createElement("tr");
            row.className = "hover:bg-blue-50";
            row.innerHTML = `
            <td class="py-4 px-4">${user.name}</td>
            <td class="py-4 px-4">${user.email}</td>
            <td class="py-4 px-4">${user.role}</td>
            <td class="py-4 px-4">${user.phone}</td>
            <td class="py-4 px-4">${user.status}</td>
            <td class="py-4 px-4">${user.action}</td>
        `;
            userTableBody.appendChild(row);
        });
    }

    // Update pagination info
    function updatePagination(data) {
        // Calculate total pages
        totalPages = Math.ceil(data.total / pageSize);

        // Update the counts
        shownCount.textContent = data.users.length;
        totalCount.textContent = data.total;

        // Enable/disable prev/next buttons
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage >= totalPages;

        // Generate pagination buttons
        generatePaginationButtons();
    }

    // Generate pagination buttons
    function generatePaginationButtons() {
        const paginationContainer = document.querySelector(
            ".pagination-buttons-container"
        );
        paginationContainer.innerHTML = "";

        // Determine page range to show (show up to 5 page buttons)
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);

        // Adjust start page if we're near the end
        if (endPage - startPage < 4 && startPage > 1) {
            startPage = Math.max(1, endPage - 4);
        }

        // Add first page button with ellipsis if needed
        if (startPage > 1) {
            addPageButton(1);
            if (startPage > 2) {
                addEllipsis();
            }
        }

        // Add page buttons
        for (let i = startPage; i <= endPage; i++) {
            addPageButton(i);
        }

        // Add last page button with ellipsis if needed
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                addEllipsis();
            }
            addPageButton(totalPages);
        }

        // Helper function to add a page button
        function addPageButton(page) {
            const button = document.createElement("button");
            button.textContent = page;
            button.classList.add(
                "pagination-button",
                "px-3",
                "py-2",
                "transition-colors",
                "duration-300"
            );

            if (page === currentPage) {
                button.classList.add(
                    "bg-blue-600",
                    "text-white",
                    "hover:bg-blue-700"
                );
            } else {
                button.classList.add("hover:bg-blue-50");
            }

            button.addEventListener("click", () => {
                if (page !== currentPage) {
                    currentPage = page;
                    fetchUsers();
                }
            });

            paginationContainer.appendChild(button);
        }

        // Helper function to add ellipsis
        function addEllipsis() {
            const ellipsis = document.createElement("span");
            ellipsis.textContent = "...";
            ellipsis.classList.add("px-3", "py-2", "text-gray-600");
            paginationContainer.appendChild(ellipsis);
        }
    }

    // Update sort indicators
    function updateSortIndicators() {
        sortableHeaders.forEach((header) => {
            const icon = header.querySelector(".sort-icon");
            if (header.dataset.column === sortColumn) {
                icon.style.transform =
                    sortDirection === "asc" ? "rotate(180deg)" : "rotate(0deg)";
            } else {
                icon.style.transform = "rotate(0deg)";
            }
        });
    }

    // Update page buttons
    function updatePageButtons() {
        document.querySelectorAll(".pagination-button").forEach((button) => {
            const page = parseInt(button.textContent);
            button.classList.toggle("bg-blue-600", page === currentPage);
            button.classList.toggle("text-white", page === currentPage);
            button.classList.toggle("bg-white", page !== currentPage);
            button.classList.toggle("hover:bg-blue-50", page !== currentPage);
        });
    }

    // Event listeners
    searchInput.addEventListener("input", () => {
        searchTerm = searchInput.value;
        currentPage = 1;
        fetchUsers();
    });

    sortDropdown.addEventListener("change", (e) => {
        [sortColumn, sortDirection] = e.target.value.split("_");
        fetchUsers();
    });

    prevButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            fetchUsers();
        }
    });

    nextButton.addEventListener("click", () => {
        currentPage++;
        fetchUsers();
    });

    // Filter button handlers
    document.getElementById("filterAll").addEventListener("click", () => {
        activeFilterType = null;
        activeFilterValue = null;
        currentPage = 1;
        fetchUsers();
    });

    // Filter button handlers
    document.querySelectorAll("[data-filter-type]").forEach((button) => {
        button.addEventListener("click", (e) => {
            const filterType = e.currentTarget.dataset.filterType;
            const filterValue = e.currentTarget.dataset.filterValue;

            // Toggle filter if clicking the same button
            if (
                activeFilterType === filterType &&
                activeFilterValue === filterValue
            ) {
                activeFilterType = null;
                activeFilterValue = null;
            } else {
                activeFilterType = filterType;
                activeFilterValue = filterValue;
            }

            currentPage = 1;
            fetchUsers();
        });
    });

    // Add header sorting handlers
    sortableHeaders.forEach((header) => {
        header.addEventListener("click", () => {
            const column = header.dataset.column;

            if (sortColumn === column) {
                // Toggle direction if same column
                sortDirection = sortDirection === "asc" ? "desc" : "asc";
            } else {
                // New column, default to asc
                sortColumn = column;
                sortDirection = "asc";
            }

            currentPage = 1;
            fetchUsers();
            updateSortIndicators();
        });
    });

    // Initial fetch
    fetchUsers();
});
