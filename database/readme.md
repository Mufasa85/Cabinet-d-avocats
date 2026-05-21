# SCHÉMA DE LA BASE DE DONNÉES - ELMD Cabinet d'Avocats

## Vue d'ensemble

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                              ELMD_CABINET                                   │
│                                                                             │
│  ┌─────────────┐      ┌─────────────┐      ┌─────────────┐                  │
│  │    users    │      │  specialites│      │    images   │                  │
│  │─────────────│      │─────────────│      │─────────────│                  │
│  │ id (PK)     │      │ id (PK)     │      │ id (PK)     │                  │
│  │ email       │      │ nom          │◄─────│ specialite_ │                  │
│  │ password    │      │ slug         │      │   id (FK)   │                  │
│  │ role        │      │ description  │      │             │                  │
│  │ is_active   │      └─────────────┘      └──────┬──────┘                  │
│  └──────┬──────┘                                    │                       │
│         │                                           │                       │
│         │ 1:1                                       │ 1:N                  │
│         ▼                                           ▼                       │
│  ┌─────────────┐      ┌─────────────┐      ┌─────────────┐                  │
│  │   avocats   │      │   articles  │      │             │                  │
│  │─────────────│      │─────────────│      │             │                  │
│  │ id (PK)     │      │ id (PK)     │      │             │                  │
│  │ user_id(FK) │──────│ avocat_id   │──────┤             │                  │
│  │ nom         │      │ titre       │      │             │                  │
│  │ prenom      │      │ slug        │      │             │                  │
│  │ specialite_ │      │ extrait     │      │             │                  │
│  │   id (FK)   │◄─────│ contenu     │      │             │                  │
│  │ telephone   │      │ image       │      │             │                  │
│  │ photo       │      │ statut      │      │             │                  │
│  └──────┬──────┘      └─────────────┘      └─────────────┘                  │
│         │                                                             │
│         │ 1:N                                                        │
│         ▼                                                            │
│  ┌─────────────┐                                                    │
│  │   images    │                                                    │
│  │─────────────│                                                    │
│  │ id (PK)     │                                                    │
│  │ avocat_id   │──────────────────────────────────────────────────│
│  │ article_id  │──────────────────────────────────────────────────│
│  │ nom_fichier │                                                    │
│  │ chemin      │                                                    │
│  │ type        │                                                    │
│  │ est_active  │                                                    │
│  └─────────────┘                                                    │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

## Tables

### 1. users (Comptes utilisateurs)
```
┌──────────────────┐
│      users       │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ ✉️  email         │  UNIQUE, NOT NULL
│ 🔐 password      │  NOT NULL (haché)
│ 👤 role          │  ENUM: admin, avocat, secretaire, stagiaire
│ ✅ is_active     │  TINYINT (0/1)
│ 🕐 last_login    │  TIMESTAMP NULL
│ 📅 created_at    │
│ 📅 updated_at    │
└──────────────────┘
```

### 2. specialites (Domaines juridiques)
```
┌──────────────────┐
│   specialites    │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ 📝 nom           │  NOT NULL
│ 🔗 slug          │  UNIQUE, NOT NULL
│ 📄 description   │  TEXT NULL
│ 📅 created_at    │
│ 📅 updated_at    │
└──────────────────┘
  │
  │ 1:N
  ▼
┌─────────────────────────────────────────────────┐
│                   RELATIONS                      │
├─────────────────────────────────────────────────┤
│  specialites ──FK──► avocats (specialite_id)     │
│  specialites ──FK──► articles (via avocat)      │
└─────────────────────────────────────────────────┘
```

