window.addEventListener('load', function() {
	var e = document.querySelector('.no-script');
	if (e) e.className = e.className.replace('no-script', '');
	else console.warn('Cannot clear ".no-script". No such element.');
});
