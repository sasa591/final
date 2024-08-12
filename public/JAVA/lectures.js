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



