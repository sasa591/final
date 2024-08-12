let btn = document.getElementById("btn");
let file = document.getElementById("file");
btn.addEventListener("click", function () {
  if (this.checked) {
    file.style.display = "block";
    file.style.height = "100%";
    file.style.transition = "height 0.3s";
  } else {
    file.style.display = "none";
    file.style.height = "0";
    file.style.transition = "height 0.3s";
  }
});
