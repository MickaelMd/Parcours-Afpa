let constrain = 20;
let mouseOverContainer = document.getElementById("ex1");
let ex1Layer = document.getElementById("ex1-layer");

function transforms(x, y, el) {
  let box = el.getBoundingClientRect();
  let calcX = -(y - box.top - box.height / 2) / constrain;
  let calcY = (x - box.left - box.width / 2) / constrain;

  return (
    "perspective(500px) " +
    "rotateX(" +
    calcX +
    "deg) " +
    "rotateY(" +
    calcY +
    "deg)"
  );
}

function transformElement(el, xyEl) {
  el.style.transform = transforms(xyEl[0], xyEl[1], el);
}

mouseOverContainer.addEventListener("mousemove", function (e) {
  let xy = [e.clientX, e.clientY];
  window.requestAnimationFrame(function () {
    transformElement(ex1Layer, xy);
  });
});

mouseOverContainer.addEventListener("mouseleave", function () {
  ex1Layer.style.transform = "perspective(500px) rotateX(0deg) rotateY(0deg)";
});

// ---------------

const input_search = document.getElementById("input_search");
const search_zone = document.getElementById("search_zone");
const plats = document.querySelectorAll(".plat_affiche");

input_search.addEventListener("input", searchPlats);
search_zone.style.display = "none";

function showSearchZone() {
  plats.forEach((plat, index) => {
    plat.style.display = index < 3 ? "flex" : "none";
  });
  search_zone.style.removeProperty("display");
}

input_search.addEventListener("click", (event) => {
  event.stopPropagation();
  if (search_zone.style.display === "none") {
    showSearchZone();
  }
});

input_search.addEventListener("focus", (event) => {
  event.stopPropagation();
  if (search_zone.style.display === "none") {
    showSearchZone();
  }
});

document.addEventListener("click", () => {
  search_zone.style.display = "none";
});

function searchPlats() {
  const query = input_search.value.toLowerCase();
  let resultCount = 0;

  plats.forEach((plat) => {
    const platInfo = plat
      .querySelector(".info_plat_sh h5")
      .textContent.toLowerCase();

    if (platInfo.includes(query) && resultCount < 3) {
      plat.style.display = "flex";
      resultCount++;
    } else {
      plat.style.display = "none";
    }
  });
}

// --------------

document.addEventListener("keydown", function (event) {
  if (event.ctrlKey && event.key === "k") {
    event.preventDefault();

    if (input_search) {
      input_search.focus();
    }
  }
});

// -------------------
