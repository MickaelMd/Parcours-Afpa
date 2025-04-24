const img_upload = document.getElementById("inputGroupFile02");
const img_show = document.getElementById("img_show");

img_upload.addEventListener("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      img_show.src = e.target.result;
      img_show.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});
