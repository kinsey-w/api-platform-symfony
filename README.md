# **Projet API Movies (Symfony + API Platform)**

## Présentation du projet

Ce projet est une **API REST complète** réalisée avec **Symfony** et **API Platform**.

---

## Installation du projet

### 1️. Cloner le projet

```bash
git clone <repo>
cd movies-api
```

### 2️. Installer les dépendances

```bash
composer install
```

### 3️. Configurer la base de données

Dans `.env` :

```
DATABASE_URL="mysql://[username]:[password]@127.0.0.1:3306/[db-name]"
```

Créer la base :

```bash
php bin/console doctrine:database:create
```

### 4️. Générer les clés JWT

```bash
php bin/console lexik:jwt:generate-keypair
```

### 5️. Exécuter les migrations

```bash
php bin/console doctrine:migrations:migrate
```

### 6️. Charger les fixtures (films + affiches + utilisateurs)

```bash
php bin/console doctrine:fixtures:load
```

---

# Endpoints principaux

## Films

| Méthode | Endpoint         | Sécurité    | Description       |
| ------- | ---------------- | ----------- | ----------------- |
| GET     | /api/movies      | Public      | Liste des films   |
| GET     | /api/movies/{id} | Public      | Détails d’un film |
| POST    | /api/movies      | Admin (JWT) | Ajouter un film   |
| PATCH   | /api/movies/{id} | Admin (JWT) | Modifier          |
| DELETE  | /api/movies/{id} | Admin (JWT) | Supprimer         |

Inclut des **filtres API Platform** :

* `?title=abc`
* `?duration[gt]=120`
* `?releaseDate[before]=2010-01-01`

---

# Catégories

| Méthode | Endpoint             |
| ------- | -------------------- |
| GET     | /api/categories      |
| POST    | /api/categories      |
| DELETE  | /api/categories/{id} |

---

## Front intégré (Twig)

Le projet contient un mini front :

| Page        | URL            | Description                    |
| ----------- | -------------- | ------------------------------ |
| Accueil     | `/`            | Présentation du site           |
| Liste films | `/movies`      | Vue grille avec affiches       |
| Détail film | `/movies/{id}` | Synopsis + bouton Favori       |
| Login       | `/login`       | Formulaire de connexion        |
| Logout      | `/logout`      | Déconnexion                    |


---

## Utilisateurs par défaut

| Email             | Mot de passe | Rôle       |
| ----------------- | ------------ | ---------- |
| admin@example.com | admin123     | ROLE_ADMIN |
| user@example.com  | user123      | ROLE_USER  |
