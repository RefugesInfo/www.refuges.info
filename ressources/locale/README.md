# Traductions de l'interface

Principe : gettext, le msgid est le texte **français** tel qu'il est écrit dans le code (`_("...")`). Sans catalogue (français)
ou sans traduction, c'est le texte français qui est affiché.

- `en_GB/LC_MESSAGES/refuges.po` : sources des traductions anglaises. `refuges.mo` : compilé (`make locale`), versionné pour que
  `git pull` suffise en production. Après modification en prod : recharger php-fpm (glibc garde le .mo en cache par processus).
- `valeurs_base_de_donnees.php` : liste des valeurs françaises qui viennent de la base (types de points, libellés d'équivalence,
  précisions GPS, types de polygones). Jamais exécuté, il sert à xgettext. À mettre à jour si on ajoute un type ou un libellé.
- Mettre à jour le catalogue après avoir marqué de nouveaux textes : `make locale-extraire` puis traduire les entrées vides du .po.

Règles : `sprintf(_("... %s ..."), $x)` pour les variables (jamais de concaténation), `%1$s %2$s` si l'ordre peut changer,
`ngettext()` pour les pluriels. Les textes de modération (menus réservés aux modérateurs) ne sont pas traduits.
