document.addEventListener("DOMContentLoaded", () => {
  function i() {
    console.log("test");
  }
  const form = document.getElementById("form_profil");
  const fields = [
    "profil_nom",
    "profil_prenom",
    "profil_email",
    "profil_telephone",
    "profil_adresse",
    "profil_pwd",
    "profil_pwd_confirm",
  ];

  const validations = {
    profil_nom: {
      validate: (value) => /^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/.test(value),
      errorMessage:
        "Le nom est obligatoire et doit comporter uniquement des lettres.",
    },
    profil_prenom: {
      validate: (value) => /^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/.test(value),
      errorMessage:
        "Le prénom est obligatoire et doit comporter uniquement des lettres.",
    },
    profil_email: {
      validate: (value) =>
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value),
      errorMessage: "Veuillez entrer un email valide.",
    },
    profil_telephone: {
      validate: (value) =>
        /^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/.test(value),
      errorMessage:
        "Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)",
    },
    profil_adresse: {
      validate: (value) =>
        /^\d+\s[A-Za-zÀ-ÿ0-9\s.'-]+(?:\sAppartement\s\d+)?\s*,?\s*\d{5}\s[A-Za-zÀ-ÿ\s.'-]+$/.test(
          value
        ),
      errorMessage: "L'adresse est obligatoire et doit être valide.",
    },
    profil_pwd: {
      validate: (value) => {
        if (value === "") return true;
        return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value);
      },
      errorMessage:
        "Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères.",
    },
    profil_pwd_confirm: {
      validate: (value, values) => {
        if (values.profil_pwd === "" && value === "") return true;
        return value === values.profil_pwd;
      },
      errorMessage: "Les mots de passe doivent être identiques.",
    },
  };

  const validateField = (fieldId) => {
    const field = document.getElementById(fieldId);
    const errorField = document.getElementById(`error-${fieldId}`);
    const { validate, errorMessage } = validations[fieldId];

    const formValues = fields.reduce((acc, field) => {
      acc[field] = document.getElementById(field).value.trim();
      return acc;
    }, {});

    const isValid = validate(field.value.trim(), formValues);
    errorField.textContent = isValid ? "" : errorMessage;
    return isValid;
  };

  form.addEventListener("submit", (event) => {
    const isValid = fields.every(validateField);
    if (!isValid) event.preventDefault();
  });

  fields.forEach((fieldId) => {
    document
      .getElementById(fieldId)
      .addEventListener("blur", () => validateField(fieldId));
  });
});
