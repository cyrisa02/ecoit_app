# Déploiement d'EcoIT

## Prérequis sur le serveur

Que ce soit dans le cadre d'un déploiement en local ou en ligne, plusieurs éléments sont requis afin de permettre la bonne exécution de Symfony sur un serveur :

- PHP, dans sa version 8.0 au minimum

- Composer

## Cloner le dépot git en local ou sur un serveur

Un dépot git public est associé au projet EcoIT. Pour le cloner en local ou sur un serveur, exécuter la commande :

`git clone https://github.com/cyrisa02/ecoit_app.git`

# On se déplace dans le dossier

cd ecoit_app

## Installer les dépendances du projet

Pour installer les dépendances du projet à partir du fichier composer.json, exécuter la commande :

`composer install`

## Configurer l'accès à la base de données et les variables d'environnement

Accéder au fichier .env à la racine du projet. A la ligne DATABASE_URL, renseignez vos informations de connexion à votre propre base de donnée sous la forme :

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

## Configurer la base de données

Créer la base de donnée si elle n'existe pas déjà :

`php bin/console doctrine:database:create --if-not-exists`

Effectuer les migrations dans la base de données pour créer les différentes tables :

`php bin/console doctrine:migrations:migrate`

## Ajouter des fausses données générées automatiquement dans la base de donnée (OPTIONNEL)

Afin de tester le projet dans des conditions proches du réel, il est possible de générer des utilisateurs, ainsi que des formations automatiquement pour remplir la base de donnée ainsi que le site. Pour cela, exécuter la commande :

`php bin/console doctrine:fixtures:load`

## Lancer le serveur

`php bin/console server:run`

## Créer un compte d'administrateur pour gérer le site et les demandes de formateur

Après création de la base de données, il est nécessaire de créer un compte d'administrateur qui pourra se connecter au site web et gérer celui-ci.

Tout d'abord, définir un mot de passe sécurisé pour l'administrateur. Ensuite, aller sur https://www.bcrypt.fr/ et générer un cryptage du mot de passe avec l'algorithme bcrypt.

Ensuite, exécutez la commande, en remplaçant, entre les parenthèses suivant 'VALUES' le nom_utilisateur, le hash_mot_de_passe généré précédemment, ainsi que l'email :

`php bin/console doctrine:query:sql "INSERT INTO user(id, pseudo, roles, password, email, photo) VALUES (UUID(), 'nom_utilisateur', '['ROLE_ADMIN']', 'hash_mot_de_passe', 'email', NULL);"`
