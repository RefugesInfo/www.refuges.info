// Script lié à la page d'accueil

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $modele contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 14/03/2013 Léo - Création

/************************* FONCTIONS CARTE *************************/

// Les variables necessaires au bon fonctionnement du truc
var map;
var ajaxRequest;
var plotlist;
var plotlayers=[];
var init = 0;


// Fonction lancée dès que le <div> map est chargé
function initmap(){
	// On teste que le navigateur soit compatible AJAX
	ajaxRequest=GetXmlHttpObject();
	if (ajaxRequest==null) {
		alert ("Ce navigateur ne semble pas suporter la technologie AJAX... Vous devrez peut-être le mettre à jour...");
		return;
	}
	
	// On créé notre carte vierge
	map = new L.Map('map');

	var MRIUrl='http://maps.refuges.info/hiking/{z}/{x}/{y}.png'; // Serveur de tuiles MRI
	var MRIAttrib='&copy; Contributeurs d\'<a href="http://openstreetmap.org">OpenStreetMap</a>'; // Petit texte de crédit en bas à droite
	var MRI = new L.TileLayer(MRIUrl, {minZoom: 2, maxZoom: 14, attribution: MRIAttrib}); // Création du calque de tuiles nommé MRI

	map.setView(new L.LatLng(47, 2),6); // Par défaut on affiche la France entière
	askForPlots(); // Et on affiche les refuges

	// Fonction lancée quand la géolocalisation a marché
	function onLocationFound(e) {
	    L.marker(e.latlng).addTo(map); // On ajoute un marqueur indiquant notre position (bleu par défaut)
		askForPlots(); // On affiche les refuges dans cette aire
	}
	// Fonction lancée quand la géolocalisation a échoué
	function onLocationError(e) {
		alert(e.message); // On explique que l'erreur au visiteur
	}
	map.locate({watch: true, setView: true, maxZoom: 14}); // On demande de géolocalisé, en continu, avec un zoom de 14 sur notre position

	map.attributionControl.setPrefix(''); // On enlève le crédit vers leaflet
	map.addLayer(MRI); // On ajoute le calque MRI à la carte

	// Ajout de l'icone fullscreen
	var fullScreen = new L.Control.FullScreen(); 
	map.addControl(fullScreen);

	// Action en cas des évenements suivant
	map.on('locationerror', onLocationError);
	map.on('locationfound', onLocationFound);
	map.on('moveend', onMapMove);
}

// Fonction lancée quand on veux afficher les points des refuges
function askForPlots() {
	// On garde en variable les quatres angles de la vue courante (bbox à télécharger)
	var bounds=map.getBounds();
	var minll=bounds.getSouthWest();
	var maxll=bounds.getNorthEast();
	// On prépare l'adresse à télécharger, avec la bbox.
	var msg='../exportations/exportations.php?format=geojson&bbox='+minll.lng+','+minll.lat+','+maxll.lng+','+maxll.lat;

	// Requete AJAX
	ajaxRequest.onreadystatechange = stateChanged; // Si on a récupéré le fichier, on apelle stateChanged();
	ajaxRequest.open('GET', msg, true); //  On apelle le fichier.
	ajaxRequest.send(null); 
}

function onMapMove(e) { askForPlots(); } // Si on a fini de trifouiller la carte, on rafraichi la liste des refuges

// Fonction appelée pour tester la compatibilité AJAX
function GetXmlHttpObject() {
	if (window.XMLHttpRequest) { return new XMLHttpRequest(); }
	if (window.ActiveXObject)  { return new ActiveXObject("Microsoft.XMLHTTP"); }
	return null;
}

// Fonction lancée quand AJAX à retourné quelque chose
function stateChanged() {
	// Si AJAX à bien retourné ce que l'on attendais
	if (ajaxRequest.readyState==4) {
		if (ajaxRequest.status==200) {
			plotlist=eval("(" + ajaxRequest.responseText + ")"); // On enregistre la variable GeoJSON en local
			removeMarkers(); // On enlève tous les points actuels
			for (i=0;i<plotlist.features.length;i++) { // Pour chaque point (ligne GeoJSON)
				var plotll = new L.LatLng(plotlist.features[i].geometry.coordinates[1],plotlist.features[i].geometry.coordinates[0]); // On enregistre ses coordonnées
				var plotmark = new L.Marker(plotll); // On créé un marqueur (bleu par défaut)
				map.addLayer(plotmark); // On ajoute un calque pour ce marqueur
				plotmark.data=plotlist.features[i]; // Useless ?
				// Une variable contenant le style du marqueur
				var cabaneIcon = L.icon({
					iconUrl: '../images/icones/' + plotlist.features[i].properties.type + '.png', // On télécharge la bonne image de marqueur
					iconSize: [16, 16],
					iconAnchor: [8, 8],
					popupAnchor: [0, 0]
				});
				plotmark.setIcon(cabaneIcon); // On applique notre icone juste créé
				plotmark.bindPopup('<a href="#" onclick="affichePoint(' + plotlist.features[i].properties.id_point + ');">' + plotlist.features[i].properties.nom + '</a>'); // On ajoute au marqueur un popup contenant le lien
				plotlayers.push(plotmark);
			}
		}
	}
}

