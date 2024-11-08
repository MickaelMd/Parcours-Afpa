let nombre = 45;
let multiple = 45;
let result;

function produit(x, y) {
  nombre = prompt("Entrez un nombre");
  multiple = prompt("Entrez un multiple");
  result = parseInt(nombre) * parseInt(multiple);
}

let cube = nombre * nombre * nombre;

function afficheImg(image) {
  document.body.innerHTML =
    "<img src='papillon.jpg' width='" +
    nombre +
    "'" +
    "height='" +
    multiple +
    "'>" +
    "<br>" +
    "<p>Le cube de " +
    nombre +
    " est égal à " +
    cube +
    "<br> Le produit de " +
    nombre +
    " x " +
    multiple +
    " est égal à " +
    result;
}

// Width et Height prennent le nombre et le multiple pour tester

produit();
afficheImg();
