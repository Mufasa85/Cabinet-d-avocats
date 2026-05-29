-- Migration: Seed Articles
-- Exécutez ce fichier après schema.sql et seed.sql pour ajouter des articles de test

USE cabinet_platform;

-- =====================================================
-- ARTICLES DE TEST
-- =====================================================

-- Récupérer l'ID de l'avocat pour les articles
SET
    @avocat_id = (
        SELECT a.id
        FROM avocats a
            JOIN users u ON a.user_id = u.id
        LIMIT 1
    );

-- Catégorie ID pour les articles
SET
    @cat_affaires = (
        SELECT id
        FROM categories
        WHERE
            slug = 'droit-affaires'
        LIMIT 1
    );

SET
    @cat_minier = (
        SELECT id
        FROM categories
        WHERE
            slug = 'droit-minier'
        LIMIT 1
    );

SET
    @cat_fiscal = (
        SELECT id
        FROM categories
        WHERE
            slug = 'droit-fiscal'
        LIMIT 1
    );

SET
    @cat_travail = (
        SELECT id
        FROM categories
        WHERE
            slug = 'droit-travail'
        LIMIT 1
    );

SET
    @cat_ohada = (
        SELECT id
        FROM categories
        WHERE
            slug = 'ohada'
        LIMIT 1
    );

-- Article 1 - À la une (Droit des Affaires)
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_affaires,
        'Réformes du Code des Investissements en République Démocratique du Congo',
        'reformes-code-investissements-rdc',
        'Une analyse approfondie des récentes modifications législatives visant à améliorer le climat des investissements et à simplifier les procédures administratives.',
        '<p>La République Démocratique du Congo a récemment amendé son Code des Investissements, marquant un tournant majeur dans l''approche du pays pour attirer les capitaux étrangers. Ces réformes visent à créer un environnement des affaires plus favorable tout en protégeant les intérêts nationaux.</p><h2>Les Principales Modifications</h2><p>La nouvelle législation introduit plusieurs changements clés qui impacteront les investisseurs locaux et internationaux. Parmi les plus significatifs figurent la simplification des procédures d''enregistrement et le renforcement de la protection des investissements étrangers contre l''expropriation.</p><ul><li>Réduction des démarches administratives pour la création d''entreprise</li><li>Incitations fiscales pour les secteurs stratégiques incluant les mines et l''agriculture</li><li>Mécanismes améliorés de règlement des différends</li><li>Protection des droits de propriété intellectuelle</li></ul><h2>Implications pour les Investisseurs</h2><p>Pour les investisseurs étrangers, ces changements représentent une opportunité significative. Le gouvernement a également introduit des garanties contre les risques politiques, ce qui devrait renforcer la confiance pour les investissements à long terme.</p>',
        'publie',
        '2026-05-15 10:00:00'
    );

-- Article 2 - Droit Minier
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_minier,
        'Les Nouvelles Obligations Environnementales pour les Titulaires de Permis Miniers',
        'nouvelles-obligations-environnementales-permis-miniers',
        'Décryptage des nouvelles normes environnementales imposées aux entreprises minières opérant en RDC et leurs implications pratiques.',
        '<p>Les titulaires de permis miniers en République Démocratique du Congo font face à de nouvelles obligations environnementales strictes. Ces mesures visent à garantir une exploitation minière responsable et durable sur le territoire national.</p><h2>Cadre Réglementaire</h2><p>Le Code Minier de 2002, tel que modifié en 2018, impose désormais des exigences plus rigoureuses en matière de protection de l''environnement. Les entreprises minières doivent démontrer leur engagement envers des pratiques durables.</p><ul><li>Études d''impact environnemental obligatoires avant le démarrage des opérations</li><li>Plans de réhabilitation des sites miniers après exploitation</li><li>Gestion des déchets et eaux usées conforme aux normes internationales</li><li>Programmes de reforestation et compensation environnementale</li></ul><h2>Sanctions et Conformité</h2><p>Le non-respect de ces obligations peut entraîner des sanctions sévères, incluant la suspension ou le retrait des permis miniers.</p>',
        'publie',
        '2026-05-10 09:00:00'
    );

