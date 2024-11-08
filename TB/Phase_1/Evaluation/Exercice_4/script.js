let pu;
let qtecom;
let pap;
let rem;
let port;
let total;

pu = parseInt(prompt("Prix Unitaire du produit ?"));
qtecom = parseInt(prompt("Quantité ?"));

total = pu * qtecom;

if (total >= 100 && total <= 200) {
  rem = (5 / 100) * total;
  total = total - rem;
  console.log("prix entre 100 et 200");
}
if (total >= 200) {
  rem = (10 / 100) * total;
  total = total - rem;
  console.log("prix supp a 200");
} else if (total < 100) {
  console.log("prix inf a 100");
}
if (total > 500) {
  port = 0;
  console.log("Port gratuit !");
} else {
  port = (2 / 100) * total;
}

if (port >= 0.0001 && port <= 6) {
  total = total + 6;
} else {
  total = total + port;
}
console.log(total);
