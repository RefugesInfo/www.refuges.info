# Traduction automatique des contenus utilisateurs : contexte commun à toutes les langues

Ce fichier est lu par le script de traduction (et par tout humain qui relit/corrige) : il décrit le site, ce qu'on
traduit et les règles qui valent quelle que soit la langue cible. Le vocabulaire et le style propres à une langue sont
dans `glossaire-<langue>.md` (ex. `glossaire-en.md`, depuis le français). Pour les textes écrits dans une autre
langue source, un fichier par langue : `glossaire-<source>-en.md` (`glossaire-de-en.md`, `glossaire-it-en.md`),
rédigés dans la langue concernée pour être relus par des locuteurs natifs.

## Le site

refuges.info est une base collaborative, rédigée par des bénévoles, de refuges, cabanes, gîtes, abris, points d'eau
et passages délicats en montagne (France, mais aussi Suisse, Italie, Espagne, Allemagne). Les textes sont écrits par
des randonneurs, pas par des professionnels : ton souvent informel, fautes de frappe, abréviations, humour,
parfois de l'agacement. La traduction doit **rester fidèle au registre** (ne pas lisser, ne pas rendre plus poli).

## Ce qui est traduit

| Table / champ | Contenu |
|---|---|
| `points.remarques` | description et remarques sur la fiche |
| `points.acces` | itinéraire d'accès |
| `points.proprietaires` | propriétaire / gestionnaire / contacts |
| `commentaires.texte` | commentaires des visiteurs sur la fiche |
| (plus tard) messages du forum | `phpbb3_posts` |

Le texte original reste en base dans sa table d'origine ; les traductions vont dans `traductions`
(voir `ressources/sql/2026-10-13-nouvelle-table-traductions.sql`).

## Règles absolues

1. **Traduire à partir de la fiche entière** : les 3 champs + tous les commentaires sont donnés ensemble, pour que
   « le poêle », « la source », « le refuge d'hiver » désignent la même chose partout.
2. **Ne pas inventer, ne pas corriger les faits** (horaires, altitudes, prix, numéros). Ne pas compléter.
3. **Conserver tel quel** : les noms propres et toponymes, les pseudos et signatures (« Merci boubou »), les URL,
   adresses e-mail, numéros de téléphone, coordonnées GPS (y compris les `?` laissés par un ancien problème
   d'encodage : `N45?09'48.7"`), les entités HTML (`&#8217;`).
4. **Conserver le balisage** (BBcode maison, voir `includes/mise_en_forme_texte.php`) : `[b]…[/b]`, `[i]`, `[u]`,
   `[url=…]texte[/url]` (traduire le texte, jamais l'adresse), `[link]`, `[color=red]…[/color]`, `[msg]`, `[img]`.
5. **`[->152]` est un lien vers la fiche n°152** : ne jamais le modifier ni le traduire.
6. **Conserver la mise en forme** : sauts de ligne, lignes vides, listes avec `-`, `*`, `#`, majuscules d'insistance
   (« PAS D'EAU » → « NO WATER »), émoticônes.
7. **Les notes de modération se traduisent** (« modération : … », « ** Modération par sly : … ** ») : ce sont des
   textes du site visibles par le lecteur.
8. **Texte déjà dans la langue cible** : ne pas retraduire (la ligne `traductions.texte` reste `NULL`).
9. **Ne rien ajouter** : pas de « Translation: », pas de commentaire du traducteur dans le texte.
10. **Passages inintelligibles ou ambigus** : traduire au plus près, ne pas deviner.

## Doublons et textes très courts

Les commentaires identiques ou quasi (reposts, légendes de photo répétées) sont **traduits comme les autres** :
pas de dédoublonnage, le volume concerné est négligeable.

## Données personnelles (décision du 2026-10-13, à revoir)

Les adresses e-mail, numéros de téléphone, noms de gardiens et autres informations de contact présents dans un
texte source sont **conservés tels quels** dans la traduction : ils sont déjà publics sur le site et ne sont pas
filtrés. Cette décision est provisoire. Elle suppose que la suppression ou la modification d'une source entraîne
celle de ses traductions (voir ci-dessous), sans quoi une donnée personnelle retirée du site resterait dans
`traductions`.

## Cycle de vie des traductions (décidé, à implémenter plus tard)

- **Source modifiée** (commentaire ou champ de fiche) : toutes ses traductions, dans toutes les langues, sont
  refaites. En attendant, laffichage retombe sur loriginal (le hash ne correspond plus).
- **Source supprimée** : toutes ses traductions sont supprimées, immédiatement ou par une purge régulière
  (données personnelles possibles dans les textes).
- Mécanisme à décider : une table par type avec clé étrangère `ON DELETE CASCADE` (suppression garantie par la
  base) ou une table unique avec purge des orphelins par le script. Voir la discussion du 2026-10-13.

## Pour corriger / enrichir

Toute correction (terme, tournure, règle) s'ajoute dans le `glossaire-<langue>.md` correspondant, section
« Corrections », avec le texte fautif et la correction. Le script relit ces fichiers à chaque lancement.
