# Fichier de tests — TP3/TP4

## Tests fonctionnels — CRUD

### Test 1 : CREATE (Ajouter un produit)
**Objectif** : Vérifier que l'ajout fonctionne et que le produit est enregistré en BD

| Élément | Détail |
|---------|--------|
| **Action** | Accès à `ajouter.php`, remplissage du formulaire avec nom="Tiramisu Spécial", prix=7.99, quantite=10, categorie="dessert" |
| **Résultat attendu** | Alerte SweetAlert verte + redirection vers `produits.php` + produit visible dans la liste |
| **Résultat obtenu** | ✅ PASS — Produit ajouté en BD, visible dans le tableau |
| **Date test** | 2026-05-31 |

---

### Test 2 : READ (Afficher les produits)
**Objectif** : Vérifier que tous les produits sont récupérés de la BD et affichés

| Élément | Détail |
|---------|--------|
| **Action** | Accès à `produits.php` |
| **Résultat attendu** | Tableau HTML avec tous les produits (id, nom, prix, quantité, catégorie, actions) |
| **Résultat obtenu** | ✅ PASS — 8 produits affichés (6 de base + 2 ajoutés) |
| **Date test** | 2026-05-31 |

---

### Test 3 : UPDATE (Modifier un produit)
**Objectif** : Vérifier que la modification fonctionne et que les changements sont en BD

| Élément | Détail |
|---------|--------|
| **Action** | Clic "Modifier" sur Margherita → changement du prix de 12.99 à 13.99 → soumission |
| **Résultat attendu** | Alerte SweetAlert verte + redirection + prix mis à jour en BD |
| **Résultat obtenu** | ✅ PASS — Prix changé en 13.99 dans le tableau et en BD |
| **Date test** | 2026-05-31 |

---

### Test 4 : DELETE (Supprimer un produit)
**Objectif** : Vérifier que la suppression fonctionne

| Élément | Détail |
|---------|--------|
| **Action** | Clic "Supprimer" sur un produit → alerte de confirmation → "Oui, supprimer" |
| **Résultat attendu** | Alerte verte de confirmation + produit disparu du tableau et de la BD |
| **Résultat obtenu** | ✅ PASS — Produit supprimé de la BD et plus visible |
| **Date test** | 2026-05-31 |

---

## Tests de validation — Côté client + serveur

### Test 5 : Validation nom (trop court)
**Objectif** : Vérifier que le nom d'1 lettre est rejeté

| Élément | Détail |
|---------|--------|
| **Action** | Formulaire ajouter.php avec nom="A" |
| **Résultat attendu** | Alerte SweetAlert d'erreur (côté client) |
| **Résultat obtenu** | ✅ PASS — Formulaire bloqué, erreur affichée avant envoi |
| **Date test** | 2026-05-31 |

---

### Test 6 : Validation prix (trop élevé)
**Objectif** : Vérifier que le prix > 100€ est rejeté

| Élément | Détail |
|---------|--------|
| **Action** | Formulaire ajouter.php avec prix=2000 |
| **Résultat attendu** | Alerte SweetAlert d'erreur (côté client) |
| **Résultat obtenu** | ✅ PASS — Formulaire bloqué, erreur affichée |
| **Date test** | 2026-05-31 |

---

### Test 7 : Validation quantité (négative)
**Objectif** : Vérifier que quantité < 0 est rejeté

| Élément | Détail |
|---------|--------|
| **Action** | Formulaire ajouter.php avec quantite=-5 |
| **Résultat attendu** | Alerte SweetAlert d'erreur |
| **Résultat obtenu** | ✅ PASS — Formulaire bloqué, erreur "La quantité ne peut pas être négative" |
| **Date test** | 2026-05-31 |

---

### Test 8 : Validation serveur (contournement JS)
**Objectif** : Vérifier que la validation côté serveur fonctionne même si JS est désactivé

| Élément | Détail |
|---------|--------|
| **Action** | Envoi direct en POST via curl avec nom vide : `curl -X POST http://localhost/projetWebProjet/ajouter.php -d "nom=&prix=10&quantite=5&categorie=pizza"` |
| **Résultat attendu** | Erreur serveur (page avec alerte SweetAlert) |
| **Résultat obtenu** | ✅ PASS — Serveur rejette, affiche erreur |
| **Date test** | 2026-05-31 |

---

## Tests de sécurité

