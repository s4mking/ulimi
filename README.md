# Ulimi

Site ecommerce réalisé à l'ai du Framework Symfony + bundle Aiemos

### Prérequis

Vous aurez besoin de composer....
De plus créer une BDD qui a comme nom: ulimistable


### Installation

Vous devez cloner mon repo Git, modifier les fichiers doctrine.yaml afin de faire correspondre les paramètres de connexions à la BDD:


```
    database_host: 127.0.0.1
    database_port: 8889
    database_name: ulimistable
    database_user: root
    database_password: root
```


## Lancement installation

Effectuer la commande :

```
  composer.phar install
```
Cette commande doit être lancé là où est situé le fichier composer.json évidemment...

### Lancement du site

Normalement votre site eest installé vous pouvez maintenant le lancer à l'aide du serveur de Symfony comme ceci :

```
php bin/console server:run
```

### Webpack

La gestion des fichiers JS et CSS est gérée par Webpack afin de ne pes vous embêter à charger à chaque fois voici la ligne qui va écouter en direct toutes modifications : 

```
yarn encore dev --watch
```

## Cache

Ligne de commande afin de vider le cache en dev : 

```
php bin/console cache:clear --no-warmup --env=dev
```

## Authors

* **Samuel Simonney** - *Initial work* - [Aimeos](https://aimeos.org/)



## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

