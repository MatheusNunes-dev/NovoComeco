let navLinks = document.getElementById('nav-links');
let content = document.getElementById('content')
let navbar = document.getElementById('navbar')
let logo = document.getElementById('logo')
let showSideBar = false;

function toggleSideBar() {
    showSideBar = !showSideBar;
    if (showSideBar) {
        navLinks.classList.add('show');
        navLinks.style.animationName = 'showSideBar'
        content.style.backgroundColor = 'rgba(0, 0, 0, 0.4)'
        navbar.style.backgroundColor = 'rgba(0, 0, 0, 0.4)'
        logo.style.filter = 'brightness(0.4 )';
    } else {
        navLinks.classList.remove('show');
        content.style.backgroundColor = 'rgba(0, 0, 0, 0)'
        navbar.style.backgroundColor = 'rgba(0, 0, 0, 0)'
        logo.style.filter = 'brightness(1)';
    }
}

function closeSideBar() {
    if (showSideBar) {
        toggleSideBar();
    }
}

window.addEventListener('resize', function () {
    if (window.innerWidth > 991 && showSideBar) {
        toggleSideBar();
    }
});