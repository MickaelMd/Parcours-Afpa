import { navMove, writeNav } from "./nav.js";

writeNav();
navMove();

fetch("../data/record.json")
  .then((response) => response.json())
  .then((data) => {
    const discs = data[2].data;

    const artists = discs.map((disc) => disc.artist_name);

    artists.forEach((artist) => {
      const apiUrl = `https://fr.wikipedia.org/w/api.php?action=query&format=json&origin=*&prop=pageimages|extracts&titles=${encodeURIComponent(
        artist
      )}&exintro&explaintext&piprop=thumbnail&pithumbsize=500`;

      fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
          const page = Object.values(data.query.pages)[0];
          if (page) {
            console.log(page);
            const section = document.getElementById("artist_cards_section");
            const card = document.createElement("div");
            card.className = "card_artist";
            section.appendChild(card);

            const h1 = document.createElement("h1");
            h1.innerHTML = artist;
            card.appendChild(h1);

            const image = document.createElement("img");
            image.src = page.thumbnail?.source || "assets/img/default.webp";
            image.alt = `Image de ${artist}`;
            card.appendChild(image);

            const p = document.createElement("p");
            const description =
              page.extract || "Aucune description disponible.";
            const words = description.split(" ");
            p.innerHTML =
              words.length > 100
                ? words.slice(0, 100).join(" ") + "..."
                : description;
            card.appendChild(p);

            const a = document.createElement("a");
            a.href = "http://fr.wikipedia.org/?curid=" + page.pageid || "#";
            a.innerHTML = "Page wikipédia";
            card.appendChild(a);
          } else {
            console.log(`Aucun résultat trouvé pour ${artist}`);
          }
        })
        .catch((error) => {
          console.error(`Erreur lors de la recherche pour ${artist}:`, error);
        });
    });
  })
  .catch((error) => {
    console.error("Erreur lors du chargement des données :", error);
  });
