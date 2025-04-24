let array = [];

fetch("../data/record.json")
  .then((response) => response.json())
  .then((data) => {
    const discs = data[3].data;

    discs.forEach((disc) => {
      array.push(disc.disc_picture);
    });
  });

function removeImage() {
  const images = document.getElementsByClassName("img_index");

  if (images.length > 0) {
    const delImage = images[0];

    delImage.classList.add("hidden");

    setTimeout(() => {
      delImage.remove();
    }, 600);
  }

  if (images.length > 4) {
    const delImage = images[0];

    delImage.classList.add("hidden");

    setTimeout(() => {
      delImage.remove();
    }, 300);
  }
}

export function showImageAnim(setinterval, settimeout, activate) {
  let lastX = 0;
  let lastY = 0;

  setInterval(removeImage, setinterval);

  document.addEventListener("mousemove", (event) => {
    // if (activate == true) {
    if (
      Math.abs(event.pageX - lastX) >= 180 ||
      Math.abs(event.pageY - lastY) >= 180
    ) {
      //   console.log(event.pageX, event.pageY);
      lastX = event.pageX;
      lastY = event.pageY;
      const img = document.createElement("img");
      img.src =
        "assets/img/pictures/" +
        array[Math.floor(Math.random() * array.length)];
      img.classList.add("img_index");
      img.style.position = "absolute";
      img.style.left = `${event.pageX - 50}px`;
      img.style.top = `${event.pageY - 50}px`;
      document.body.appendChild(img);

      setTimeout(() => {
        img.classList.add("visible");
      }, settimeout);
    }
    // }
  });
}
