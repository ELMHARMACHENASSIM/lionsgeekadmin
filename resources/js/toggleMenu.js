document.addEventListener("DOMContentLoaded", function () {
    var menuIcon = document.getElementById("menuIcon");
    var mobileMenu = document.getElementById("mobileMenu");
    var openIcon = menuIcon.querySelector(".openicon");
    var closeIcon = menuIcon.querySelector(".closeicon");

    menuIcon.addEventListener("click", function () {
        if (mobileMenu.classList.contains("mobileMenuShow")) {
            // Hide the menu with animation
            mobileMenu.classList.remove("mobileMenuShow");
            // Change the icon to bars
            openIcon.style.display = "block";
            closeIcon.style.display = "none";
        } else {
            // Show the menu with animation
            mobileMenu.classList.add("mobileMenuShow");
            // Change the icon to xmark
            openIcon.style.display = "none";
            closeIcon.style.display = "block";
        }
    });
});
