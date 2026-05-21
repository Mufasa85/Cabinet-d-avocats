<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Avocat | ELMD - Cabinet d'Avocats</title>
  <meta name="description" content="Profil d'un avocat du cabinet ELMD">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/profile.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar">
    <div class="navbar-container">
      <a href="index.php" class="navbar-logo">
        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
          <circle cx="12" cy="3" r="1" fill="currentColor"/>
          <path d="M7 21h10M9 21v-3h6v3"/>
        </svg>
        <span class="logo-text">ELMD</span>
      </a>
      <!-- Desktop Menu -->
      
      <!-- Theme Switcher -->
      <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>
      <!-- Mobile Menu Button -->
    </div>
  </nav>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-1"></div>
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-2"></div>
    <div class="mobile-menu-content">
      <div class="mobile-menu-header">
        <a href="index.php" class="navbar-logo">
          <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
            <circle cx="12" cy="3" r="1" fill="currentColor"/>
            <path d="M7 21h10M9 21v-3h6v3"/>
          </svg>
          <span class="logo-text">ELMD</span>
        </a>
        <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Fermer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="mobile-menu-links">
        <a href="index.php" class="mobile-link">
          <span>Accueil</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#cabinet" class="mobile-link">
          <span>Le Cabinet</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#expertises" class="mobile-link">
          <span>Expertises</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#equipe" class="mobile-link">
          <span>Équipe</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#actualites" class="mobile-link">
          <span>Actualités</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#contact" class="mobile-link">
          <span>Contact</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="stages.php" class="mobile-link">
          <span>Stages</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="connexion.php" class="mobile-link">
          <span>Connexion</span>
          <span class="mobile-link-arrow">→</span>
        </a>
      </div>
      <div class="mobile-menu-footer">
        <a href="index.php#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>

  <!-- Profile Hero -->
  <section class="profile-hero">
    <div class="profile-container">
      <a href="index.php#equipe" class="profile-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        <span>Retour à l'équipe</span>
      </a>

      <div class="profile-header">
        <div class="profile-image-wrapper">
          <img id="profileImage" class="profile-image" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80" alt="Photo de l'avocat">
          <span class="profile-badge">Expert</span>
        </div>

        <div class="profile-content">
          <h1 id="profileName" class="profile-title">Jean-Pierre Dupont</h1>
          <p id="profileRole" class="profile-role">Associé Fondateur</p>
          <div id="profileSpecialty" class="profile-specialty">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18"/>
            </svg>
            <span>Droit des Affaires</span>
          </div>
          <p id="profileBio" class="profile-bio">
            Fort de plus de 20 ans d'expérience en droit des affaires, Jean-Pierre Dupont accompagne les entreprises dans leurs opérations de fusions-acquisitions, restructurations et leurs enjeux réglementaires les plus complexes. Reconnu pour son expertise transactionnelle, il a advise de nombreuses multinationales et groupes locaux sur des deals significatifs en Afrique et en Europe.
          </p>

          <div class="profile-stats">
            <div class="profile-stat">
              <div id="statYears" class="profile-stat-number">20+</div>
              <div class="profile-stat-label">Années d'expérience</div>
            </div>
            <div class="profile-stat">
              <div id="statDossiers" class="profile-stat-number">250+</div>
              <div class="profile-stat-label">Dossiers traités</div>
            </div>
            <div class="profile-stat">
              <div id="statClients" class="profile-stat-number">85+</div>
              <div class="profile-stat-label">Clients actifs</div>
            </div>
          </div>

          <div class="profile-actions">
            <a href="#contact-section" class="profile-btn profile-btn-primary">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              <span>Prendre rendez-vous</span>
            </a>
            <a id="profileLinkedIn" href="#" target="_blank" rel="noopener noreferrer" class="profile-btn profile-btn-secondary">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                <rect x="2" y="9" width="4" height="12"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
              <span>LinkedIn</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Expertise Section -->
  <section class="profile-sections">
    <div class="profile-section">
      <div class="profile-section-header">
        <div class="profile-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h2 class="profile-section-title">Domaines d'Expertise</h2>
      </div>

      <div id="expertiseGrid" class="expertise-grid">
        <div class="expertise-card">
          <div class="expertise-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            </svg>
          </div>
          <h3 class="expertise-card-title">Fusions & Acquisitions</h3>
          <p class="expertise-card-text">Accompagnement dans les opérations de M&A, due diligences, négociations et closing de transactions complexes.</p>
        </div>

        <div class="expertise-card">
          <div class="expertise-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
              <line x1="8" y1="21" x2="16" y2="21"/>
              <line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
          </div>
          <h3 class="expertise-card-title">Corporate Governance</h3>
          <p class="expertise-card-text">Conseil en gouvernance d'entreprise, restructurations de groupes et optimisation de structures juridiques.</p>
        </div>

        <div class="expertise-card">
          <div class="expertise-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
          </div>
          <h3 class="expertise-card-title">Droit International</h3>
          <p class="expertise-card-text">Expertise en droit international des affaires, contrats internationaux et gestion de litiges transfrontaliers.</p>
        </div>

        <div class="expertise-card">
          <div class="expertise-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="12" y1="1" x2="12" y2="23"/>
              <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
          </div>
          <h3 class="expertise-card-title">Finance & Investissement</h3>
          <p class="expertise-card-text">Conseil en structuration de financements, levées de fonds et opérations de capital-investissement.</p>
        </div>
      </div>
    </div>

    <!-- Education Section -->
    <div class="profile-section">
      <div class="profile-section-header">
        <div class="profile-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
          </svg>
        </div>
        <h2 class="profile-section-title">Formation</h2>
      </div>

      <div id="educationTimeline" class="education-timeline">
        <div class="education-item">
          <span class="education-year">2004</span>
          <h4 class="education-degree">Master 2 en Droit des Affaires</h4>
          <p class="education-school">Université Paris 1 Panthéon-Sorbonne</p>
        </div>
        <div class="education-item">
          <span class="education-year">2002</span>
          <h4 class="education-degree">Licence en Droit</h4>
          <p class="education-school">Université de Kinshasa</p>
        </div>
        <div class="education-item">
          <span class="education-year">2000</span>
          <h4 class="education-degree">Baccalauréat Série C</h4>
          <p class="education-school">Lycée de la Référence, Kinshasa</p>
        </div>
      </div>
    </div>

    <!-- Publications Section -->
    <div class="profile-section">
      <div class="profile-section-header">
        <div class="profile-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10 9 9 9 8 9"/>
          </svg>
        </div>
        <h2 class="profile-section-title">Publications</h2>
      </div>

      <div id="publicationsList" class="publications-list">
        <div class="publication-item">
          <div class="publication-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
            </svg>
          </div>
          <div class="publication-content">
            <span class="publication-date">Décembre 2023</span>
            <h4 class="publication-title">Les enjeux de la conformité OHADA pour les PME africaines</h4>
            <span class="publication-type">Article juridique</span>
          </div>
        </div>

        <div class="publication-item">
          <div class="publication-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
            </svg>
          </div>
          <div class="publication-content">
            <span class="publication-date">Septembre 2023</span>
            <h4 class="publication-title">Guide pratique des fusions transfrontalières en Afrique centrale</h4>
            <span class="publication-type">Étude approfondie</span>
          </div>
        </div>

        <div class="publication-item">
          <div class="publication-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
            </svg>
          </div>
          <div class="publication-content">
            <span class="publication-date">Mars 2023</span>
            <h4 class="publication-title">L'arbitrage international comme alternative aux litiges commerciaux</h4>
            <span class="publication-type">Tribune</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <div id="contact-section" class="profile-section">
      <div class="profile-section-header">
        <div class="profile-section-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
        </div>
        <h2 class="profile-section-title">Contact</h2>
      </div>

      <div class="contact-card">
        <div class="contact-grid">
          <div class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
            </div>
            <div>
              <span class="contact-label">Email</span>
              <p id="contactEmail" class="contact-value">
                <a href="mailto:jean-pierre.dupont@elmd.com">jean-pierre.dupont@elmd.com</a>
              </p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </div>
            <div>
              <span class="contact-label">Téléphone</span>
              <p id="contactPhone" class="contact-value">+243 811 403 315</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <div>
              <span class="contact-label">Bureau</span>
              <p class="contact-value">448, Avenue Maduda, Kolwezi</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <div>
              <span class="contact-label">Disponibilité</span>
              <p class="contact-value">Lun - Ven : 8h00 - 17h00</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <script type="module" src="js/theme.js"></script>
  <script>
    // Données des avocats (simulées - à remplacer par des données réelles depuis la base)
    const avocatsData = {
      1: {
        name: "Jean-Pierre Dupont",
        role: "Associé Fondateur",
        specialty: "Droit des Affaires",
        image: "https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80",
        bio: "Fort de plus de 20 ans d'expérience en droit des affaires, Jean-Pierre Dupont accompagne les entreprises dans leurs opérations de fusions-acquisitions, restructurations et leurs enjeux réglementaires les plus complexes. Reconnu pour son expertise transactionnelle, il a advise de nombreuses multinationales et groupes locaux sur des deals significatifs en Afrique et en Europe.",
        years: "20+",
        dossiers: "250+",
        clients: "85+",
        linkedin: "https://linkedin.com/in/jean-pierre-dupont",
        email: "jean-pierre.dupont@elmd.com",
        phone: "+243 811 403 315",
        expertises: [
          { icon: "cube", title: "Fusions & Acquisitions", text: "Accompagnement dans les opérations de M&A, due diligences, négociations et closing de transactions complexes." },
          { icon: "monitor", title: "Corporate Governance", text: "Conseil en gouvernance d'entreprise, restructurations de groupes et optimisation de structures juridiques." },
          { icon: "globe", title: "Droit International", text: "Expertise en droit international des affaires, contrats internationaux et gestion de litiges transfrontaliers." },
          { icon: "dollar", title: "Finance & Investissement", text: "Conseil en structuration de financements, levées de fonds et opérations de capital-investissement." }
        ],
        education: [
          { year: "2004", degree: "Master 2 en Droit des Affaires", school: "Université Paris 1 Panthéon-Sorbonne" },
          { year: "2002", degree: "Licence en Droit", school: "Université de Kinshasa" },
          { year: "2000", degree: "Baccalauréat Série C", school: "Lycée de la Référence, Kinshasa" }
        ],
        publications: [
          { date: "Décembre 2023", title: "Les enjeux de la conformité OHADA pour les PME africaines", type: "Article juridique" },
          { date: "Septembre 2023", title: "Guide pratique des fusions transfrontalières en Afrique centrale", type: "Étude approfondie" },
          { date: "Mars 2023", title: "L'arbitrage international comme alternative aux litiges commerciaux", type: "Tribune" }
        ]
      },
      2: {
        name: "Marie-Claire Bernard",
        role: "Associée Senior",
        specialty: "Droit Fiscal",
        image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80",
        bio: "Marie-Claire Bernard est spécialiste en droit fiscal international avec plus de 15 ans d'expérience. Elle conseille les groupes multinationaux et les particuliers fortunés sur l'optimisation fiscale, la structuration patrimoniale et les enjeux de conformité fiscale.",
        years: "15+",
        dossiers: "180+",
        clients: "60+",
        linkedin: "https://linkedin.com/in/marie-claire-bernard",
        email: "marie-claire.bernard@elmd.com",
        phone: "+243 811 403 315",
        expertises: [
          { icon: "percent", title: "Optimisation Fiscale", text: "Stratégies d'optimisation fiscale pour entreprises et particuliers dans le respect des lois." },
          { icon: "file-text", title: "Fiscalité des Transactions", text: "Conseil en structuration fiscale des opérations de M&A et autres transactions." },
          { icon: "building", title: "Fiscalité des Groups", text: "Accompagnement des groupes internationaux dans leur organisation fiscale." },
          { icon: "shield", title: "Compliance Fiscale", text: "Assistance dans la mise en conformité avec les différentes réglementations fiscales." }
        ],
        education: [
          { year: "2008", degree: "LL.M. Fiscalité Internationale", school: "Université de Genève" },
          { year: "2006", degree: "Master 2 Droit Fiscal", school: "Université Paris 2 Assas" },
          { year: "2004", degree: "Licence en Droit", school: "Université de Lubumbashi" }
        ],
        publications: [
          { date: "Novembre 2023", title: "La réforme fiscale en RDC : impacts et opportunités", type: "Analyse" },
          { date: "Juillet 2023", title: "Stratégies de planification fiscale pour les groupes africains", type: "Guide pratique" }
        ]
      },
      3: {
        name: "Alexandre Martin",
        role: "Associé",
        specialty: "Droit International",
        image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80",
        bio: "Alexandre Martin est expert en droit international et en arbitration commercial. Il représente les clients dans les différends internationaux et les conseille sur les contrats transfrontaliers complexes.",
        years: "12+",
        dossiers: "150+",
        clients: "45+",
        linkedin: "https://linkedin.com/in/alexandre-martin",
        email: "alexandre.martin@elmd.com",
        phone: "+243 811 403 315",
        expertises: [
          { icon: "globe", title: "Droit International Privé", text: "Gestion des aspects juridiques des relations commerciales internationales." },
          { icon: "scale", title: "Arbitrage International", text: "Représentation devant les tribunaux arbitraux internationaux (CCI, CIRDI)." },
          { icon: "file-signature", title: "Contrats Internationaux", text: "Négociation et rédaction de contrats commerciaux internationaux." },
          { icon: "truck", title: "Commerce International", text: "Conseil en import-export, douanes et régulation du commerce international." }
        ],
        education: [
          { year: "2011", degree: "Master 2 Droit International", school: "Université Paris 1 Panthéon-Sorbonne" },
          { year: "2009", degree: "Licence en Droit", school: "Université de Kinshasa" }
        ],
        publications: [
          { date: "Octobre 2023", title: "L'arbitrage CIRDI : procédures et bonnes pratiques", type: "Guide" },
          { date: "Mai 2023", title: "Les contrats FIDIC dans les projets d'infrastructure", type: "Analyse juridique" }
        ]
      },
      4: {
        name: "Sophie Laurent",
        role: "Counsel",
        specialty: "Droit Social",
        image: "https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=80",
        bio: "Sophie Laurent est spécialisée en droit du travail et droit social. Elle accompagne les entreprises dans la gestion de leurs ressources humaines, les relations collectives et individuelles, ainsi que les contentieux sociaux.",
        years: "10+",
        dossiers: "120+",
        clients: "40+",
        linkedin: "https://linkedin.com/in/sophie-laurent",
        email: "sophie.laurent@elmd.com",
        phone: "+243 811 403 315",
        expertises: [
          { icon: "users", title: "Relations de Travail", text: "Conseil en gestion des relations entre employeurs et salariés." },
          { icon: "file-check", title: "Contrats de Travail", text: "Rédaction et négociation de contrats de travail et conventions collectives." },
          { icon: "alert-triangle", title: "Contentieux Social", text: "Représentation devant les juridictions sociales et conseils de prud'hommes." },
          { icon: "trending-up", title: "Restructurations", text: "Accompagnement dans les plans sociaux et licenciements économiques." }
        ],
        education: [
          { year: "2013", degree: "Master 2 Droit Social", school: "Université Paris 2 Assas" },
          { year: "2011", degree: "Licence en Droit", school: "Université de Kinshasa" }
        ],
        publications: [
          { date: "Août 2023", title: "Le nouveau Code du travail congolais : analyse comparative", type: "Étude" }
        ]
      }
    };

    // Charger les données en fonction de l'ID
    function loadProfile() {
      const urlParams = new URLSearchParams(window.location.search);
      const id = parseInt(urlParams.get('id')) || 1;
      
      const avocat = avocatsData[id] || avocatsData[1];
      
      // Mise à jour des éléments
      document.getElementById('profileImage').src = avocat.image;
      document.getElementById('profileImage').alt = avocat.name;
      document.getElementById('profileName').textContent = avocat.name;
      document.getElementById('profileRole').textContent = avocat.role;
      document.getElementById('profileSpecialty').querySelector('span').textContent = avocat.specialty;
      document.getElementById('profileBio').textContent = avocat.bio;
      document.getElementById('statYears').textContent = avocat.years;
      document.getElementById('statDossiers').textContent = avocat.dossiers;
      document.getElementById('statClients').textContent = avocat.clients;
      document.getElementById('profileLinkedIn').href = avocat.linkedin;
      document.getElementById('contactEmail').innerHTML = `<a href="mailto:${avocat.email}">${avocat.email}</a>`;
      document.getElementById('contactPhone').textContent = avocat.phone;

      // Mise à jour du titre de la page
      document.title = `${avocat.name} | ELMD - Cabinet d'Avocats`;

      // Mise à jour des expertises
      const expertiseGrid = document.getElementById('expertiseGrid');
      expertiseGrid.innerHTML = avocat.expertises.map(exp => `
        <div class="expertise-card">
          <div class="expertise-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              ${getIconSvg(exp.icon)}
            </svg>
          </div>
          <h3 class="expertise-card-title">${exp.title}</h3>
          <p class="expertise-card-text">${exp.text}</p>
        </div>
      `).join('');

      // Mise à jour de l'éducation
      const educationTimeline = document.getElementById('educationTimeline');
      educationTimeline.innerHTML = avocat.education.map(edu => `
        <div class="education-item">
          <span class="education-year">${edu.year}</span>
          <h4 class="education-degree">${edu.degree}</h4>
          <p class="education-school">${edu.school}</p>
        </div>
      `).join('');

      // Mise à jour des publications
      const publicationsList = document.getElementById('publicationsList');
      publicationsList.innerHTML = avocat.publications.map(pub => `
        <div class="publication-item">
          <div class="publication-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
            </svg>
          </div>
          <div class="publication-content">
            <span class="publication-date">${pub.date}</span>
            <h4 class="publication-title">${pub.title}</h4>
            <span class="publication-type">${pub.type}</span>
          </div>
        </div>
      `).join('');
    }

    // Fonction helper pour les icônes
    function getIconSvg(icon) {
      const icons = {
        cube: '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>',
        monitor: '<rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
        globe: '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
        dollar: '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
        percent: '<line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/>',
        'file-text': '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>',
        building: '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>',
        shield: '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'file-signature': '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h2"/><path d="M8 17h2"/><path d="M14 13h2"/><path d="M14 17h2"/>',
        truck: '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
        users: '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'file-check': '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15l2 2 4-4"/>',
        'alert-triangle': '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
        'trending-up': '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'
      };
      return icons[icon] || '<circle cx="12" cy="12" r="10"/>';
    }

    // Charger le profil au démarrage
    document.addEventListener('DOMContentLoaded', loadProfile);
  </script>
</body>
</html>