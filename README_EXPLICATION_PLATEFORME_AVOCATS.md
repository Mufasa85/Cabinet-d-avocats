# README - Explication de la Plateforme Cabinet ELMD

## Introduction

Bienvenue sur la plateforme digitale du Cabinet d'Avocats ELMD. Ce document a pour but de vous expliquer, de manière claire et accessible, le fonctionnement general du systeme informatique que vous utilisez au quotidien pour gerer vos activites professionnelles.

---

## I. PRESENTATION GENERALE DU SYSTEME

### 1.1 Qu'est-ce que cette plateforme ?

Notre plateforme est un **espace de travail numerique** qui vous permet de :

- Gerer votre profil professionnel
- Rediger et publier des articles juridiques
- Stocker et organiser vos documents
- Participer a des formations continues
- Consulter vos notifications et messages

En quelque sorte, c'est votre **bureau virtuel** qui fonctionne 24h/24 et 7j/7.

### 1.2 Les differents espaces de la plateforme

La plateforme est organisee en plusieurs zones :

| Zone                      | Acces              | Fonction                   |
| ------------------------- | ------------------ | -------------------------- |
| **Espace Public**         | Tous les visiteurs | Site vitrine du cabinet    |
| **Espace Avocat**         | Vous uniquement    | Votre bureau personnel     |
| **Espace Stagiaire**      | Les stagiaires     | Espace des apprentis       |
| **Espace Administration** | L'administrateur   | Gestion globale du systeme |

---

## II. COMMENT ACCEDER A VOTRE ESPACE

### 2.1 La connexion

Pour acceder a votre espace avocat, vous devez :

1. **Ouvrir votre navigateur** (Chrome, Firefox, Edge...)
2. **Aller a l'adresse** du cabinet (par exemple : www.elmd-law.com)
3. **Cliquer sur "Connexion"** dans le menu
4. **Entrer vos identifiants** (email et mot de passe)
5. **Cliquer sur "Se connecter"**

> _Remarque : Vos identifiants vous ont ete communiques par l'administrateur du cabinet lors de votre integration._

### 2.2 Apres la connexion

Une fois connecte, vous arrivez sur votre **tableau de bord** qui vous presente :

- Un resume de vos activites recentes
- Le nombre de vos articles publies
- Vos notifications en attente
- Un acces rapide aux differentes sections

---

## III. LES FONCTIONNALITES PRINCIPALES

### 3.1 La gestion de votre profil

Cette section vous permet de **personnaliser vos informations professionnelles**.

**Ce que vous pouvez faire :**

- Modifier votre nom complet
- Mettre a jour votre adresse email professionnelle
- Ajouter ou changer votre photo de profil
- Renseigne votre numero de telephone
- Decrire votre parcours et specialites
- Indiquer votre bureau d'affectation

**Comment uploader votre photo de profil :**

1. Allez dans "Mon Profil"
2. Cliquez sur l'icone camera votre photo actuelle
3. Selectionnez une image depuis votre ordinateur
4. Cliquez sur "Enregistrer"

> _Conseil : Utilisez une photo professionnelle recente, de preference avec un arriere-plan neutre. Le format recommandee est JPG ou PNG._

### 3.2 La redaction d'articles juridiques

Cette fonctionnalite vous permet de **partager votre expertise** avec le grand public.

**Les etapes pour publier un article :**

1. **Acceder a la section "Articles"**
   - Depuis le menu lateral, cliquez sur "Articles"

2. **Creer un nouvel article**
   - Cliquez sur le bouton "Nouvel article"
   - Choisissez une categorie (Droit des affaires, Droit minier, etc.)
   - Renseignez le titre de votre article
   - Redigez le contenu dans l'editeur de texte
   - Ajoutez une image de couverture si souhaite
   - Choisissez le statut (brouillon ou publie)

3. **Modifier ou supprimer un article**
   - Vous pouvez a tout moment modifier vos articles
   - La suppression est egalement possible

