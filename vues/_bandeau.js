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

// Ajout d'infos pour les traces
const formEls = document.getElementsByTagName('form');

if (formEls.length) {
	const formEl = formEls[formEls.length - 1],
	dateTimeFormat = Intl.DateTimeFormat().resolvedOptions();

	formEl.insertAdjacentHTML('beforeend',
		'<input type="hidden" name="browser_locale" value="' + dateTimeFormat.locale + '" />'
	),
	formEl.insertAdjacentHTML('beforeend',
		'<input type="hidden" name="browser_timeZone" value="' + dateTimeFormat.timeZone + '" />'
	),
	formEl.insertAdjacentHTML('beforeend',
		'<input type="hidden" name="browser_operator" value="robot" />'
	),

	window.addEventListener('mousemove', () => {
		formEl.children[formEl.childElementCount - 1].value = 'human';
	});
}
