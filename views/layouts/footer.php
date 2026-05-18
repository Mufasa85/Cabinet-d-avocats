<?php
/**
 * ELMD - Cabinet d'Avocats
 * Footer Layout
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$currentYear = date('Y');
?>
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="<?= ELMD_ROOT ?>/index.php" class="navbar-logo">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
              <circle cx="12" cy="3" r="1" fill="currentColor"/>
              <path d="M7 21h10M9 21v-3h6v3"/>
            </svg>
            <span class="logo-text">ELMD</span>
          </a>
          <p class="footer-tagline">L'excellence juridique au service de votre réussite depuis 1985.</p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                <rect x="2" y="9" width="4" height="12"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
              </svg>
            </a>
          </div>
        </div>
        
        <div class="footer-links">
          <h4>Le Cabinet</h4>
          <ul>
            <li><a href="<?= ELMD_ROOT ?>/#cabinet">Notre Histoire</a></li>
            <li><a href="<?= ELMD_ROOT ?>/#equipe">Notre Équipe</a></li>
            <li><a href="<?= ELMD_ROOT ?>/#expertises">Nos Expertises</a></li>
            <li><a href="<?= ELMD_ROOT ?>/actualites.php">Actualités</a></li>
          </ul>
        </div>
        
        <div class="footer-links">
          <h4>Expertises</h4>
          <ul>
            <li><a href="<?= ELMD_ROOT ?>/droit-ohada.php">Droit OHADA</a></li>
            <li><a href="<?= ELMD_ROOT ?>/droit-minier.php">Droit Minier</a></li>
            <li><a href="<?= ELMD_ROOT ?>/droit-travail.php">Droit Travail</a></li>
            <li><a href="<?= ELMD_ROOT ?>/droit-fiscal.php">Droit Fiscal</a></li>
          </ul>
        </div>
        
        <div class="footer-links">
          <h4>Contact</h4>
          <ul>
            <li>448, Avenue Maduda</li>
            <li>Quartier Biashara, Dilala, Kolwezi, Lualaba</li>
            <li>+243 811 403 315</li>
            <li>laurentmbako@etudelmbako.com</li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; <?= $currentYear ?> ELMD Avocats. Tous droits réservés.</p>
        <div class="footer-legal">
          <a href="<?= ELMD_ROOT ?>/mentions-legales.php">Mentions légales</a>
          <a href="<?= ELMD_ROOT ?>/politique-confidentialite.php">Politique de confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script type="module" src="<?= ELMD_ROOT ?>/js/theme.js"></script>
  <script type="module" src="<?= ELMD_ROOT ?>/js/main.js"></script>
</body>
</html>