# Traducción francés → español: glosario, estilo y elecciones por verificar

*Résumé (fr) : choix de vocabulaire et de style utilisés pour l'interface, le wiki et les contenus en espagnol (catalogue `ressources/locale/es_ES`, pages wiki et contenus dans `traductions`). Fichier rédigé en espagnol pour être relu par des locuteurs natifs : colonne « Corrección » à remplir. Complète `contexte.md`.*

## Para qué sirve este archivo

Refuges.info es un sitio colaborativo, escrito por voluntarios, que censa refugios, cabañas, albergues de etapa, puntos de agua y pasos delicados en montaña (Francia, pero también Suiza, Italia, España, Alemania).
La interfaz, las páginas de ayuda y los contenidos se han traducido del francés al español con una inteligencia artificial. **Buscamos personas hispanohablantes que conozcan la montaña** (Pirineos, Picos de Europa, Gredos, Sierra Nevada...) para decirnos si los términos elegidos son los correctos y suenan naturales.

**Cómo ayudar:** en cada fila, ¿la traducción es correcta y natural? Si no, escribid la forma correcta en la columna « Corrección ». Una respuesta como « no lo sé » es perfecta: dejamos el estado ⏳. Podéis escribirnos en el foro: https://www.refuges.info/forum/

Estados: ✅ confirmado · ⏳ elección provisional, por confirmar · ❌ por evitar

## Estilo

| Punto | Elección | Estado | Corrección |
|---|---|---|---|
| Registro | **tú** (informal) en la interfaz y las páginas de ayuda; el francés dice « vous ». El pack de idioma del foro (phpBB) es también « Español (Tú) » | ⏳ | |
| Botones | imperativo o infinitivo (« Guardar », « Descargar », « Cancelar ») | ⏳ | |
| Impersonal | el francés usa mucho « on » → « se » o 3.ª persona plural | ✅ | |
| Mayúsculas | solo a principio de frase; los nombres de tipos de punto en minúscula | ✅ | |
| Unidades | sin cambios (m, km, h) | ✅ | |
| Comillas | « » para las citas | ✅ | |

## Tipos de punto (nombres mostrados en el sitio)

| Francés | Español | Nota | Estado | Corrección |
|---|---|---|---|---|
| cabane non gardée | cabaña no guardada | refugio libre sin guarda; alternativa muy usada en España: *refugio libre* | ⏳ | |
| refuge gardé | refugio guardado | refugio con guarda | ⏳ | |
| gîte d'étape | albergue de etapa (gîte d'étape) | no hay equivalente exacto; *albergue* es lo más cercano | ⏳ | |
| point d'eau | punto de agua | | ⏳ | |
| abri naturel | abrigo natural | cueva, abrigo bajo roca | ⏳ | |
| passage délicat | paso delicado | | ⏳ | |
| bâtiment à investiguer / bâtiment en montagne | edificio por investigar / edificio en montaña | | ⏳ | |

## Vocabulario

| Francés | Español | Nota | Estado | Corrección |
|---|---|---|---|---|
| fiche | ficha | la página descriptiva de un punto | ⏳ | |
| point | punto | | ✅ | |
| commentaire | comentario | | ✅ | |
| modérateur | moderador | | ✅ | |
| contributeur | colaborador | | ⏳ | |
| gardien, gardienne | guarda | también *guardés* en Cataluña; para el gestor: *gestor* | ⏳ | |
| gardiennage / hors gardiennage | guardería / fuera del periodo de guardería | | ⏳ | |
| local d'hiver, refuge d'hiver | local de invierno | parte siempre abierta de un refugio guardado | ⏳ | |
| poêle | estufa | | ✅ | |
| cheminée | chimenea | | ✅ | |
| bat-flanc | tarima (para dormir) | | ⏳ | |
| couchage, place | plaza (para dormir) | | ⏳ | |
| couvertures | mantas | | ✅ | |
| clé à récupérer | llave por recoger | | ⏳ | |
| livre d'or, cahier de cabane | libro de registro | o *libro de visitas / de firmas* | ⏳ | |
| massif | macizo | | ⏳ | |
| zone | zona | | ✅ | |
| commune | municipio | | ✅ | |
| département | departamento | | ✅ | |
| mairie | ayuntamiento | | ✅ | |
| col | collado / puerto / paso | nombres propios sin cambios; Pirineos: *collado*, *puerto* | ⏳ | |
| bergerie | cabaña de pastor / majada | | ⏳ | |
| loir | lirón | | ⏳ | |
| lérot | lirón careto | | ⏳ | |
| source / fontaine | fuente / fuente | *manantial* para source naturelle | ⏳ | |
| bachal | bachal (abrevadero) | término regional, glosado entre paréntesis | ⏳ | |
| sentier | sendero | | ✅ | |
| névé | nevero | | ⏳ | |
| lapiaz | lapiaz | | ✅ | |
| estive | pastos de verano / puerto | | ⏳ | |

## Reglas generales

- Los nombres propios y topónimos no se cambian (*refuge du Carro*, *Parc naturel de la Chartreuse*). En España se respetan los nombres locales (*Refugio de Góriz*, *Cabaña de la Rinconada*).
- Siglas y organismos sin cambios (CAF/FFCAM, GR, GRP, IGN, ONF, FEDME, FEEC, CAI, CAS).
- Números de teléfono, correos, enlaces y coordenadas sin cambios.
- Los enlaces internos a otras páginas del sitio llevan el idioma al final: `/nav/es/`, `/point_formulaire_recherche/es/`, `/wiki/xxx/es/`.
- Las páginas `bandeau` y `bbcode_tests` del wiki (técnicas) no se traducen.

## Puntos conocidos por mejorar en el código (no en el glosario)

- « Voici toutes les %ss » (nav.html): el francés forma el plural añadiendo una *s* al tipo; se ha reformulado (« Aquí están todos los elementos de tipo «%s» »).
- Género de los tipos de punto (« cerrado/cerrada », « destruido/a »): el sitio usa el masculino/femenino francés.

Véase también `contexte.md`, `glossaire-en.md` y `glossaire-it.md`.
