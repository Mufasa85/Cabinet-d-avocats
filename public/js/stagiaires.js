/**
 * STAGIAIRES PAGE - JavaScript Module
 * Premium Institutional Design
 */

// ============================================
// INITIALIZATION
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    initLoader();
    initNavbar();
    initMobileMenu();
    initHeroParticles();
    initScrollAnimations();
    initCounters();
    initUploadZones();
    initForm();
    initModal();
    initPlacesCarousel();
});

// ============================================
// LOADER
// ============================================

function initLoader() {
    const loader = document.getElementById('loader');
    
    window.addEventListener('load', () => {
        setTimeout(() => {
            loader.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 1800);
    });
}

// ============================================
// NAVBAR
// ============================================

function initNavbar() {
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 100;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ============================================
// MOBILE MENU
// ============================================

function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileCloseBtn = document.getElementById('mobileCloseBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileLinks = mobileMenu.querySelectorAll('a');
    
    function openMenu() {
        mobileMenu.classList.add('active');
        mobileMenuBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        mobileMenu.classList.remove('active');
        mobileMenuBtn.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    mobileMenuBtn.addEventListener('click', openMenu);
    mobileCloseBtn.addEventListener('click', closeMenu);
    
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
}

// ============================================
// HERO PARTICLES
// ============================================

function initHeroParticles() {
    const container = document.getElementById('heroParticles');
    if (!container) return;
    
    const particleCount = 30;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${8 + Math.random() * 8}s`;
        container.appendChild(particle);
    }
}

// ============================================
// SCROLL ANIMATIONS
// ============================================

function initScrollAnimations() {
    const elements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.dataset.delay || 0;
                setTimeout(() => {
                    entry.target.classList.add('animated');
                }, parseInt(delay));
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    elements.forEach(element => observer.observe(element));
}

// ============================================
// COUNTERS
// ============================================

function initCounters() {
    const counters = document.querySelectorAll('[data-count]');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element) {
    const target = parseInt(element.dataset.count);
    const duration = 2000;
    const start = 0;
    const startTime = performance.now();
    
    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeProgress = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(start + (target - start) * easeProgress);
        
        element.textContent = current;
        
        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }
    
    requestAnimationFrame(update);
}

// ============================================
// FILE UPLOAD
// ============================================

const uploadedFiles = {
    cv: null,
    letter: null,
    academic: null
};

function initUploadZones() {
    const zones = document.querySelectorAll('.upload-zone');
    
    zones.forEach(zone => {
        const input = zone.querySelector('input[type="file"]');
        const type = zone.dataset.type;
        
        // Drag events
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('dragover');
        });
        
        zone.addEventListener('dragleave', () => {
            zone.classList.remove('dragover');
        });
        
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileUpload(zone, files[0], type);
            }
        });
        
        // Click upload
        input.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(zone, e.target.files[0], type);
            }
        });
        
        // Remove button
        const removeBtn = zone.querySelector('.preview-remove');
        if (removeBtn) {
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                resetUploadZone(zone, type);
            });
        }
    });
}

function handleFileUpload(zone, file, type) {
    // Validate file type
    if (file.type !== 'application/pdf') {
        showError('Seuls les fichiers PDF sont acceptés.');
        zone.classList.add('error');
        setTimeout(() => zone.classList.remove('error'), 3000);
        return;
    }
    
    // Validate file size (5MB)
    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        showError('Le fichier ne doit pas dépasser 5 Mo.');
        zone.classList.add('error');
        setTimeout(() => zone.classList.remove('error'), 3000);
        return;
    }
    
    // Simulate upload progress
    simulateUpload(zone, file, type);
}

function simulateUpload(zone, file, type) {
    const content = zone.querySelector('.upload-content');
    const preview = zone.querySelector('.upload-preview');
    const progress = zone.querySelector('.upload-progress');
    const progressFill = progress.querySelector('.progress-fill');
    const progressText = progress.querySelector('.progress-text');
    
    // Hide content, show progress
    content.style.display = 'none';
    preview.style.display = 'none';
    progress.style.display = 'flex';
    
    let percent = 0;
    const interval = setInterval(() => {
        percent += Math.random() * 15;
        if (percent >= 100) {
            percent = 100;
            clearInterval(interval);
            
            // Show preview
            setTimeout(() => {
                progress.style.display = 'none';
                preview.style.display = 'flex';
                
                const nameEl = preview.querySelector('.preview-name');
                const sizeEl = preview.querySelector('.preview-size');
                
                nameEl.textContent = file.name;
                sizeEl.textContent = formatFileSize(file.size);
                
                zone.classList.add('uploaded');
                zone.classList.remove('error');
                
                // Store file reference
                uploadedFiles[type] = file;
            }, 300);
        }
        
        progressFill.style.width = `${percent}%`;
        progressText.textContent = `${Math.round(percent)}%`;
    }, 100);
}

function resetUploadZone(zone, type) {
    const content = zone.querySelector('.upload-content');
    const preview = zone.querySelector('.upload-preview');
    const progress = zone.querySelector('.upload-progress');
    const input = zone.querySelector('input[type="file"]');
    
    content.style.display = 'block';
    preview.style.display = 'none';
    progress.style.display = 'none';
    zone.classList.remove('uploaded', 'error');
    input.value = '';
    uploadedFiles[type] = null;
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// ============================================
// FORM HANDLING
// ============================================

function initForm() {
    const form = document.getElementById('applicationForm');
    const submitBtn = document.getElementById('submitBtn');
    const motivationField = document.getElementById('motivation');
    const charCount = document.getElementById('charCount');
    
    if (motivationField && charCount) {
        motivationField.addEventListener('input', () => {
            const count = motivationField.value.length;
            charCount.textContent = count;
            charCount.style.color = count > 2000 ? 'var(--color-error)' : 'var(--color-muted)';
        });
    }
    
    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Validate form
        if (!validateForm()) {
            return;
        }
        
        // Submit animation
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Erreur lors de l\'envoi.');
            }

            submitBtn.classList.remove('loading');
            submitBtn.classList.add('success');

            setTimeout(() => {
                showModal();
                submitBtn.classList.remove('success');
                submitBtn.disabled = false;
                form.reset();
                document.querySelectorAll('.upload-zone').forEach(zone => {
                    resetUploadZone(zone, zone.dataset.type);
                });
                if (charCount) charCount.textContent = '0';
            }, 800);
        } catch (err) {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
            showError(err.message || 'Une erreur est survenue.');
        }
    });
}

function validateForm() {
    let isValid = true;
    const requiredFields = document.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        const formGroup = field.closest('.form-group') || field.closest('.checkbox-group');
        const errorEl = formGroup?.querySelector('.form-error');
        
        if (field.type === 'checkbox') {
            if (!field.checked) {
                isValid = false;
                showError('Veuillez accepter la politique de confidentialité.');
            }
        } else if (field.type === 'file') {
            const type = field.closest('.upload-zone')?.dataset.type;
            if (!uploadedFiles[type]) {
                isValid = false;
                field.closest('.upload-zone')?.classList.add('error');
            }
        } else if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
            if (errorEl) {
                errorEl.textContent = 'Ce champ est requis';
            }
        } else {
            field.classList.remove('error');
            if (errorEl) {
                errorEl.textContent = '';
            }
        }
    });
    
    // Validate email format
    const emailField = document.getElementById('email');
    if (emailField.value && !isValidEmail(emailField.value)) {
        isValid = false;
        emailField.classList.add('error');
        const errorEl = emailField.closest('.form-group')?.querySelector('.form-error');
        if (errorEl) {
            errorEl.textContent = 'Email invalide';
        }
    }
    
    // Validate phone format
    const phoneField = document.getElementById('phone');
    if (phoneField.value && !isValidPhone(phoneField.value)) {
        isValid = false;
        phoneField.classList.add('error');
        const errorEl = phoneField.closest('.form-group')?.querySelector('.form-error');
        if (errorEl) {
            errorEl.textContent = 'Numéro invalide';
        }
    }
    
    // Check motivation length
    const motivationField = document.getElementById('motivation');
    if (motivationField.value.length > 2000) {
        isValid = false;
        motivationField.classList.add('error');
        showError('La lettre de motivation ne doit pas dépasser 2000 caractères.');
    }
    
    if (!isValid) {
        showError('Veuillez remplir tous les champs obligatoires.');
    }
    
    return isValid;
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
    return /^[\d\s+()-]{8,}$/.test(phone);
}

// ============================================
// MODAL
// ============================================

function initModal() {
    const modal = document.getElementById('successModal');
    const closeBtn = document.getElementById('closeModal');
    const backdrop = modal.querySelector('.modal-backdrop');
    
    closeBtn.addEventListener('click', hideModal);
    backdrop.addEventListener('click', hideModal);
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            hideModal();
        }
    });
}

function showModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function hideModal() {
    const modal = document.getElementById('successModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// ============================================
// TOAST NOTIFICATIONS
// ============================================

function showError(message) {
    const toast = document.getElementById('errorToast');
    const messageEl = toast.querySelector('.toast-message');
    
    messageEl.textContent = message;
    toast.classList.add('active');
    
    setTimeout(() => {
        toast.classList.remove('active');
    }, 4000);
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ============================================
// PLACES CAROUSEL
// ============================================

function initPlacesCarousel() {
    const slider = document.getElementById('placesSlider');
    const prevBtn = document.getElementById('placesPrev');
    const nextBtn = document.getElementById('placesNext');
    const dotsContainer = document.getElementById('placesDots');
    
    if (!slider || !prevBtn || !nextBtn) return;
    
    const cards = slider.querySelectorAll('.place-card');
    const totalCards = cards.length;
    let currentIndex = 0;
    let cardsPerView = getCardsPerView();
    let isMobile = window.innerWidth <= 768;
    
    function getCardsPerView() {
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 1024) return 2;
        return 3;
    }
    
    function updateSlider() {
        if (isMobile) return; // No transformation on mobile
        const cardWidth = cards[0].offsetWidth + 32; // card width + gap
        const offset = currentIndex * cardWidth;
        slider.style.transform = `translateX(-${offset}px)`;
        updateDots();
    }
    
    function updateDots() {
        if (!dotsContainer) return;
        const dots = dotsContainer.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }
    
    function goToNext() {
        const maxIndex = totalCards - cardsPerView;
        if (currentIndex < maxIndex) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateSlider();
    }
    
    function goToPrev() {
        const maxIndex = totalCards - cardsPerView;
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = maxIndex;
        }
        updateSlider();
    }
    
    function goToIndex(index) {
        currentIndex = index;
        updateSlider();
    }
    
    // Event listeners
    nextBtn.addEventListener('click', goToNext);
    prevBtn.addEventListener('click', goToPrev);
    
    // Dot navigation
    if (dotsContainer) {
        const dots = dotsContainer.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToIndex(index));
        });
    }
    
    // Drag support
    let isDragging = false;
    let startX = 0;
    let currentTranslate = 0;
    
    slider.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.pageX;
        slider.style.cursor = 'grabbing';
    });
    
    slider.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const diff = e.pageX - startX;
        currentTranslate = -currentIndex * (cards[0].offsetWidth + 32) + diff;
    });
    
    slider.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;
        slider.style.cursor = 'grab';
        
        if (currentTranslate > 50) {
            goToPrev();
        } else if (currentTranslate < -50) {
            goToNext();
        }
    });
    
    slider.addEventListener('mouseleave', () => {
        if (isDragging) {
            isDragging = false;
            slider.style.cursor = 'grab';
        }
    });
    
    // Touch support for mobile
    let touchStartX = 0;
    
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].pageX;
    }, { passive: true });
    
    slider.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].pageX;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                goToNext();
            } else {
                goToPrev();
            }
        }
    }, { passive: true });
    
    // Resize handler
    window.addEventListener('resize', debounce(() => {
        isMobile = window.innerWidth <= 768;
        cardsPerView = getCardsPerView();
        const maxIndex = totalCards - cardsPerView;
        if (currentIndex > maxIndex) {
            currentIndex = maxIndex;
        }
        if (!isMobile) {
            updateSlider();
        } else {
            slider.style.transform = 'none';
        }
    }, 250));
    
    // Auto-play (optional)
    let autoPlayInterval = setInterval(goToNext, 5000);
    
    // Pause on hover
    slider.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });
    
    slider.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(goToNext, 5000);
    });
}

