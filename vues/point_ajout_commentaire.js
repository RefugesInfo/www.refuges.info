document.addEventListener('DOMContentLoaded', function () {
  var zone = document.getElementById('zone_depot_photo');
  if (!zone) return;

  var entree = zone.querySelector('input[type=file]');
  var texte = zone.querySelector('.pilule_fichier_texte');
  var nomFichier = zone.querySelector('.nom_fichier_choisi');
  var apercu = zone.querySelector('.apercu_photo');
  var texteDefaut = texte.textContent;
  var urlApercuPrecedente = null;

  function majAffichage() {
    if (urlApercuPrecedente) {
      URL.revokeObjectURL(urlApercuPrecedente);
      urlApercuPrecedente = null;
    }

    if (entree.files && entree.files.length > 0) {
      var fichier = entree.files[0];
      zone.classList.add('a_un_fichier');
      texte.textContent = 'Changer la photo';
      nomFichier.textContent = fichier.name;

      if (fichier.type && fichier.type.indexOf('image/') === 0) {
        urlApercuPrecedente = URL.createObjectURL(fichier);
        apercu.src = urlApercuPrecedente;
      } else {
        apercu.removeAttribute('src');
      }
    } else {
      zone.classList.remove('a_un_fichier');
      texte.textContent = texteDefaut;
      nomFichier.textContent = '';
      apercu.removeAttribute('src');
    }
  }

  entree.addEventListener('change', majAffichage);

  ['dragenter', 'dragover'].forEach(function (evenement) {
    zone.addEventListener(evenement, function (e) {
      e.preventDefault();
      e.stopPropagation();
      zone.classList.add('survol');
    });
  });

  ['dragleave', 'dragend', 'drop'].forEach(function (evenement) {
    zone.addEventListener(evenement, function (e) {
      e.preventDefault();
      e.stopPropagation();
      zone.classList.remove('survol');
    });
  });

  zone.addEventListener('drop', function (e) {
    var fichiers = e.dataTransfer.files;
    if (fichiers && fichiers.length > 0) {
      entree.files = fichiers;
      majAffichage();
    }
  });
});
