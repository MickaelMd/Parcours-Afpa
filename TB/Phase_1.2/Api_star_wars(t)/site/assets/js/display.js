class Display {
  static createCard(item, type) {
    const card = document.createElement("div");
    card.className = "card mb-3";
    card.innerHTML = `
        <div class="card-body">
          <h5 class="card-title">${item.title || item.name}</h5>
          <button class="btn btn-primary view-details" data-id="${
            item.url
          }" data-type="${type}">View Details</button>
        </div>
      `;
    return card;
  }

  static displayList(items, container, type) {
    container.innerHTML = "";
    items.forEach((item) => {
      const card = this.createCard(item, type);
      container.appendChild(card);
    });
  }

  static displayDetails(item, container) {
    container.innerHTML = `
        <h2>${item.title || item.name}</h2>
        ${item.opening_crawl ? `<p>${item.opening_crawl}</p>` : ""}
        ${item.description ? `<p>${item.description}</p>` : ""}
        ${item.director ? `<p>Director: ${item.director}</p>` : ""}
        ${item.producer ? `<p>Producer: ${item.producer}</p>` : ""}
        ${item.release_date ? `<p>Release date: ${item.release_date}</p>` : ""}
        ${this.getPersonDetails(item)}
        ${this.getPlanetDetails(item)}
      `;
  }

  static getPersonDetails(person) {
    if (!person.height) return "";
    return `
        <p>Height: ${person.height} cm</p>
        <p>Mass: ${person.mass} kg</p>
        <p>Hair Color: ${person.hair_color}</p>
        <p>Skin Color: ${person.skin_color}</p>
        <p>Eye Color: ${person.eye_color}</p>
        <p>Birth Year: ${person.birth_year}</p>
        <p>Gender: ${person.gender}</p>
      `;
  }

  static getPlanetDetails(planet) {
    if (!planet.climate) return "";
    return `
        <p>Climate: ${planet.climate}</p>
        <p>Diameter: ${planet.diameter} km</p>
        <p>Gravity: ${planet.gravity}</p>
        <p>Orbital Period: ${planet.orbital_period} days</p>
        <p>Population: ${planet.population}</p>
        <p>Rotation Period: ${planet.rotation_period} hours</p>
        <p>Surface Water: ${planet.surface_water} %</p>
        <p>Terrain: ${planet.terrain}</p>
      `;
  }
}
