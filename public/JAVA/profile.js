let popup = document.getElementById("popup");
function openPopup() {
  popup.classList.add("open-popup");
  popup2.classList.remove("open-popup");
  popup3.classList.remove("open-popup");
  popup4.classList.remove("open-popup");
  popup5.classList.remove("open-popup");
  popup6.classList.remove("open-popup");
}
function closePopup() {
  popup.classList.remove("open-popup");
}
// -----------------------------------------------
let popup2 = document.getElementById("popup2");
function openPopup2() {
  popup2.classList.add("open-popup");
  popup.classList.remove("open-popup");
  popup3.classList.remove("open-popup");
  popup4.classList.remove("open-popup");
  popup5.classList.remove("open-popup");
  popup6.classList.remove("open-popup");
}
function closePopup2() {
  popup2.classList.remove("open-popup");
}
// -----------------------------------------------
let popup3 = document.getElementById("popup3");
function openPopup3() {
  popup3.classList.add("open-popup");
  popup.classList.remove("open-popup");
  popup2.classList.remove("open-popup");
  popup4.classList.remove("open-popup");
  popup5.classList.remove("open-popup");
  popup6.classList.remove("open-popup");
}
function closePopup3() {
  popup3.classList.remove("open-popup");
}
// -----------------------------------------------
let popup4 = document.getElementById("popup4");
function openPopup4() {
  popup4.classList.add("open-popup");
  popup.classList.remove("open-popup");
  popup2.classList.remove("open-popup");
  popup3.classList.remove("open-popup");
  popup5.classList.remove("open-popup");
  popup6.classList.remove("open-popup");
}
function closePopup4() {
  popup4.classList.remove("open-popup");
}
// -----------------------------------------------
let popup5 = document.getElementById("popup5");
function openPopup5() {
  popup5.classList.add("open-popup");
  popup.classList.remove("open-popup");
  popup2.classList.remove("open-popup");
  popup3.classList.remove("open-popup");
  popup4.classList.remove("open-popup");
  popup6.classList.remove("open-popup");
}
function closePopup5() {
  popup5.classList.remove("open-popup");
}
// -----------------------------------------------
let popup6 = document.getElementById("popup6");
function openPopup6() {
  popup6.classList.add("open-popup");
  popup.classList.remove("open-popup");
  popup2.classList.remove("open-popup");
  popup3.classList.remove("open-popup");
  popup4.classList.remove("open-popup");
  popup5.classList.remove("open-popup");
}
function closePopup6() {
  popup6.classList.remove("open-popup");
}
// ------------------------------------------------------
// Start Notification menu
let notfiIcon = document.getElementById("notfi-icon");
let notfiMenu = document.getElementById("notfi-menu");
notfiIcon.onclick = function () {
  notfiMenu.classList.toggle("open-notfi");
  notfiIcon.classList.remove("light-red");
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
// End Close Notification menu
// End Notification menu
// ------------------------------------------------------
// start change photo button

let chp = document.querySelector(".chp");
let ima = document.getElementById("ima");
ima.onclick = function(){
    chp.style.display = "block";
}

// start change photo button
