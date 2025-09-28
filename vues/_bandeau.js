const menuEls = document.getElementsByClassName('menu-bouton');

for (let el of menuEls) {
	el.addEventListener('mouseover', menuAction);
	el.addEventListener('mouseout', menuAction);
	el.addEventListener('click', menuAction);
}
// Ferme les boutons quand on clique sur la page
document.body.addEventListener('click', menuClean);

function menuAction(evt) {
	// Passage de la souris sur tout l'élement de classe 'menu-bouton'
	// ajoute la classe 'menu-hover' à cet élément
	// Traiter le hover en js pour améliorer sa gestion sur mobiles
	if (evt.type == 'mouseover')
		this.classList.add('menu-hover');
	else if (evt.type == 'mouseout' &&
		evt.relatedTarget) // Pour éviter de sortir quand on survolle le gestionnaire de mot de passe
		this.classList.remove('menu-hover');

	// Click de la souris ou touch sur un élement
	// directement fils de l'élément de classe 'menu-bouton'
	// ajoute la classe 'menu-touch' à cet élément
	if (evt.type == 'click' && // Mouse click & touch
		this == evt.target.parentNode) {
		this.classList.toggle('menu-touch');
		this.classList.remove('menu-hover');
	}

	// Ferme les autres boutons ouverts
	for (let el of menuEls)
		if (!el.contains(evt.target))
			el.classList.remove('menu-touch');
}

function menuClean(evt) {
	// Ferme les autres boutons ouverts
	for (let el of menuEls)
		if (!el.contains(evt.target))
			el.classList.remove('menu-touch');
}

// Détection du prefers-color-scheme pour changer le style
const dark_style = document.cookie.includes('prosilver_dark'),
	dark_mode = window.matchMedia &&
		window.matchMedia('(prefers-color-scheme: dark)').matches;

if (dark_style != dark_mode) {
	document.cookie = dark_mode ?
		'style=prosilver_dark; path=/' :
		'style=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';

	location.reload(true);
}
