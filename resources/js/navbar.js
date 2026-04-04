// Gestione navbar
// ---------------------------------------------

const navbar = document.querySelector('#navbar');

let lastScrollTop = 0;

window.addEventListener('scroll', () => {

	const currentScrollTop = window.scrollY;

	if (currentScrollTop > lastScrollTop) {
		navbar.classList.add('navbar-transform');
	} else {
		navbar.classList.remove('navbar-transform');
	}

	lastScrollTop = Math.max(0, currentScrollTop);
});
