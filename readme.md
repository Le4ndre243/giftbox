# Giftbox

## Prérequis
- Docker Desktop installé et lancé

## Démarrage

1. Remplir le fichier `.env` avec vos identifiants (mêmes valeurs que dans `db.ini`)

2. Lancer les services :
```bash
docker compose up -d
```

3. Importer la base de données via Adminer (http://localhost:8080) :
   - Importer `sql/gift.schema.sql`
   - Importer `sql/gift.data.sql`

4. Accéder à l'application : http://localhost:5180

# Participants

AIME--CABOCEL Léandre
ANTZORN Hugo
BOUDOUAH Ilias
FAVINI-LEHNOF Maël