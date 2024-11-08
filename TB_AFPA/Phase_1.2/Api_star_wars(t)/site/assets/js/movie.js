document.addEventListener("DOMContentLoaded", () => {
  const api = new API("films");
  const movieListContainer = document.getElementById("movie-list");
  const movieDetailsContainer = document.getElementById("movie-details");

  api.fetchAll().then((movies) => {
    Display.displayList(movies, movieListContainer, "films");
  });

  movieListContainer.addEventListener("click", (event) => {
    if (event.target.classList.contains("view-details")) {
      const url = event.target.getAttribute("data-id");
      fetch(url)
        .then((response) => response.json())
        .then((data) => {
          Display.displayDetails(data, movieDetailsContainer);
        });
    }
  });
});
