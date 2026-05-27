<?php
// Les variables sont passées par HomeController::login()
// error, success, rememberEmail

// S'assurer que les variables existent (fallback)
$error = $error ?? $_SESSION['error'] ?? null;
$success = $success ?? $_SESSION['success'] ?? null;
$rememberedEmail = $rememberEmail ?? $_COOKIE['remember_email'] ?? '';

// Nettoyer les messages après lecture
if (isset($_SESSION['error'])) unset($_SESSION['error']);
if (isset($_SESSION['success'])) unset($_SESSION['success']);

?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | ELMD Cabinet d'Avocats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="css/connexion.css">
</head>

<body class="connexion-body">
    <!-- Navigation -->
    <header class="navbar">
        <div class="container">
            <a href="<?= Router\Router::route('/') ?>" class="logo">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
                    <circle cx="12" cy="3" r="1" fill="currentColor" />
                    <path d="M7 21h10M9 21v-3h6v3" />
                </svg>
                <span class="logo-text">ELMD</span>
            </a>
            <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>
        </div>
    </header>

    <!-- Login Section -->
    <section class="login-section">
        <div class="login-bg">
            <div class="login-gradient"></div>
            <div class="login-pattern"></div>
        </div>

        <div class="login-container">
            <div class="login-card animate-on-scroll">
                <div class="login-header">
                    <div class="login-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <h1>Bienvenue</h1>
                    <p>Connectez-vous à votre espace</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                            <path d="M9 12l2 2 4-4" />
                        </svg>
                        <span><?= htmlspecialchars($success) ?></span>
                    </div>
                <?php endif; ?>

                <form class="login-form" id="loginForm" method="POST" action="<?= Router\Router::route('/login') ?>">
                    <?= \Core\Security::csrf_tokken() ?>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" required placeholder="votre@email.com" value="<?= htmlspecialchars($rememberedEmail ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required placeholder="••••••••">
                            <button type="button" class="password-toggle" id="togglePassword" title="Afficher/Masquer le mot de passe">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkbox-custom"></span>
                            <span>Se souvenir de moi</span>
                        </label>
                        <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <span>Se connecter</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>

                <div class="register-link">
                    <p><a href="<?= Router\Router::route('/') ?>">Retour à l'accueil</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="login-footer">
        <p>&copy; <?= date('Y') ?> ELMD & Associés. <a href="#">Politique de confidentialité</a></p>
    </footer>

    <script type="module" src="js/theme.js"></script>
    <script>
        // Password toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            const eyeIcon = togglePassword.querySelector('svg');
            if (type === 'text') {
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        });

        // Animation on scroll - add visible class immediately for login page
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            el.classList.add('visible');
        });
    </script>
</body>

</html>