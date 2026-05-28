# Explication du fonctionnement côté serveur - TP3

## Structure du projet

```
projetWebProjet/
├── index.php              # Redirige vers produits.php
├── produits.php           # Affiche tous les produits (READ)
├── ajouter.php            # Formulaire + traitement ajout (CREATE)
├── modifier.php           # Formulaire + traitement modification (UPDATE)
├── supprimer.php          # Suppression d'un produit (DELETE)
├── config/
│   └── database.php       # Connexion PDO à la base de données
├── classes/
│   └── Produit.php        # Classe PHP représentant un produit
├── database/
│   └── stock.sql          # Script SQL de création de la base
└── ...
```

## Base de données

La base de données s'appelle `pizzeria_eafc` et contient une table `produits` avec :
- `id` (INT, clé primaire, auto-incrémenté)
- `nom` (VARCHAR 100)
- `description` (TEXT)
- `prix` (DECIMAL 10,2)
- `quantite` (INT)
- `categorie` (VARCHAR 100)
- `date_creation` (DATETIME)

## Connexion PDO

Le fichier `config/database.php` crée une instance PDO connectée à MySQL via XAMPP.
On utilise PDO car il permet d'utiliser les prepared statements (sécurité contre les injections SQL).

## Classe Produit (PHP)

La classe `Produit` représente un produit avec ses propriétés privées (encapsulation) et des getters/setters publics. Elle est utilisée notamment dans `produits.php` pour transformer les lignes de la BD en objets manipulables.

## CRUD complet

### Read (produits.php)
Récupère tous les produits avec `SELECT * FROM produits`, les transforme en objets `Produit`, et les affiche dans un tableau HTML avec des liens "Modifier" et "Supprimer".

### Create (ajouter.php)
Affiche un formulaire HTML. Quand l'utilisateur soumet (POST), on utilise une prepared query `INSERT INTO` pour ajouter le produit en BD de manière sécurisée.

### Update (modifier.php)
Récupère un produit par son ID (via `$_GET['id']`), pré-remplit un formulaire avec ses valeurs actuelles. Au submit (POST), exécute un `UPDATE` avec prepared query.

### Delete (supprimer.php)
Reçoit l'ID via GET, exécute `DELETE FROM produits WHERE id = :id` et redirige vers la liste.

## Sécurité

- **Prepared statements** (`:nom`, `:prix`, etc.) → protection contre les injections SQL
- **htmlspecialchars()** dans l'affichage → protection contre les XSS
- **Validation côté client** (JS, TP2) + **côté serveur** (à étendre si besoin)

## Méthodes HTTP

- **GET** : `produits.php`, `modifier.php?id=X`, `supprimer.php?id=X`
- **POST** : `ajouter.php` (soumission formulaire), `modifier.php` (soumission formulaire)