-- Article 3 - Droit Fiscal
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_fiscal,
        'Optimisation Fiscale Internationale : Stratégies et Conformité',
        'optimisation-fiscale-internationale',
        'Guide pratique sur les stratégies d''optimisation fiscale dans le respect des nouvelles réglementations nationales et internationales.',
        '<p>L''optimisation fiscale internationale demeure un sujet brûlant pour les entreprises opérant à travers plusieurs juridictions. Les autorités fiscales congolaises intensifient leurs contrôles et les entreprises doivent adopter des stratégies conformes aux normes internationales.</p><h2>Évolution du Paysage Fiscal</h2><p>Les traités de double imposition et les règles de transfert pricing jouent un rôle crucial dans la planification fiscale des multinationales. La RDC a signé plusieurs accords bilatéraux pour éviter la double imposition.</p><ul><li>Utilisation optimale des incitations fiscales prévues par la loi</li><li>Planification de la structure des sociétés holding</li><li>Gestion des prix de transfert dans le respect des règles OECD</li><li>Structuration des flux de dividendes et royalties</li></ul><p>Notre équipe vous accompagne dans l''élaboration de stratégies fiscales responsables.</p>',
        'publie',
        '2026-05-05 08:00:00'
    );

-- Article 4 - Droit du Travail
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_travail,
        'Rupture Conventionnelle : Tout ce que l''Employeur Doit Savoir',
        'rupture-conventionnelle-guide-employeur',
        'Procédure, négociation et conséquences fiscales de la rupture conventionnelle du contrat de travail en droit congolais.',
        '<p>La rupture conventionnelle constitue un mode de séparation amiable entre employeur et salarié, régi par le Code du Travail congolais. Elle offre une alternative aux licenciements et permet une négociation des conditions de départ.</p><h2>Procédure à Suivre</h2><p>La rupture conventionnelle doit respecter une procédure stricte incluant un entretien préalable durant lequel les parties discutent des conditions de séparation.</p><ul><li>Entretien de négociation des conditions</li><li>Rédaction du protocole de rupture</li><li>Demande d''homologation auprès de l''Inspection du Travail</li><li>Délai de rétractation de 15 jours</li></ul><h2>Conséquences Fiscales</h2><p>Les indemnités versées sont soumises à des règles fiscales spécifiques.</p>',
        'publie',
        '2026-04-28 14:00:00'
    );

-- Article 5 - OHADA
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_ohada,
        'L''Acte Uniforme sur le Droit Commercial : Actualités et Jurisprudence',
        'acte-uniforme-droit-commercial-jurisprudence',
        'Analyse des récentes décisions de justice interprétant les dispositions de l''AUDCG et leurs impacts sur les opérations commerciales.',
        '<p>L''Acte Uniforme relatif au Droit Commercial Général (AUDCG) constitue le socle du droit commercial dans les États membres de l''OHADA. Les juridictions nationales rendent régulièrement des décisions qui enrichissent l''interprétation de ce texte fondamental.</p><h2>Jurisprudence Récente</h2><p>Les Cours d''appel et la Cour Commune de Justice et d''Arbitrage (CCJA) ont eu à se prononcer sur plusieurs questions essentielles.</p><ul><li>Conditions de validité du contrat de vente commerciale</li><li>Responsabilité des administrateurs de société</li><li>Régime des clauses limitatives de responsabilité</li><li>Prescription des actions commerciales</li></ul><h2>Impact pour les Entreprises</h2><p>Ces décisions jurisprudentielles ont un impact direct sur les opérations commerciales quotidiennes.</p>',
        'publie',
        '2026-04-22 11:00:00'
    );

-- Article 6 - Droit des Affaires
INSERT INTO
    articles (
        avocat_id,
        category_id,
        titre,
        slug,
        extrait,
        contenu,
        statut,
        publie_le
    )
VALUES (
        @avocat_id,
        @cat_affaires,
        'Fusion et Acquisition : Due Diligence et Évaluation des Risques',
        'fusion-acquisition-due-diligence-risques',
        'Méthodologie de la due diligence dans les opérations de fusions-acquisitions et identification des risques contractuels.',
        '<p>Les opérations de fusion et acquisition requièrent une analyse approfondie des risques potentiels. La due diligence constitue une étape cruciale qui permet d''identifier les passifs cachés et d''évaluer la valeur réelle de la cible.</p><h2>Les Différentes Facettes de la Due Diligence</h2><p>Une due diligence complète doit couvrir plusieurs aspects : juridique, fiscal, financier, opérationnel et environnemental.</p><ul><li>Analyse des contrats en cours et de leurs clauses de changement de contrôle</li><li>Vérification de la conformité réglementaire</li><li>Évaluation des litiges en cours et potentiels</li><li>Analyse des engagements hors bilan</li></ul><h2>Gestion des Risques Identifiés</h2><p>Une fois les risques identifiés, différentes stratégies peuvent être mises en place.</p>',
        'publie',
        '2026-04-18 16:00:00'
    );