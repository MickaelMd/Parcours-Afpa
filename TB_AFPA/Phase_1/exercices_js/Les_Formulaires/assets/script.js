let mytextbox = document.getElementById("message");
let mydropdown = document.getElementById("f_envir_bis");

mydropdown.onchange = function () {
  let mydropdownValue = mydropdown.options[mydropdown.selectedIndex].value;
  mytextbox.value = mytextbox.value + " " + mydropdownValue;
};

document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    if (checkform()) {
      alert("Formulaire validé !");
    }
  });

function checkform() {
  let societe = document.getElementById("societe").value;
  let personne = document.getElementById("f_personne").value;
  let postal = document.getElementById("f_postal").value;
  let ville = document.getElementById("f_ville").value;
  let email = document.getElementById("f_email").value;
  let soc_error = document.getElementById("er_societe");
  let per_error = document.getElementById("er_personne");
  let postal_error = document.getElementById("er_postal");
  let ville_error = document.getElementById("er_ville");
  let mail_error = document.getElementById("er_email");

  if (societe.length < 1) {
    alert("La 'Société' doit comporter au moins 1 caractère.");
    soc_error.textContent = "La 'Société' doit comporter au moins 1 caractère.";
    return false;
  }

  if (personne.length < 1) {
    alert("La 'Personne à contacter' doit comporter au moins 1 caractère.");
    per_error.textContent =
      "La 'Personne à contacter' doit comporter au moins 1 caractère.";
    return false;
  }

  if (!/^\d{5}$/.test(postal)) {
    alert("Le 'Code postal' doit comporter 5 caractères numériques.");
    postal_error.textContent =
      "Le 'Code postal' doit comporter 5 caractères numériques.";
    return false;
  }

  if (ville.length < 1) {
    alert("La 'Ville' doit comporter au moins 1 caractère.");
    ville_error.textContent = "La 'Ville' doit comporter au moins 1 caractère.";
    return false;
  }

  if (!email.includes("@")) {
    alert("Le Email doit comporter au moins le caractère '@'.");
    mail_error.textContent =
      "Le Email doit comporter au moins le caractère '@'.";
    return false;
  }

  return true;
}

// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
  const mouseTracker = document.getElementById("mouse-tracker");

  document.addEventListener("mousemove", function (souris) {
    mouseTracker.style.left = souris.clientX + "px";
    mouseTracker.style.top = souris.clientY + "px";
  });
});

// -

const btntoggle = document.getElementById("btn_toggle");

btntoggle.addEventListener("click", () => {
  const flare = document.getElementById("mouse-tracker");

  if (flare.classList.contains("mouse_on")) {
    flare.classList.remove("mouse_on");
    flare.classList.add("mouse_off");
  } else {
    flare.classList.remove("mouse_off");
    flare.classList.add("mouse_on");
  }
});
