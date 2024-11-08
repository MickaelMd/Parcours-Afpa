document.addEventListener("DOMContentLoaded", function () {
  const ecran = document.getElementById("affichage_text");
  const button = document.querySelectorAll(".btn_number");
  let currentInput = "";

  button.forEach((button) => {
    button.addEventListener("click", () => {
      const value = button.textContent;

      if (value === "=") {
        try {
          currentInput = eval(currentInput);
          ecran.textContent = currentInput;
        } catch (error) {
          ecran.textContent = "Erreur";
        }
      } else if (value === "DEL") {
        currentInput = "0";
        ecran.textContent = currentInput;
      } else {
        currentInput += value;
        ecran.textContent = currentInput;
      }
    });
  });
});
