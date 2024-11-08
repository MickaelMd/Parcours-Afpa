document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("add_cat_form");
  const fields = ["cat_add_name"];

  const validations = {
    cat_add_name: {
      validate: (value) => /^[a-zA-Z0-9]+$/.test(value),
      errorMessage:
        "Dans Libelle, seuls les lettres et les chiffres sont autorisés.",
    },
  };

  const validateField = (fieldId) => {
    const field = document.getElementById(fieldId);
    const errorField = document.getElementById(`error-${fieldId}`);
    const { validate, errorMessage } = validations[fieldId];

    const isValid = validate(field.value.trim());
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

document.addEventListener("DOMContentLoaded", function () {
  const categorySelect = document.getElementById("categorySelect");
  const platsBody = document.getElementById("platsBody");
  const allRows = platsBody.querySelectorAll("tr");

  categorySelect.addEventListener("change", function () {
    const selectedCategory = this.value;

    allRows.forEach((row) => {
      const rowCategory = row.getAttribute("data-category");

      if (rowCategory === selectedCategory || selectedCategory === "") {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
});
