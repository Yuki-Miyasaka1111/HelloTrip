document.addEventListener("DOMContentLoaded", function () {
    var dropdownToggles = document.querySelectorAll(".sidebar-nav-items > div");
    dropdownToggles.forEach(function (dropdownToggle) {
        dropdownToggle.addEventListener("click", function (event) {
            event.preventDefault();
            var parentListItem = event.target.closest(".sidebar-nav-items");
            parentListItem.classList.toggle("open");
        });
    });
});