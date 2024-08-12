//Start Strong Password

let pass = document.getElementById("paassword");
let msg = document.getElementById("meessage");
let str = document.getElementById("sstrenght");
pass.addEventListener("input", () => {
  if (pass.value.length > 0) {
    msg.style.display = "block";
  } else {
    msg.style.display = "none";
  }
  if (pass.value.length < 4) {
    str.innerHTML = "Weak";
    msg.style.color = "red";
    msg.style.zIndex = "-3";
  } else if (pass.value.length >= 4 && pass.value.length < 8) {
    str.innerHTML = "Medium";
    msg.style.color = "#ff5b29";
    msg.style.zIndex = "-3";
  } else if (pass.value.length >= 8) {
    str.innerHTML = "Strong";
    msg.style.color = "green";
    msg.style.zIndex = "-3";
  }
});

//End Strong Password

// Start Show Password

let eyeicon = document.getElementById("eyeicon");
eyeicon.onclick = () => {
  if (pass.type == "password") {
    pass.type = "text";
    eyeicon.src = "Images/eye-open.png";
  } else {
    pass.type = "password";
    eyeicon.src = "Images/eye-close.png";
  }
};

// End Show Password
