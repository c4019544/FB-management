    document.addEventListener("DOMContentLoaded", function () {
        let dropdowns = document.querySelectorAll(".has-submenu > a");

        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent link navigation
                
                let parent = this.parentElement;
                parent.classList.toggle("active"); // Toggle active class
                
                // Close other dropdowns when one is opened
                document.querySelectorAll(".has-submenu").forEach(function (item) {
                    if (item !== parent) {
                        item.classList.remove("active");
                    }
                });
            });
        });
    });
