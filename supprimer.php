<?php
require_once 'config/database.php';

// Récupérer l'ID du produit à supprimer
$id = $_GET['id'] ?? null;

if (!$id) {
  header('Location: produits.php');
  exit;
}

// Supprimer le produit avec prepared query
$stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);

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
    title: 'Supprimé !',
    text: 'Le produit a été supprimé avec succès.',
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
?>
