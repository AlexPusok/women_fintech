document.addEventListener("DOMContentLoaded", function () {
    // Check if dark mode preference is stored in localStorage
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    // Apply dark or light theme on page load
    function applyTheme() {
        if (isDarkMode) {
            document.body.classList.add('bg-dark', 'text-light');
            document.body.classList.remove('bg-light', 'text-dark');

            // Apply dark mode to cards, body, and statistics containers
            document.querySelectorAll('.card').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.well').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.card-body').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-container').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-title').forEach(el => el.classList.add('text-light'));
            document.querySelectorAll('.statistics-list').forEach(el => el.classList.add('text-light'));
            document.querySelectorAll('.statistics-table').forEach(el => el.classList.add('table-dark'));
            document.querySelectorAll('.statistics-item').forEach(el => el.classList.add('text-light'));

            // Apply dark mode to all rows in statistics tables
            document.querySelectorAll('.statistics-table tr').forEach(row => {
                row.classList.add('bg-dark', 'text-light');
            });

            // Apply dark mode to jumbotron
            document.querySelectorAll('.jumbotron').forEach(el => {
                el.classList.add('bg-secondary', 'text-light');
            });

            // Apply dark mode to forms
            document.querySelectorAll('form').forEach(el => {
                el.classList.add('bg-dark', 'text-light', 'border-0');
            });

            // Apply dark mode to list items in mentorship matches
            document.querySelectorAll('.list-group-item').forEach(el => {
                el.classList.add('bg-dark', 'text-light');
            });

            // Apply dark mode to mentorship match buttons, excluding specific ones
            document.querySelectorAll('.btn').forEach(button => {
                if (button.classList.contains('btn-info') ||
                    button.classList.contains('btn-primary') ||
                    button.classList.contains('form-control') ||
                    button.classList.contains('btn-dark')) {
                    // Exclude specific button classes
                    return;
                } else {
                    button.classList.add('btn-dark'); // Default button color for other buttons
                }
            });
        } else {
            document.body.classList.add('bg-light', 'text-dark');
            document.body.classList.remove('bg-dark', 'text-light');

            // Revert dark mode changes
            document.querySelectorAll('.card').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.well').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.card-body').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-container').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-title').forEach(el => el.classList.remove('text-light'));
            document.querySelectorAll('.statistics-list').forEach(el => el.classList.remove('text-light'));
            document.querySelectorAll('.statistics-table').forEach(el => el.classList.remove('table-dark'));
            document.querySelectorAll('.statistics-item').forEach(el => el.classList.remove('text-light'));

            // Revert the rows to default (light mode)
            document.querySelectorAll('.statistics-table tr').forEach(row => {
                row.classList.remove('bg-dark', 'text-light');
            });

            // Revert jumbotron to light mode
            document.querySelectorAll('.jumbotron').forEach(el => {
                el.classList.remove('bg-secondary', 'text-light');
            });

            // Revert form to light mode
            document.querySelectorAll('form').forEach(el => {
                el.classList.remove('bg-dark', 'text-light', 'border-0');
            });

            // Revert list items in mentorship matches to light mode
            document.querySelectorAll('.list-group-item').forEach(el => {
                el.classList.remove('bg-dark', 'text-light');
            });

            // Revert mentorship match buttons, excluding specific ones
            document.querySelectorAll('.btn').forEach(button => {
                if (button.classList.contains('btn-info') ||
                    button.classList.contains('btn-primary') ||
                    button.classList.contains('form-control') ||
                    button.classList.contains('btn-dark')) {
                    // Exclude specific button classes
                    return;
                } else {
                    button.classList.remove('btn-dark');
                }
            });
        }
    }

    // Call function to apply theme
    applyTheme();

    // Toggle Dark Mode
    function darkMode() {
        const isCurrentlyDark = document.body.classList.contains('bg-dark');
        if (isCurrentlyDark) {
            // Switch to light mode
            document.body.classList.add('bg-light', 'text-dark');
            document.body.classList.remove('bg-dark', 'text-light');
            document.querySelectorAll('.card').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.well').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.card-body').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-container').forEach(el => el.classList.remove('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-title').forEach(el => el.classList.remove('text-light'));
            document.querySelectorAll('.statistics-list').forEach(el => el.classList.remove('text-light'));
            document.querySelectorAll('.statistics-table').forEach(el => el.classList.remove('table-dark'));
            document.querySelectorAll('.statistics-item').forEach(el => el.classList.remove('text-light'));

            // Remove dark mode from all rows
            document.querySelectorAll('.statistics-table tr').forEach(row => {
                row.classList.remove('bg-dark', 'text-light');
            });

            // Remove dark mode from jumbotron
            document.querySelectorAll('.jumbotron').forEach(el => {
                el.classList.remove('bg-secondary', 'text-light');
            });

            // Remove dark mode from forms
            document.querySelectorAll('form').forEach(el => {
                el.classList.remove('bg-dark', 'text-light', 'border-0');
            });

            // Remove dark mode from mentorship list items
            document.querySelectorAll('.list-group-item').forEach(el => {
                el.classList.remove('bg-dark', 'text-light');
            });

            // Revert mentorship match buttons to default
            document.querySelectorAll('.btn').forEach(button => {
                if (button.classList.contains('btn-info') ||
                    button.classList.contains('btn-primary') ||
                    button.classList.contains('form-control') ||
                    button.classList.contains('btn-dark')) {
                    // Exclude specific button classes
                    return;
                } else {
                    button.classList.remove('btn-dark');
                }
            });

            // Save preference to localStorage
            localStorage.setItem('darkMode', 'false');
        } else {
            // Switch to dark mode
            document.body.classList.add('bg-dark', 'text-light');
            document.body.classList.remove('bg-light', 'text-dark');
            document.querySelectorAll('.card').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.well').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.card-body').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-container').forEach(el => el.classList.add('bg-dark', 'text-light'));
            document.querySelectorAll('.statistics-title').forEach(el => el.classList.add('text-light'));
            document.querySelectorAll('.statistics-list').forEach(el => el.classList.add('text-light'));
            document.querySelectorAll('.statistics-table').forEach(el => el.classList.add('table-dark'));
            document.querySelectorAll('.statistics-item').forEach(el => el.classList.add('text-light'));

            // Apply dark mode to all rows
            document.querySelectorAll('.statistics-table tr').forEach(row => {
                row.classList.add('bg-dark', 'text-light');
            });

            // Apply dark mode to jumbotron
            document.querySelectorAll('.jumbotron').forEach(el => {
                el.classList.add('bg-secondary', 'text-light');
            });

            // Apply dark mode to forms
            document.querySelectorAll('form').forEach(el => {
                el.classList.add('bg-dark', 'text-light', 'border-0');
            });

            // Apply dark mode to mentorship list items
            document.querySelectorAll('.list-group-item').forEach(el => {
                el.classList.add('bg-dark', 'text-light');
            });

            // Apply dark mode to mentorship match buttons, excluding specific ones
            document.querySelectorAll('.btn').forEach(button => {
                if (button.classList.contains('btn-info') ||
                    button.classList.contains('btn-primary') ||
                    button.classList.contains('form-control') ||
                    button.classList.contains('btn-dark')) {
                    // Exclude specific button classes
                    return;
                } else {
                    button.classList.add('btn-dark'); // Default button color for other buttons
                }
            });

            // Save preference to localStorage
            localStorage.setItem('darkMode', 'true');
        }
    }

    // Attach the dark mode toggle function to the button
    const darkModeButton = document.getElementById("darkButton");
    if (darkModeButton) {
        darkModeButton.addEventListener("click", darkMode);
    }
});
