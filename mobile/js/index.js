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
		alert ("Ce navigateur ne semble pas supporter la technologie AJAX... Vous devrez peut-être le mettre à jour...");
		return;
	}
	
	// On créé notre carte vierge
	map = new L.Map('map');

//	var MRIUrl='http://maps.refuges.info/hiking/{z}/{x}/{y}.png'; // Serveur de tuiles MRI
	var MRIUrl='http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png'; // Serveur de tuiles Thunderforest
	var MRI = new L.TileLayer(MRIUrl, {minZoom: 2, maxZoom: 18, noWrap: true}); // Création du calque de tuiles nommé MRI

	map.setView(new L.LatLng(47, 2),6); // Par défaut on affiche la France entière

	// Fonction lancée quand la géolocalisation a marché
	function onLocationFound(e) {
	    L.marker(e.latlng).addTo(map); // On ajoute un marqueur indiquant notre position (bleu par défaut)
	}
	map.locate({setView: true, maxZoom: 14}); // On demande de géolocalisé, avec un zoom de 14 sur notre position

	map.attributionControl.setPrefix(''); // On enlève le crédit vers leaflet
	map.addLayer(MRI); // On ajoute le calque MRI à la carte

	// Ajout de l'icone fullscreen
	L.control.scale().addTo(map);
	
	// Action en cas des évenements suivant
	map.on('locationfound', onLocationFound);
	map.on('moveend', onMapMove);
	onMapMove();
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
				// Une variable contenant le style du marqueur
				var cabaneIcon = L.icon({
					iconUrl: './images/icones/' + plotlist.features[i].properties.type + '.png', // On télécharge la bonne image de marqueur
					iconSize: [16, 16],
					iconAnchor: [8, 8],
					popupAnchor: [0, 0]
				});
				var plotmark = new L.Marker(plotll, {icon: cabaneIcon}); // On créé un marqueur (bleu par défaut)
				map.addLayer(plotmark); // On ajoute un calque pour ce marqueur
				plotmark.data=plotlist.features[i]; // Useless ?
				var popup = new L.Rrose({autoPan: false})
				    .setContent('<a href="#" onclick="affichePoint(' + plotlist.features[i].properties.id_point + ');">' + plotlist.features[i].properties.nom + '</a>');
				plotmark.bindPopup(popup); // On ajoute au marqueur un popup contenant le lien
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
	var msg='../point-geojson/' + idpoint;

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
			document.getElementById('infosPoint').innerHTML = '<span id="titrePoint"></span><div id="fichePoint"><span id="idPoint"></span><span id="typePoint"></span></div><p id="coordPoint"></p><p id="proprioPoint"></p><p id="accesPoint"></p><p id="rmqPoint"></p><p id="infoscompPoint"><b>Informations complémentaires :</b><br /><span id="couverturePoint"></span><span id="eauPoint"></span><span id="boisPoint"></span><span id="latrinePoint"></span><span id="manquemurPoint"></span><span id="poelePoint"></span><span id="chemineePoint"></span><span id="clefPoint"></span><span id="matelasPoint"></span><span id="ravitaillementeauPoint"></span><span id="sitewebPoint"></span></p><p id="pointsprochesPoint"><b>Points proches :</b><br /><span id="pp0Point"></span><span id="pp1Point"></span><span id="pp2Point"></span></p><div id="commentairesPoint"><p><b>Commentaires :</b></p><div id="com0Point"></div><div id="com1Point"></div><div id="com2Point"></div><div id="com3Point"></div><div id="com4Point"></div></div><p class="sautdeligne"></p>';
			document.getElementById('titrePoint').innerHTML = point.properties.nom;
			document.getElementById('idPoint').innerHTML = "(Point n°<a target=\"_blank\" href='http://www.refuges.info/point/" + point.properties.id + "' title='Informations détaillées sur le point, version PC'>" + point.properties.id + "</a>)<br />Édité le " + point.properties.derniere_modif;
			document.getElementById('typePoint').innerHTML = point.properties.type + "<br />" + point.properties.nb_places + " place(s)";
			document.getElementById('coordPoint').innerHTML = "<b>Coordonnées :</b><br />&nbsp;<i>Précision</i> : " + point.properties.precision_gps + "<br />&nbsp;<i>Altitude</i> : " + point.geometry.coordinates[2] + "m, <i>Longitude</i> : " + point.geometry.coordinates[0] + ", <i>Latitude</i> : " + point.geometry.coordinates[1];
			document.getElementById('rmqPoint').innerHTML = "<b>Remarques :</b><br />" + point.properties.remarques;
			if (point.properties.remarques == "") {removeElement("rmqPoint"); }
			document.getElementById('proprioPoint').innerHTML = "<b>" + point.properties.annonce_proprio + " :</b><br />" + point.properties.proprio;
			if (point.properties.annonce_proprio == "" || point.properties.proprio == "") {removeElement("proprioPoint"); }
			document.getElementById('accesPoint').innerHTML = "<b>Accès :</b><br />" + point.properties.acces;
			if (point.properties.acces == "") {removeElement("accesPoint"); }
			if (point.properties.couvertures != undefined) { document.getElementById('couverturePoint').innerHTML = "Couvertures : " + point.properties.couvertures + "<br />"; }
			if (point.properties.eau_a_proximite != undefined) { document.getElementById('eauPoint').innerHTML = "Eau à proximité : " + point.properties.eau_a_proximite + "<br />"; }
			if (point.properties.bois_a_proximite != undefined) { document.getElementById('boisPoint').innerHTML = "Bois à proximité : " + point.properties.bois_a_proximite + "<br />"; }
			if (point.properties.latrines != undefined) { document.getElementById('latrinePoint').innerHTML = "Latrines : " + point.properties.latrines + "<br />"; }
			if (point.properties.manque_un_mur != undefined) { document.getElementById('manquemurPoint').innerHTML = "Manque un mur : " + point.properties.manque_un_mur + "<br />"; }
			if (point.properties.poele != undefined) { document.getElementById('poelePoint').innerHTML = "Poêle : " + point.properties.poele + "<br />"; }
			if (point.properties.cheminee != undefined) { document.getElementById('chemineePoint').innerHTML = "Cheminée : " + point.properties.cheminee + "<br />"; }
			if (point.properties.clef_a_recuperer != undefined) { document.getElementById('clefPoint').innerHTML = "Clé à récupérer : " + point.properties.clef_a_recuperer + "<br />"; }
			if (point.properties.places_sur_matelas != undefined) { document.getElementById('matelasPoint').innerHTML = "Places sur matelas : " + point.properties.places_sur_matelas + "<br />"; }
			if (point.properties.ravitaillement_en_eau_possible != undefined) { document.getElementById('ravitaillementeauPoint').innerHTML = "Ravitaillement en eau possible : " + point.properties.ravitaillement_en_eau_possible + "<br />"; }
			if (point.properties.site_officiel != undefined) { document.getElementById('sitewebPoint').innerHTML = "Site officiel : " + '<a href="' + point.properties.site_officiel + '" target="_blank">' + point.properties.nom + "</a><br />"; }
			if (point.properties.acces == "" && point.properties.couvertures == "" && point.properties.eau_a_proximite == "" && point.properties.bois_a_proximite == "" && point.properties.latrines == "" && point.properties.manque_un_mur == "" && point.properties.poele == "" && point.properties.cheminee == "" && point.properties.clef_a_recuperer == "" && point.properties.places_sur_matelas == "" && point.properties.ravitaillement_en_eau_possible == "" && point.properties.site_officiel == "") {removeElement("infoscompPoint"); }
			if (point.properties.id_pp_0 != undefined) { document.getElementById('pp0Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_0 + ');">' + point.properties.nom_pp_0 + '</a> — ' + point.properties.type_pp_0 + ' à ' + point.properties.distance_pp_0 + '<br />'; }
			if (point.properties.id_pp_1 != undefined) { document.getElementById('pp1Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_1 + ');">' + point.properties.nom_pp_1 + '</a> — ' + point.properties.type_pp_1 + ' à ' + point.properties.distance_pp_1 + '<br />'; }
			if (point.properties.id_pp_2 != undefined) { document.getElementById('pp2Point').innerHTML = '<a href="#" onclick="affichePoint(' + point.properties.id_pp_2 + ');">' + point.properties.nom_pp_2 + '</a> — ' + point.properties.type_pp_2 + ' à ' + point.properties.distance_pp_2 + '<br />'; }
			if (point.properties.id_pp_0 == undefined && point.properties.id_pp_1 == undefined && point.properties.id_pp_2 == undefined) {removeElement("pointsprochesPoint"); }
			// À remplacer par un foreach quand j'aurais le temps
			if (point.properties.com_0 != undefined) { document.getElementById('com0Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_0 + ' par ' + point.properties.auteur_com_0 + '</p><br /><p class="com">' + point.properties.com_0 + '<br />';
				if (point.properties.photo_com_0 != undefined) { document.getElementById('com0Point').innerHTML += '<a target="_blank" data-lightbox="photoCom" href="..' + point.properties.photo_com_0 + '"><img src="..' + point.properties.miniature_com_0 + '" /></a>'; }
				document.getElementById('com0Point').innerHTML += '</p>'; } else { removeElement("com0Point"); }
			if (point.properties.com_1 != undefined) { document.getElementById('com1Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_1 + ' par ' + point.properties.auteur_com_1 + '</p><br /><p class="com">' + point.properties.com_1 + '<br />';
				if (point.properties.photo_com_1 != undefined) { document.getElementById('com1Point').innerHTML += '<a target="_blank" data-lightbox="photoCom" href="..' + point.properties.photo_com_1 + '"><img src="..' + point.properties.miniature_com_1 + '" /></a>'; }
				document.getElementById('com1Point').innerHTML += '</p>'; } else { removeElement("com1Point"); }
			if (point.properties.com_2 != undefined) { document.getElementById('com2Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_2 + ' par ' + point.properties.auteur_com_2 + '</p><br /><p class="com">' + point.properties.com_2 + '<br />';
				if (point.properties.photo_com_2 != undefined) { document.getElementById('com2Point').innerHTML += '<a target="_blank" data-lightbox="photoCom" href="..' + point.properties.photo_com_2 + '"><img src="..' + point.properties.miniature_com_2 + '" /></a>'; }
				document.getElementById('com2Point').innerHTML += '</p>'; } else { removeElement("com2Point"); }
			if (point.properties.com_3 != undefined) { document.getElementById('com3Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_3 + ' par ' + point.properties.auteur_com_3 + '</p><br /><p class="com">' + point.properties.com_3 + '<br />';
				if (point.properties.photo_com_3 != undefined) { document.getElementById('com3Point').innerHTML += '<a target="_blank" data-lightbox="photoCom" href="..' + point.properties.photo_com_3 + '"><img src="..' + point.properties.miniature_com_3 + '" /></a>'; }
				document.getElementById('com3Point').innerHTML += '</p>'; } else { removeElement("com3Point"); }
			if (point.properties.com_4 != undefined) { document.getElementById('com4Point').innerHTML = '<p class="legendecom">' + point.properties.date_com_4 + ' par ' + point.properties.auteur_com_4 + '</p><br /><p class="com">' + point.properties.com_4 + '<br />';
				if (point.properties.photo_com_4 != undefined) { document.getElementById('com4Point').innerHTML += '<a target="_blank" data-lightbox="photoCom" href="..' + point.properties.photo_com_4 + '"><img src="..' + point.properties.miniature_com_4 + '" /></a>'; }
				document.getElementById('com4Point').innerHTML += '</p>'; } else { removeElement("com4Point"); }
			displayBlock('points');
		}
	}
}

// Fonction appeler pour basculer entre les vues
function displayBlock(bloc) {
	var carte = document.getElementById('carte');
	var index = document.getElementById('index');
	var aide = document.getElementById('aide');
	var parametres = document.getElementById('parametres');
	var licence = document.getElementById('licence');
	var patientez = document.getElementById('patientez');
	var points = document.getElementById('infosPoint');
	var header = document.querySelector('header');
	var footer = document.querySelector('footer');
	var section = document.querySelector('section');


	if(bloc == 'carte') {
		points.style.display = 'none';
		carte.style.display = 'block';
		header.style.display = 'none';
		index.style.display = 'none';
		aide.style.display = 'none';
		parametres.style.display = 'none';
		licence.style.display = 'none';
		patientez.style.display = 'none';
		section.style.height = '100%';
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
		index.style.display = 'none';
		aide.style.display = 'none';
		parametres.style.display = 'none';
		licence.style.display = 'none';
		patientez.style.display = 'block';
		section.style.height = '';
	}
	else if(bloc == 'points') {
		points.style.display = 'block';
		carte.style.display = 'none';
		header.style.display = 'none';
		index.style.display = 'none';
		aide.style.display = 'none';
		parametres.style.display = 'none';
		licence.style.display = 'none';
		patientez.style.display = 'none';
		section.style.height = '';
	}
	else if(bloc == 'aide') {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'block';
		index.style.display = 'none';
		aide.style.display = 'block';
		parametres.style.display = 'none';
		licence.style.display = 'none';
		patientez.style.display = 'none';
		section.style.height = '';
	}
	else if(bloc == 'parametres') {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'block';
		index.style.display = 'none';
		aide.style.display = 'none';
		parametres.style.display = 'block';
		licence.style.display = 'none';
		patientez.style.display = 'none';
		section.style.height = '';
	}
	else if(bloc == 'licence') {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'block';
		index.style.display = 'none';
		aide.style.display = 'none';
		parametres.style.display = 'none';
		licence.style.display = 'block';
		patientez.style.display = 'none';
		section.style.height = '';
	}
	else {
		points.style.display = 'none';
		carte.style.display = 'none';
		header.style.display = 'block';
		index.style.display = 'block';
		footer.style.display = 'block';
		aide.style.display = 'none';
		parametres.style.display = 'none';
		licence.style.display = 'none';
		patientez.style.display = 'none';
		section.style.height = '';
	}
}

// Fonction appelée pour effacer un élément
function removeElement(id) {
  var element = document.getElementById(id);
  element.parentNode.removeChild(element);
}

$(window).load(function() { 
   displayBlock('index');
});