// Affiche un wiki au survol d'une cible
// Syntaxe de la cible: <span onmouseover="wiki(this,'help')">TEST</span>
// © Dominique Cavailhez octobre 2013

var div_wiki, url_wiki;

function wiki_out () { // Masque le wiki
	if (div_wiki)
		div_wiki.style.display = 'none';
}

function wiki (cible, url) {
    if (document.body.offsetWidth < 800) // ça ne marche pas pour les tout petits écrans
        return;

	cible.onmouseout = wiki_out; // On positionne un contrôle pour démasquer le popup quand on quite l'élement survollé
	// Si le popup existe déjà mais est caché, on le démasque
	if (div_wiki)
		div_wiki.style.display = '';
	else {
		// Sinon, on crée un <div> enveloppant qui permet de centrer le wiki
		div_wiki = document.createElement('div');
		div_wiki.style.position = 'absolute'; // Ce <div> sort du flux pour s'afficher au milieu de la page
		div_wiki.style.width = '600px';
		div_wiki.style.height = '600px';
		div_wiki.style.overflow = 'auto';
		div_wiki.className = 'wiki'; // Style de l'affichage
		div_wiki.onmouseout = wiki_out;
	}
	cible.appendChild (div_wiki); // On le rattache à l'élément survollé

	var h = cible.offsetTop - 10; // Positionnement normal à côté du curseur
	h = Math.min (h, document.body.offsetHeight - 620); // On ne va pas plus bas que le bas de la fenêtre
	h = Math.max (h, 10); // On ne va pas plus haut que le haut de la fenêtre
	div_wiki.style.top = h+'px';
    
    var l = cible.offsetLeft < document.body.offsetWidth - 630
        ? cible.offsetLeft + 30 // Positionnement normal à droite du curseur
        : cible.offsetLeft - 570; // Si pas la place à droite, on le met à gauche
    l = Math.max (l, 10); // Mais on ne déborde pas à gauche de la fenêtre
	div_wiki.style.left = l+'px';
    
    if (url != url_wiki) {
        url_wiki = url;
        div_wiki.innerHTML = 'Chargement<br/>' + url;
        
        // on va chercher le contenu du popup de façon asynchrone
        var xhr = new XMLHttpRequest();
        xhr.open ("GET", url, true);
        xhr.url = url;
        xhr.onload = function () { // Fonction de réponse asynchrone
            if (xhr.readyState === 4) {
                if (xhr.status === 200)
                    div_wiki.innerHTML = xhr.responseText;
                else
                    div_wiki.innerHTML = 'Erreur http au chargement de la page<br/>' + xhr.url + '<br/>' + xhr.statusText;
            }
        };
        xhr.onerror = function () { // Erreur de load
            div_wiki.innerHTML = 'Erreur http au chargement de la page<br/>' + xhr.url + '<br/>' + xhr.statusText;
        };
        xhr.send (null);
    }
}