**Les statuts d'un article :**
| Statut | Signification | Visibilite |
|--------|---------------|------------|
| **Brouillon** | Article en cours de redaction | Vous seul |
| **Publie** | Article visible par tous | Grand public |
| **Archive** | Ancien article | Archived |

### 3.3 La gestion des documents

Vous pouvez **stocker tous vos documents professionnels** de maniere securisee.

**Types de documents acceptes :**

- Contrats et conventions
- Conclusions et memoires
- Correspondances officielles
- Attestations et certificats

**Format autorise :** PDF uniquement (pour des raisons de securite)

**Comment uploader un document :**

1. Allez dans "Documents"
2. Cliquez sur "Ajouter un document"
3. Selectionnez le fichier PDF sur votre ordinateur
4. Donnez un nom au document
5. Choisissez si le document est public ou prive
6. Cliquez sur "Enregistrer"

### 3.4 Les formations continues

La plateforme vous donne acces a des **formations en ligne** pour developper vos competences.

**Fonctionnement :**

- Consultez la liste des formations disponibles
- Inscrivez-vous aux formations qui vous interessent
- Suivez votre progression
- Obtenez des attestations de participation

### 3.5 Les notifications

Le systeme vous **informe automatiquement** des evenements importants :

- Nouveaux commentaires sur vos articles
- Messages de l'administrateur
- Alertes sur vos inscriptions
- Rappel d'evenements a venir

---

## IV. COMPRENDRE LE SYSTEME DE STOCKAGE DES FICHIERS

### 4.1 Comment sont stockees vos images et documents ?

