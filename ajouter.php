<?php
require_once 'config/database.php';

$message = '';

// Traitement du formulaire si POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $nom = trim($_POST['nom'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $prix = floatval($_POST['prix'] ?? 0);
  $quantite = intval($_POST['quantite'] ?? 0);
  $categorie = $_POST['categorie'] ?? '';

  // Validation côté serveur
  $erreurs = [];

  if (strlen($nom) < 2) {
    $erreurs[] = "Le nom doit faire au moins 2 caractères.";
  }
  if ($prix <= 0 || $prix > 100) {
    $erreurs[] = "Le prix doit être entre 0.01€ et 100€.";
  }
  if ($quantite < 0) {
    $erreurs[] = "La quantité ne peut pas être négative.";
  }
  if (!in_array($categorie, ['pizza', 'boisson', 'dessert'])) {
    $erreurs[] = "Catégorie invalide.";
  }

  if (!empty($erreurs)) {
    // Afficher SweetAlert avec les erreurs
    $messageErreur = implode("\\n", $erreurs);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    <script>
      Swal.fire({
        title: 'Erreur !',
        text: "<?= $messageErreur ?>",
        icon: 'error',
        confirmButtonText: 'Corriger',
        confirmButtonColor: '#dc3545'
      }).then(() => {
        window.history.back();
      });
    </script>
    </body>
    </html>
    <?php
    exit;
  }

  // Insérer dans la BD avec une prepared query (sécurité)
  $sql = "INSERT INTO produits (nom, description, prix, quantite, categorie)
          VALUES (:nom, :description, :prix, :quantite, :categorie)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':nom' => $nom,
    ':description' => $description,
    ':prix' => $prix,
    ':quantite' => $quantite,
    ':categorie' => $categorie
  ]);

  // Afficher SweetAlert de succès et rediriger
  ?>
  <!DOCTYPE html>
  <html lang="fr">
  <head>
      <meta charset="UTF-8">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
  <script>
    Swal.fire({
      title: 'Succès !',
      text: 'Le produit a été ajouté avec succès.',
      icon: 'success',
      confirmButtonText: 'OK',
      confirmButtonColor: '#28a745'
    }).then(() => {
      window.location.href = 'produits.php';
    });
  </script>
  </body>
  </html>
  <?php
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria EAFC - Ajouter un produit</title>
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
        <h2>Ajouter un produit</h2>

        <form method="POST" action="ajouter.php">
            <p>
                <label for="nom">Nom du produit :</label><br>
                <input type="text" id="nom" name="nom" required>
            </p>

            <p>
                <label for="categorie">Catégorie :</label><br>
                <select id="categorie" name="categorie">
                    <option value="pizza">Pizza</option>
                    <option value="boisson">Boisson</option>
                    <option value="dessert">Dessert</option>
                </select>
            </p>

            <p>
                <label for="prix">Prix (€) :</label><br>
                <input type="number" id="prix" name="prix" step="0.01" min="0.01" max="100" required>
            </p>

            <p>
                <label for="quantite">Quantité :</label><br>
                <input type="number" id="quantite" name="quantite" min="0" required>
            </p>

            <p>
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" rows="4"></textarea>
            </p>

            <button type="submit">Ajouter le produit</button>
        </form>

        <p><a href="produits.php">Voir tous les produits</a></p>
    </main>

    <footer>
        <p>&copy; 2026 Pizzeria EAFC - À bientôt !</p>
    </footer>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const nom = document.getElementById('nom').value.trim();
            const prix = parseFloat(document.getElementById('prix').value);
            const quantite = parseInt(document.getElementById('quantite').value);
            let erreurs = [];

            if (nom.length < 2) erreurs.push("Le nom doit faire au moins 2 caractères.");
            if (prix <= 0 || prix > 100) erreurs.push("Le prix doit être entre 0.01€ et 100€.");
            if (quantite < 0) erreurs.push("La quantité ne peut pas être négative.");

            if (erreurs.length > 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Erreur !',
                    html: erreurs.join('<br>'),
                    icon: 'error',
                    confirmButtonText: 'Corriger',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    </script>

</body>
</html>
