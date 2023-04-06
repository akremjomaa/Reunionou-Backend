# Reunionou-Backend (Atelier n°2)

*Projet réalisé du 27 mars au 5 avril 2023*

## Récupérer le projet 

```sh
git clone git@github.com:akremjomaa/Reunionou-Backend.git
cd Reunionou-Backend
```

### Docker

Lancer Docker. Dans le terminal, exécuter ces commandes :

```sh
docker compose up
docker exec -it reunionou-backend-api.reunionou-1 composer update
```

Dans votre fichier `hosts`, rajouter ces lignes :

```
# Atelier 2 Reunionou
127.0.0.1 api.reunionou.local
```

### Base de données

Créer le fichier `config.db.ini` dans le dossier `reu_reunionou_service/config` avec le contenu suivant : 

```
driver   = 'mysql'
host     = 'reunionou.db'
database  = 'reunionou_lbs'
username  = 'reunionou_lbs'
password  = 'reunionou_lbs'
charset   = 'utf8'
collation = 'utf8_unicode_ci'
prefix    = ''
```

Lien du phpmyadmin : http://localhost:19180/ 

Dans phpMyAdmin, importer dans un premier temps, le fichier `reunionou_lbs.schema.sql` puis `reunionou_lbs.data.sql` qui se situent dans le dossier `reu_reunionou_service/sql`

## Collaborateurs

- Akrem JOMAA ([@akremjomaa](https://github.com/akremjomaa))
- Khaoula BOULHDIR ([@KhaoulaCode](https://github.com/KhaoulaCode))
- Léo SIX ([@leosix10](https://github.com/leosix10))
- Waïl ZIDANE ([@WZidane](https://github.com/WZidane))
