const str1 = "La raison sans les passions serait presque un roi sans sujet";
const str2 =
  "Quiconque lutte contre des monstres devrait prendre garde à ne pas devenir un monstre lui-même.";
let n = "";

function strtok() {
  n = prompt("chiffre en 1 et 9");
  const mots1 = str1.split(" ");
  const mots2 = str2.split(" ");
  console.log(mots1[n]);
  console.log(mots2[n]);
}

strtok();
