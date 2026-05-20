# Explication des scripts - TP2

## Fichier : assets/js/script.js

### 1. Navigation active
Au chargement de la page (`DOMContentLoaded`), le script détecte la page actuelle et ajoute la classe `active` au lien correspondant dans la navigation.

### 2. Validation du formulaire
Trois fonctions gèrent la validation du formulaire d'ajout de produit :
- `validationNom()` : vérifie que le nom fait au moins 2 caractères.
- `validationPrix()` : vérifie que le prix est entre 0 et 100.
- `validateForm()` : vérifie les deux champs et affiche une popup SweetAlert de succès ou d'erreur.

### 3. Classe Produit
Classe JavaScript représentant un produit du restaurant.
- **Constructor** : reçoit nom, prix, catégorie et description.
- **Getters** : `getNom()`, `getPrix()`, `getCategorie()`, `getDescription()` pour accéder aux propriétés.
- **Setters** : `setNom()`, `setPrix()`, `setCategorie()`, `setDescription()` pour modifier les propriétés.
- **Méthode** : `afficheInfo()` retourne une chaîne avec toutes les infos du produit.

### 4. Chargement des produits (JSON)
La fonction `ajouterProduit()` est une fonction asynchrone qui :
1. Récupère le fichier `assets/data/produits.json` avec `fetch()`.
2. Convertit la réponse en objets JavaScript avec `.json()`.
3. Crée une instance de la classe `Produit` pour chaque élément avec `.map()`.
4. Stocke le tout dans le tableau `catalogueProduits`.

### 5. Affichage dynamique
La fonction `afficherProduits()` :
1. Récupère le conteneur HTML (`produits-container`).
2. Vide son contenu.
3. Boucle sur `catalogueProduits` et crée un `<div>` pour chaque produit avec son nom, prix, catégorie et description.
4. Ajoute chaque élément au DOM avec `appendChild()`.

### 6. Filtrage par catégorie
La fonction `filtrerProduits(categorie)` :
- Si la catégorie est `'tous'` : affiche tous les produits.
- Sinon : utilise `.filter()` pour garder seulement les produits de la catégorie choisie et les affiche.

## Fichier : assets/data/produits.json

Fichier JSON contenant 6 produits avec les propriétés : id, nom, description, prix et catégorie.
Catégories disponibles : pizza, boisson, dessert.

## Bibliothèque tierce : SweetAlert2

SweetAlert2 est utilisé pour afficher des popups stylisées à la place des `alert()` classiques du navigateur.
- Intégré via CDN dans les 4 pages HTML.
- Utilisé dans `validateForm()` pour afficher des messages de succès ou d'erreur lors de la validation du formulaire.