Quand vous **uploadez un fichier** (photo de profil, document PDF, image d'article), le systeme le stocke automatiquement dans un **espace securise** sur le serveur du cabinet.

**Le processus est le suivant :**

1. Vous selectionnez un fichier sur votre ordinateur
2. Le fichier est envoye au serveur de maniere securisee
3. Le serveur le stocke dans un dossier dedie
4. Un lien (URL) est cree pour acceder au fichier
5. Ce lien est enregistre dans la base de donnees

### 4.2 Pourquoi mes fichiers sont parfois caches sur Windows ?

Si vous utilisez un **PC sous Windows**, vous remarquerez peut-etre que certains fichiers apparaissent comme "caches" dans l'explorateur de fichiers. Ne vous inquietez pas, c'est **tout a fait normal** et n'affecte pas le fonctionnement.

**Comment voir ces fichiers caches :**

1. Ouvrez l'explorateur de fichiers
2. Cliquez sur "Affichage" dans le menu
3. Cochez la case "Elements caches"
4. Les fichiers apparaitront maintenant

### 4.3 Emplacement des fichiers sur le serveur

Les fichiers sont stockes dans differentes zones selon leur type :

| Type de fichier   | Emplacement sur le serveur           |
| ----------------- | ------------------------------------ |
| Photos de profil  | `/public/resources/images/avatars/`  |
| Images d'articles | `/public/resources/images/articles/` |
| Documents PDF     | `/public/resources/documents/`       |

> _Note : Vous n'avez pas besoin deconnaitre ces details techniques. Le systeme gere automatiquement le stockage._

---

## V. LA SECURITE DU SYSTEME

### 5.1 Protection de vos donnees

Le systeme utilise plusieurs **niveaux de securite** :

- **Authentification** : Chaque utilisateur doit s'identifier avec un email et un mot de passe unique
- **Session securisee** : Une fois connecte, vous etes identifie tout au long de votre navigation
- **Droits d'acces** : Vous ne pouvez voir et modifier que vos propres donnees
- **Protection CSRF** : Prevenir les attaques informatique lors de la soumission de formulaires

### 5.2 Vos responsabilites

Pour maintenir la securite du systeme, vous devez :

- **Ne jamais partager** vos identifiants avec autrui
- **Choisir un mot de passe complexe** et lechanger regulierement
- **Se deconnecter** quand vous quittez votre poste de travail
- **Signaler** toute activite suspecte a l'administrateur

---

## VI. CONSEILS D'UTILISATION

### 6.1 Bonnes pratiques

| Situation                | Conseils                                                     |
| ------------------------ | ------------------------------------------------------------ |
| **Upload de photo**      | Utilisez des images de moins de 5 Mo au format JPG ou PNG    |
| **Redaction d'articles** | Sauvegardez regulierement votre texte pour eviter les pertes |
| **Documents PDF**        | Verifiez que vos fichiers ne depassent pas 5 Mo              |
| **Connexion**            | Utilisez toujours le meme ordinateur et navigateur           |

### 6.2 Problemes frequents et solutions

| Probleme                               | Solution                                                           |
| -------------------------------------- | ------------------------------------------------------------------ |
| **Je n'arrive pas a me connecter**     | Verifiez votre email et mot de passe. Contactez l'admin si besoin. |
| **L'upload d'image ne fonctionne pas** | Verifiez la taille du fichier (max 5 Mo) et le format (JPG, PNG)   |
| **Je ne vois pas mes modifications**   | Rafraichissez la page ou deconnectez-vous et reconnectez-vous      |
| **Le document PDF ne s'upload pas**    | Verifiez que le fichier est bien au format PDF                     |

### 6.3 Contacter le support technique

Si vous rencontrez un **probleme non resolu**, vous pouvez :

1. **Consulter les logs** : Le systeme enregistre les erreurs dans un journal
2. **Contacter l'administrateur** : Par email ou via le formulaire de contact
3. **Decrire le probleme** en detail : Ce que vous essayiez de faire, ce qui s'est passe

---

## VII. ARCHITECTURE TECHNIQUE (POUR INFORMATION)

### 7.1 Les composants du systeme

| Composant               | Role                                                          |
| ----------------------- | ------------------------------------------------------------- |
| **Base de donnees**     | Stocke toutes les informations (utilisateurs, articles, etc.) |
| **Serveur web**         | Traite les requetes et affiche les pages                      |
| **Système de fichiers** | Stocke les images et documents                                |
| **Routeur**             | Dirige chaque requete vers la bonne action                    |

### 7.2 Le processus d'une action

**Exemple : Vous publiez un article**

1. **Vous remplissez le formulaire** sur la page articles
2. **Le navigateur envoie** les donnees au serveur
3. **Le controleur** recoit et traite la demande
4. **Le modele** sauvegarde l'article dans la base de donnees
5. **Le systeme de fichiers** stocke l'image de couverture
6. **La vue** genere la page de confirmation
7. **Le navigateur** affiche le resultat

---

## VIII. GLOSSAIRE

| Terme          | Definition                                      |
| -------------- | ----------------------------------------------- |
| **Dashboard**  | Tableau de bord - page d'accueil personnalisee  |
| **Upload**     | Action d'envoyer un fichier vers le serveur     |
| **CSRF**       | Token de securite pour les formulaires          |
| **Session**    | Periode active de connexion                     |
| **Route**      | Adresse URL qui declenche une action            |
| **Controller** | Logiciel qui traite les requetes                |
| **Modele**     | Composant qui interagit avec la base de donnees |
| **Vue**        | Page HTML affichee a l'utilisateur              |

---

## CONCLUSION

Cette plateforme a ete concue pour **faciliter votre travail quotidien** et vous permettre de vous concentrer sur l'essentiel : conseiller et defender vos clients.

N'hesitez pas a **explorer toutes les functionalities** et a nous faire part de vos suggestions d'amelioration. Votre retour d'experience est precieux pour rendre ce systeme encore plus utile.

**L'equipe technique du Cabinet ELMD reste a votre disposition** pour toute question ou assistance.

---

_Document redige le 28 mai 2026_
_Cabinet d'Avocats ELMD - Service Informatique_
