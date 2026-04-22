# PROJECT-PHP-FORMULAIRE-D’AUTHENTIFICATION
🚀 Projet de Formulaire en PHP

📝 Description du projet

Ce projet est un modèle de formulaire d’authentification et d’inscription, relié à un clone simplifié de Facebook.

🛠️ Technologies utilisées

| Couche | Technologies |
|--------|-------------|
| **Back-end** | PHP , Sessions PHP |
| **Base de données** |  MySQL (via PDO) |
| **Front-end** | HTML5, CSS3, JavaScript |
| **Serveur local** | XAMPP  |

⚙️ Installation

1. Clonez ce dépôt sur votre machine locale.
2. Importez le fichier dbname.sql dans votre base MySQL.
3. Modifiez les paramètres de connexion dans db.php.
4. Ouvrez index.php dans votre navigateur pour commencer.

📂 Structure du projet

* PROJECTT/


├── 📄 index.php                # Page d'accueil — portail d'entrée

├── 📄 login.php                # Formulaire de connexion (fond vidéo)

├── 📄 register.php             # Formulaire d'inscription multi-champs

├── 📄 logout.php               # Destruction de session et redirection

├── 📄 verify_email.php         # Validation du lien de vérification email

├── 📄 dashboard.php            # Tableau de bord post-connexion

├── 📄 home.php                 # Feed social (posts, stories, sidebar)

├── 📄 profile.php              # Page de profil utilisateur


├── 📄 auth.php                 # 🔑 Cœur du système — toutes les fonctions auth

├── 📄 db.php                   # Connexion PDO + création/migration de table
│

├── 🎨 style.css                # Feuille de styles principale (thème + dark mode)

├── ⚙️ scripte.js               # Dark mode toggle + menu paramètres
│

├── 🗄️ dbname.sql               # Script SQL pour créer la base de données

├── 🖼️ imag.jpeg                # Logo SocialBook

├── 🎬 video.mp4                # Vidéo de fond (pages auth)
│

└── 📁 images/                 # Icônes, avatars, images de feed


 🔑 Fichier `auth.php` — Architecture des fonctions

| Fonction | Rôle |
|----------|------|
| `isLoggedIn()` | Vérifie si l'utilisateur est connecté |
| `currentUser()` | Retourne les données de l'utilisateur en session |
| `requireLogin()` | Redirige vers login si non connecté |
| `validateRegistrationData()` | Valide tous les champs du formulaire |
| `createUser()` | Insère un nouvel utilisateur en base |
| `getUser()` | Récupère un utilisateur par email |
| `authenticate()` | Vérifie email + mot de passe |
| `verifyUserEmail()` | Active le compte via token de vérification |
| `loginUser()` | Stocke l'utilisateur en session |
| `logout()` | Détruit la session proprement |

🚀 Fonctionnalités

👤 Authentification
- ✅ **Inscription** avec prénom, nom, date de naissance, email et mot de passe
- ✅ **Connexion sécurisée** avec gestion des erreurs explicites
- ✅ **Déconnexion propre** avec destruction complète de la session
- ✅ **Vérification de l'email** avant accès au compte (lien de confirmation unique)
- ✅ **Redirection intelligente** selon l'état de connexion

🛡️ Sécurité
- ✅ **Hachage des mots de passe** avec `password_hash()` (bcrypt)
- ✅ **Vérification sécurisée** via `password_verify()`
- ✅ **Comparaison de tokens** via `hash_equals()` (protection contre les attaques temporelles)
- ✅ **Requêtes préparées PDO** (protection contre les injections SQL)
- ✅ **Validation serveur** complète sur tous les champs
- ✅ **Échappement HTML** via `htmlspecialchars()` (protection XSS)
- ✅ **Filtres PHP** (`FILTER_VALIDATE_EMAIL`, `FILTER_SANITIZE_EMAIL`)

🎨 Interface
- ✅ Design **glassmorphism** moderne avec animations CSS
- ✅ **Fond vidéo** dynamique sur les pages login et register
- ✅ Interface **feed social** avec stories, posts et sidebar
- ✅ **Mode sombre** (dark mode) avec persistance via `localStorage`
- ✅ **Responsive design** adapté mobile et tablette
- ✅ Page de **profil utilisateur** complète


👥 Auteurs

* 	Mariam Ait idkir
* 	Mohamed chily
* 	Aya Rizki
* 	Lahoucine Agnaou
* 	Soulaiman Joui
