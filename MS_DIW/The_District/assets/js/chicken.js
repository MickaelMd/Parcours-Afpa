let typedWord = "";
const newImageUrl =
  "https://as1.ftcdn.net/v2/jpg/05/58/72/10/1000_F_558721098_2Rw1X8iuXXI2tkPw8bclo8uGd3aSMWhT.jpg";
const images = document.querySelectorAll("#pres_cat_pl img");

document.addEventListener("keydown", function (event) {
  typedWord += event.key;

  if (typedWord.includes("tardis")) {
    images.forEach((img) => {
      img.src = newImageUrl;
    });
    typedWord = "";
  }
  if (typedWord.length > 10) {
    typedWord = typedWord.slice(-5);
  }
});
