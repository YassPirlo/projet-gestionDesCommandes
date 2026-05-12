// Marque le lien actif dans la navigation
document.addEventListener('DOMContentLoaded', () => {
  const currentPage = window.location.pathname.split('/').pop();
  document.querySelectorAll('nav a').forEach(link => {
    if (link.getAttribute('href') === currentPage) {
      link.classList.add('active');
    }
  });
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
    submitErreur.innerHTML = "Corriger les erreurs";
    return false;
  }
  submitErreur.innerHTML = "";
  return true;
}
