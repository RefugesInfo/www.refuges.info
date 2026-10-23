// Les textarea de form#comment s'adaptent à la hauteur de leur contenu
// (même comportement que form#form_point, voir point_formulaire_modification.html)
document.querySelectorAll('form#comment textarea').forEach(function(ta) {
  ta.style.overflow = 'hidden';
  ta.style.height = '0'; // invisible avant le premier paint
  var style = getComputedStyle(ta);
  var lineHeight = parseFloat(style.lineHeight);
  if (isNaN(lineHeight)) lineHeight = parseFloat(style.fontSize) * 1.4;
  ta.style.height = (ta.scrollHeight + lineHeight) + 'px';

  // Interactif : agrandit uniquement, sans effondrer (pas de scroll parasite)
  ta.addEventListener('input', function() {
    if (ta.scrollHeight > ta.clientHeight)
      ta.style.height = (ta.scrollHeight + lineHeight) + 'px';
  });
});
