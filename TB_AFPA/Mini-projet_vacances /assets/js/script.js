document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const tableContents = document.getElementById("table_contents_mobile");

  menuToggle.addEventListener("click", () => {
    tableContents.classList.toggle("active");
  });
});

// -------------------

const scrollToTopBtn = document.querySelector(".scrollToTopBtn");
scrollToTopBtn.addEventListener("click", scrollToTop);
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

// -----------------

document.querySelectorAll(".clickable-image").forEach((image) => {
  image.addEventListener("click", () => {
    let overlay = document.querySelector(".fullscreen-overlay");
    if (!overlay) {
      overlay = document.createElement("div");
      overlay.classList.add("fullscreen-overlay");
      document.body.appendChild(overlay);
    }

    let imgClone = document.querySelector(".fullscreen-image");
    if (!imgClone) {
      imgClone = image.cloneNode();
      imgClone.classList.add("fullscreen-image");
      document.body.appendChild(imgClone);
    } else {
      imgClone.remove();
      overlay.remove();
    }

    overlay.style.display = "block";

    overlay.addEventListener("click", () => {
      imgClone.remove();
      overlay.remove();
    });

    imgClone.addEventListener("click", () => {
      imgClone.remove();
      overlay.remove();
    });
  });
});
