# Giftbox

## Prérequis
- Docker Desktop installé et lancé

## Démarrage

1. Créer le fichier `.env` et le remplir avec vos identifiants (mêmes valeurs que dans `gift.appli/src/conf/db.ini`)
```bash
DB_USER=    
DB_PASSWORD=
DB_NAME=giftbox
```
2. Lancer les services :
```bash
docker compose up -d
```

3. Importer la base de données via Adminer (http://localhost:8080) :
   - Importer `sql/gift.schema.sql`
   - Importer `sql/gift.data.sql`

4. Accéder à l'application : http://localhost:5180
5. Accéder à l'API : http://localhost:5180/api

# Participants

AIME--CABOCEL Léandre
ANTZORN Hugo
BOUDOUAH Ilias
FAVINI-LEHNOF Maël
