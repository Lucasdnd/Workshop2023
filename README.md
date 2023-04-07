# CMS WORKSHOP 2023 📈

Création d'un CRM Open Source afin de simplifier la gestion de la relation client à travers différents status (Leads, Prospects et Clients). 

La page d'accueil affiche les statistiques et les graphiques concernant les contacts et les actions. Les pages Leads, Prospects et Clients permettent de créer, afficher, mettre à jour et supprimer des contacts, et de les passer d'un statut à un autre. Les pages Entreprises, Actions et Utilisateurs permettent de gérer les informations correspondantes. Il est également possible d'exporter et d'importer des contacts depuis et vers un fichier CSV.


## Prérequis 📌

- Laravel ^10.5
- Composer ^2.5.5
- PHP ^8.2.4
- npm ^6.14


## Installation 🔧

Si vous souhaitez installer le projet sur votre machine, veuillez suivre les étapes suivantes:

1. Cloner le projet https://github.com/Lucasdnd/Workshop2023.git
2. Installer les dépendances avec `composer install` et `npm install`
3. Activer ensuite l'extension `;extension=pdo_sqlite` en enlevant le ';' dans le fichier php.init
4. Executer les migrations avec `php artisan migrate`
5. Puis pour lancer le serveur faite un `php artisan serve`

 Vous voila avec le projet fonctionnel et prêt à être utilisé ! 🌐

## Auteurs 👥

- DURAND Lucas
- MASCOLO Nicola

