//Start Show Password

let checkboxPass = document.querySelector(".checkbox-pass");
let passwordInput = document.querySelector(".password");
checkboxPass.onclick = () => {
  if (checkboxPass.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
};

//End Show Password

// Start popup

let popup = document.getElementById("popup");
function openPopup() {
  popup.classList.add("open-popup");
}
function closePopup() {
  popup.classList.remove("open-popup");
}

// End Popup
