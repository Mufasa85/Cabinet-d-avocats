/**
 * ELMD Admin Filters
 * Common filter functions for admin pages
 */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize filters for all admin pages
    initAdminFilters();
});

function initAdminFilters() {
    // Common filter for all admin tables
    const searchInputs = document.querySelectorAll('input[data-search], .filter-bar input[type="text"]');
    const filterSelects = document.querySelectorAll('select[data-filter], .filter-bar select');

    // Bind input events
    searchInputs.forEach(input => {
        input.addEventListener('input', function () {
            const tableId = this.closest('.card')?.querySelector('table')?.id || 'main-table';
            filterTable(tableId, {
                search: this.value,
                filters: getFilterValues()
            });
        });
    });

    // Bind change events for selects
    filterSelects.forEach(select => {
        select.addEventListener('change', function () {
            const tableId = this.closest('.card')?.querySelector('table')?.id || 'main-table';
            filterTable(tableId, {
                search: getSearchValue(),
                filters: getFilterValues()
            });
        });
    });
}

function getSearchValue() {
    const searchInput = document.querySelector('.filter-bar input[type="text"], .header-search input') ||
        document.querySelector('input[data-search]');
    return searchInput?.value?.toLowerCase() || '';
}

function getFilterValues() {
    const filters = {};
    document.querySelectorAll('.filter-bar select[data-filter], .filter-bar select').forEach(select => {
        const key = select.dataset.filter || select.className.includes('status') ? 'status' :
            select.className.includes('role') ? 'role' :
                select.className.includes('type') ? 'type' : 'general';
        filters[key] = select.value;
    });
    return filters;
}

function filterTable(tableId, options = {}) {
    const table = document.getElementById(tableId) || document.querySelector('table');
    if (!table) return;

    const tbody = table.querySelector('tbody');
    if (!tbody) return;

    const rows = tbody.querySelectorAll('tr[data-row]');
    let visibleCount = 0;

    rows.forEach(row => {
        const searchableText = row.textContent?.toLowerCase() || '';
        const matchesSearch = !options.search || searchableText.includes(options.search);

        // Check each data attribute for filters
        let matchesFilters = true;
        for (const [key, value] of Object.entries(options.filters || {})) {
            const rowValue = row.dataset[key] || '';
            if (value && rowValue !== value) {
                matchesFilters = false;
                break;
            }
        }

        if (matchesSearch && matchesFilters) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update count display
    const countEl = document.getElementById('result-count') ||
        document.querySelector('.filter-bar + .card .card-footer span');
    if (countEl) {
        countEl.textContent = visibleCount + ' résultat(s)';
    }

    return visibleCount;
}

// Legacy support functions
function filterCandidatures() {
    filterTable('candidatures-table', {
        search: getSearchValue(),
        filters: getFilterValues()
    });
}

function filterTrainings() {
    filterTable('formations-table', {
        search: getSearchValue(),
        filters: getFilterValues()
    });
}

function filterPublications() {
    filterTable('publications-table', {
        search: getSearchValue(),
        filters: getFilterValues()
    });
}

function filterUsers() {
    filterTable('users-table', {
        search: getSearchValue(),
        filters: getFilterValues()
    });
}

function filterLawyers() {
    filterTable('lawyers-table-body', {
        search: getSearchValue(),
        filters: getFilterValues()
    });
}