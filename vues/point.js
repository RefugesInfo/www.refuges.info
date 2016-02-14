<?// Script lié à la page point

// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP
// $config les données communes à tout WRI

if ($vue->mini_carte) { ?>
	var map, layerSwitcher;

	window.addEventListener('load', function() {
		var baseLayers = {
			'Refuges.info':new L.TileLayer.OSM.MRI(),
			'OSM fr':      new L.TileLayer.OSM.FR(),
			'Outdoors':    new L.TileLayer.OSM.Outdoors(),
			'IGN':         new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS'}),
			'IGN Express': new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE'}),
			'SwissTopo':   new L.TileLayer.SwissTopo({l:'ch.swisstopo.pixelkarte-farbe'}),
			'Autriche':    new L.TileLayer.Kompass({l:'Touristik'}),
			'Espagne':     new L.TileLayer.WMS.IDEE(),
			'Italie':      new L.TileLayer.WMS.IGM(),
			'Angleterre':  new L.TileLayer.OSOpenSpace('<?=$config['os_key']?>', {}),
			'Photo Bing':  new L.BingLayer('<?=$config['bing_key']?>', {type:'Aerial'}),
			'Photo IGN':   new L.TileLayer.IGN({k: '<?=$config['ign_key']?>', l:'ORTHOIMAGERY.ORTHOPHOTOS'})
		};

		map = new L.Map('vignette', {
			layers: [
				baseLayers['<?=$vue->vignette[0]?>'] || // Le fond de carte assigné à cette région par $config['fournisseurs_fond_carte']
				baseLayers['<?=$config["carte_base"]?>'] || // Sinon le fond de carte par défaut
				baseLayers[Object.keys(baseLayers)[0]] // Sinon la première couche définie
			]
		});

		// Cadre fixe marquant une position;
		var cadre = new L.Marker([<?=$vue->point->latitude?>,<?=$vue->point->longitude?>], {
			clickable: false, // Evite d'activer le curseur: pointeur
			icon: L.icon({
				iconUrl: '<?=$config['sous_dossier_installation']?>images/cadre.png',
				iconAnchor: [15, 21]
			})
		})
		.coordinates('position') // Affiche les coordonnées dans les éléments HTML id=position-*
		.addTo(map);
		// La carte est centrée autour
		map.setView(cadre._latlng, 13, {reset: true});

		new L.GeoJSON.Ajax( // Les points d'intérêt WRI
			'<?=$config['sous_dossier_installation']?>api/bbox',
			{
				argsGeoJSON: {
					type_points: 'all'
				},
				bbox: true,
				style: function(feature) {
					var prop = [];
					if (feature.properties.coord.alt)
						prop.push (feature.properties.coord.alt+'m');
					if (feature.properties.places.valeur)
						prop.push (feature.properties.places.valeur+'<img src="<?=$config['sous_dossier_installation']?>images/lit.png"/>');
					return {
						url: feature.properties.lien,
						iconUrl: '<?=$config['sous_dossier_installation']?>images/icones/' + feature.properties.type.icone + '.png',
						iconAnchor: [8, 8],
						title: feature.properties.nom +
							(prop.length
								? '<div style=text-align:center>'+prop.join(' ')+'</div>'
								: ''
							),
						popupAnchor: [-1, -9],
						degroup: 12 // Spread the icons when the cursor hovers on a busy area.
					};
				}
			}
		).addTo(map);

		new L.Control.Fullscreen().addTo(map);

		layerSwitcher = new L.Control.Layers(baseLayers).addTo(map); // Le controle de changement de couche de carte avec la liste des cartes dispo

		new L.Control.Permalink.Cookies({ // Garde la mémoire des position, zoom, carte.
			layers: layerSwitcher,
			text: null, // Le contrôle n'apparait pas sur la carte car ça n'a pas de sens pour un point qui positionne lui même la carte
			move: false // On n'itialise pas la carte avec le permalink: il est uniquement là pour enregistrer
		}).addTo(map);
	});

	// Actions de la page
	function agrandir_vignette() {

		// On masque le contrôle puisqu'il a déjà été activé
		var agrandir_vignette = document.getElementById('agrandir_vignette');
		if (agrandir_vignette)
			agrandir_vignette.style.display = 'none';

		// On redimensionne la carte
		document.getElementById('vignette').id = 'vignette-agrandie';
		map.autoHeight();

		// On positionne la couche de second choix
		var oldLayerId, newLayerId;
		for (l in layerSwitcher._layers) {
			if (map.hasLayer(layerSwitcher._layers[l].layer))
				oldLayerId = l;
			if (layerSwitcher._layers[l].name == '<?=$vue->vignette[2]?>')
				newLayerId = l;
		}
		if (oldLayerId && newLayerId && oldLayerId != newLayerId) {
			map.removeLayer(layerSwitcher._layers[oldLayerId].layer);
			map.addLayer(layerSwitcher._layers[newLayerId].layer);
		}
	}
<?}?>

