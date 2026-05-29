/**
 * ELMD Lawyer Space
 * Main JavaScript Module
 */

// ==========================================
// Sidebar Toggle
// ==========================================
const initSidebar = () => {
    const sidebar = document.getElementById('lawyer-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const headerToggle = document.getElementById('header-toggle');

    const openSidebar = () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeSidebar = () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    sidebarToggle?.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });

    headerToggle?.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            openSidebar();
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });

    overlay?.addEventListener('click', closeSidebar);
};

// ==========================================
// User Menu Dropdown
// ==========================================
const initUserMenu = () => {
    const userMenu = document.getElementById('user-menu');
    const userMenuBtn = userMenu?.querySelector('.user-menu-btn');

    userMenuBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!userMenu?.contains(e.target)) {
            userMenu?.classList.remove('active');
        }
    });
};

// ==========================================
// Theme Switcher
// ==========================================
const initThemeSwitcher = () => {
    // Selecteurs pour header (theme-btn) et settings (theme-option)
    const themeSelectors = document.querySelectorAll('.theme-btn, .theme-option');
    const html = document.documentElement;

    // Load saved theme
    const savedTheme = localStorage.getItem('elmd-lawyer-theme') || 'dark';
    applyTheme(savedTheme);

    themeSelectors.forEach(btn => {
        btn.addEventListener('click', () => {
            const theme = btn.dataset.theme;
            applyTheme(theme);
            localStorage.setItem('elmd-lawyer-theme', theme);
        });
    });

    function applyTheme(theme) {
        // Retirer active de tous les boutons (header et settings)
        document.querySelectorAll('.theme-btn, .theme-option').forEach(b => b.classList.remove('active'));

        // Activer le bouton correspondant dans le header
        document.querySelectorAll(`.theme-btn[data-theme="${theme}"]`).forEach(b => b.classList.add('active'));
        // Activer le bouton correspondant dans settings
        document.querySelectorAll(`.theme-option[data-theme="${theme}"]`).forEach(b => b.classList.add('active'));

        html.setAttribute('data-theme', theme);

        // Apply theme-specific colors
        if (theme === 'light') {
            html.style.setProperty('--primary-black', '#FFFFFF');
            html.style.setProperty('--secondary-black', '#F8F8F8');
            html.style.setProperty('--white', '#171717');
            html.style.setProperty('--text-primary', '#171717');
            html.style.setProperty('--text-secondary', '#525252');
            html.style.setProperty('--text-muted', '#737373');
            html.style.setProperty('--modal-bg', 'rgba(250, 250, 250, 0.98)');
            html.style.setProperty('--modal-overlay', 'rgba(0, 0, 0, 0.5)');
            html.style.setProperty('--card-bg', '#FFFFFF');
            html.style.setProperty('--border-color', '#E5E5E5');
        } else if (theme === 'royal') {
            html.style.setProperty('--primary-black', '#0F172A');
            html.style.setProperty('--secondary-black', '#1E293B');
            html.style.setProperty('--modal-bg', 'rgba(30, 41, 59, 0.98)');
            html.style.setProperty('--modal-overlay', 'rgba(15, 23, 42, 0.7)');
        } else {
            // Dark theme (default)
            html.style.setProperty('--primary-black', '#0A0A0A');
            html.style.setProperty('--secondary-black', '#141414');
            html.style.setProperty('--white', '#FFFFFF');
            html.style.setProperty('--text-primary', '#FFFFFF');
            html.style.setProperty('--text-secondary', '#A0A0A0');
            html.style.setProperty('--text-muted', '#737373');
            html.style.setProperty('--modal-bg', 'rgba(20, 20, 20, 0.98)');
            html.style.setProperty('--modal-overlay', 'rgba(0, 0, 0, 0.7)');
            html.style.setProperty('--card-bg', '#1A1A1A');
            html.style.setProperty('--border-color', '#2A2A2A');
        }
    }
};

