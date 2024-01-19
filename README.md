Projet D'EscapeGame avec utilisation de Composer

Ce projet est basé sur un Framework PHP et utilise Composer comme gestionnaire de dépendances. Voici les instructions pour configurer et exécuter le projet.

Prérequis
Avant de commencer, assurez-vous que les logiciels suivants sont installés sur votre machine :

PHP v7.4 ou version ultérieure.
Composer - Gestionnaire des dépendances PHP.
Serveur web Apache/Nginx ou similaire.
Installation
Suivez ces étapes pour installer et configurer votre projet :

1. Installation de Composer
Avant de pouvoir utiliser ce projet, vous devez avoir Composer installé. Si ce n'est pas encore le cas, suivez ces instructions :

Sur Windows, téléchargez et exécutez l'installateur de Composer.

Sur macOS et Linux, exécutez les commandes suivantes dans votre terminal :


curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

2. Clonage du projet
Clonez le projet dans votre répertoire local en utilisant git :

git clone https://github.com/user/projet.git
Changez "user/projet.git" par l'URL du dépôt du projet.

3. Installation des dépendances
Accédez au répertoire du projet et installez les dépendances via Composer :

cd projet
composer install
Changez "projet" par le nom du répertoire de votre projet.

4. Configuration du Serveur Web
Configurez votre serveur web pour pointer vers le répertoire public/ du projet. Ceci va dépendre de votre serveur web. Voici un exemple pour Apache :

<VirtualHost *:80>
    DocumentRoot "/chemin/vers/projet/public"
    ServerName projet.local

    <Directory "/chemin/vers/projet/public">
        AllowOverride All
        Order allow,deny
        Allow from All
    </Directory>
</VirtualHost>
N'oubliez pas d'ajouter une entrée dans votre fichier hosts si nécessaire :

127.0.0.1 projet.local
Assurez-vous de remplacer "projet.local" et "/chemin/vers/projet/public" par le nom de domaine que vous souhaitez utiliser pour le projet et le chemin vers le répertoire public/ de votre projet respectivement.

Exécution du Projet
Après avoir terminé l'installation, vous pouvez accéder à l'application via votre navigateur en utilisant l'URL de votre serveur local/ressource de domaine que vous avez configurée, par exemple projet.local.
