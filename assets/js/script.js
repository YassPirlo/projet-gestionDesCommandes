// Marque le lien actif dans la navigation selon la page courante
document.addEventListener('DOMContentLoaded', () => {
  const currentPage = window.location.pathname.split('/').pop();
  document.querySelectorAll('nav a').forEach(link => {
    if (link.getAttribute('href') === currentPage) {
      link.classList.add('active');
    }
  });
});

let nomErreur = document.getElementById('nom-erreur');
let prixErreur = document.getElementById('prix-erreur');
let submitErreur = document.getElementById('form-erreur');

 function validationNom(){
    let name = document.getElementById('nom').value;

    if (name.length == 0){
            nomErreur.innerHTML = "le nom est obligatoire";
            return false
    }
    if (!name.match(/^[A-Za-zÀ-ÿ0-9\s'-]{2,50}$/)) {
      nomErreur.innerHTML = "Ecrire un nom correct"
      return false
      }

    nomErreur.innerHTML='';
    return true;
 }


function validationPrix(){
  let prix=document.getElementById('prix');

  if (prix.value > 100){
    prixErreur.innerHTML = "Prix trop élevé";
    return false;

  }
  prixErreur.innerHTML="";
  return true; 

}

function validateForm(){
  if(!validationNom() ||!validationPrix() ) {
    submitErreur.innerHTML = "corriger l'erreur pour envoyer le formulaire";
    setTimeout(function(){submitErreur.style.display='none';},3000);
    return false;
  }
}

