const reponse = await fetch("assets/json/books.json");
const data = await reponse.json();

const list_authors = data.map((book) => book.authors);
const all_authors = [].concat(...list_authors);
const newlist_authors = [...new Set(all_authors)];
newlist_authors.sort((a, b) => a.localeCompare(b));

const list_categories = data.map((book) => book.categories);
const all_categories = [].concat(...list_categories);
const newlist_categories = [...new Set(all_categories)];
newlist_categories.sort((a, b) => a.localeCompare(b));

const list_date = data.map((book) => {
  if (book.publishedDate && book.publishedDate.dt_txt) {
    const date = new Date(book.publishedDate.dt_txt);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
  }
  return null;
});
console.log(list_date);

const authors_select = document.getElementById("auteurs_select");
const categorie_select = document.getElementById("categorie_select");

newlist_authors.forEach((author) => {
  let name = document.createElement("option");
  name.text = author;
  authors_select.add(name);
});

newlist_categories.forEach((category) => {
  let cate = document.createElement("option");
  cate.text = category;
  categorie_select.add(cate);
});

categorie_select.addEventListener("change", () => {
  authors_select.value = "";
  filterBooks();
});

authors_select.addEventListener("change", () => {
  categorie_select.value = "";
  filterBooks();
});

function filterBooks() {
  const selectedAuthor = authors_select.value;
  const selectedCategory = categorie_select.value;

  let filteredData = data;

  if (selectedAuthor) {
    filteredData = filteredData.filter((book) =>
      book.authors.includes(selectedAuthor)
    );
  }

  if (selectedCategory) {
    filteredData = filteredData.filter((book) =>
      book.categories.includes(selectedCategory)
    );
  }

  displaybook(filteredData);
}

function displaybook(data) {
  let listelivres = document.getElementById("displaycards");
  listelivres.innerHTML = "";

  data.forEach((book) => {
    let displaybook = document.createElement("div");
    displaybook.className = "card";
    listelivres.appendChild(displaybook);

    let thumbnail = document.createElement("img");
    if (book.thumbnailUrl) {
      thumbnail.src = book.thumbnailUrl;
    } else {
      thumbnail.src =
        "https://p1.storage.canalblog.com/14/48/1145642/91330992_o.png";
    }
    thumbnail.onerror = function () {
      this.src =
        "https://p1.storage.canalblog.com/14/48/1145642/91330992_o.png";
    };
    displaybook.appendChild(thumbnail);

    let nomlivre = document.createElement("h4");
    nomlivre.textContent = `${book.title}`;
    displaybook.appendChild(nomlivre);

    let isbn = document.createElement("p");
    isbn.textContent = `ISBN : ${book.isbn}`;
    displaybook.appendChild(isbn);

    let datepubli = document.createElement("p");
    if (book.publishedDate && book.publishedDate.dt_txt) {
      const date = new Date(book.publishedDate.dt_txt);
      const jour = String(date.getDate()).padStart(2, "0");
      const mois = String(date.getMonth() + 1).padStart(2, "0");
      const annee = date.getFullYear();
      datepubli.textContent = `Date de publication : ${jour}/${mois}/${annee}`;
    } else {
      datepubli.textContent = "";
    }
    displaybook.appendChild(datepubli);

    let numberpage = document.createElement("p");
    if (book.pageCount == 0) {
      numberpage.textContent = "";
    } else {
      numberpage.textContent = `Nombre de pages : ${book.pageCount}`;
    }
    displaybook.appendChild(numberpage);

    let auteur = document.createElement("p");
    auteur.textContent = `Auteur : ${book.authors.join(", ")}`;
    displaybook.appendChild(auteur);

    let categorie = document.createElement("p");
    categorie.textContent = `Catégorie : ${book.categories.join(", ")}`;
    displaybook.appendChild(categorie);

    let description = document.createElement("p");
    if (book.shortDescription == null) {
      categorie.textContent = "";
    } else {
      description.textContent = ` Description : ${book.shortDescription}`;
    }
    displaybook.appendChild(description);
  });
}

displaybook(data);