// ==========================================
// Modal System
// ==========================================
const initModals = () => {
    const modalTriggers = document.querySelectorAll('[data-modal]');

    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modalId = trigger.dataset.modal;
            openModal(modalId);
        });
    });

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                closeModal(overlay.id);
            }
        });
    });

    // Close modal on close button
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.modal');
            if (modal) closeModal(modal.id);
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal.active').forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
};

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        modal.previousElementSibling?.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        modal.previousElementSibling?.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// ==========================================
// Form Validation
// ==========================================
const initForms = () => {
    const forms = document.querySelectorAll('form[data-validate]');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!validateForm(form)) {
                e.preventDefault();
            }
        });
    });

    function validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');

                // Add error message
                let errorMsg = field.parentElement.querySelector('.form-error');
                if (!errorMsg) {
                    errorMsg = document.createElement('span');
                    errorMsg.className = 'form-error';
                    errorMsg.textContent = 'Ce champ est requis';
                    field.parentElement.appendChild(errorMsg);
                }
            } else {
                field.classList.remove('error');
                const errorMsg = field.parentElement.querySelector('.form-error');
                errorMsg?.remove();
            }
        });

        return isValid;
    }
};

// ==========================================
// File Upload Preview
// ==========================================
const initFileUpload = () => {
    const fileInputs = document.querySelectorAll('.file-upload input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const preview = input.closest('.file-upload').querySelector('.file-upload-preview');
                if (preview) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    });
};

// ==========================================
// Smooth Scroll
// ==========================================
const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
};

// ==========================================
// Animated Counters
// ==========================================
const initCounters = () => {
    const counters = document.querySelectorAll('[data-counter]');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));

    function animateCounter(el) {
        const target = parseInt(el.dataset.counter);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                el.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                el.textContent = target;
            }
        };

        updateCounter();
    }
};

// ==========================================
// Notifications
// ==========================================
const initNotifications = () => {
    const notificationsBtn = document.getElementById('notifications-btn');

    notificationsBtn?.addEventListener('click', () => {
        window.location.href = 'notifications.php';
    });
};

// ==========================================
// Tables Mobile View
// ==========================================
const initTables = () => {
    const tables = document.querySelectorAll('.table');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                checkMobileView();
                observer.unobserve(entry.target);
            }
        });
    });

    tables.forEach(table => observer.observe(table));

    function checkMobileView() {
        if (window.innerWidth < 768) {
            tables.forEach(table => {
                const container = table.closest('.table-container');
                if (container && !container.querySelector('.mobile-table-cards')) {
                    convertTableToCards(table);
                }
            });
        }
    }

    function convertTableToCards(table) {
        const container = table.closest('.table-container');
        const rows = table.querySelectorAll('tbody tr');

        const cardsContainer = document.createElement('div');
        cardsContainer.className = 'table-mobile-cards';

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const headers = table.querySelectorAll('th');

            const card = document.createElement('div');
            card.className = 'mobile-table-card';

            headers.forEach((header, index) => {
                const label = header.textContent;
                const value = cells[index]?.textContent || '';

                const item = document.createElement('div');
                item.className = 'mobile-table-card-item';
                item.innerHTML = `
                    <span class="mobile-table-card-label">${label}</span>
                    <span class="mobile-table-card-value">${value}</span>
                `;
                card.appendChild(item);
            });

            cardsContainer.appendChild(card);
        });

        container.appendChild(cardsContainer);
    }

    window.addEventListener('resize', checkMobileView);
};

// ==========================================
// Toast Notifications
// ==========================================
const showToast = (message, type = 'info') => {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            ${type === 'success' ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>' : ''}
            ${type === 'error' ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>' : ''}
            ${type === 'info' ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>' : ''}
        </div>
        <span class="toast-message">${message}</span>
        <button class="toast-close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    `;

    document.body.appendChild(toast);

    // Add styles
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--secondary-black);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-lg);
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 9999;
        animation: slideInRight 0.3s ease;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    `;

    const closeBtn = toast.querySelector('.toast-close');
    closeBtn?.addEventListener('click', () => {
        toast.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    });

    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
};

// ==========================================
// Initialize All
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initUserMenu();
    initThemeSwitcher();
    initModals();
    initForms();
    initFileUpload();
    initSmoothScroll();
    initCounters();
    initNotifications();
    initTables();
});

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(20px); }
    }
`;
document.head.appendChild(style);