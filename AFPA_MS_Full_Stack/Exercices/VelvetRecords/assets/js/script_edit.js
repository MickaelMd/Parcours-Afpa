const btn_edit = document.getElementById("btn_edit");
const inputs = document.querySelectorAll(".form-control");
const btn_submit = document.getElementById("submit_btn");
const img_field = document.getElementById("upload_img");
const delete_btn = document.getElementById("delete_btn");
const select_artist = document.getElementById("select_artist");
const artist_input = document.getElementById("artist_details_f");

btn_edit.addEventListener("click", function (e) {
  inputs.forEach(function (input) {
    input.removeAttribute("disabled");
  });

  delete_btn.style.display = "none";
  btn_edit.style.display = "none";
  img_field.style.display = "";
  btn_submit.style.display = "";
  select_artist.style.display = "";
  artist_input.style.display = "none";
});

const delete_def_btn = document.getElementById("delete_submit");
delete_btn.addEventListener("click", function (e) {
  delete_def_btn.style.display = "";
  delete_btn.style.display = "none";
});

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
