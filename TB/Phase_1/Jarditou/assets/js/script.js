// ----------------
const name_error = document.getElementById("name_error");
const name2_error = document.getElementById("name2_error");
const sexe_error = document.getElementById("s_error");
const date_error = document.getElementById("date_error");
const postal_error = document.getElementById("postal_error");
const adresse_error = document.getElementById("adresse_error");
const email_error = document.getElementById("email_error");
const sujet_error = document.getElementById("sujet_error");
const question_error = document.getElementById("question_error");
const check_error = document.getElementById("check_error");

// -----------------

let send = document.getElementById("envoyer_form").value;

document
  .getElementById("contact_form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    if (checkform()) {
      document.forms["contact_form"].submit();
    }
  });

function checkform() {
  const name = document.getElementById("form_name").value;
  const name2 = document.getElementById("form_f_name").value;
  const sexeselect = document.querySelector(
    "input[type='radio'][name=choixsexe]:checked"
  );
  const date = document.getElementById("form_bday").value;
  const codepostal = document.getElementById("form_post").value;
  const adresse = document.getElementById("form_adresse").value;
  const email = document.getElementById("form_email").value;
  const sujet = document.getElementById("form_sujet").value;
  const question = document.getElementById("form_question").value;
  const check = document.getElementById("check_accept").checked;

  if (name.length < 1) {
    name_error.textContent = "Le nom doit comporter au moins 1 caractère.";
    return false;
  }

  if (name2.length < 1) {
    name2_error.textContent = "Le prénom doit comporter au moins 1 caractère.";
    return false;
  }
  if (sexeselect === null) {
    sexe_error.textContent = "Veuillez indiquer votre sexe.";
    return false;
  }

  if (date === "") {
    date_error.textContent = "La date est invalide.";
    return false;
  }

  if (!/^\d{5}$/.test(codepostal)) {
    postal_error.textContent =
      "Le Code postal doit comporter 5 caractères numériques.";
    return false;
  }

  if (adresse.length < 1) {
    adresse_error.textContent = "L'adresse est invalide.";
    return false;
  }

  if (!email.includes("@")) {
    email_error.textContent =
      "L'Email doit comporter au moins le caractère '@'.";
    return false;
  }

  if (sujet === "0") {
    sujet_error.textContent = "Un sujet doit être séléctionné.";
    return false;
  }
  if (question.length < 32) {
    question_error.textContent =
      "Votre question doit comporter au minimum 32 caractéres.";
    return false;
  }
  if (check === false) {
    check_error.textContent = "Veuillez accepter les conditions ";
    return false;
  }

  return true;
}
