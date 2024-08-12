// ------------------------------------------------------
// Start Notification menu
let notfiIcon = document.getElementById("notfi-icon");
let notfiMenu = document.getElementById("notfi-menu");
notfiIcon.onclick = function () {
  notfiMenu.classList.toggle("open-notfi");
};
// start Close Notification menu
let closeNotfiMenu = document.getElementById("close-notfi-menu");
closeNotfiMenu.onclick = function () {
  notfiMenu.classList.remove("open-notfi");
};
function handleClick3(event) {
  if (!notfiMenu.contains(event.target) && !notfiIcon.contains(event.target)) {
    notfiMenu.classList.remove("open-notfi");
  }
}
// End Notficition menu
// ----------------------------------------

// let dele = document.getElementById("dele");
// let pop = document.getElementById("popup");
// let cancel = document.getElementById("cancel");
// let content = document.getElementsByClassName("lectures");
// let line = document.getElementsByClassName("Home-content");
// dele.addEventListener("click", function () {
//   pop.classList.add("open-popup");
//   content[0].style.opacity = "0.2";
//   line[0].classList.add("active");
// });
// cancel.addEventListener("click", function () {
//   pop.classList.remove("open-popup");
//   content[0].style.opacity = "1";
//   line[0].classList.remove("active");
// });
