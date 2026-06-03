/**
 * ==============================================
 * ADMIN DASHBOARD JAVASCRIPT - INTERACTIVE
 * Cabinet d'Avocats - Responsive Interactions
 * Noir/Blanc/Doré Premium Theme
 * ==============================================
 */

(function () {
    'use strict';

    // ==========================================
    // SIDEBAR TOGGLE - RESPONSIVE
    // ==========================================
    const initSidebar = function () {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const toggleBtn = document.getElementById('sidebarToggle') || document.querySelector('.header-toggle');
        const closeBtn = document.getElementById('sidebarClose');

        if (!sidebar) return;

        function updateToggleIcon() {
            if (toggleBtn) {
                const icon = toggleBtn.querySelector('i');
                if (icon) {
                    if (sidebar.classList.contains('active')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                }
            }
        }

        function openSidebar() {
            sidebar.classList.add('active');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            updateToggleIcon();
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
            updateToggleIcon();
        }

        function toggleSidebar() {
            if (sidebar.classList.contains('active')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        // Toggle button click
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }

        // Close button click (inside sidebar)
        if (closeBtn) {
            closeBtn.addEventListener('click', closeSidebar);
        }

        // Overlay click to close
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Escape key to close sidebar
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', debounce(function () {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        }, 100));

        // Listen for custom sidebar events
        document.addEventListener('sidebar:open', openSidebar);
        document.addEventListener('sidebar:close', closeSidebar);
        document.addEventListener('sidebar:toggle', toggleSidebar);

        // Initial icon state
        updateToggleIcon();
    };

    // ==========================================
    // USER DROPDOWN
    // ==========================================
    const initUserDropdown = function () {
        const userBtn = document.querySelector('.header-user-btn');
        const userDropdown = document.querySelector('.header-user-dropdown');

        if (!userBtn || !userDropdown) return;

        userBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const headerUser = document.querySelector('.header-user');
            headerUser.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.header-user')) {
                document.querySelector('.header-user')?.classList.remove('active');
            }
        });
    };

    // ==========================================
    // MODAL SYSTEM
    // ==========================================
    const initModals = function () {
        // Open modal buttons
        document.querySelectorAll('[data-modal-open]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const modalId = this.getAttribute('data-modal-open');
                openModal(modalId);
            });
        });

        // Close modal buttons
        document.querySelectorAll('[data-modal-close]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const modalId = this.getAttribute('data-modal-close');
                closeModal(modalId);
            });
        });

        // Close on overlay click
        document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
            overlay.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeModal(this.id.replace('-overlay', ''));
                }
            });
        });

        // Close on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const activeModal = document.querySelector('.modal.active');
                if (activeModal) {
                    closeModal(activeModal.id);
                }
            }
        });
    };

    window.openModal = function (modalId) {
        const modal = document.getElementById(modalId);
        const overlay = document.getElementById(modalId + '-overlay');

        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        if (overlay) {
            overlay.classList.add('active');
        }

        // Dispatch event
        modal?.dispatchEvent(new CustomEvent('modal:open', { detail: { id: modalId } }));
    };

    window.closeModal = function (modalId) {
        const modal = document.getElementById(modalId);
        const overlay = document.getElementById(modalId + '-overlay');

        if (modal) {
            modal.classList.remove('active');
        }

        if (overlay) {
            overlay.classList.remove('active');
        }

        // Only restore body scroll if no modals are open
        const anyOpenModal = document.querySelector('.modal.active');
        if (!anyOpenModal) {
            document.body.style.overflow = '';
        }

        // Dispatch event
        modal?.dispatchEvent(new CustomEvent('modal:close', { detail: { id: modalId } }));
    };

    // ==========================================
    // TABS
    // ==========================================
    const initTabs = function () {
        document.querySelectorAll('.tabs').forEach(function (tabsContainer) {
            const tabs = tabsContainer.querySelectorAll('.tab');
            const targetId = tabsContainer.getAttribute('data-tabs-target');

            if (!targetId) return;

            const panels = document.querySelectorAll(targetId);

            tabs.forEach(function (tab, index) {
                tab.addEventListener('click', function () {
                    // Remove active class from all tabs
                    tabs.forEach(function (t) {
                        t.classList.remove('active');
                    });

                    // Add active class to clicked tab
                    tab.classList.add('active');

                    // Hide all panels
                    panels.forEach(function (panel) {
                        panel.classList.add('hidden');
                    });

                    // Show target panel
                    const targetPanel = document.querySelector(tab.getAttribute('data-tab-target'));
                    if (targetPanel) {
                        targetPanel.classList.remove('hidden');
                    }
                });
            });
        });
    };

    // ==========================================
    // TOAST NOTIFICATIONS
    // ==========================================
    const initToasts = function () {
        window.showToast = function (message, type = 'success', duration = 3000) {
            const container = document.querySelector('.toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = 'toast ' + type;
            toast.innerHTML = `
                <div class="toast-icon">
                    ${type === 'success' ?
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>' :
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>'
                }
                </div>
                <div class="toast-content">
                    <p>${message}</p>
                </div>
            `;

            container.appendChild(toast);

            // Auto remove
            setTimeout(function () {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(function () {
                    toast.remove();
                }, 300);
            }, duration);
        };

        // Listen for toast events
        document.addEventListener('toast:show', function (e) {
            showToast(e.detail.message, e.detail.type, e.detail.duration);
        });
    };

    // ==========================================
    // ANIMATED COUNTERS
    // ==========================================
    const initCounters = function () {
        const counters = document.querySelectorAll('.stat-card-value[data-count]');

        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-count'), 10);
                    const suffix = el.getAttribute('data-suffix') || '';
                    const duration = parseInt(el.getAttribute('data-duration'), 10) || 1500;

                    animateCounter(el, target, suffix, duration);
                    observer.unobserve(el);
                }
            });
        }, observerOptions);

        counters.forEach(function (counter) {
            observer.observe(counter);
        });
    };

    function animateCounter(element, target, suffix, duration) {
        const start = 0;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Ease out cubic
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(start + (target - start) * easeOut);

            element.textContent = current + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                element.textContent = target + suffix;
            }
        }

        requestAnimationFrame(update);
    }

    // ==========================================
    // FORM VALIDATION
    // ==========================================
    const initFormValidation = function () {
        document.querySelectorAll('form[data-validate]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                let isValid = true;

                form.querySelectorAll('[required]').forEach(function (field) {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        showFieldError(field, 'Ce champ est requis');
                    } else {
                        field.classList.remove('error');
                        clearFieldError(field);
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Real-time validation
            form.querySelectorAll('input, select, textarea').forEach(function (field) {
                field.addEventListener('blur', function () {
                    if (field.hasAttribute('required') && !field.value.trim()) {
                        field.classList.add('error');
                        showFieldError(field, 'Ce champ est requis');
                    } else {
                        field.classList.remove('error');
                        clearFieldError(field);
                    }
                });
            });
        });
    };

    function showFieldError(field, message) {
        clearFieldError(field);
        const error = document.createElement('div');
        error.className = 'form-error';
        error.textContent = message;
        field.parentNode.appendChild(error);
    }

    function clearFieldError(field) {
        const existingError = field.parentNode.querySelector('.form-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // ==========================================
    // FILE UPLOAD PREVIEW
    // ==========================================
    const initFileUpload = function () {
        document.querySelectorAll('.file-upload input[type="file"]').forEach(function (input) {
            input.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const preview = this.closest('.file-upload').querySelector('.file-preview');
                    if (preview) {
                        preview.innerHTML = `
                            <div class="file-preview-item">
                                <span class="file-name">${file.name}</span>
                                <span class="file-size">${formatFileSize(file.size)}</span>
                            </div>
                        `;
                    }
                }
            });
        });
    };

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // ==========================================
    // SEARCH FUNCTIONALITY
    // ==========================================
    const initSearch = function () {
        const searchInputs = document.querySelectorAll('.search-input input, .header-search input');

        searchInputs.forEach(function (input) {
            input.addEventListener('input', debounce(function () {
                const query = this.value.toLowerCase().trim();
                const targetSelector = this.closest('.search-input')?.getAttribute('data-search-target') ||
                    this.getAttribute('data-search-target');

                if (targetSelector) {
                    const items = document.querySelectorAll(targetSelector);
                    items.forEach(function (item) {
                        const text = item.textContent.toLowerCase();
                        if (query === '' || text.includes(query)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }
            }, 300));
        });
    };

    // ==========================================
    // CONFIRM DIALOG
    // ==========================================
    window.confirmAction = function (message, onConfirm, onCancel) {
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay active';
        overlay.innerHTML = `
            <div class="modal active confirm-modal">
                <div class="modal-header">
                    <div class="modal-header-content">
                        <div class="modal-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="modal-title">Confirmer</h3>
                        </div>
                    </div>
                    <button class="modal-close" data-action="cancel">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p>${message}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-action="cancel">Annuler</button>
                    <button class="btn btn-primary" data-action="confirm">Confirmer</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);
        document.body.style.overflow = 'hidden';

        const closeDialog = function () {
            overlay.remove();
            document.body.style.overflow = '';
        };

        overlay.querySelector('[data-action="cancel"]').addEventListener('click', function () {
            closeDialog();
            if (onCancel) onCancel();
        });

        overlay.querySelector('[data-action="confirm"]').addEventListener('click', function () {
            closeDialog();
            if (onConfirm) onConfirm();
        });

        overlay.querySelector('.modal-close').addEventListener('click', function () {
            closeDialog();
            if (onCancel) onCancel();
        });

        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closeDialog();
                if (onCancel) onCancel();
            }
        });
    };

    // ==========================================
    // SCROLL ANIMATIONS
    // ==========================================
    const initScrollAnimations = function () {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');

        if (animatedElements.length === 0) return;

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        animatedElements.forEach(function (el) {
            observer.observe(el);
        });
    };

    // ==========================================
    // TABLE ROW ACTIONS
    // ==========================================
    const initTableActions = function () {
        document.querySelectorAll('.table tbody tr').forEach(function (row) {
            row.addEventListener('click', function (e) {
                if (e.target.closest('a, button, .btn')) return;

                const actionUrl = this.getAttribute('data-action-url');
                if (actionUrl) {
                    window.location.href = actionUrl;
                }
            });
        });
    };

    // ==========================================
    // SWITCH TOGGLE
    // ==========================================
    const initSwitches = function () {
        document.querySelectorAll('.switch input').forEach(function (input) {
            input.addEventListener('change', function () {
                const isChecked = this.checked;
                const value = isChecked ? '1' : '0';

                // Dispatch custom event
                this.dispatchEvent(new CustomEvent('switch:change', {
                    detail: { value: value, checked: isChecked }
                }));
            });
        });
    };

    // ==========================================
    // PAGINATION
    // ==========================================
    const initPagination = function () {
        document.querySelectorAll('.pagination-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const page = this.getAttribute('data-page');
                if (page) {
                    const form = document.querySelector('[data-pagination-form]');
                    if (form) {
                        form.querySelector('[name="page"]').value = page;
                        form.submit();
                    }
                }
            });
        });
    };

    // ==========================================
    // NOTIFICATIONS DRAWER (Mobile)
    // ==========================================
    const initNotificationsDrawer = function () {
        const notificationBtn = document.querySelector('.header-action[data-notifications]');
        const drawer = document.querySelector('.notifications-drawer');

        if (!notificationBtn || !drawer) return;

        notificationBtn.addEventListener('click', function () {
            drawer.classList.toggle('active');
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.notifications-drawer') && !e.target.closest('.header-action[data-notifications]')) {
                drawer.classList.remove('active');
            }
        });
    };

    // ==========================================
    // UTILITY FUNCTIONS
    // ==========================================
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = function () {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function throttle(func, limit) {
        let inThrottle;
        return function (...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(function () { inThrottle = false; }, limit);
            }
        };
    }

    // ==========================================
    // INITIALIZATION
    // ==========================================
    function init() {
        initSidebar();
        initUserDropdown();
        initModals();
        initTabs();
        initToasts();
        initCounters();
        initFormValidation();
        initFileUpload();
        initSearch();
        initScrollAnimations();
        initTableActions();
        initSwitches();
        initPagination();
        initNotificationsDrawer();

        // Add loaded class for animations
        document.body.classList.add('js-loaded');

        console.log('Admin Dashboard initialized');
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();