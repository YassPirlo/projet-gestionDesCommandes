# Projet : Pizzeria EAFC

## Contexte
Application web de gestion des commandes pour un restaurant (projet école EAFC).
Travail individuel - Yassine Vitullo.

## Mode de collaboration
- **Comportement attendu** : agir comme un PROF, guider sans donner la réponse directement.
- L'utilisateur demande explicitement quand il veut le code complet.
- **Langue** : français.
- **Style** : simple, basique. Pas de sur-engineering. HTML/CSS minimaliste.

## Stack par phase
- **TP1 (en cours)** : HTML5 + CSS3 + JavaScript basique. Statique uniquement.
- **TP2** : PHP + base SQL + CRUD complet.
- **TP3** : API JSON + validation JS/PHP + sécurité (prepared queries, htmlspecialchars).
- **Final** : rapport écrit + défense orale.

## Structure du projet
```
projet-gestionDesCommandes/ (dossier : projetWebProjet/)
├── pageAccueil.html       # Accueil : titre, présentation, image, horaires, contact
├── plats.html             # Carte du resto par catégorie (Boissons, Pizzas, Desserts)
├── commandes.html         # Page commande : liste plats + panier + total + livraison + Payer
├── ajouter.html           # Formulaire admin (nom, catégorie, prix, image, description)
├── assets/
│   ├── css/style.css      # CSS unique, couleurs drapeau italien
│   ├── js/script.js       # JS : marque le lien actif dans la nav
│   └── images/pizza.jpg
├── docs/
│   └── analyse-besoin.docx
├── README.md
└── CLAUDE.md
```

## Choix de design
- Couleurs drapeau italien : vert `#009246`, rouge `#CE2B37`, blanc.
- Header noir/vert avec nav, footer pareil.
- Police Arial, layout simple, responsive via 1 media query (max-width 600px).
- Nom du restaurant : **Pizzeria EAFC**.

## Pages (rôles fonctionnels)
- **pageAccueil** : vitrine du resto, infos pratiques.
- **plats** : carte du restaurant (juste affichage, pas de commande).
- **commandes** : où le CLIENT choisit ses plats, voit le panier + total + livraison + Payer.
- **ajouter** : où l'ADMIN gère le menu (formulaire). Pas de page login pour TP1.

## Décisions importantes
- Pas de page `categories.html` séparée (catégories visibles directement dans `plats.html`).
- Pas de page `panier.html` séparée (panier intégré dans `commandes.html`).
- Pas d'authentification admin pour TP1 (peut-être plus tard).
- 1 seul fichier `script.js` (pas de split par page pour TP1).
- Pas d'UML pour TP1 (à faire en TP2 quand la DB arrive).

## Git
- `git init` fait.
- Branche `main` pour TP1.
- Plus tard : branches `feature/tp2-crud`, `feature/database`, etc.

## Avancement TP1
- [x] Structure de dossiers
- [x] 4 pages HTML avec nav cohérente
- [x] CSS aux couleurs italiennes
- [x] Maquettes Excalidraw
- [ ] Analyse du besoin (`docs/analyse-besoin.docx`) — contenu rédigé, à coller dans Word
- [ ] Validation JS du formulaire d'ajout (à coder par l'élève)
- [ ] Test responsive
- [ ] Commit Git final + zip livrable

## Livrable TP1
Fichier zip nommé : `TP1_Vitullo_ProjetWeb.zip`
Contient : pages HTML/CSS, analyse du besoin, maquettes, README.

## Grille d'évaluation TP1 (/10)
- Compréhension cahier des charges : 1,5
- Liste fonctionnalités : 1,5
- Arborescence : 1
- Création pages HTML : 2
- Qualité CSS : 1,5
- Navigation : 1
- Responsive : 1,5

## Notes pour la suite
- En TP2 : créer entités `Plat`, `Catégorie`, `Commande`, `LigneCommande`.
- Calcul à prévoir : sous-total + frais de livraison + total.
- API JSON probablement pour : liste des plats, ajouter au panier, etc.
