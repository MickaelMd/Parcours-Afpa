import { Jsonplaceholder } from "./classes.js";
import { array } from "./classes.js";
import { OtherClass } from "./classes.js";
import { TestText } from "./classes.js";
import { TesTestText } from "./classes.js";
import { Form } from "./classes.js";

// !%------------------------------%!
// !%------------------------------%!

// fetch("https://jsonplaceholder.typicode.com/todos/1")
//   .then((response) => response.json())
//   .then((json) => {
//     console.log(json);

//     for (const key in json) {
//       console.log(`${key}: ${json[key]}`);
//     }
//   })
//   .catch((error) => console.error("Erreur : ", error));

// --------------------

// fetch("https://jsonplaceholder.typicode.com/posts")
//   .then((response) => response.json())
//   .then((data) => {
//     data.forEach((element) => {
//       console.log(element);
//     });
//   });

// !%------------------------------%!
// !%------------------------------%!

document.getElementById("reset_show").addEventListener("click", () => {
  document.querySelectorAll("#content section").forEach((section) => {
    section.innerHTML = "";
  });
});

document.getElementById("test1_show").addEventListener("click", (e) => {
  const jsonPlaceholder = new Jsonplaceholder(
    "https://jsonplaceholder.typicode.com/posts",
    10,
    "test_section_text"
  );
  jsonPlaceholder.ShowText();

  const jsonPlaceholderr = new Jsonplaceholder(
    "https://jsonplaceholder.typicode.com/photos",
    10,
    "test_section_img"
  );
  jsonPlaceholderr.ShowImg();

  // ----------------

  console.log(array);

  console.log(array["number1"]);

  console.log(array.number1);

  // -------------------

  const OtherC = new OtherClass(12);
  console.log(OtherC.calcul());
  console.log(OtherC.nocalcul());
  console.log(OtherC.ifif());

  // -------------

  const newnew = new TestText(
    "Test titre",
    "Test paragraphe",
    "test_section_retext"
  );

  newnew._textInsert();

  console.log(newnew.textinin());

  const other = new TesTestText(
    "Test titre deux",
    "Test paragraphe deux",
    "test_section_retext",
    8
  );
  other._textInsert("");

  console.log(other.otherfun());

  // -------------------

  const newform = new Form();

  newform.FormInput("test", "test label", "test_section_reretext");

  newform.FormInput("newtest", "new test label", "newtest_section_reretext");

  newform.FormInputDeux("test", "test label", "form_section");
  let i = 0;
  document.getElementById("btncl").addEventListener("click", () => {
    i++;
    newform.FormInputDeux("test" + i, "test", "form_section_new");
    console.log(i);
  });

  // --------

  // https://fr.wikipedia.org/w/api.php?action=query&list=search&srsearch=Président%20français&utf8=&format=json

  fetch(
    "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=Président%20français&utf8=&format=json&origin=*&srlimit=100"
  )
    .then((response) => response.json())
    .then((data) => {
      data.query.search.forEach((element) => {
        console.log(element.title);
      });
    })
    .catch((error) => console.error("Erreur:", error));
});

console.log(text_test);
