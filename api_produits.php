<?php
// API qui retourne les produits de la BD en format JSON
require_once 'config/database.php';

// Indiquer au navigateur que c'est du JSON
header('Content-Type: application/json; charset=utf-8');

// Récupérer tous les produits
$stmt = $pdo->query("SELECT id, nom, description, prix, quantite, categorie FROM produits ORDER BY id ASC");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convertir le prix en nombre décimal (PDO retourne des strings)
foreach ($produits as &$produit) {
    $produit['prix'] = floatval($produit['prix']);
    $produit['quantite'] = intval($produit['quantite']);
}

// Retourner le JSON
echo json_encode($produits, JSON_UNESCAPED_UNICODE);
?>
