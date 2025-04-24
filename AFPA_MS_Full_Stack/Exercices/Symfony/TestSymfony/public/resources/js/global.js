document.getElementById("test").addEventListener("click", function event() {
  console.log("test");

  const pe = document.createElement("div");
  pe.innerHTML = "</br>test";
  document.getElementById("test").appendChild(pe);

  document.getElementById("test").removeEventListener("click", event);
});
