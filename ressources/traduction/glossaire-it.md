# Traduzione francese → italiano: glossario, stile e scelte da verificare

*Résumé (fr) : choix de vocabulaire et de style utilisés pour l'interface et le wiki en italien (catalogue `ressources/locale/it_IT`, pages wiki en `traductions`). Fichier rédigé en italien pour être relu par des locuteurs natifs : colonne « Correzione » à remplir. Complète `contexte.md`.*

## A cosa serve questo file

Refuges.info è un sito collaborativo, scritto da volontari, che censisce rifugi, capanne, alloggi di tappa, punti acqua e passaggi delicati in montagna (Francia, ma anche Svizzera, Italia, Spagna, Germania).
L'interfaccia e le pagine di aiuto sono state tradotte dal francese all'italiano da un'intelligenza artificiale. **Cerchiamo persone di lingua italiana che conoscano la montagna** per dirci se i termini scelti sono quelli giusti e naturali.

**Come aiutare:** per ogni riga, la traduzione è corretta e naturale? Se no, scrivete la forma giusta nella colonna « Correzione ». Una risposta come « non lo so » va benissimo: lasciamo lo stato ⏳. Potete scriverci sul forum: https://www.refuges.info/forum/

Stati: ✅ confermato · ⏳ scelta provvisoria, da confermare · ❌ da evitare

## Stile

| Punto | Scelta | Stato | Correzione |
|---|---|---|---|
| Registro | **tu** (informale) nell'interfaccia e nelle pagine di aiuto; il francese dice « vous ». Il « tu » è usuale tra escursionisti, ma è forse troppo familiare? | ⏳ | |
| Pulsanti | imperativo (« Scarica », « Invia », « Annulla ») | ⏳ | |
| Impersonale | il francese usa spesso « on » → « si » (« si raccoglie la legna... ») | ✅ | |
| Maiuscole | solo a inizio frase; i nomi dei tipi di punto in minuscolo | ✅ | |
| Unità | invariate (m, km, h) | ✅ | |

## Tipi di punto (nomi mostrati sul sito)

| Francese | Italiano | Nota | Stato | Correzione |
|---|---|---|---|---|
| cabane non gardée | capanna non custodita | rifugio libero senza gestore; alternative: *bivacco*, *ricovero*. « Bivacco » in Italia indica spesso una struttura metallica fissa | ⏳ | |
| refuge gardé | rifugio custodito | rifugio con gestore/custode | ⏳ | |
| gîte d'étape | alloggio di tappa (gîte d'étape) | non esiste un equivalente esatto: *ostello*? *foresteria*? *rifugio-albergo*? Proposta: lasciare « gîte d'étape » tra parentesi | ⏳ | |
| point d'eau | punto acqua | | ⏳ | |
| abri naturel | riparo naturale | grotta, riparo sotto roccia | ⏳ | |
| passage délicat | passaggio delicato | | ⏳ | |
| bâtiment à investiguer / bâtiment en montagne | edificio da verificare / edificio in montagna | | ⏳ | |

## Vocabolario

| Francese | Italiano | Nota | Stato | Correzione |
|---|---|---|---|---|
| fiche | scheda | la pagina descrittiva di un punto | ⏳ | |
| point | punto | | ✅ | |
| commentaire | commento | | ✅ | |
| modérateur | moderatore | | ✅ | |
| contributeur | contributore | | ⏳ | |
| gardien, gardienne | custode | per chi gestisce il rifugio: « gestore » | ⏳ | |
| gardiennage / hors gardiennage | custodia / fuori dal periodo di custodia | | ⏳ | |
| local d'hiver, refuge d'hiver | locale invernale | parte sempre aperta di un rifugio custodito | ⏳ | |
| poêle | stufa | | ✅ | |
| cheminée | camino | | ✅ | |
| bat-flanc | pianale (per dormire) | | ⏳ | |
| couchage, place | posto (letto) | | ⏳ | |
| clé à récupérer | chiavi da ritirare | | ⏳ | |
| livre d'or, cahier de cabane | libro del rifugio | oppure *libro delle firme* | ⏳ | |
| massif | massiccio | in Italia si dice più spesso *gruppo montuoso*; qui *massiccio* per i poligoni del sito | ⏳ | |
| zone | zona | | ✅ | |
| commune | comune | | ✅ | |
| département | dipartimento | | ✅ | |
| mairie | comune (municipio) | | ⏳ | |
| col | colle / passo | nomi propri invariati | ⏳ | |
| bergerie | ovile | | ⏳ | |
| loir | ghiro | | ⏳ | |
| lérot | topo quercino | | ⏳ | |
| source / fontaine | sorgente / fontana | | ✅ | |
| bachal | bachal (vasca/abbeveratoio) | termine regionale, glossa tra parentesi | ⏳ | |
| piste (ski) / sentier | pista / sentiero | | ✅ | |
| lapiaz | lapiaz (campo carreggiato) | | ⏳ | |
| névé | nevato | | ⏳ | |

## Regole generali

- I nomi propri e i toponimi restano invariati (*refuge du Carro*, *col de la Vanoise*, *Parc naturel de la Chartreuse*).
- Sigle e organismi invariati (CAF/FFCAM, GR, GRP, IGN, ONF, CAI, CAS).
- Numeri di telefono, e-mail, link e coordinate invariati.
- I link interni verso altre pagine del sito portano la lingua in fondo: `/nav/it/`, `/point_formulaire_recherche/it/`, `/wiki/xxx/it/`.
- Le pagine `bandeau` e `bbcode_tests` del wiki (tecniche) non sono tradotte.

## Punti noti da migliorare nel codice (non nel glossario)

- « Voici toutes les %ss » (nav.html): il francese forma il plurale aggiungendo una *s* al tipo; in italiano la frase è stata riformulata (« Ecco tutte le voci di tipo «%s» »). Da correggere con `ngettext` o con i plurali dei tipi.
- Genere dei tipi di punto (« chiuso/chiusa », « distrutto/a »): il sito usa il maschile/femminile francese.

Vedi anche `contexte.md`, `glossaire-en.md` e `glossaire-it-en.md` (italiano → inglese).
