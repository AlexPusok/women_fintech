document.addEventListener("DOMContentLoaded", function () {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    const darkClasses = {
        body: ['bg-dark', 'text-light'],
        card: ['bg-dark', 'text-light'],
        well: ['bg-dark', 'text-light'],
        cardBody: ['bg-dark', 'text-light'],
        statisticsContainer: ['bg-dark', 'text-light'],
        statisticsTitle: ['text-light'],
        statisticsList: ['text-light'],
        statisticsTable: ['table-dark'],
        statisticsItem: ['text-light'],
        statisticsTableRow: ['bg-dark', 'text-light'],
        jumbotron: ['bg-secondary', 'text-light'],
        form: ['bg-dark', 'text-light', 'border-0'],
        listGroupItem: ['bg-dark', 'text-light'],
        tableData: ['text-light'],
    };

    function toggleClasses(elements, classes, action) {
        elements.forEach(el => el.classList[action](...classes));
    }

    function applyTheme(isDark) {
        const action = isDark ? 'add' : 'remove';

        toggleClasses([document.body], darkClasses.body, action);
        toggleClasses(document.querySelectorAll('.card'), darkClasses.card, action);
        toggleClasses(document.querySelectorAll('.well'), darkClasses.well, action);
        toggleClasses(document.querySelectorAll('.card-body'), darkClasses.cardBody, action);
        toggleClasses(document.querySelectorAll('.statistics-container'), darkClasses.statisticsContainer, action);
        toggleClasses(document.querySelectorAll('.statistics-title'), darkClasses.statisticsTitle, action);
        toggleClasses(document.querySelectorAll('.statistics-list'), darkClasses.statisticsList, action);
        toggleClasses(document.querySelectorAll('.statistics-table'), darkClasses.statisticsTable, action);
        toggleClasses(document.querySelectorAll('.statistics-item'), darkClasses.statisticsItem, action);
        toggleClasses(document.querySelectorAll('.statistics-table tr'), darkClasses.statisticsTableRow, action);
        toggleClasses(document.querySelectorAll('.jumbotron'), darkClasses.jumbotron, action);
        toggleClasses(document.querySelectorAll('form'), darkClasses.form, action);
        toggleClasses(document.querySelectorAll('.list-group-item'), darkClasses.listGroupItem, action);
        toggleClasses(document.querySelectorAll('.table tbody td'), darkClasses.tableData, action);
    }

    function darkModeToggle() {
        const isCurrentlyDark = document.body.classList.contains('bg-dark');
        const newMode = !isCurrentlyDark;

        applyTheme(newMode);
        localStorage.setItem('darkMode', newMode.toString());
    }

    applyTheme(isDarkMode);

    const darkModeButton = document.getElementById("darkButton");
    if (darkModeButton) {
        darkModeButton.addEventListener("click", darkModeToggle);
    }
});
