let uservalue;
let i = 10;
let add = 1;
let ope;
let result;

function TableMultiplication(uservalue) {
  uservalue = prompt("Quelle table voulez-vous ?");
  do {
    result = uservalue * add;
    console.log(uservalue + " x " + add + " = " + result);
    add++;
    i--;
  } while (i > 0);
}
TableMultiplication();
