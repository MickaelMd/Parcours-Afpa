const text_test = "test";

const btn_test = document.getElementById("test1_show");

btn_test.addEventListener("mouseover", () => {
  btn_test.style.transition = "150ms";
  btn_test.style.backgroundColor = "red";
});

btn_test.addEventListener("mouseout", () => {
  btn_test.style.transition = "150ms";
  btn_test.style.backgroundColor = "";
});
