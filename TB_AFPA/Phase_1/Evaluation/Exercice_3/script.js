let tab = [
  "Audrey",
  "Aurélien",
  "Flavien",
  "Jérémy",
  "Laurent",
  "Melik",
  "Nouara",
  "Salem",
  "Samuel",
  "Stéphane",
];
let uservalue;
let pos;
let btnforchome;

console.log(tab.length);

function script() {
  do {
    uservalue = prompt("Donne moi un prénom !");
    if (tab.includes(uservalue)) {
      pos = tab.indexOf(uservalue);
      tab.splice(pos, 1);
      console.log(tab);
    } else {
      console.log("Prénom non trouvé");
    }
  } while (tab.length > 0);
}

btnforchome = document.getElementById("btn");
btnforchome.addEventListener("click", () => {
  script();
});

// /!\ Ajout du bouton pour chrome /!\
