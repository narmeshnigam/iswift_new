// Main JS for iSwift site.  Currently empty – add interactive
// functionality (e.g. mobile navigation toggles) as needed.
document.addEventListener('DOMContentLoaded', () => {
    // Example: toggle mobile menu if present
    const navToggle = document.querySelector('.nav-toggle');
    const navList  = document.querySelector('.nav-list');
    if (navToggle && navList) {
        navToggle.addEventListener('click', () => {
            navList.classList.toggle('open');
        });
    }
});