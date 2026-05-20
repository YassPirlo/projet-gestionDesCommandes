// Marque le lien actif dans la navigation
document.addEventListener('DOMContentLoaded', () => {
  const currentPage = window.location.pathname.split('/').pop();
  document.querySelectorAll('nav a').forEach(link => {
    if (link.getAttribute('href') === currentPage) {
      link.classList.add('active');
    }
    
  });
const container = document.getElementById('produits-container');
if (container) {
  ajouterProduit().then(() => {
    afficherProduits();
  });
}
});

// Spans d'erreur
let nomErreur = document.getElementById('nom-erreur');
let prixErreur = document.getElementById('prix-erreur');
let submitErreur = document.getElementById('form-erreur');

function validationNom() {
  let name = document.getElementById('nom').value;

  if (name.length < 2) {
    nomErreur.innerHTML = "Le nom doit faire au moins 2 caractères";
    return false;
  }

  nomErreur.innerHTML = "";
  return true;
}

function validationPrix() {
  let prix = document.getElementById('prix').value;

  if (prix <= 0) {
    prixErreur.innerHTML = "Le prix doit être supérieur à 0";
    return false;
  }
  if (prix > 100) {
    prixErreur.innerHTML = "Prix trop élevé (max 100€)";
    return false;
  }

  prixErreur.innerHTML = "";
  return true;
}

function validateForm() {
  if (!validationNom() || !validationPrix()) {
  Swal.fire('Erreur', 'Veuillez corriger les erreurs dans le formulaire avant de soumettre.', 'error');
  return false;
  }
  Swal.fire('Succès', 'Produit ajouté avec succès !', 'success');
  return false;

}

class Produit {
  constructor(nom,prix,categorie,description){
    this.nom = nom;
    this.prix = prix;
    this.categorie = categorie;
    this.description = description;
  }
  getNom(){
    return this.nom;
  }
  getPrix(){
    return this.prix;
  }   
  getCategorie(){
    return this.categorie;
  }
  getDescription(){
    return this.description;
  } 
  setNom(nom){
    this.nom = nom;
  }
  setPrix(prix){
    this.prix = prix;
  }   
  setCategorie(categorie){
    this.categorie = categorie;
  }
  setDescription(description){
    this.description = description;
  }

afficheInfo(){
  return `Produit: ${this.nom}, Prix: ${this.prix}€, Catégorie: ${this.categorie}, Description: ${this.description}`;
}

}

let catalogueProduits = [];

async function ajouterProduit() {
  try {
    const reponse = await fetch('assets/data/produits.json');
    const produitsJson = await reponse.json();

    catalogueProduits = produitsJson.map(item => {
      return new Produit(item.nom, item.prix, item.categorie, item.description);
    });
    console.log("Les produits ont été ajoutés au catalogue :", catalogueProduits);
    console.log(catalogueProduits[0].afficheInfo());
  } catch (error) {
    console.error("Erreur lors du chargement des produits :", error);
  }
}

function afficherProduits() {
  const container = document.getElementById('produits-container');
  container.innerHTML = '';

  catalogueProduits.forEach(produit => {
    const produitDiv = document.createElement('div');
    produitDiv.classList.add('produit');

    produitDiv.innerHTML = `
      <h3>${produit.getNom()}</h3>
      <p>Prix: ${produit.getPrix()}€</p>
      <p>Catégorie: ${produit.getCategorie()}</p>
      <p>Description: ${produit.getDescription()}</p>
    `;

    container.appendChild(produitDiv);
  });
}

function filtrerProduits(categorie) {
  if (categorie === 'tous') {
    afficherProduits();
    return;
  }else {
    const produitsFiltres = catalogueProduits.filter(produit => produit.getCategorie() === categorie);
    const container = document.getElementById('produits-container');
    container.innerHTML = '';

    produitsFiltres.forEach(produit => {
      const produitDiv = document.createElement('div');
      produitDiv.classList.add('produit');

      produitDiv.innerHTML = `
        <h3>${produit.getNom()}</h3>
        <p>Prix: ${produit.getPrix()}€</p>
        <p>Catégorie: ${produit.getCategorie()}</p>
        <p>Description: ${produit.getDescription()}</p>
      `;

      container.appendChild(produitDiv);
    });
  }
}

