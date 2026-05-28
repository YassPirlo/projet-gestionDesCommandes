<?php
class Produit {
  private $id;
  private $nom;
  private $description;
  private $prix;
  private $quantite;
  private $categorie;
  private $date_creation;

  // Constructor
  public function __construct($id, $nom, $description, $prix, $quantite, $categorie, $date_creation = null) {
    $this->id = $id;
    $this->nom = $nom;
    $this->description = $description;
    $this->prix = $prix;
    $this->quantite = $quantite;
    $this->categorie = $categorie;
    $this->date_creation = $date_creation;
  }

  // Getters
  public function getId() { return $this->id; }
  public function getNom() { return $this->nom; }
  public function getDescription() { return $this->description; }
  public function getPrix() { return $this->prix; }
  public function getQuantite() { return $this->quantite; }
  public function getCategorie() { return $this->categorie; }
  public function getDateCreation() { return $this->date_creation; }

  // Setters
  public function setNom($nom) { $this->nom = $nom; }
  public function setDescription($description) { $this->description = $description; }
  public function setPrix($prix) { $this->prix = $prix; }
  public function setQuantite($quantite) { $this->quantite = $quantite; }
  public function setCategorie($categorie) { $this->categorie = $categorie; }

  // Méthode pour afficher les infos
  public function afficheInfo() {
    return "Produit: {$this->nom}, Prix: {$this->prix}€, Catégorie: {$this->categorie}, Description: {$this->description}";
  }
}
?>
