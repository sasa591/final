// Start Popup
// Start first popup
// let popup = document.getElementById("popup");
// function openPopup() {
//   popup.classList.add("open-popup");
//   popup3.classList.remove("open-popup");
// }
// function closePopup() {
//   popup.classList.remove("open-popup");
// }
// End first popup

// Start Third popup
// let popup3 = document.getElementById("popup3");
// function openPopup3() {
//   popup3.classList.add("open-popup");
//   popup.classList.remove("open-popup");
// }
// function closePopup3() {
//   popup3.classList.remove("open-popup");
// }
// End Third popup

// End Popup

// Start display Image in Create Post
let fileInput = document.getElementById("fileInput");

function displayImage(event) {
  let files = event.target.files;
  let info = document.getElementById("in");
  info.innerHTML = "";
  for (let i = 0; i < files.length; i++) {
    let src = URL.createObjectURL(files[i]);
    info.innerHTML = `<img id="ia" src="${src}">
      <i id="ic" class="fa-solid fa-circle-minus"></i>`;
    let ia = document.getElementById("ia");
    let icon = document.getElementById("ic");
    icon.style.color = "red";
    icon.style.cursor = "pointer";
    icon.addEventListener("click", function () {
      ia.remove();
      icon.remove();
    });
  }
}
// End display Image in Create Post

// Start display Image in Edit Post


// function displayImage2(event) {
//   let files = event.target.files;
//   let info = document.getElementById("in2");
//   info.innerHTML = "";

//     let src = URL.createObjectURL(files[0]);

//     let content_image=document.getElementById('content_imag');
//     let answer=content_image.querySelector('img')!==null;
//     if(answer){
//         content_image.style.display = "none";
//     }
//     info.innerHTML = `<img id="ib" src="${src}">
//       <i id="id" class="fa-solid fa-circle-minus"></i>`;
//     let ia = document.getElementById("ib");
//     let icon = document.getElementById("id");
//     icon.style.color = "red";
//     icon.style.cursor = "pointer";
//     icon.addEventListener("click", function () {
//       ia.remove();
//       icon.remove();
//     });

// }
// End display Image in Edit Post

// Start Somting to post
function toggleRequired(inputId, otherInputId) {
  var input = document.getElementById(inputId);
  var otherInput = document.getElementById(otherInputId);

  if (input.value.trim() !== "") {
    otherInput.removeAttribute("required");
  } else {
    otherInput.setAttribute("required", "required");
  }
}
// End Somting to post




// let postText = document.getElementById("post-text");
// function toggleContent() {
//   postText.removeAttribute("readonly");
//   postText.focus();
//   var content = document.getElementById("contentA");
//   var icon = document.getElementById("iconA");
//   icon.style.display = "none";
//   content.style.display = content.style.display === "none" ? "flex" : "none";
// }

// function handleClick(event) {
//   var content = document.getElementById("contentA");
//   var icon = document.getElementById("iconA");
//   var textareaeditpost = document.getElementById("textareaeditpost");
//   if (
//     !content.contains(event.target) &&
//     !icon.contains(event.target) &&
//     !textareaeditpost.contains(event.target)
//   ) {
//     content.style.display = "none";
//     icon.style.display = "inline";
//     postText.setAttribute("readonly", "readonly");
//   }
// }

// Start Edit or Delete Comment
// let deletCommentIcon = document.getElementById("editCommentIcon");
// let commentText = document.getElementById("comment-text");
// let rplayInput = document.getElementById("rplayInput");
// deletCommentIcon.onclick = function () {
//     console.log("dcl,;l,x")
//   commentText.removeAttribute("readonly");
//   commentText.focus();
//   rplayInput.style.display = "block";
// };


// function handleClick2(event) {
//   var content = document.getElementById("commentTextArea");
//   var icon = document.getElementById("editCommentIcon");
//   if (!content.contains(event.target) && !icon.contains(event.target)) {
//     icon.style.display = "inline";
//     commentText.setAttribute("readonly", "readonly");
//   }
// }
// End Edit or Delete Comment



// const postEdit = document.getElementById("Edit-post-icon_"+postId);
// const editPostDiv = document.getElementById("contentA_"+postId);
// function handy(event){
//     if(!postEdit.contains(event.target) && !editPostDiv.contains(event.target)){
//         editPostDiv.display = 'none';
//     }
// }