// AFFICHAGE DE LA METEO
// Source: http://www.prevision-meteo.ch/services
// http://www.prevision-meteo.ch/uploads/pdf/recuperation-donnees-meteo.pdf
function meteo_fcst(data) {
	var html = '<div>' +
		'<p>' + data.day_long + '</p>' +
		'<p>' + data.tmin + ' à ' + data.tmax + '°</p>',
		intervalles_par_jour = Math.min(6, Math.floor(document.getElementById('meteo').offsetWidth / 5 /* Jours présentés */ / 31 /* Pixels par icône */ )),
		heures_par_intervalle = Math.round(24 / intervalles_par_jour);

	// Détermination des heures de T° min & max
	var h_t_min = 0,
		h_t_max = 0;
	for (h = 0; h < 24; h++) {
		if (data.hourly_data[h + 'H00'].TMP2m < data.hourly_data[h_t_min + 'H00'].TMP2m) h_t_min = h;
		if (data.hourly_data[h + 'H00'].TMP2m > data.hourly_data[h_t_max + 'H00'].TMP2m) h_t_max = h;
	}

	for (debut_intervalle = 0; debut_intervalle < 24; debut_intervalle += heures_par_intervalle) {
		var precipitation = 0,
			h_pluie_max, pluie_max,
			heure = debut_intervalle + (intervalles_par_jour == 2 ? 0 : Math.floor(heures_par_intervalle / 2));
		if (debut_intervalle <= h_t_min && h_t_min < debut_intervalle + heures_par_intervalle) heure = h_t_min; // On prend cette heure si c'est la température la plus basse
		if (debut_intervalle <= h_t_max && h_t_max < debut_intervalle + heures_par_intervalle) heure = h_t_max; // On prend cette heure si c'est la température la plus élevée
		for (h = debut_intervalle; h < Math.min(24, debut_intervalle + heures_par_intervalle); h++) {
			var data_heure = data.hourly_data[h + 'H00'];
			precipitation += data_heure.APCPsfc;
			if (pluie_max < data_heure.APCPsfc) {
				pluie_max = data_heure.APCPsfc;
				heure = h; // On prend cette heure si c'est la pluie la plus intense
			}
		}
		var data_heure = data.hourly_data[heure + 'H00'],
			comment =
			data_heure.CONDITION + '\n' +
			Math.round(data_heure.TMP2m) +
				(Math.round(data_heure.WNDCHILL2m) < Math.round(data_heure.TMP2m) ? '° ressenti ' + Math.round(data_heure.WNDCHILL2m) : '') +
				'° à ' + heure + 'h\n' +
			'Humidité ' + data_heure.RH2m + '%\n' +
			(!precipitation ? '' : 'Précipitation ' + Math.round(precipitation) + 'mm de ' + debut_intervalle + ' à ' + Math.min(24, debut_intervalle + heures_par_intervalle) + 'h\n') +
			'Vent ' + data_heure.WNDDIRCARD10 + ' ' + data_heure.WNDSPD10m + 'km/h' + (data_heure.WNDGUST10m < data_heure.WNDSPD10m ? '' : ' rafales à ' + data_heure.WNDGUST10m + 'km/h');
		html += '<div title="' + comment + '"><img width="30" src="' + data_heure.ICON + '" /></div>';
	}
	return html + '</div>';
}

var xhttp;
function meteo_draw() {
	var html = '';
	if (xhttp.readyState == 4 && xhttp.status == 200) {
		var jsonObj = JSON.parse(xhttp.responseText);
		for (k in jsonObj) {
			var f = window['meteo_' + k.split('_')[0]];
			if (typeof f == 'function')
				html += f(jsonObj[k]);
		}
	}
	document.getElementById('meteo').innerHTML = html;
}

function meteo() {
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = meteo_draw;
	xhttp.open ('GET', 'http://www.prevision-meteo.ch/services/json/lat=<?=$vue->point->latitude?>lng=<?=$vue->point->longitude?>', true);
	xhttp.send();
	window.onresize = meteo_draw;
}

function meteo_run(el) {
	var dd = document.createElement("dd"),
		dt = el.parentElement;
	dt.innerHTML = '<dt><?=$vue->nom_debut_majuscule?> &copy; <a href="http://www.prevision-meteo.ch/">prevision-meteo.ch</a></dt>';
	dd.innerHTML = '<div id="meteo"></div><br style="clear:both" />';
	dt.parentNode.insertBefore(dd, dt.nextSibling);
	meteo();
}
