// ------------- Afficher du texte --------------
function adt() {
  let nom;
  let prenom;

  nom = prompt("Saisissez votre nom");
  prenom = prompt("Saisissez votre prenom");

  alert(nom + " " + prenom);
}

//  -------Addition de nombre-------
function ad() {
  let premiernombre;
  let deuxiemenombre;

  premiernombre = prompt("Premier nombre ?");
  deuxiemenombre = prompt("Deuxieme nombre ?");
  let result = parseInt(premiernombre) + parseInt(deuxiemenombre);
  alert(result);
}

// ---------------------------
function temp() {
  let temp;

  temp = prompt("degrés celsius");
  temp = (temp * 9) / 5 + 32;

  alert(temp);
}

// --------Opérateurs------
function op() {
  let a = 100;
  let b = 100;
  let c = 1.0;
  let d = true;

  console.log("Ceci est une chaîne de caractères : " + a);
  console.log(b - 1);
  console.log(a + c);
  console.log(d != d);
}

// ---Instructions conditionnelles et alternatives------
function ica() {
  let nombre;
  nombre = prompt("Ecrivez un nombre");
  result = nombre % 2;
  if (result == 0) {
    alert("Le nombre est pair");
  } else alert("Le nombre est impair");
}

// -----------------------------------

function age() {
  let age;
  age = prompt("Quelle est votre année de naissance");

  if (age <= 2006) {
    console.log("Majeur");
  } else {
    console.log("Mineur");
  }
}

// --------------------------------------
function calculatrice() {
  let premiernombre;
  let deuxiemenombre;
  let operateur;
  let result;

  premiernombre = prompt("Premier nombre ?");
  operateur = prompt("Entrer un opérateur (+, -, *, /)");
  deuxiemenombre = prompt("Deuxieme nombre ?");

  if (operateur == "+") {
    result = parseInt(premiernombre) + parseInt(deuxiemenombre);

    alert(result);
  } else if (operateur == "-") {
    result = parseInt(premiernombre) - parseInt(deuxiemenombre);

    alert(result);
  } else if (operateur == "*") {
    result = parseInt(premiernombre) * parseInt(deuxiemenombre);

    alert(result);
  } else if (operateur == "/") {
    result = parseInt(premiernombre) / parseInt(deuxiemenombre);

    alert(result);
  } else if ((operateur != "+", "-", "*", "/")) {
    alert("Erreur !, il faut utiliser un opérateur correct (+, -, *, /)");
  }
}

// ---Les boucles-----------------
function boucle1() {
  let prenom = "";
  let compteur = 0;

  do {
    prenom = prompt("Prénom ?");
    compteur++;
  } while (prenom !== "");
  console.log(compteur);
}

// -------------------------------
function boucle2() {
  let number;

  number = prompt("Donne moi un nombre !");

  while (number >= 0) {
    console.log(number);
    number--;
  }
}

// -----------------------------
function boucle3() {
  let numberone;
  let numbertwo;
  let numberthree;
  let somme;
  let result;
  numberone = parseInt(prompt("Donne moi un nombre !"));
  numbertwo = parseInt(prompt("Donne moi un autre nombre !"));
  numberthree = parseInt(prompt("Donne moi encore un autre nombre !"));
  somme = numberone + numbertwo + numberthree;
  result = (numberone + numbertwo + numberthree) / 3;
  console.log("La somme est de " + somme + " et la moyenne est de " + result);

  while (result >= 0) {
    console.log(result);
    result--;
  }
}

// ---------------------------
function boucle4() {
  let n = parseInt(prompt("Donne moi un nombre !"));
  let x = parseInt(prompt("Multiplier par quel nombre ?"));
  let i;
  let result;
  for (i = 1; i <= n; i++) {
    result = i * x;
    console.log(i + " x " + x + " = " + result);
  }
}

// -----------a revenir--------
function boucle5() {
  let mot;
  let count = 0;
  mot = prompt("Ecrit moi un mot");
  for (let i = 0; i < mot.length; i++) {
    let voyelle = mot[i];
    if (
      voyelle === "a" ||
      voyelle === "e" ||
      voyelle === "i" ||
      voyelle === "o" ||
      voyelle === "u" ||
      voyelle === "y"
    ) {
      count++;
    }
  }
  console.log("Nombre de voyelles : " + count);
}

// ------Fonctions------

// Dans un autre fichier (function/)

// ------Tableaux---------
function tableau() {
  let tableau;
  let taille;

  taille = parseInt(prompt("Taille du tableau ?"));
  tableau = [];
  i = taille;
  do {
    tableau.push(prompt("mot a ajouter ?"));
    taille = taille - 1;
  } while (taille > 0);
  console.log(tableau);
}
// ------Les objets natifs---
function objetsnatifs() {
  let tab = [];
  let uservalue;
  let somme = 0;
  let moyenne;
  let taille;

  do {
    uservalue = parseInt(prompt("Nombre à rajouter ?"));
    if (uservalue > 0) {
      tab.push(uservalue);
    }
  } while (uservalue > 0);

  taille = tab.length;

  for (let i = 0; i < taille; i++) {
    somme += tab[i];
  }

  moyenne = somme / taille;

  console.log("Nombre de valeurs: " + taille);
  console.log("Somme: " + somme);
  console.log("Moyenne: " + moyenne);
}

// ------------------------------------------------

btn1 = document.getElementById("btn1");
btn1.addEventListener("click", () => {
  adt();
});

btn2 = document.getElementById("btn2");
btn2.addEventListener("click", () => {
  ad();
});
btn3 = document.getElementById("btn3");
btn3.addEventListener("click", () => {
  temp();
});
btn4 = document.getElementById("btn4");
btn4.addEventListener("click", () => {
  op();
});
btn5 = document.getElementById("btn5");
btn5.addEventListener("click", () => {
  ica();
});
btn6 = document.getElementById("btn6");
btn6.addEventListener("click", () => {
  age();
});
btn7 = document.getElementById("btn7");
btn7.addEventListener("click", () => {
  calculatrice();
});
btn8 = document.getElementById("btn8");
btn8.addEventListener("click", () => {
  boucle1();
});
btn9 = document.getElementById("btn9");
btn9.addEventListener("click", () => {
  boucle2();
});
btn10 = document.getElementById("btn10");
btn10.addEventListener("click", () => {
  boucle3();
});
btn11 = document.getElementById("btn11");
btn11.addEventListener("click", () => {
  boucle4();
});
btn12 = document.getElementById("btn12");
btn12.addEventListener("click", () => {
  boucle5();
});
btn13 = document.getElementById("btn13");
btn13.addEventListener("click", () => {
  tableau();
});
btn14 = document.getElementById("btn14");
btn14.addEventListener("click", () => {
  objetsnatifs();
});