### Test 9 : Protection XSS (htmlspecialchars)
**Objectif** : Vérifier qu'une balise script ne s'exécute pas

| Élément | Détail |
|---------|--------|
| **Action** | Ajouter un produit avec nom=`<script>alert('XSS')</script>` |
| **Résultat attendu** | Texte affiché littéralement, script NON exécuté |
| **Résultat obtenu** | ✅ PASS — Texte affiché en tant que texte brut (htmlspecialchars) |
| **Date test** | 2026-05-31 |

---

### Test 10 : Protection Injection SQL (Prepared Statements)
**Objectif** : Vérifier qu'une injection SQL est impossible

| Élément | Détail |
|---------|--------|
| **Action** | Ajouter un produit avec nom=`'; DROP TABLE produits; --` |
| **Résultat attendu** | La chaîne est insérée comme valeur, pas exécutée comme SQL |
| **Résultat obtenu** | ✅ PASS — Produit créé avec ce nom littéral, table intacte |
| **Date test** | 2026-05-31 |

---

### Test 11 : Protection Injection SQL (Modifier via GET)
**Objectif** : Vérifier que l'ID en GET ne peut pas faire une injection

| Élément | Détail |
|---------|--------|
| **Action** | Accès à `modifier.php?id=1 OR 1=1` |
| **Résultat attendu** | Erreur ou produit inexistant (pas d'extraction de tous les produits) |
| **Résultat obtenu** | ✅ PASS — Aucun produit ne correspond à cet ID bizarre, page affiche "Produit introuvable" |
| **Date test** | 2026-05-31 |

---

## Tests API JSON

### Test 12 : API retourne du JSON valide
**Objectif** : Vérifier que `api_produits.php` retourne du JSON exploitable

| Élément | Détail |
|---------|--------|
| **Action** | `curl http://localhost/projetWebProjet/api_produits.php` |
| **Résultat attendu** | JSON valide avec array de produits : `[{"id":1, "nom":"...", "prix":"...", ...}]` |
| **Résultat obtenu** | ✅ PASS — JSON retourné correctement, parsable en JS |
| **Date test** | 2026-05-31 |

---

### Test 13 : fetch() récupère l'API
**Objectif** : Vérifier que le JS peut consommer l'API

| Élément | Détail |
|---------|--------|
| **Action** | Console du navigateur : `fetch('api_produits.php').then(r => r.json()).then(d => console.log(d))` |
| **Résultat attendu** | Array de produits affichés en console |
| **Résultat obtenu** | ✅ PASS — 8 produits affichés |
| **Date test** | 2026-05-31 |

---

### Test 14 : Menu dynamique (plats.html) affiche les produits API
**Objectif** : Vérifier que les produits ajoutés via CRUD apparaissent dans le menu

| Élément | Détail |
|---------|--------|
| **Action** | Ajouter "Tiramisu Spécial" via CRUD → Aller sur `plats.html` |
| **Résultat attendu** | "Tiramisu Spécial" doit être visible dans le menu |
| **Résultat obtenu** | ✅ PASS — Produit visible après rechargement de la page |
| **Date test** | 2026-05-31 |

---

### Test 15 : Filtres produits (Tous, Pizzas, Boissons, Desserts)
**Objectif** : Vérifier que les filtres fonctionnent

| Élément | Détail |
|---------|--------|
| **Action** | `plats.html` → Clic "Pizzas" → Clic "Boissons" → Clic "Tous" |
| **Résultat attendu** | Liste filtrée correctement par catégorie |
| **Résultat obtenu** | ✅ PASS — Filtres fonctionnent, catégories correctes |
| **Date test** | 2026-05-31 |

---

## Résumé des tests

| Total tests | PASS | FAIL | Coverage |
|-------------|------|------|----------|
| **15** | **15** | **0** | **100%** |

### Domaines couverts
- ✅ CRUD complet (Create, Read, Update, Delete)
- ✅ Validation côté client (JavaScript)
- ✅ Validation côté serveur (PHP)
- ✅ Protection XSS (htmlspecialchars)
- ✅ Protection Injection SQL (Prepared Statements)
- ✅ API JSON fonctionnelle
- ✅ fetch() et consommation API
- ✅ Intégration dynamique des données

### Conclusion
Tous les critères du TP3 et TP4 sont validés. L'application est **sécurisée**, **fonctionnelle** et **dynamique**.
