// Script lié à la page d'accueil

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $modele contient les données passées par le fichier PHP
// $config les données communes à tout WRI

// 14/03/2013 Léo - Création

/************************* FONCTIONS CARTE *************************/

// Les variables necessaires au bon fonctionnement du truc
var map;
var ajaxRequest;
var plotlayers=[];
var init = 0;

// Fonction lancée dès que le <div> map est chargé
function initmap(){
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
	var msg='../api/bbox/?format_texte=html&bbox='+minll.lng+','+minll.lat+','+maxll.lng+','+maxll.lat;

	// Requete AJAX
	$.get(msg)
	.done(function(data) { 
		stateChanged(data); 
	})
	.fail(function() {
		alert( "Erreur lors de la réception de la requête AJAX" );
	});
}

function onMapMove(e) { askForPlots(); } // Si on a fini de trifouiller la carte, on rafraichi la liste des refuges

// Fonction lancée quand AJAX à retourné quelque chose
function stateChanged(plotlist) {
	// Si AJAX à bien retourné ce que l'on attendais
	removeMarkers(); // On enlève tous les points actuels
	for (i=0;i<plotlist.features.length;i++) { // Pour chaque point (ligne GeoJSON)
		var plotll = new L.LatLng(plotlist.features[i].geometry.coordinates[1],plotlist.features[i].geometry.coordinates[0]); // On enregistre ses coordonnées
		// Une variable contenant le style du marqueur
		var cabaneIcon = L.icon({
			iconUrl: './images/icones/' + plotlist.features[i].properties.type.icone + '.png', // On télécharge la bonne image de marqueur
			iconSize: [16, 16],
			iconAnchor: [8, 8],
			popupAnchor: [0, 0]
		});
		var plotmark = new L.Marker(plotll, {icon: cabaneIcon}); // On créé un marqueur (bleu par défaut)
		map.addLayer(plotmark); // On ajoute un calque pour ce marqueur
		var popup = new L.Rrose({autoPan: false})
		.setContent('<a href="#pt' + plotlist.features[i].properties.id + '">' + plotlist.features[i].properties.nom + '</a>');
		plotmark.bindPopup(popup); // On ajoute au marqueur un popup contenant le lien
		plotlayers.push(plotmark);
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
	var msg='../api/point?id=' + idpoint + "&format_texte=html";

	// Requete AJAX
	$.ajax(msg)
	.done(function(data) { 
		pointRecu(data); 
	})
	.fail(function() {
		alert( "Erreur lors de la réception de la requête AJAX" );
	});
}

// Fonction qui retourne Oui ou Non au lieu du code binaire
function on(val) {
	if (val === "1") return "Oui";
	else if (val === "0") return "Non";
	else if (val === null) return "<i>Non renseigné</i>";
	else return val;

}

// Fonction lancée quand AJAX à retourné quelque chose
function pointRecu(point) {
	// Si AJAX à bien retourné ce que l'on attendais
	point = point.features[0].properties;
	$('#infosPoint').html('<span id="titrePoint"></span><div id="fichePoint"><span id="idPoint"></span><span id="typePoint"></span></div><p id="coordPoint"></p><p id="proprioPoint"></p><p id="accesPoint"></p><p id="rmqPoint"></p><p id="infoscompPoint"><b>Informations complémentaires :</b><br /></p><p id="pointsprochesPoint"><b>Points proches :</b><br /></p><div id="commentairesPoint"><p><b>Commentaires :</b></p></div><p class="sautdeligne"></p>');
	$('#titrePoint').html(point.nom);
	$('#idPoint').html("(Point n°<a target=\"_blank\" href='http://www.refuges.info/point/" + point.id + "' title='Informations détaillées sur le point, version PC'>" + point.id + "</a>)<br />Édité le ");
	if(point.date.derniere_modif === null)
		$('#idPoint').append(point.date.creation);
	else
		$('#idPoint').append(point.date.derniere_modif);
	$('#typePoint').html("<p>" + point.type.valeur + "</p><span id=\"nbPlaces\">" + point.places.valeur + " " + point.places.nom + "</span>");
	$('#coordPoint').html("<b>Coordonnées :</b><br />&nbsp;<i>Précision</i> : " + point.coord.precision.nom + "<br />&nbsp;<i>Altitude</i> : " + point.coord.alt + "m, <i>Longitude</i> : " + point.coord.long + ", <i>Latitude</i> : " + point.coord.lat);
	$('#rmqPoint').html("<b>" + point.remarque.nom + " :</b><br />" + point.remarque.valeur);
	$('#proprioPoint').html("<b>" + point.proprio.nom + " :</b><br />" + point.proprio.valeur);
	$('#accesPoint').html("<b>" + point.acces.nom + " :</b><br />" + point.acces.valeur);
	
	// Infos complémentaires, elle sont ajoutés à la suite du titre
	$.each(point.info_comp, function(info_comp_name, info_comp) {
		if (info_comp.nom != "") {
			$( "#infoscompPoint" ).append("<span id=\"" + info_comp_name + "Point\">" +
				info_comp.nom + " : ");
			if(info_comp_name == "site_officiel") {
				if(info_comp.valeur != "")
					$( "#infoscompPoint" ).append("<a target=\"_blank\" href=\"" + info_comp.valeur + "\">" + point.nom + "</a>");
				else
					$( "#infoscompPoint" ).append("<i>Non renseigné</i>");
			}
			else
				$( "#infoscompPoint" ).append(on(info_comp.valeur));
			$( "#infoscompPoint" ).append("<br /></span>");
		}
	});

	// Points proches
	$.each(point.pp, function(pp_name, pp) {
		if (pp_name != "nb")
			$( "#pointsprochesPoint" ).append('<a href="#pt' + pp.id + '">' + pp.nom + '</a> —  à ' + (pp.distance/1000).toFixed(2) + ' km<br />');
	});

	// On affiche les derniers commentaires
	$.each(point.coms, function(coms_name, com) {
		if (coms_name != "nb") {
			commentaire = '<div id="com' + com.id + 'Point"><p class="legendecom">' + com.date;
			if (com.createur.nom != "")
				commentaire += ' par ' + com.createur.nom;
			commentaire += '</p><p class="com">';
			if (com.texte != "")
				commentaire += com.texte + '<br />';
			if (com.photo.nb != 0)
				commentaire += '<a target="_blank" data-lightbox="photoCom" href="' + com.photo.originale + '"><img src="' + com.photo.reduite + '" /></a>';
			commentaire += '</p></div>';
			$( "#commentairesPoint" ).append(commentaire);
		}
	});

	clearBlocsVides(point);
	displayBlock('points');
}

function clearBlocsVides(point) {
	// Effacer les infos complémentaires s'il y en a aucune
	infosComp = $('#infoscompPoint').html();
	if (infosComp == "<b>Informations complémentaires :</b><br>") {
		$("#infoscompPoint").remove();
	}
	
	// Effacer les commentaires
	if (point.coms.nb==0) { $("#commentairesPoint").remove(); }

	
	// Effacer les trois gros blocs
	if (point.remarque.valeur == "") { $("#rmqPoint").remove(); }
	if (point.proprio.valeur == "" || point.proprio == "") { $("#proprioPoint").remove(); }
	if (point.acces.valeur == "") { $("#accesPoint").remove(); }

	// Effacer les points proches si aucun
	if (point.pp.nb==0) { $("#pointsprochesPoint").remove(); }

	// Effacer les places dispo pour sommets, col, lac, sources.
	if (point.type.valeur == "lac" || point.type.valeur == "point de passage" || point.type.valeur == "sommet" || point.type.valeur == "point d'eau" ) {
		$("#nbPlaces").remove();
	}
}


// Fonction appelée pour basculer entre les vues
function displayBlock(bloc) {
	var carte = $('#carte');
	var index = $('#index');
	var aide = $('#aide');
	var parametres = $('#parametres');
	var licence = $('#licence');
	var patientez = $('#patientez');
	var points = $('#infosPoint');
	var header = $('header');
	var footer = $('footer');
	var section = $('section');

	footer.css('display', 'block');

	if(bloc == 'carte') {
		points.css('display', 'none');
		carte.css('display', 'block');
		header.css('display', 'none');
		index.css('display', 'none');
		aide.css('display', 'none');
		parametres.css('display', 'none');
		licence.css('display', 'none');
		patientez.css('display', 'none');
		section.css('height', '100%');
		if (init!=1) {
			initmap();
			init = 1;
		}
		map.invalidateSize();
	}
	else if(bloc == 'patientez') {
		points.css('display', 'none');
		carte.css('display', 'none');
		header.css('display', 'none');
		index.css('display', 'none');
		aide.css('display', 'none');
		parametres.css('display', 'none');
		licence.css('display', 'none');
		patientez.css('display', 'block');
		section.css('height', '');
	}
	else if(bloc == 'points') {
		points.css('display', 'block');
		carte.css('display', 'none');
		header.css('display', 'none');
		index.css('display', 'none');
		aide.css('display', 'none');
		parametres.css('display', 'none');
		licence.css('display', 'none');
		patientez.css('display', 'none');
		section.css('height', '');
	}
	else if(bloc == 'aide') {
		points.css('display', 'none');
		carte.css('display', 'none');
		header.css('display', 'block');
		index.css('display', 'none');
		aide.css('display', 'block');
		parametres.css('display', 'none');
		licence.css('display', 'none');
		patientez.css('display', 'none');
		section.css('height', '');
	}
	else if(bloc == 'parametres') {
		points.css('display', 'none');
		carte.css('display', 'none');
		header.css('display', 'block');
		index.css('display', 'none');
		aide.css('display', 'none');
		parametres.css('display', 'block');
		licence.css('display', 'none');
		patientez.css('display', 'none');
		section.css('height', '');
	}
	else if(bloc == 'licence') {
		points.css('display', 'none');
		carte.css('display', 'none');
		header.css('display', 'block');
		index.css('display', 'none');
		aide.css('display', 'none');
		parametres.css('display', 'none');
		licence.css('display', 'block');
		patientez.css('display', 'none');
		section.css('height', '');
	}
	else {
		points.css('display', 'none');
		carte.css('display', 'none');
		header.css('display', 'block');
		index.css('display', 'block');
		aide.css('display', 'none');
		parametres.css('display', 'none');
		licence.css('display', 'none');
		patientez.css('display', 'none');
		section.css('height', '');
	}
}

$(window).load(function() {
	changeBlock();
});

window.onhashchange = changeBlock;

function changeBlock() {
	if (location.hash.substring(0,3) == "#pt") {
		affichePoint(location.hash.substring(3));
	}
	else {
		switch (location.hash) {
			case "#help":
			displayBlock('aide');
			break;
			case "#settings":
			displayBlock('parametres');
			break;
			case "#map":
			displayBlock('carte');
			break;
			case "#license":
			displayBlock('licence');
			break;
			default:
			displayBlock('index');
			break;
		}
	}
}
