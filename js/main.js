document.addEventListener('DOMContentLoaded', function () {
    // Validare formular
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const email = document.querySelector('input[type="email"]');
            const linkedin = document.querySelector('input[name="linkedin_profile"]');

            if (email && !validateEmail(email.value)) {
                e.preventDefault();
                alert('Please enter a valid email address');
            }

            if (linkedin && !validateLinkedIn(linkedin.value)) {
                e.preventDefault();
                alert('Please enter a valid LinkedIn URL');
            }
        });
    }
});

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateLinkedIn(url) {
    return url.includes('linkedin.com/');
}

function schimbaModSortare() {
    var btn = document.getElementById("sortbutton");
    var sortInput = document.getElementById("sortInput");
    var professionInput = document.getElementById("hiddenProfessionInput")
    var searchQueryInput = document.getElementById("hiddenSearchQuery")
    if (btn.innerHTML === "Sort dupa nume") {
        btn.innerHTML = "Sort dupa creare";
        sortInput.value = "sortcreare";
    } else {
        btn.innerHTML = "Sort dupa nume";
        sortInput.value = "sortnume";
    }

    document.getElementById("sortForm").submit();
}

function toggleFilterSection() {
    var section = document.getElementById('filterSection');
    section.style.display = (section.style.display === 'none' || section.style.display === '') ? 'block' : 'none';
}

function darkMode() {
    // Check if dark mode is saved in localStorage
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    // Apply the theme on page load based on saved preference
    if (isDarkMode) {
        document.body.className = "bg-dark";
        document.getElementById("fter").className = "footer mt-auto py-3 bg-dark";
    } else {
        document.body.className = "bg-light";
        document.getElementById("fter").className = "footer mt-auto py-3 bg-light";
    }

}

function previewProfilePicture(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('profilePicPreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}