// Fonction appelée au avant d'ajouter les marqueurs fournis par AJAX pour enlever les précédents
function removeMarkers() {
	for (i=0;i<plotlayers.length;i++) {
		map.removeLayer(plotlayers[i]);
	}
	plotlayers=[];
}

/************************* FONCTIONS POINTS *************************/


// Fonction appelée lors d'un clic sur point pour afficher les caractéristiques
function affichePoint(idpoint) {
	displayBlock('patientez');

	// On prépare l'adresse à télécharger, avec l'id du point.
	var msg='../point.php/' + idpoint + '/?format=geojson';

	// Requete AJAX
	ajaxRequest.onreadystatechange = pointRecu; // Si on a récupéré le fichier, on apelle pointRecu();
	ajaxRequest.open('GET', msg, true); //  On apelle le fichier.
	ajaxRequest.send(null); 
}

// Fonction lancée quand AJAX à retourné quelque chose
function pointRecu() {
	// Si AJAX à bien retourné ce que l'on attendais
	if (ajaxRequest.readyState==4) {
		if (ajaxRequest.status==200) {
			point=eval("(" + ajaxRequest.responseText + ")"); // On enregistre la variable GeoJSON en local
			document.querySelector('#infosPoint').innerHTML = '<a class="retour" href="#" onclick="displayBlock(\'carte\');">Retour carte</a><span id="titrePoint"></span><div id="fichePoint"><span id="typePoint"></span><span id="idPoint"></span></div><p id="coordPoint"></p><p id="proprioPoint"></p><p id="accesPoint"></p><p id="rmqPoint"></p><p id="infoscompPoint"><b>Informations complémentaires :</b><br /><span id="couverturePoint"></span><span id="eauPoint"></span><span id="boisPoint"></span><span id="latrinePoint"></span><span id="manquemurPoint"></span><span id="poelePoint"></span><span id="chemineePoint"></span><span id="clefPoint"></span><span id="matelasPoint"></span><span id="ravitaillementeauPoint"></span><span id="sitewebPoint"></span></p><p id="pointsprochesPoint"><b>Points proches :</b><br /><span id="pp0Point"></span><span id="pp1Point"></span><span id="pp2Point"></span></p><div id="commentairesPoint"><p><b>Commentaires :</b></p><div id="com0Point"></div><div id="com1Point"></div><div id="com2Point"></div><div id="com3Point"></div><div id="com4Point"></div></div><p class="sautdeligne"></p>';
			document.querySelector('#titrePoint').innerHTML = point.properties.nom;
			document.querySelector('#idPoint').innerHTML = " (Point n°" + point.properties.id + ") ";
			document.querySelector('#typePoint').innerHTML = point.properties.type;
			document.querySelector('#coordPoint').innerHTML = "<b>Coordonnées :</b><br />&nbsp;<i>Précision</i> : " + point.properties.precision_gps + "<br />&nbsp;<i>Altitude</i> : " + point.geometry.coordinates[2] + "m, <i>Longitude</i> : " + point.geometry.coordinates[0] + ", <i>Latitude</i> : " + point.geometry.coordinates[1];
			document.querySelector('#rmqPoint').innerHTML = "<b>Remarques :</b><br />" + point.properties.remarques;
			document.querySelector('#proprioPoint').innerHTML = "<b>" + point.properties.annonce_proprio + " :</b><br />" + point.properties.proprio;
			document.querySelector('#accesPoint').innerHTML = "<b>Accès :</b><br />" + point.properties.acces;
			if (point.properties.couvertures != undefined) { document.querySelector('#couverturePoint').innerHTML = "Couvertures : " + point.properties.couvertures + "<br />"; }
			if (point.properties.eau_a_proximite != undefined) { document.querySelector('#eauPoint').innerHTML = "Eau à proximité : " + point.properties.eau_a_proximite + "<br />"; }
			if (point.properties.bois_a_proximite != undefined) { document.querySelector('#boisPoint').innerHTML = "Bois à proximité : " + point.properties.bois_a_proximite + "<br />"; }
			if (point.properties.latrines != undefined) { document.querySelector('#latrinePoint').innerHTML = "Latrines : " + point.properties.latrines + "<br />"; }
			if (point.properties.manque_un_mur != undefined) { document.querySelector('#manquemurPoint').innerHTML = "Manque un mur : " + point.properties.manque_un_mur + "<br />"; }
			if (point.properties.poele != undefined) { document.querySelector('#poelePoint').innerHTML = "Poêle : " + point.properties.poele + "<br />"; }
			if (point.properties.cheminee != undefined) { document.querySelector('#chemineePoint').innerHTML = "Cheminée : " + point.properties.cheminee + "<br />"; }
			if (point.properties.clef_a_recuperer != undefined) { document.querySelector('#clefPoint').innerHTML = "Clé à récupérer : " + point.properties.clef_a_recuperer + "<br />"; }
			if (point.properties.places_sur_matelas != undefined) { document.querySelector('#matelasPoint').innerHTML = "Places sur matelas : " + point.properties.places_sur_matelas + "<br />"; }
			if (point.properties.ravitaillement_en_eau_possible != undefined) { document.querySelector('#ravitaillementeauPoint').innerHTML = "Ravitaillement en eau possible : " + point.properties.ravitaillement_en_eau_possible + "<br />"; }
			if (point.properties.site_officiel != undefined) { document.querySelector('#sitewebPoint').innerHTML = "Site officiel : " + point.properties.site_officiel + "<br />"; }
			if (point.properties.id_pp_0 != undefined) { document.querySelector('#pp0Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_0 + ');">' + point.properties.nom_pp_0 + '</a> — ' + point.properties.type_pp_0 + ' à ' + point.properties.distance_pp_0 + '<br />'; }
			if (point.properties.id_pp_1 != undefined) { document.querySelector('#pp1Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_1 + ');">' + point.properties.nom_pp_1 + '</a> — ' + point.properties.type_pp_1 + ' à ' + point.properties.distance_pp_1 + '<br />'; }
			if (point.properties.id_pp_2 != undefined) { document.querySelector('#pp2Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_2 + ');">' + point.properties.nom_pp_2 + '</a> — ' + point.properties.type_pp_2 + ' à ' + point.properties.distance_pp_2 + '<br />'; }
			if (point.properties.com_0 != undefined) { document.querySelector('#com0Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_0 + ' par ' + point.properties.auteur_com_0 + '</p><br /><p class="com">' + point.properties.com_0 + '<br /><a href="' + point.properties.photo_com_0 + '"><img src="' + point.properties.miniature_com_0 + '" /></a></p>'; }
			if (point.properties.com_1 != undefined) { document.querySelector('#com1Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_1 + ' par ' + point.properties.auteur_com_1 + '</p><br /><p class="com">' + point.properties.com_1 + '<br /><a href="' + point.properties.photo_com_1 + '"><img src="' + point.properties.miniature_com_1 + '" /></a></p>'; }
			if (point.properties.com_2 != undefined) { document.querySelector('#com2Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_2 + ' par ' + point.properties.auteur_com_2 + '</p><br /><p class="com">' + point.properties.com_2 + '<br /><a href="' + point.properties.photo_com_2 + '"><img src="' + point.properties.miniature_com_2 + '" /></a></p>'; }
			if (point.properties.com_3 != undefined) { document.querySelector('#com3Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_3 + ' par ' + point.properties.auteur_com_3 + '</p><br /><p class="com">' + point.properties.com_3 + '<br /><a href="' + point.properties.photo_com_3 + '"><img src="' + point.properties.miniature_com_3 + '" /></a></p>'; }
			if (point.properties.com_4 != undefined) { document.querySelector('#com4Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_4 + ' par ' + point.properties.auteur_com_4 + '</p><br /><p class="com">' + point.properties.com_4 + '<br /><a href="' + point.properties.photo_com_4 + '"><img src="' + point.properties.miniature_com_4 + '" /></a></p>'; }
			displayBlock('points');
		}
	}
}

// Fonction appeler pour basculer entre les vues
function displayBlock(bloc) {
	var carte = document.querySelector('#carte');
	var index = document.querySelector('#index');
	var patientez = document.querySelector('#patientez');
	var points = document.querySelector('#infosPoint');
	var header = document.querySelector('header');
	var footer = document.querySelector('footer');
	var main = document.querySelector('section');


	if(bloc == 'carte') {
		points.style.display = 'none';
		carte.style.display = 'block';
		header.style.display = 'none';
		footer.style.display = 'none';
		index.style.display = 'none';
		patientez.style.display = 'none';
		main.style.height = '100%';
		if (init!=1) {
			initmap();
			init = 1;
		}
		map.invalidateSize();
	}
	else if(bloc == 'patientez') {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'none';
		footer.style.display = 'none';
		index.style.display = 'none';
		patientez.style.display = 'block';
		main.style.height = '100%';
	}
	else if(bloc == 'points') {
		points.style.display = 'block';
		carte.style.display = 'none';
		header.style.display = 'none';
		footer.style.display = 'none';
		index.style.display = 'none';
		patientez.style.display = 'none';
		main.style.height = '';
	}
	else {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'block';
		footer.style.display = 'block';
		index.style.display = 'block';
		patientez.style.display = 'none';
		main.style.height = '';
	}
}