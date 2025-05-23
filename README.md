""# Eventia - Gestion d'événements

Eventia est une application Symfony fictive développée dans le cadre du cours Symfony, permettant la gestion complète d'événements : création, modification, visualisation, participation et commentaires. Le projet est conçu avec les bonnes pratiques de Symfony, une architecture modulaire et un design élégant grâce à Tailwind CSS.

## Auteur

* **Prénom Nom :** Florent Grondin
* **Email :** [fgrondin@myges.fr](mailto:fgrondin@myges.fr)
* **Dépôt GitHub :** [tp-note-symfony](https://github.com/Froggys974/tp-note-symfony)

---

## 📌 **Fonctionnalités**

* Inscription et connexion d'utilisateurs
* Création, modification et suppression d'événements (organisateur uniquement)
* Affichage des événements sous forme de cartes
* Invitations et gestion de la participation aux événements
* Commentaires sur les événements
* Vue détaillée et édition d'événements
* Notification en temps réel pour les événements
* Interface utilisateur optimisée avec Tailwind CSS

---

## 🚀 **Lancer le projet**

```bash
# 1. Cloner le dépôt
git clone https://github.com/Froggys974/tp-note-symfony.git

# 2. Accéder au dossier
cd tp-note-symfony

# 3. Installer les dépendances
composer install
npm install
npm run build

# 4. Configurer l'environnement
cp .env.example .env .env.local
# Modifier les informations de connexion à la base de données dans le fichier .env

# 5. Créer la base de données et les schémas
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 6. Charger les fixtures (utilisateurs, événements, etc.)
php bin/console hautelook:fixtures:load

# 7. Lancer le serveur Symfony
symfony server:start -d ou php -S localhost:3000 -t public
# Le projet fictif est accessible sur http://127.0.0.1:8000
```

---

## 🔐 **Accès et rôles**

### Accès administrateur :

* **Email:** [admin@admin.fr](mailto:admin@admin.fr)
* **Mot de passe:** admin
* **Rôle:** ROLE\_ADMIN
* **Permissions :** Accès complet à l'administration, création et modification de tous les événements, gestion des utilisateurs.

### Accès utilisateur standard :

* **Exemple d'email:** [user@example.com]
* **Mot de passe:** userpassword (par défaut généré par les fixtures)
* **Rôle:** ROLE\_USER
* **Permissions :** Création d'événements, participation à des événements, commentaires.

### Accès utilisateur banni :

* **Exemple d'email:** [banned@example.com]
* **Mot de passe:** bannedpassword (par défaut généré par les fixtures)
* **Rôle:** ROLE\_BANNED
* **Permissions :** Accès restreint avec une page dédiée indiquant le bannissement. Aucune action possible sur l'application.

---

## 📝 **Contexte et explications supplémentaires**

* Ce projet est un exercice fictif réalisé dans le cadre d'un cours de Symfony.
* L'objectif est de démontrer les compétences acquises en développement Symfony, structuration de projet et gestion d'événements.
* Le projet est développé à des fins pédagogiques avec une architecture modulaire et suit les bonnes pratiques Symfony.
* Le projet est développé avec une architecture modulaire et suit les bonnes pratiques Symfony.
* Le style est géré avec **Tailwind CSS**, rendant l'interface moderne et fluide.
* La gestion des utilisateurs est optimisée avec un système de rôles (Admin, User, Banned).
* Les contrôleurs sont séparés par entité pour une meilleure lisibilité et un apprentissage structuré.
* Les formulaires sont générés dynamiquement et sont facilement modifiables.
* L'interface est conçue pour être évolutive, réutilisable et facilement extensible dans un contexte pédagogique.

---

## 🔄 **Améliorations futures**

* Mise en place d'une API REST pour une utilisation mobile.
* Ajout de la fonctionnalité de recherche et de filtrage d'événements.
* Amélioration du système de notifications en temps réel.
* Optimisation des performances et gestion du cache.

---

## 📫 **Contact**

Pour toute question ou suggestion, vous pouvez me contacter à : **[fgrondin@myges.fr](mailto:fgrondin@myges.fr)**""
