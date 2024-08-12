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

// Start Years Select PopUp
let lect = document.getElementById("lect");
let years = document.getElementById("years");
let x = document.getElementById("x-close");
let content = document.getElementsByClassName("coursers");
let line = document.getElementsByClassName("Home-content");
lect.addEventListener("click", function () {
  years.classList.add("open-popup");
  content[0].style.opacity = "0.2";
  line[0].classList.add("active");
  yearsq.classList.remove("open-popup");
});
x.addEventListener("click", function () {
  years.classList.remove("open-popup");
  content[0].style.opacity = "1";
  line[0].classList.remove("active");
});
// End Years Select PopUp

// --------------------------------------

// Start Years Qizzes Select PopUp
let quizz = document.getElementById("quizz");
let yearsq = document.getElementById("yearsq");
let xx = document.getElementById("xx-close");
quizz.addEventListener("click", function () {
  yearsq.classList.add("open-popup");
  content[0].style.opacity = "0.2";
  line[0].classList.add("active");
});
xx.addEventListener("click", function () {
  yearsq.classList.remove("open-popup");
  content[0].style.opacity = "1";
  line[0].classList.remove("active");
  years.classList.remove("open-popup");
});
// End Years Qizzes Select PopUp
