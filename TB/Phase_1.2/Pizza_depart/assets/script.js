let btn;
btn = document.getElementsByClassName("button")[0];

btn.addEventListener("click", () => {
  display();
});

function display() {
  fetch("data.json")
    .then((response) => response.json())
    .then((data) => {
      let previewDiv = document.querySelector(".preview");
      previewDiv.innerHTML = "";

      // let nouvelElement = document.createElement("div");
      // let parentElement = document.getElementById("conteneur");
      // parentElement.appendChild(nouvelElement);

      let restauInfoDiv = document.createElement("div");
      restauInfoDiv.style.textAlign = "center";
      restauInfoDiv.style.marginBottom = "20px";

      let nomRestau = document.createElement("h1");
      nomRestau.textContent = data.nom;
      restauInfoDiv.appendChild(nomRestau);

      let sloganRestau = document.createElement("p");
      sloganRestau.textContent = data.slogan;
      restauInfoDiv.appendChild(sloganRestau);
      previewDiv.appendChild(restauInfoDiv);

      // ---------------------------

      // let nomrestau = document.createElement("p");
      // nomrestau.textContent = data.nom;
      // previewDiv.appendChild(nomrestau);

      // let sloganrestau = document.createElement("p");
      // sloganrestau.textContent = data.slogan;
      // previewDiv.appendChild(sloganrestau);
      // ----------------
      let pizzas = data.pizzas;
      previewDiv.style = "display : flex";
      previewDiv.style.flexWrap = "wrap";
      previewDiv.style.justifyContent = "center";

      pizzas.forEach((pizza) => {
        let cardDiv = document.createElement("div");
        cardDiv.className = "card";
        cardDiv.style.border = "1px solid black";
        cardDiv.style.margin = "10px";
        cardDiv.style.padding = "10px";
        cardDiv.style.backgroundColor = "#fff";
        cardDiv.style.maxWidth = "300px";
        cardDiv.style.textAlign = "center";
        previewDiv.appendChild(cardDiv);

        let img = document.createElement("img");
        img.src = pizza.image;
        img.style.width = "100%";
        cardDiv.appendChild(img);

        let nom = document.createElement("h2");
        nom.textContent = pizza.nom;
        cardDiv.appendChild(nom);

        let prix = document.createElement("p");
        prix.textContent = `Prix: ${pizza.prix}`;
        cardDiv.appendChild(prix);

        let garnitures = document.createElement("ul");
        pizza.garnitures.forEach((garniture) => {
          let li = document.createElement("li");
          li.textContent = garniture;
          garnitures.appendChild(li);
        });
        cardDiv.appendChild(garnitures);
      });
    });
}
