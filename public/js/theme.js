/**
 * ELMD Law Firm Website
 * Theme Manager Module
 */

// ==========================================
// Theme Configuration
// ==========================================
const THEMES = {
  dark: {
    name: 'Dark Luxury',
    icon: 'moon',
    description: 'Mode sombre élégant'
  },
  light: {
    name: 'Light Professional',
    icon: 'sun',
    description: 'Mode clair professionnel'
  },
  royal: {
    name: 'Royal Blue',
    icon: 'star',
    description: 'Thème royal bleu'
  }
};

// ==========================================
// Theme Storage Keys
// ==========================================
const THEME_STORAGE_KEY = 'themis-theme';
const THEME_TRANSITION_CLASS = 'theme-transitioning';

// ==========================================
// Theme Manager Class
// ==========================================
class ThemeManager {
  constructor() {
    this.currentTheme = 'dark';
    this.themes = THEMES;
    this.init();
  }

  init() {
    // Load saved theme from localStorage
    this.loadTheme();
    
    // Apply theme to document
    this.applyTheme(this.currentTheme);
    
    // Initialize theme switcher buttons if they exist
    this.initThemeSwitcher();
    
    // Listen for system theme changes
    this.watchSystemTheme();
    
    // Add transition class for smooth theme changes
    this.enableTransition();
  }

  loadTheme() {
    const savedTheme = localStorage.getItem(THEME_STORAGE_KEY);
    if (savedTheme && this.themes[savedTheme]) {
      this.currentTheme = savedTheme;
    } else {
      // Check system preference
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      this.currentTheme = prefersDark ? 'dark' : 'dark';
    }
  }

  saveTheme(theme) {
    localStorage.setItem(THEME_STORAGE_KEY, theme);
  }

  applyTheme(theme) {
    // Remove all theme attributes
    document.documentElement.removeAttribute('data-theme');
    
    // Apply new theme (only if not default dark)
    if (theme !== 'dark') {
      document.documentElement.setAttribute('data-theme', theme);
    }
    
    this.currentTheme = theme;
    this.saveTheme(theme);
    
    // Update theme switcher UI
    this.updateThemeSwitcherUI(theme);
    
    // Dispatch custom event for other scripts to listen to
    window.dispatchEvent(new CustomEvent('themechange', { 
      detail: { theme, themes: this.themes }
    }));
  }

  setTheme(theme) {
    if (this.themes[theme]) {
      this.applyTheme(theme);
    }
  }

  toggleTheme() {
    const themeKeys = Object.keys(this.themes);
    const currentIndex = themeKeys.indexOf(this.currentTheme);
    const nextIndex = (currentIndex + 1) % themeKeys.length;
    this.setTheme(themeKeys[nextIndex]);
  }

  getTheme() {
    return this.currentTheme;
  }

  getThemes() {
    return this.themes;
  }

  initThemeSwitcher() {
    const themeButtons = document.querySelectorAll('[data-theme-switcher]');
    
    themeButtons.forEach(button => {
      button.addEventListener('click', () => {
        const theme = button.getAttribute('data-theme');
        if (theme) {
          this.setTheme(theme);
        } else {
          this.toggleTheme();
        }
      });
    });

    // Theme button in navbar or settings
    const settingsButtons = document.querySelectorAll('[data-theme-btn]');
    settingsButtons.forEach(button => {
      const theme = button.getAttribute('data-theme-btn');
      if (theme) {
        button.addEventListener('click', () => {
          this.setTheme(theme);
        });
      }
    });
  }

  updateThemeSwitcherUI(activeTheme) {
    // Update all theme switcher buttons
    const themeButtons = document.querySelectorAll('[data-theme-switcher]');
    themeButtons.forEach(button => {
      const theme = button.getAttribute('data-theme');
      if (theme === activeTheme) {
        button.classList.add('active');
      } else {
        button.classList.remove('active');
      }
    });

    // Update theme dropdown buttons
    const dropdownButtons = document.querySelectorAll('[data-theme-btn]');
    dropdownButtons.forEach(button => {
      const theme = button.getAttribute('data-theme-btn');
      if (theme === activeTheme) {
        button.classList.add('active');
      } else {
        button.classList.remove('active');
      }
    });

    // Update theme indicator if exists
    const indicator = document.querySelector('.theme-indicator');
    if (indicator) {
      indicator.textContent = this.themes[activeTheme].name;
    }
  }

  watchSystemTheme() {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    
    mediaQuery.addEventListener('change', (e) => {
      // Only auto-switch if user hasn't manually set a preference
      const savedTheme = localStorage.getItem(THEME_STORAGE_KEY);
      if (!savedTheme) {
        this.applyTheme(e.matches ? 'dark' : 'light');
      }
    });
  }

  enableTransition() {
    // Add transition class after first load
    setTimeout(() => {
      document.documentElement.classList.add(THEME_TRANSITION_CLASS);
    }, 100);
  }

  disableTransition() {
    document.documentElement.classList.remove(THEME_TRANSITION_CLASS);
  }
}

