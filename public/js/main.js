/**
 * ELMD Law Firm Website
 * Main JavaScript Module
 */

// ==========================================
// Loader
// ==========================================
const initLoader = () => {
  const loader = document.getElementById('loader');

  window.addEventListener('load', () => {
    setTimeout(() => {
      loader.classList.add('hidden');
      document.body.style.overflow = '';
    }, 2000);
  });

  // Prevent scrolling while loading
  document.body.style.overflow = 'hidden';
};

// ==========================================
// Navbar
// ==========================================
const initNavbar = () => {
  const navbar = document.getElementById('navbar');
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuClose = document.getElementById('mobile-menu-close');
  const mobileLinks = document.querySelectorAll('.mobile-link');

  // Scroll effect
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

  // Mobile menu toggle
  const openMobileMenu = () => {
    mobileMenu.classList.add('active');
    mobileMenuBtn.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  const closeMobileMenu = () => {
    mobileMenu.classList.remove('active');
    mobileMenuBtn.classList.remove('active');
    document.body.style.overflow = '';
  };

  mobileMenuBtn.addEventListener('click', () => {
    if (mobileMenu.classList.contains('active')) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  });

  mobileMenuClose.addEventListener('click', closeMobileMenu);

  mobileLinks.forEach(link => {
    link.addEventListener('click', closeMobileMenu);
  });
};

const initHeroSlider = () => {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  const prevBtn = document.querySelector('.hero-prev');
  const nextBtn = document.querySelector('.hero-next');
  const heroSection = document.querySelector('.hero');

  // Exit early if hero slider elements don't exist (e.g., on sub-pages)
  if (!slides.length || !heroSection) {
    return;
  }

  let currentSlide = 0;
  let autoplayInterval;

  const showSlide = (index) => {
    // Normalize index
    if (index >= slides.length) index = 0;
    if (index < 0) index = slides.length - 1;

    // Update slides
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
    });

    // Update dots
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
    });

    currentSlide = index;
  };

  const nextSlide = () => showSlide(currentSlide + 1);
  const prevSlide = () => showSlide(currentSlide - 1);

  // Event listeners (only if elements exist)
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      resetAutoplay();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      resetAutoplay();
    });
  }

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      showSlide(index);
      resetAutoplay();
    });
  });

  // Autoplay
  const startAutoplay = () => {
    autoplayInterval = setInterval(nextSlide, 6000);
  };

  const resetAutoplay = () => {
    clearInterval(autoplayInterval);
    startAutoplay();
  };

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
      prevSlide();
      resetAutoplay();
    } else if (e.key === 'ArrowRight') {
      nextSlide();
      resetAutoplay();
    }
  });

  // Touch support
  let touchStartX = 0;
  let touchEndX = 0;

  heroSection.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  heroSection.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  }, { passive: true });

  const handleSwipe = () => {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;

    if (Math.abs(diff) > swipeThreshold) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
      resetAutoplay();
    }
  };

  startAutoplay();
};

// ==========================================
// Gold Particles
// ==========================================
const initParticles = () => {
  const particlesContainer = document.getElementById('particles');
  if (!particlesContainer) return;
  const particleCount = 20;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.top = `${Math.random() * 100}%`;
    particle.style.width = `${Math.random() * 4 + 2}px`;
    particle.style.height = particle.style.width;
    particle.style.animationDuration = `${Math.random() * 10 + 10}s`;
    particle.style.animationDelay = `${Math.random() * 5}s`;
    particlesContainer.appendChild(particle);
  }
};

// ==========================================
// Scroll Animations
// ==========================================
const initScrollAnimations = () => {
  const animatedElements = document.querySelectorAll('.animate-on-scroll');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  animatedElements.forEach(el => observer.observe(el));
};

