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
  document.body.classList.add(localStorage.darksideofthemoon);

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
  const bandeauEls = document.getElementsByClassName('bandeau-info');

  if (bandeauEls.length)
    bandeauEls[0].style.display = 'none';

  document.cookie =
    'bandeau_info=<?=$vue->bandeau_info->date??''?>;'+
    'expires=<?=$vue->bandeau_info->new_cookie_expire??''?>;'+
    'path=/';
}


/*********** Langue de l'interface : mémorisation du choix et suggestion ***********
 Tout se passe ici, dans le navigateur, et pas côté serveur : la page est la même pour tous (cache, moteurs de recherche)
 et on n'utilise jamais l'en-tête Accept-Language mais navigator.languages, uniquement pour proposer.
 - un clic sur une langue du sélecteur mémorise le choix (cookie "langue", 1 an)
 - choix = autre langue que celle de la page : bascule vers la même page dans cette langue (jamais vers le français :
   le français est la langue de repli, on ne renvoie pas un visiteur arrivé sur une page anglaise vers le français)
 - pas de choix, page en français et navigateur dans une autre langue gérée (avant le français) : bascule automatique
   avec le message "Switched to ... / Back to French" ; sur une page non française : proposition discrète */
(function () {
  const alternates = {};
  document.querySelectorAll('link[rel=alternate][hreflang]').forEach(function (l) {
    if (l.hreflang != 'x-default')
      alternates[l.hreflang] = l.href;
  });
  const langues = Object.keys(alternates);

  const languePage = document.documentElement.lang || 'fr';
  const bloc = document.getElementById('suggestion-langue');

  function lireChoix() {
    const m = document.cookie.match(/(?:^|; )langue=([a-z]{2})/);
    return m ? m[1] : null;
  }

  function memoriser(langue) {
    document.cookie = 'langue=' + langue + '; max-age=31536000; path=/; SameSite=Lax';
  }

  // 1. Le clic sur le sélecteur est un choix explicite
  document.querySelectorAll('.menu-langue a[hreflang]').forEach(function (a) {
    a.addEventListener('click', function () { memoriser(a.hreflang); });
  });

  if (langues.length < 2)
    return; // page sans version dans une autre langue (erreur, forum : la bascule se fait côté serveur avec le cookie)

  const choix = lireChoix();

  // 2. Choix déjà fait pour une langue autre que le français, page en français : on bascule
  if (choix && choix != 'fr' && choix != languePage && alternates[choix]) {
    try { sessionStorage.setItem('langue_bascule', languePage); } catch (e) { }
    location.replace(alternates[choix]);
    return;
  }

  // 2 bis. On vient d'être basculé : on le dit, avec un lien pour revenir
  let origine = null;
  try {
    origine = sessionStorage.getItem('langue_bascule');
    sessionStorage.removeItem('langue_bascule');
  } catch (e) { }
  const bascule = bloc && bloc.querySelector('.suggestion-bascule[data-langue="' + languePage + '"]');
  if (origine && alternates[origine] && bascule) {
    bascule.hidden = false;
    bascule.querySelector('.origine').textContent = origine.toUpperCase();
    bloc.hidden = false;
    bascule.querySelector('.retour').addEventListener('click', function () {
      memoriser(origine);
      location.href = alternates[origine];
    });
    return;
  }

  // 3. Aucun choix et la première langue du navigateur que nous gérons n'est pas celle de la page : proposition
  if (choix || !bloc)
    return;
  let suggeree = null;
  for (const l of (navigator.languages || [navigator.language || ''])) {
    const code = l.toLowerCase().split('-')[0];
    if (langues.indexOf(code) >= 0) {
      suggeree = code;
      break;
    }
  }
  if (!suggeree || suggeree == languePage || suggeree == 'fr')
    return;
  // Page en français et navigateur dans une autre langue gérée : bascule automatique. On mémorise la langue (cookie)
  // pour que le forum, géré côté serveur, la suive aussi ; "Back to French" mémorise le français, et le message
  // de 2 bis prévient et permet de revenir
  if (languePage == 'fr' && alternates[suggeree]) {
    memoriser(suggeree);
    try { sessionStorage.setItem('langue_bascule', languePage); } catch (e) { }
    location.replace(alternates[suggeree]);
    return;
  }
  const proposition = bloc.querySelector('.suggestion-proposition[data-langue="' + suggeree + '"]');
  if (!proposition)
    return;
  proposition.hidden = false;
  bloc.hidden = false;
  proposition.querySelector('.oui').addEventListener('click', function () {
    memoriser(suggeree);
    location.href = alternates[suggeree];
  });
  proposition.querySelector('.non').addEventListener('click', function () {
    memoriser(languePage); // "pas maintenant" = on ne le redemande plus
    bloc.hidden = true;
  });
})();
