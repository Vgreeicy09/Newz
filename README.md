# 📰 Newz - Plateforme d'Actualités

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![PHP](https://img.shields.io/badge/PHP-8+-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-lightgrey)
![NewsAPI](https://img.shields.io/badge/API-NewsAPI-orange)
![Status](https://img.shields.io/badge/status-en%20développement-yellow)

Newz est une application web Laravel qui permet de publier et consulter des articles d'actualité locaux ainsi que d'accéder à des informations internationales en temps réel grâce à l'API NewsAPI.


🛠️ Technologies utilisées

- ⚙️ PHP 8+
- 🚀 Laravel 10
- 🗄️ MySQL
- 🎨 Bootstrap 5
- 🌐 NewsAPI
- ✨ JavaScript / jQuery
- 🧩 HTML5 / CSS3

 🚀 Fonctionnalités

- 📝 Création, modification et suppression d’articles locaux via un tableau de bord
- 🌍 Affichage des actualités internationales par catégorie avec NewsAPI
- 🔎 Filtrage des articles (politique, sport, économie, culture, etc.)
- 📁 Upload d’images pour chaque article
- 🛡️ Interface d’administration sécurisée

📦 Installation

```bash
# Cloner le projet
git clone https://github.com/Vgreeicy09/Newz.git
cd Newz

# Installer les dépendances
composer install

# Configuration de l’environnement
cp .env.example .env
php artisan key:generate

# Configurer la base de données dans le fichier .env
# puis exécuter :
php artisan migrate

# Lancer le serveur
php artisan serve

Auteur : VIAGBO A. Y. Grace 
Fait avec ❤️ et Laravel.
