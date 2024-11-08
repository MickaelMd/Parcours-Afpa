let tab = [];
let uservalue;
let i = 0;
let agevingt = 0;
let agequarante = 0;
let agevinquar = 0;

do {
  uservalue = parseInt(prompt("Age ?"));
  if (uservalue > 0 && uservalue <= 20) {
    tab.push(uservalue);
    agevingt++;
  }
  if (uservalue > 40) {
    tab.push(uservalue);
    agequarante++;
  }
  if (uservalue >= 21 && uservalue <= 40) {
    tab.push(uservalue);
    agevinquar++;
  }
} while (uservalue < 99);

console.log(tab);

console.log(
  "Il y a " + agevingt + " personnes dont l'age est inférieur a 20 ans"
);
console.log(
  "Il y a " + agequarante + " personnes dont l'age est supérieur a 40 ans"
);
console.log(
  "Il y a " + agevinquar + " personnes dont l'age est entre 20 et 40 ans"
);
