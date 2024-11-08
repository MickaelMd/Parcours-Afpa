document.addEventListener("DOMContentLoaded", () => {
  const api = new API("people");
  const peopleListContainer = document.getElementById("people_list");
  const peopleDetailsContainer = document.getElementById("people_details");

  api.fetchAll().then((people) => {
    Display.displayList(people, peopleListContainer, "people");
  });

  peopleListContainer.addEventListener("click", (event) => {
    if (event.target.classList.contains("view-details")) {
      const url = event.target.getAttribute("data-id");
      fetch(url)
        .then((response) => response.json())
        .then((data) => {
          Display.displayDetails(data, peopleDetailsContainer);
        });
    }
  });
});
