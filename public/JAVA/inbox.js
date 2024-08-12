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



// Start Filter Color

var inputs = document.querySelectorAll('input[type="radio"]');
inputs.forEach(function (input) {
  input.addEventListener("change", function () {
    var container = this.parentElement;
    document.querySelectorAll(".container").forEach(function (item) {
      item.classList.remove("green", "orange", "red");
    });

    if (this.checked) {
      if (container.classList.contains("container-1")) {
        container.classList.add("green");
      } else if (container.classList.contains("container-2")) {
        container.classList.add("orange");
      } else if (container.classList.contains("container-3")) {
        container.classList.add("red");
      }
    }
  });
});

// End Filter Color


document.querySelectorAll('.rep').forEach(icuon => {
    icuon.addEventListener('click', function() {

        // الحصول على معرف المنشور
        const rdid = this.getAttribute('show_obj');
        let drop = document.getElementById("drop-down_"+rdid);
        let show = document.getElementById("show-email_"+rdid);

        if(show.style.display === "none")
        {
            document.querySelectorAll('.show-email').forEach(menu => {
                menu.style.display = 'none';
            });
            document.querySelectorAll('.ccc').forEach(menu => {
                menu.setAttribute("class", "fa-solid fa-chevron-down fa-fw ccc");
            });

            drop.setAttribute("class", "fa-solid fa-chevron-down fa-fw ccc");
            show.style.display = "block";
        }
        else
        {
            document.querySelectorAll('.show-email').forEach(menu => {
                menu.style.display = 'none';
            });
            document.querySelectorAll('.ccc').forEach(menu => {
                menu.setAttribute("class", "fa-solid fa-chevron-down fa-fw ccc");
            });
        }


    });

});

