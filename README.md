# Mâgasum
Application web pour la gestion du stock.

![Magasum](https://github.com/MRxACR/magasum/blob/master/public/img/Magasum.png)

## Description
Ce dépôt est un projet de `fin de formation` informatique `base de données`, c'est une `application web` qui a pour but de gérer les `entrées` et les `sorties` du magasin universitaire MOULOUD MAMMERI.

Le `memoire` de fin de formation est disponible ici :  [Mémoire](https://github.com/MRxACR/magasum/blob/master/Memoire.pdf).

## Versions utilisées
- PHP : 8.0.2
- LARAVEL : 9.19

## Installation
Avant de passer à l'installation de l'application, vous devez d'abord télécharger et installer les dépendances suivantes :
- git
- PHP ~> 8.0.2 
- Laragon (or XAMPP)
- Composer 
- Nodejs

#### Cloner le dépôt Git :
Ouvrez votre terminal et accédez au répertoire où vous souhaitez installer le projet Laravel. si vous utilisez `Laragon` accédez à `C:\laragon`, Ensuite, utilisez cette commande pour cloner le dépôt :

```bash
  git clone https://github.com/MRxACR/magasum.git
```

#### Accéder au répertoire du projet :
Déplacez-vous dans le répertoire du projet :
```bash
  cd magasum
```

#### Installer les dépendances :
Exécutez la commande suivante pour installer les packages requis :
```bash
composer install
```

#### Créer le fichier d'environnement :
Dupliquez le fichier .env.example et enregistrez-le sous le nom .env. Mettez à jour les paramètres de configuration dans le fichier .env, tels que les détails de connexion à la base de données.

```bash
cp .env.example .env
```

#### Générer la clé d'application :
Exécutez la commande suivante pour générer une clé d'application unique :
```bash
php artisan key:generate
```

#### Migrer la base de données :
Exécutez la commande de migration pour créer les tables de base de données nécessaires :
```bash
php artisan migrate
```

#### Installer les dépendances Node.js:
Dans le répertoire de votre projet Laravel, exécutez la commande suivante pour installer les dépendances Node.js définies dans le fichier package.json :

```bash
npm install & npm run build
```

#### Seed la base de données :
Après avoir effectué les étapes mentionnées précédemment, vous pouvez exécuter la commande artisan pour semer (seed) la base de données:

```bash
php artisan db:seed
```


#### Lancer l'application :
Enfin, démarrez le serveur de développement Laravel :
```bash
php artisan serve
```

## Contributeurs
- [ALEM Abderrahmane](https://twitter.com/acrabdou)
- IGUERGUIT. D
