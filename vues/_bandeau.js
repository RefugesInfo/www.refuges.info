const menuEls = document.getElementsByClassName('menu-bouton');

for (let el of menuEls) {
	el.addEventListener('mouseover', menuAction);
	el.addEventListener('mouseout', menuAction);
	el.addEventListener('click', menuAction);
}
// Ferme les boutons quand on clique sur la page
document.body.addEventListener('click', menuAction);

function menuAction(evt) {
	// Passage de la souris sur tout l'élement de classe 'menu-bouton'
	// ajoute la classe 'menu-hover' à cet élément
	// Traiter le hover en js pour améliorer sa gestion sur mobiles
	if (evt.type == 'mouseover')
		this.classList.add('menu-hover');
	else // mouseout | click
		this.classList.remove('menu-hover');

	// Click de la souris ou touch sur un élement
	// directement fils de l'élément de classe 'menu-bouton'
	// ajoute la classe 'menu-touch' à cet élément
	if (evt.type == 'click' && // Mouse click & touch
		this == evt.target.parentNode)
		this.classList.toggle('menu-touch');

	// Ferme les autres boutons ouverts
	for (let el of menuEls)
		if (!el.contains(evt.target))
			el.classList.remove('menu-touch');
}