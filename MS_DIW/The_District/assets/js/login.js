document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("sign_up_form");
  const fields = [
    "sign_nom",
    "sign_prenom",
    "sign_email",
    "sign_telephone",
    "sign_adresse",
    "sign_pwd",
    "sign_pwd_confirm",
  ];

  function validateField(fieldId, errorId, validationFn, values, errorMessage) {
    const field = document.getElementById(fieldId);
    const errorField = document.getElementById(errorId);

    if (validationFn(field.value.trim(), values)) {
      errorField.textContent = "";
      return true;
    } else {
      errorField.textContent = errorMessage;
      return false;
    }
  }

  const validations = {
    sign_nom: {
      validate: (value) => /^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/.test(value),
      errorMessage:
        "Le nom est obligatoire et doit comporter uniquement des lettres.",
    },
    sign_prenom: {
      validate: (value) => /^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/.test(value),
      errorMessage:
        "Le prénom est obligatoire et doit comporter uniquement des lettres.",
    },
    sign_email: {
      validate: (value) =>
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value),
      errorMessage: "Veuillez entrer un email valide.",
    },
    sign_telephone: {
      validate: (value) =>
        /^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/.test(value),
      errorMessage:
        "Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)",
    },
    sign_adresse: {
      validate: (value) =>
        /^\d+\s[A-Za-zÀ-ÿ0-9\s.'-]+(?:\sAppartement\s\d+)?\s*,?\s*\d{5}\s[A-Za-zÀ-ÿ\s.'-]+$/.test(
          value
        ),
      errorMessage: "L'adresse est obligatoire et doit être valide.",
    },
    sign_pwd: {
      validate: (value) => /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value),
      errorMessage:
        "Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères.",
    },
    sign_pwd_confirm: {
      validate: (value, values) => value === values.sign_pwd,
      errorMessage: "Les mots de passe doivent être identiques.",
    },
  };

  form.addEventListener("submit", function (event) {
    let isValid = true;
    const values = {};

    fields.forEach((fieldId) => {
      values[fieldId] = document.getElementById(fieldId).value.trim();
    });

    fields.forEach((fieldId) => {
      const validationFn = validations[fieldId].validate;
      const errorMessage = validations[fieldId].errorMessage;
      const validationPassed = validateField(
        fieldId,
        `error-${fieldId}`,
        validationFn,
        values,
        errorMessage
      );
      if (!validationPassed) isValid = false;
    });

    if (!isValid) {
      event.preventDefault();
    }
  });

  fields.forEach((fieldId) => {
    const field = document.getElementById(fieldId);
    field.addEventListener("blur", () => {
      const values = {};
      fields.forEach((id) => {
        values[id] = document.getElementById(id).value.trim();
      });
      validateField(
        fieldId,
        `error-${fieldId}`,
        validations[fieldId].validate,
        values,
        validations[fieldId].errorMessage
      );
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("loginFail") === "true") {
    document.getElementById("error_login_fail").style.display = "block";
    localStorage.removeItem("loginFail");
  }
});

// --------
