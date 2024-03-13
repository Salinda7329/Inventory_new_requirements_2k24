// Use to highlight a left menue item when clicked.
// Should have an unique it for all menu-sub and menu-item

    document.addEventListener("DOMContentLoaded", function () {
        // Get all menu items and sub-menu items
        var menuItems = document.querySelectorAll('.menu-item, .menu-sub li');

        // Add click event listener to each menu item
        menuItems.forEach(function (item) {
            item.addEventListener('click', function (event) {
                // Remove 'active' class from all items
                menuItems.forEach(function (item) {
                    item.classList.remove('active');
                });

                // Add 'active' class to the clicked item
                item.classList.add('active');

                // Add 'active' class to the parent menu item if a sub-menu item is clicked
                var parentMenuItem = item.closest('.menu-item');
                if (parentMenuItem) {
                    parentMenuItem.classList.add('active');

                    // Add a class to the parent menu item to keep it open
                    parentMenuItem.classList.add('keep-open');
                }

                // Store the selected menu item in a cookie
                document.cookie = "selectedMenuItem=" + item.id + "; path=/";

                // Prevent the default behavior of the link only for sub-menu items
                if (item.classList.contains('menu-sub')) {
                    event.preventDefault();
                }
            });
        });

        // Check cookies for the selected menu item and add 'active' class
        var selectedMenuItemId = getCookie('selectedMenuItem');
        if (selectedMenuItemId) {
            var selectedMenuItem = document.getElementById(selectedMenuItemId);
            if (selectedMenuItem) {
                selectedMenuItem.classList.add('active');

                // Add 'active' class to the parent menu item if it's a sub-menu item
                var parentMenuItem = selectedMenuItem.closest('.menu-item');
                if (parentMenuItem) {
                    parentMenuItem.classList.add('active');

                    // Add a class to the parent menu item to keep it open
                    parentMenuItem.classList.add('keep-open');
                }
            }
        }

        // Function to get the value of a cookie by name
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }
    });

