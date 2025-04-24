export function writeNav() {
  const nav = document.createElement("nav");
  nav.innerHTML = ` 
      <a href="#accueil" id="btn_one">Accueil</a>
      <a href="#artiste" id="btn_two">Artistes</a>
      <a href="#d" id="btn_three">Disques</a>`;

  document.body.appendChild(nav);
  cliqueNav();
}

function updateZonePosition(button) {
  const rect = button.getBoundingClientRect();
  btn_back.style.display = "block";
  btn_back.style.position = "absolute";
  btn_back.style.width = `${rect.width}px`;
  btn_back.style.height = `${rect.height}px`;
  btn_back.style.top = `${rect.top}px`;
  btn_back.style.left = `${rect.left}px`;
  //   console.log(rect);
}

function activeLink() {
  const url = window.location.href;
  const index = url.includes("index");
  const artist = url.includes("artiste");
  const disque = url.includes("disque");
  const nav = document.getElementsByTagName("nav")[0];

  if (index == true) {
    const btn_active = btn_one;

    updateZonePosition(btn_active);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_one);
    });
  }

  if (artist == true) {
    const btn_active = btn_two;
    nav.style.top = "5%";
    nav.style.padding = "0px 0px";
    updateZonePosition(btn_active);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_two);
    });
  }
  if (disque == true) {
    const btn_active = btn_three;
    nav.style.top = "5%";
    nav.style.padding = "0px 0px";
    updateZonePosition(btn_active);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_three);
    });
  }
}

export function navMove() {
  activeLink();

  document.getElementById("btn_one").addEventListener("mouseover", () => {
    updateZonePosition(btn_one);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_one);
    });
  });
  document.getElementById("btn_two").addEventListener("mouseover", () => {
    updateZonePosition(btn_two);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_two);
    });
  });

  document.getElementById("btn_three").addEventListener("mouseover", () => {
    updateZonePosition(btn_three);

    window.addEventListener("resize", function () {
      updateZonePosition(btn_three);
    });
  });
}

function cliqueNav() {
  const nav = document.getElementsByTagName("nav")[0];
  document.getElementById("btn_three").addEventListener("click", () => {
    nav.style.top = "5%";
    document.getElementById("btn_back").style.display = "none";

    setTimeout(() => {
      window.location.href = "./disque.html";
    }, 600);
  });

  document.getElementById("btn_two").addEventListener("click", () => {
    nav.style.top = "5%";
    document.getElementById("btn_back").style.display = "none";

    setTimeout(() => {
      window.location.href = "./artiste.html";
    }, 600);
  });

  document.getElementById("btn_one").addEventListener("click", () => {
    nav.style.top = "45%";
    document.getElementById("btn_back").style.display = "none";

    setTimeout(() => {
      window.location.href = "./index.html";
    }, 600);
  });
}
