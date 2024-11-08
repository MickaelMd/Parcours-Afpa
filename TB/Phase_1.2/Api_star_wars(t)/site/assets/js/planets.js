document.addEventListener("DOMContentLoaded", () => {
  const api = new API("planets");
  const planetListContainer = document.getElementById("planet-list");
  const planetDetailsContainer = document.getElementById("planet-details");

  api.fetchAll().then((planets) => {
    Display.displayList(planets, planetListContainer, "planets");
  });

  planetListContainer.addEventListener("click", (event) => {
    if (event.target.classList.contains("view-details")) {
      const url = event.target.getAttribute("data-id");
      fetch(url)
        .then((response) => response.json())
        .then((data) => {
          Display.displayDetails(data, planetDetailsContainer);
        });
    }
  });
});