// ==========================================
// Stats Counter
// ==========================================
const initStatsCounter = () => {
  const stats = document.querySelectorAll('.stat-number');

  const animateCounter = (el) => {
    const target = parseInt(el.dataset.target);
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
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  stats.forEach(stat => observer.observe(stat));
};

// ==========================================
// Mobile Sliders
// ==========================================
const initMobileSliders = () => {
  const sliders = [
    { container: 'features-slider', dots: 'features-dots', slider: 'features' },
    { container: 'services-slider', dots: 'services-dots', slider: 'services' },
    { container: 'team-slider', dots: 'team-dots', slider: 'team' },
    { container: 'news-slider', dots: 'news-dots', slider: 'news' }
  ];

  sliders.forEach(({ container, dots, slider }) => {
    const sliderEl = document.getElementById(container);
    const dotsContainer = document.getElementById(dots);
    const prevBtn = document.querySelector(`.slider-prev[data-slider="${slider}"]`);
    const nextBtn = document.querySelector(`.slider-next[data-slider="${slider}"]`);

    if (!sliderEl || !dotsContainer) return;

    const cards = sliderEl.children;
    const cardCount = cards.length;
    let currentIndex = 0;

    // Create dots
    for (let i = 0; i < cardCount; i++) {
      const dot = document.createElement('button');
      dot.className = `slider-dot${i === 0 ? ' active' : ''}`;
      dot.dataset.index = i;
      dotsContainer.appendChild(dot);
    }

    const updateDots = () => {
      dotsContainer.querySelectorAll('.slider-dot').forEach((dot, i) => {
        dot.classList.toggle('active', i === currentIndex);
      });
    };

    const scrollToIndex = (index) => {
      if (index < 0) index = 0;
      if (index >= cardCount) index = cardCount - 1;

      currentIndex = index;
      const card = cards[index];
      const scrollLeft = card.offsetLeft - (sliderEl.offsetWidth - card.offsetWidth) / 2;

      sliderEl.scrollTo({
        left: scrollLeft,
        behavior: 'smooth'
      });

      updateDots();
    };

    // Button events
    prevBtn?.addEventListener('click', () => scrollToIndex(currentIndex - 1));
    nextBtn?.addEventListener('click', () => scrollToIndex(currentIndex + 1));

    // Dot events
    dotsContainer.addEventListener('click', (e) => {
      if (e.target.classList.contains('slider-dot')) {
        scrollToIndex(parseInt(e.target.dataset.index));
      }
    });

    // Scroll detection
    let scrollTimeout;
    sliderEl.addEventListener('scroll', () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(() => {
        const scrollLeft = sliderEl.scrollLeft;
        let closestIndex = 0;
        let closestDistance = Infinity;

        Array.from(cards).forEach((card, i) => {
          const cardCenter = card.offsetLeft + card.offsetWidth / 2;
          const sliderCenter = scrollLeft + sliderEl.offsetWidth / 2;
          const distance = Math.abs(cardCenter - sliderCenter);

          if (distance < closestDistance) {
            closestDistance = distance;
            closestIndex = i;
          }
        });

        currentIndex = closestIndex;
        updateDots();
      }, 100);
    }, { passive: true });
  });
};

// ==========================================
// Testimonials Slider
// ==========================================
const initTestimonialsSlider = () => {
  const cards = document.querySelectorAll('.testimonial-card');
  const dots = document.querySelectorAll('.testimonial-dot');
  const prevBtn = document.querySelector('.testimonial-prev');
  const nextBtn = document.querySelector('.testimonial-next');

  let currentIndex = 0;
  let autoplayInterval;

  const showTestimonial = (index) => {
    if (index >= cards.length) index = 0;
    if (index < 0) index = cards.length - 1;

    cards.forEach((card, i) => {
      card.classList.toggle('active', i === index);
    });

    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
    });

    currentIndex = index;
  };

  const nextTestimonial = () => showTestimonial(currentIndex + 1);
  const prevTestimonial = () => showTestimonial(currentIndex - 1);

  if (!cards.length || !prevBtn || !nextBtn) return;

  prevBtn.addEventListener('click', () => {
    prevTestimonial();
    resetAutoplay();
  });

  nextBtn.addEventListener('click', () => {
    nextTestimonial();
    resetAutoplay();
  });

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      showTestimonial(index);
      resetAutoplay();
    });
  });

  const startAutoplay = () => {
    autoplayInterval = setInterval(nextTestimonial, 5000);
  };

  const resetAutoplay = () => {
    clearInterval(autoplayInterval);
    startAutoplay();
  };

  startAutoplay();
};

// ==========================================
// Contact Form
// ==========================================
const initContactForm = () => {
  const form = document.getElementById('contact-form');

  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Get form data
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    // Here you would typically send the data to a server
    console.log('Form submitted:', data);

    // Show success message
    alert('Merci pour votre message. Nous vous contacterons dans les plus brefs délais.');

    // Reset form
    form.reset();
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
        const navbarHeight = document.getElementById('navbar').offsetHeight;
        const targetPosition = target.offsetTop - navbarHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
};

// ==========================================
// Initialize All
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
  initLoader();
  initNavbar();
  initHeroSlider();
  initParticles();
  initScrollAnimations();
  initStatsCounter();
  initMobileSliders();
  initTestimonialsSlider();
  initContactForm();
  initSmoothScroll();
});
