let input = "";
const number = rnumber(1, 100);
let testtour = 100;

function rnumber(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}

function getvalue() {
  input = document.getElementById("textBox1").value;
  verif();
}
document.getElementById("submit").addEventListener("click", getvalue);

function verif() {
  if (testtour > 0) {
    const userGuess = parseInt(input);
    if (userGuess === number) {
      document.getElementById("label1").innerHTML = "Bravo !";
    } else if (userGuess < number) {
      testtour--;
      document.getElementById("label1").innerHTML = "Trop petit !";
    } else if (userGuess > number) {
      testtour--;
      document.getElementById("label1").innerHTML = "Trop grand !";
    }
  } else {
    console.log("out");
  }
}

console.log(number);