document.querySelectorAll('.edit').forEach(icuon => {
    icuon.addEventListener('click', function() {
        // الحصول على معرف المنشور
        const postId = this.getAttribute('data-post-id');

        const editMenu = document.getElementById('contentA_'+postId);
        editMenu.style.display = 'none';

        document.querySelectorAll('.post-text-btn').forEach(menu => {
            menu.style.display = 'none';
        });

        document.querySelectorAll('.edit').forEach(eee => {
            eee.style.display = 'flex';
        });


        const textarea = document.getElementById('post-text_'+postId);
        textarea.removeAttribute("readonly");
        textarea.focus();

        document.querySelectorAll('.textare').forEach(menu => {
            menu.setAttribute("readonly","readonly");
        });
        document.querySelectorAll('.replaytext').forEach(menu => {
            menu.setAttribute("readonly","readonly");
        });

        document.querySelectorAll(".rep").forEach(menu => {
            menu.style.display = 'block';
        });

        document.querySelectorAll(".mod").forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll(".edd").forEach(menu => {
            menu.style.display = 'block';
        });
        document.querySelectorAll(".mohammd").forEach(menu => {
            menu.style.display = 'none';
        });
        editMenu.style.display = 'flex';

        const editbutton = document.getElementById('Edit-post-icon_'+postId);
        editbutton.style.display='none';
        // textarea لحد الّان عدلنا ال
        //edit وظهرنا زر الصورة وال

        const imaage = document.getElementById('fileInput2_'+postId);
        imaage.addEventListener("change", function(event) {
            // قم بكتابة التعليمات التي تريد تنفيذها عند حدوث تغيير
            console.log("تم تغيير القيمة");
            let files = event.target.files;
            let info = document.getElementById("mm_"+postId);

            info.innerHTML = "";
            let src = URL.createObjectURL(files[0]);

            let content_image=document.getElementById("content_imag_"+postId);
            if(content_image.querySelector('img')){
                content_image.style.display = "none";
            }
            info.innerHTML = `<img id="ib" src="${src}">
              <i id="id" class="fa-solid fa-circle-minus"></i>`;
            let ia = document.getElementById("ib");
            let icon = document.getElementById("id");
            icon.style.color = "red";
            icon.style.cursor = "pointer";
            icon.addEventListener("click", function () {
              ia.remove();
              icon.remove();
            });
        });

    });

});


document.querySelectorAll('.rep').forEach(icuon => {
    icuon.addEventListener('click', function() {

        // الحصول على معرف المنشور
        const rdid = this.getAttribute('replay-post-id');

        const edc = document.getElementById('editrep_'+rdid);
        edc.style.display = 'none';

        document.querySelectorAll('.mod').forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll('.replaytext').forEach(mm => {
            mm.readOnly = true;
        });

        document.querySelectorAll('.rep').forEach(eee => {
            eee.style.display = 'block';
        });
        document.querySelectorAll('.post-text').forEach(menu => {
            menu.setAttribute("readonly","readonly");
        });

        document.querySelectorAll(".edit").forEach(menu => {
            menu.style.display = 'block';
        });

        document.querySelectorAll(".post-text-btn").forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll(".mod").forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll(".edd").forEach(menu => {
            menu.style.display = 'block';
        });
        document.querySelectorAll(".mohammd").forEach(menu => {
            menu.style.display = 'none';
        });

        const comtextarea = document.getElementById('reptext_'+rdid);
        comtextarea.removeAttribute("readonly");
        comtextarea.focus();

        const editcombutton = document.getElementById('ditrep_'+rdid);
        editcombutton.style.display='none';

        edc.style.display='block';

    });
});


document.querySelectorAll('.edd').forEach(icuon => {
    icuon.addEventListener('click', function() {

        // الحصول على معرف المنشور
        const edid = this.getAttribute('editcomment-post-id');

        const edc = document.getElementById('rplayInput_'+edid);
        edc.style.display = 'none';

        document.querySelectorAll('.mohammd').forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll('.textare').forEach(mm => {
            mm.readOnly = true;
        });

        document.querySelectorAll('.edd').forEach(eee => {
            eee.style.display = 'block';
        });

        document.querySelectorAll('.replaytext').forEach(menu => {
            menu.setAttribute("readonly","readonly");
        });

        document.querySelectorAll(".rep").forEach(menu => {
            menu.style.display = 'block';
        });

        document.querySelectorAll(".mod").forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll('.post-text').forEach(menu => {
            menu.setAttribute("readonly","readonly");
        });

        document.querySelectorAll(".edit").forEach(menu => {
            menu.style.display = 'block';
        });

        document.querySelectorAll(".post-text-btn").forEach(menu => {
            menu.style.display = 'none';
        });

        const comtextarea = document.getElementById('comment-text_'+edid);
        comtextarea.removeAttribute("readonly");
        comtextarea.focus();

        const editcombutton = document.getElementById('editcom_'+edid);
        editcombutton.style.display='none';

        edc.style.display='block';

    });
});




document.querySelectorAll('.rep').forEach(icuon => {
    icuon.addEventListener('click', function() {
        // الحصول على معرف المنشور
        const edid = this.getAttribute('replay-post-id');

        const edc = document.getElementById('editrep_'+edid);
        edc.style.display = 'none';

        document.querySelectorAll('.mod').forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll('.replaytext').forEach(mm => {
            mm.readOnly = true;
        });

        document.querySelectorAll('.rep').forEach(eee => {
            eee.style.display = 'block';
        });


        const comtextarea = document.getElementById('reptext_'+edid);
        comtextarea.removeAttribute("readonly");
        comtextarea.focus();
        const editcombutton = document.getElementById('ditrep_'+edid);
        editcombutton.style.display='none';

        edc.style.display='block';

    });
});

document.querySelectorAll('.replay').forEach(r => {
    r.addEventListener('click', function() {
        // الحصول على معرف المنشور
        const coment = this.getAttribute('comment-post-id');

        const editcommment = document.getElementById('comment_'+coment);

        document.querySelectorAll('.replayComment').forEach(www => {
            www.style.display = 'none';
        });

        editcommment.style.display = 'block';

    });
});


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
// Start textareaResize
document.querySelectorAll("textarea").forEach((i) => {
  i.addEventListener("keyup", (e) => {
    i.style.height = "50px";
    let scHeight = e.target.scrollHeight;
    i.style.height = `${scHeight}px`;
  });
});
// End textareaResize