### 3. avocats (Profils des avocats)
```
┌──────────────────┐
│     avocats      │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ 🔑 user_id       │  FK → users.id (ON DELETE CASCADE)
│ 📛 nom           │  NOT NULL
│ 📛 post_nom      │  NULL
│ 📛 prenom        │  NULL
│ 🎓 titre         │  VARCHAR (ex: "Me.")
│ 🔑 specialite_id │  FK → specialites.id (ON DELETE RESTRICT)
│ 📱 telephone     │  NULL
│ ✉️  email_pro    │  NULL
│ 📷 photo         │  VARCHAR (URL)
│ 📝 bio           │  TEXT NULL
│ ⏱️  annee_       │  INT NULL
│    experience    │
│ ✅ est_actif     │  TINYINT (0/1)
│ 📅 created_at    │
│ 📅 updated_at    │
└──────────────────┘

RELATIONS:
  users ──1:1──► avocats
  specialites ──1:N──► avocats
  avocats ──1:N──► articles
  avocats ──1:N──► images
```

### 4. articles (Publications)
```
┌──────────────────┐
│     articles     │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ 🔑 avocat_id     │  FK → avocats.id (ON DELETE CASCADE)
│ 📰 titre         │  NOT NULL
│ 🔗 slug          │  UNIQUE, NOT NULL
│ 📝 extrait       │  TEXT NULL
│ 📄 contenu       │  LONGTEXT NULL
│ 🖼️  image        │  VARCHAR (URL)
│ 📊 statut        │  ENUM: brouillon, publie, archive
│ 📅 date_         │  DATE NULL
│    publication   │
│ 📅 created_at    │
│ 📅 updated_at    │
└──────────────────┘

RELATIONS:
  avocats ──1:N──► articles
  articles ──1:N──► images
```

### 5. contacts (Messages de contact)
```
┌──────────────────┐
│     contacts     │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ 👤 nom_complet   │  NOT NULL
│ ✉️  email        │  NOT NULL
│ 📱 telephone     │  NULL
│ 📋 sujet         │  NOT NULL
│ 💬 message       │  NOT NULL
│ 👁️  lu          │  TINYINT (0/1)
│ 📅 created_at    │
└──────────────────┘
```

### 6. images (Galerie)
```
┌──────────────────┐
│     images       │
├──────────────────┤
│ 🔑 id            │  PRIMARY KEY AUTO_INCREMENT
│ 🔑 avocat_id     │  FK → avocats.id (ON DELETE CASCADE) NULL
│ 🔑 article_id    │  FK → articles.id (ON DELETE CASCADE) NULL
│ 📄 nom_fichier   │  NOT NULL
│ 🗂️  chemin       │  NOT NULL (chemin du fichier)
│ 🏷️  type         │  ENUM: avatar, article, galerie, slider
│ ✅ est_active    │  TINYINT (0/1)
│ 📅 created_at    │
└──────────────────┘

RELATIONS:
  avocats ──1:N──► images
  articles ──1:N──► images
```

## Diagramme des relations simplifié

```
users (1)──────────────(1) avocat
  │                        │
  │                        │
  │                        ├──(N) articles ──(N) images
  │                        │
  │                        └──(N) images
  │
  └──(1:1 optionnel) avocat ──(N) images

specialites (1)──────────(N) avocat
```

## Clés étrangères

| Table | Colonne | Référence | Action |
|-------|---------|-----------|--------|
| avocats | user_id | users.id | CASCADE |
| avocats | specialite_id | specialites.id | RESTRICT |
| articles | avocat_id | avocats.id | CASCADE |
| images | avocat_id | avocats.id | CASCADE |
| images | article_id | articles.id | CASCADE |

## Index

| Table | Index | Colonne |
|-------|-------|---------|
| users | idx_role | role |
| avocats | idx_actif | est_actif |
| articles | idx_statut | statut |
| articles | idx_date_publication | date_publication |
| contacts | idx_lu | lu |
| images | idx_type | type |
| images | idx_active | est_active |

## Notes

- Tous les timestamps utilisent `CURRENT_TIMESTAMP` par défaut
- Les passwords sont stockés hachés (bcrypt recommandé)
- Les slugs sont URL-safe et uniques
- Soft delete via `est_actif` / `is_active` sur les tables principales