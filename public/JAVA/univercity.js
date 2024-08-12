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
let pay = document.getElementById("pay");
let confirmpay = document.getElementById("confirm");
let objform = document.getElementById("objform");
pay.onclick = function () {
  if (objform.checkValidity()) {
    confirmpay.classList.add("open-popup");
  } else {
    window.alert("Please file out this form before proceeding to payemnt");
  }
};
let cls = document.getElementById("cls");
cls.onclick = function () {
  confirmpay.classList.remove("open-popup");
};

let ok = document.getElementById("ok");
ok.onclick = function () {
  money.classList.remove("open-popup");
  obj.style.opacity = "1";
};
// end you have not enough money
