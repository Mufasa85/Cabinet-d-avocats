/**
 * Theme Manager - Global theme switching for all pages
 * Handles theme loading and persistence across the application
 */

(function () {
  'use strict';

  // Get theme from localStorage or use default
  function getTheme() {
    return localStorage.getItem('theme') || 'default';
  }

  // Apply theme to body
  function applyTheme(theme) {
    if (theme && theme !== 'default') {
      document.body.setAttribute('data-theme', theme);
    } else {
      document.body.removeAttribute('data-theme');
    }
  }

  // Update theme buttons (both navbar and sidebar selectors)
  function updateThemeButtons(theme) {
    var selectors = '.theme-nav-btn, .theme-btn';
    var buttons = document.querySelectorAll(selectors);
    buttons.forEach(function (btn) {
      if (btn.getAttribute('data-theme') === theme) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  // Update theme showcase - images toujours visibles, juste highlight
  function updateThemeShowcase(theme) {
    var items = document.querySelectorAll('.theme-item');
    items.forEach(function (item) {
      item.classList.remove('active');
      // Highlight the active theme
      if (theme === 'light' && item.hasAttribute('data-theme-light')) {
        item.classList.add('active');
      } else if (theme === 'royal' && item.hasAttribute('data-theme-royal')) {
        item.classList.add('active');
      } else if ((theme === 'default' || theme === null) && item.hasAttribute('data-theme-default')) {
        item.classList.add('active');
      }
    });

    var showcase = document.querySelector('.themes-showcase');
    if (showcase) {
      showcase.classList.add('active');
    }
  }

  // Set theme and save to database
  function setTheme(theme) {
    // Apply to body
    applyTheme(theme);

    // Update navbar buttons
    updateThemeButtons(theme);

    // Update theme showcase images
    updateThemeShowcase(theme);

    // Save to localStorage
    localStorage.setItem('theme', theme);

    // Save to database via AJAX
    fetch('/interns/settings/theme', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'theme=' + encodeURIComponent(theme)
    })
      .then(function (response) { return response.json(); })
      .then(function (data) {
        if (data.success) {
          console.log('Theme saved:', theme);
        }
      })
      .catch(function (error) {
        console.error('Error saving theme:', error);
      });
  }

  // Initialize theme on page load
  function initTheme() {
    var theme = getTheme();
    applyTheme(theme);
    updateThemeButtons(theme);
    updateThemeShowcase(theme);

    // Setup all theme buttons (navbar and sidebar)
    var buttons = document.querySelectorAll('.theme-nav-btn, .theme-btn');
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var newTheme = this.getAttribute('data-theme');
        setTheme(newTheme);
      });
    });
  }

  // Listen for DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTheme);
  } else {
    initTheme();
  }
})();
