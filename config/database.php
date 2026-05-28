<?php
// Connexion à la base de données avec PDO

$host = 'localhost';
$dbname = 'pizzeria_eafc';
$username = 'root';
$password = '';

try {
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $username,
    $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
  // echo "Connexion réussie !";
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}
?>
