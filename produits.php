<?php
// Activer les erreurs PHP (à enlever en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la BD et la classe Produit
require_once 'config/database.php';
require_once 'classes/Produit.php';

// Récupérer tous les produits depuis la base de données
$stmt = $pdo->query("SELECT * FROM produits ORDER BY id ASC");
$produitsBD = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Transformer chaque ligne en instance de la classe Produit
$produits = [];
foreach ($produitsBD as $row) {
  $produits[] = new Produit(
    $row['id'],
    $row['nom'],
    $row['description'],
    $row['prix'],
    $row['quantite'],
    $row['categorie'],
    $row['date_creation']
  );
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria EAFC - Produits (BD)</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <header>
        <h1>Pizzeria EAFC</h1>
        <nav>
            <a href="pageAccueil.html">Accueil</a>
            <a href="plats.html">Menu</a>
            <a href="commandes.html">Commander</a>
            <a href="produits.php">Produits (BD)</a>
            <a href="ajouter.php">Admin</a>
        </nav>
    </header>

    <main>
        <h2>Liste des produits (depuis la base de données)</h2>

        <p><a href="ajouter.php" style="display:inline-block; padding:10px 20px; background-color:#009246; color:white; text-decoration:none; border-radius:5px; font-weight:bold;">+ Ajouter un produit</a></p>

        <?php if (empty($produits)) : ?>
            <p>Aucun produit dans la base de données.</p>
        <?php else : ?>
            <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit) : ?>
                        <tr>
                            <td><?= $produit->getId() ?></td>
                            <td><?= htmlspecialchars($produit->getNom()) ?></td>
                            <td><?= htmlspecialchars($produit->getDescription()) ?></td>
                            <td><?= $produit->getPrix() ?> €</td>
                            <td><?= $produit->getQuantite() ?></td>
                            <td><?= htmlspecialchars($produit->getCategorie()) ?></td>
                            <td>
                                <a href="modifier.php?id=<?= $produit->getId() ?>">Modifier</a> |
                                <a href="#" onclick="supprimerProduit(event, <?= $produit->getId() ?>)">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Pizzeria EAFC - À bientôt !</p>
    </footer>

    <script>
        function supprimerProduit(event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'supprimer.php?id=' + id;
                }
            });
        }
    </script>

</body>
</html>
