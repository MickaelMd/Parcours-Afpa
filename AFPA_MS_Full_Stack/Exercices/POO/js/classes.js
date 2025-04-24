export class Jsonplaceholder {
  constructor(link, limit, place) {
    this.link = link;
    this.limit = "?_limit=" + limit;
    this.place = place;
  }

  ShowText() {
    fetch(this.link + this.limit)
      .then((response) => response.json())
      .then((data) => {
        const sectionTest = document.getElementById(this.place);
        sectionTest.innerHTML = "";

        data.forEach((post) => {
          const titleElement = document.createElement("h1");
          titleElement.innerHTML = `${post.title} -/- ${post.id}`;
          sectionTest.appendChild(titleElement);
        });
      })
      .catch((error) => {
        console.error("Erreur:", error);
      });
  }

  ShowImg() {
    fetch(this.link + this.limit)
      .then((response) => response.json())
      .then((data) => {
        const sectionTest = document.getElementById(this.place);
        sectionTest.innerHTML = "";

        data.forEach((post) => {
          const linkElement = document.createElement("a");
          linkElement.href = post.url;

          const imgElement = document.createElement("img");
          imgElement.src = post.url;

          imgElement.classList.add("img");
          imgElement.style.width = "200px";

          linkElement.appendChild(imgElement);
          sectionTest.appendChild(linkElement);
        });
      })
      .catch((error) => {
        console.error("Erreur:", error);
      });
  }
}

export let array = {
  test: "test",
  test1: "autre",
  number1: 10,
  number2: 486,
};

// ---------

export class OtherClass {
  #private_number = 50;
  public_number = 10;
  yy;

  constructor(number) {
    this.number = number;
    this.k;
  }

  calcul(private_number, public_number, number, yy) {
    this.yy = this.#private_number + 10 + this.public_number + this.number;
    return this.yy;
  }

  nocalcul() {
    return this.yy + 2;
  }

  ifif() {
    if (this.yy >= 50) {
      return true;
    } else {
      return false;
    }
  }
}
// ----------

export class TestText {
  constructor(texttitre, para, where) {
    this.texttitre = texttitre;
    this.where = where;
    this.para = para;
  }

  _textInsert() {
    return (document.getElementById(this.where).innerHTML =
      "<h1>" + this.texttitre + "</h1> <p>" + this.para + "</p>");
  }

  textinin() {
    return this._textInsert();
  }
  number() {
    return 45;
  }
}

export class TesTestText extends TestText {
  constructor(texttitre, para, where, other) {
    super(texttitre, para, where);
    this.other = other;
    this.number();
  }

  otherfun(other) {
    return 4 + this.other + this.number();
  }
}

// -----------------

export class Form {
  FormInput(forlabel, label, where) {
    return (
      (document.getElementById(
        `${where}`
      ).innerHTML = `<label for="${forlabel}">${label}</label>
    <input type="text" maxlength="40" for="${forlabel}"" id="${forlabel}" name="${forlabel}">`),
      document
        .getElementById(`${forlabel}`)
        .addEventListener("input", function () {
          console.log(document.getElementById(`${forlabel}`).value);
        })
    );
  }

  FormInputDeux(forlabel, label, where) {
    const form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("class", "form");

    const labelElement = document.createElement("label");
    labelElement.setAttribute("for", forlabel);
    labelElement.textContent = label;
    form.appendChild(labelElement);

    const inputElement = document.createElement("input");
    inputElement.type = "text";
    inputElement.maxLength = 40;
    inputElement.id = forlabel;
    inputElement.name = forlabel;
    form.appendChild(inputElement);

    const btn = document.createElement("button");
    btn.innerText = "reset";
    btn.setAttribute("type", "reset");
    btn.setAttribute("id", "btncl");
    form.appendChild(btn);

    inputElement.addEventListener("input", function () {
      if (inputElement.value == "") {
        console.log("vide");
      } else {
        fetch(
          `https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=${inputElement.value}&utf8=&format=json&origin=*`
        )
          .then((response) => response.json())
          .then((data) => {
            data.query.search.forEach((element) => {
              console.log(
                element.title +
                  " / " +
                  "https://en.wikipedia.org/?curid=" +
                  element.pageid
              );
            });
          })
          .catch((error) => console.error("Erreur:", error));
      }

      // console.log(inputElement.value);
    });

    document.getElementById(where).appendChild(form);
  }
}
