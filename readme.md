Cette application Symfony fournit une API restful pour gérer des tâches.
Elle permet de créer, mettre à jour, supprimer et rechercher des tâches

Instructions pour lancer l'application

1. Installez les dépendances
Assurez vous que PHP, Composer et MySQL sont installées, puis installez les dépendances avec Composer:
composer install

2. Configurer l'environnement
Configurer la connexion à la base de données dans le fichier .environnement

3. Initialisation de la base de donnée
Créez la base de donnée et appliquez les migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

4. Démarrer le serveur de développement de Symfony
symfony serve
Vous pouvez utilisez Wamp Server pour gérer le serveur plus facilement

5. Exécuter les tests
Installer le packages de test Symfony avec composer:
composer require --dev symfony/test-pack

Exécuter les tests avec PHPUnit :
php bin/phpunit

Les tests incluent des tests unitaires afin de vérifier la logique (que les méthodes de l'entité fonctionnent)  et des tests fonctionnels pour vérifier le comportement des de l'API ( vérifie que les endpoints retourne bien les donénes attendues)

Choix Techniques
1. Installation l simplifiée avec WAMP
WAMP a été choisi pour sa capacité à centraliser PHP, MySQL, et Apache, rendant l'installation plus simple sur Windows.

2. Symfony comme framework
Symfony a été retenu pour les raisons suivantes :

Doctrine pour la gestion des entités et des migrations.
Gestion des contrôleurs et entités.
Support REST : Simplicité dans la création d'une API REST grâce aux annotations de routage.

3. MySQL comme base de données
Le choix de MySQL est motivé par sa compatibilité avec Doctrine ORM et sa popularité dans les environnements de production. 

4. Gestion des tests avec PHPUnit
Les tests automatisés ont été implémentés avec PHPUnit pour valider les fonctionnalités principales. Les tests couvrent :

La validation des données envoyées à l'API.
Les retours des endpoints (codes HTTP, contenu JSON, etc.).

5. Déploiement avec Git
Git a été utilisé pour versionner le projet et faciliter la collaboration. Les étapes incluent l'initialisation d'un dépôt local, le lien avec un dépôt GitHub, et la gestion des commits pour suivre les modifications.
