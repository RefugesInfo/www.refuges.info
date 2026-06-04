const menuEls = document.getElementsByClassName('menu-bouton');

for (let el of menuEls) {
  el.addEventListener('mouseover', menuAction);
  el.addEventListener('mouseout', menuAction);
  el.addEventListener('click', menuAction);
}
// Ferme les boutons quand on clique sur la page
document.body.addEventListener('click', menuClean);

// Commutateur de thème jour / nuit de prosilver_fr
if (localStorage.darksideofthemoon)
  document.body.classList.add (localStorage.darksideofthemoon);

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
  // Clic sur enfant direct OU sur un <span> dans un <a> enfant direct
  if (evt.type == 'click' &&
    (this == evt.target.parentNode ||
     (evt.target.parentNode?.tagName === 'A' && this == evt.target.parentNode?.parentNode))) {
    this.classList.toggle('menu-touch');
    this.classList.remove('menu-hover');
  }

  // Focus l'input de recherche dès que le menu s'ouvre, quelle que soit la cible du clic
  if (evt.type == 'click' &&
      this.classList.contains('icone-recherche') &&
      this.classList.contains('menu-touch'))
    setTimeout(() => this.querySelector('input[type=text]').focus(), 50);

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

function masqueBandeauInfo() {
  const bandeauEls = document.getElementsByClassName('bandeau_info');

  if (bandeauEls.length)
    bandeauEls[0].style.display = 'none';

  document.cookie =
    'bandeau_info=<?=$vue->bandeau_info->date??''?>;'+
    'expires=<?=$vue->bandeau_info->new_cookie_expire??''?>;'+
    'path=/';
}