// ==========================================
// Theme Switcher UI Component
// ==========================================
const createThemeSwitcher = (container) => {
  const themes = Object.entries(THEMES);
  const themeSwitcher = document.createElement('div');
  themeSwitcher.className = 'theme-switcher';
  themeSwitcher.setAttribute('role', 'radiogroup');
  themeSwitcher.setAttribute('aria-label', 'Choisir un thème');

  themes.forEach(([key, theme]) => {
    const button = document.createElement('button');
    button.className = 'theme-switcher-btn';
    button.setAttribute('data-theme-switcher', key);
    button.setAttribute('data-theme', key);
    button.setAttribute('role', 'radio');
    button.setAttribute('aria-checked', 'false');
    button.setAttribute('title', theme.name);
    button.setAttribute('aria-label', `${theme.name} - ${theme.description}`);
    
    // Icon based on theme type
    let iconSVG = '';
    switch (theme.icon) {
      case 'moon':
        iconSVG = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>`;
        break;
      case 'sun':
        iconSVG = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="5"/>
          <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
        </svg>`;
        break;
      case 'star':
        iconSVG = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
        </svg>`;
        break;
    }
    
    button.innerHTML = iconSVG;
    
    button.addEventListener('click', () => {
      window.themeManager.setTheme(key);
    });
    
    themeSwitcher.appendChild(button);
  });

  if (container) {
    container.appendChild(themeSwitcher);
  }

  return themeSwitcher;
};

// ==========================================
// Initialize Theme Manager
// ==========================================
let themeManager = null;

document.addEventListener('DOMContentLoaded', () => {
  // Initialize theme manager
  themeManager = new ThemeManager();
  
  // Make globally accessible
  window.themeManager = themeManager;
  
  // Create theme switcher in navbar if container exists
  const themeContainer = document.getElementById('theme-switcher-container');
  if (themeContainer) {
    createThemeSwitcher(themeContainer);
  }

  // Initialize mobile theme dropdown
  const mobileDropdown = document.querySelector('.mobile-theme-dropdown');
  const mobileToggle = document.getElementById('mobile-theme-toggle');
  const mobileMenu = document.getElementById('mobile-theme-dropdown-menu');
  const dropdownItems = document.querySelectorAll('.theme-dropdown-item');
  const themeCurrent = document.getElementById('mobile-theme-current');

  // Theme names map
  const themeNames = {
    dark: 'Dark',
    light: 'Light',
    royal: 'Royal'
  };

  // Toggle dropdown
  mobileToggle?.addEventListener('click', () => {
    mobileDropdown.classList.toggle('open');
  });

  // Handle theme selection
  dropdownItems.forEach(item => {
    item.addEventListener('click', () => {
      const theme = item.getAttribute('data-theme');
      if (theme) {
        window.themeManager.setTheme(theme);
        if (themeCurrent) {
          themeCurrent.textContent = themeNames[theme] || 'Dark';
        }
        dropdownItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        mobileDropdown.classList.remove('open');
      }
    });
  });

  // Update current theme on load
  const currentTheme = window.themeManager.getTheme();
  if (themeCurrent) {
    themeCurrent.textContent = themeNames[currentTheme] || 'Dark';
  }

  // ==========================================
  // Themes Showcase in About Section
  // ==========================================
  const themesShowcase = document.querySelector('.themes-showcase');
  const themeItems = document.querySelectorAll('.theme-item');

  // Function to update visible theme
  const updateThemesShowcase = (activeTheme) => {
    if (!themesShowcase) return;

    // Add active class to showcase
    themesShowcase.classList.add('active');

    themeItems.forEach(item => {
      // Determine which theme this item represents
      let itemThemeKey = 'dark';
      if (item.hasAttribute('data-theme-light')) itemThemeKey = 'light';
      else if (item.hasAttribute('data-theme-royal')) itemThemeKey = 'royal';

      // Show only the active theme, hide others
      if (itemThemeKey === activeTheme) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  };

  // Initialize showcase on load
  updateThemesShowcase(currentTheme);

  // Listen for theme changes
  window.addEventListener('themechange', (e) => {
    updateThemesShowcase(e.detail.theme);
  });

  // Add CSS for theme transition
  const style = document.createElement('style');
  style.textContent = `
    .theme-transitioning,
    .theme-transitioning * {
      transition: background-color 0.3s ease, 
                  color 0.3s ease, 
                  border-color 0.3s ease,
                  box-shadow 0.3s ease !important;
    }
    
    .theme-switcher {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }
    
    .theme-switcher-btn {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--color-border);
      border-radius: 50%;
      background: transparent;
      color: var(--color-foreground);
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .theme-switcher-btn:hover {
      border-color: var(--color-primary);
      color: var(--color-primary);
    }
    
    .theme-switcher-btn.active {
      border-color: var(--color-primary);
      background: var(--color-primary);
      color: var(--color-primary-foreground);
    }
    
    .theme-switcher-btn svg {
      width: 18px;
      height: 18px;
    }
  `;
  document.head.appendChild(style);

  console.log('Theme Manager initialized:', themeManager.getTheme());
});
