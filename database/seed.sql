-- Données initiales — Cabinet d'Avocats
USE cabinet_platform;



INSERT INTO specialites (nom, slug, descriptions) VALUES
('Droit des Affaires', 'droit-affaires', 'Conseil et contentieux en droit des affaires'),
('Droit Fiscal', 'droit-fiscal', 'Fiscalité nationale et internationale'),
('Droit du Travail', 'droit-travail', 'Relations individuelles et collectives'),
('Droit Minier', 'droit-minier', 'Permis, contrats et compliance minière'),
('Droit OHADA', 'ohada', 'Actes uniformes et droit commercial harmonisé')
ON DUPLICATE KEY UPDATE nom = nom;

INSERT INTO categories (nom, slug) VALUES
('Droit des Affaires', 'droit-affaires'),
('Droit Minier', 'droit-minier'),
('Droit Fiscal', 'droit-fiscal'),
('Droit du Travail', 'droit-travail'),
('OHADA', 'ohada')
ON DUPLICATE KEY UPDATE nom = nom;

INSERT INTO avocats (user_id, titre, email_professionnel, bio, experience, bureau)
SELECT id, 'Avocat associé', email, 'Expert en droit des affaires et investissements.', 12, 'Kinshasa'
FROM users WHERE email = 'avocat@cabinet.avocat'
AND NOT EXISTS (SELECT 1 FROM avocats a JOIN users u ON a.user_id = u.id WHERE u.email = 'avocat@cabinet.avocat');

INSERT INTO avocat_specialites (avocat_id, specialite_id)
SELECT a.id, s.id
FROM avocats a
JOIN users u ON a.user_id = u.id
JOIN specialites s ON s.slug IN ('droit-affaires', 'droit-fiscal')
WHERE u.email = 'avocat@cabinet.avocat'
ON DUPLICATE KEY UPDATE avocat_id = avocat_id;

INSERT INTO stagiaires (user_id, universite, filiere, niveau_etude, departement, statut)
SELECT id, 'Université de Kinshasa', 'Droit des Affaires', 'M2', 'Droit des Affaires', 'actif'
FROM users WHERE email = 'stagiaire@cabinet.avocat'
AND NOT EXISTS (SELECT 1 FROM stagiaires st JOIN users u ON st.user_id = u.id WHERE u.email = 'stagiaire@cabinet.avocat');

INSERT INTO formations (titre, slug, description, places_max, public_cible, statut, date_debut, date_fin) VALUES
(
  'Formation continue — Due diligence M&A',
  'due-diligence-ma',
  'Atelier pratique sur la due diligence en fusions-acquisitions.',
  15,
  'avocat',
  'ouverte',
  '2026-06-15',
  '2026-06-17'
),
(
  'Perfectionnement — Fiscalité des sociétés',
  'fiscalite-societes',
  'Programme de mise à jour en droit fiscal des sociétés en RDC.',
  20,
  'tous',
  'ouverte',
  '2026-07-01',
  '2026-07-03'
),
(
  'Atelier stagiaires — Rédaction d''actes',
  'redaction-actes-stagiaires',
  'Formation dédiée aux stagiaires sur la rédaction d''actes juridiques.',
  10,
  'stagiaire',
  'ouverte',
  '2026-05-30',
  '2026-05-31'
)
ON DUPLICATE KEY UPDATE titre = titre;


INSERT INTO users (fullname, email, passwords, roles, is_active) 
VALUES ('Admin', 'admin@test.com', '$2y$10$...', 'admin', 1);
