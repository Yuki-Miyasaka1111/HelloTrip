document.addEventListener('DOMContentLoaded', (event) => {
    let modal = document.getElementById("createProjectModal");
    let btn = document.getElementById("openModalButton");
    let span = document.getElementById("closeModalButton");

    btn.onclick = function() {
        modal.style.opacity = "1";
        modal.style.visibility = "visible";
    }

    span.onclick = function() {
        modal.style.opacity = "0";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.opacity = "0";
        }
    }

    modal.addEventListener("transitionend", function(event) {
        if(event.propertyName === "opacity" && window.getComputedStyle(modal).opacity === "0") {
            modal.style.visibility = "hidden";
        }
    }, false);
});