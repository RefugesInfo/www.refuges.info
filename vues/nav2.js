<?// Code Javascript de la page des cartes
// yip test de WFS, en Official OL car je ne sais pas modifier OL pour inclure les fonctions
?>

var map;
// Proxy monte par Dominique
OpenLayers.ProxyHost = "/ol2.12.1.3/proxy.php?url=";

window.onload = function () {

	//===================  DEBUT initialisation MAP =======================
	var options = {
		controls: [
                        new OpenLayers.Control.Navigation(),
                        new OpenLayers.Control.PanZoomBar(),
                        new OpenLayers.Control.ScaleLine(),
                        new OpenLayers.Control.MousePosition(),
                    ]
	};
	map = new OpenLayers.Map('carte_nav', options);
	//================ FIN initialisation MAP ==========================

	//===================== DEBUT LAYERS ========================
	// definit et ajoute la couche de base
	var base = new OpenLayers.Layer.WMS( "OpenLayers WMS",
                    "http://vmap0.tiles.osgeo.org/wms/vmap0",
                    {layers: 'basic'} );
	map.addLayer(base);
	
	// extend superlarge, mais il ne sera pas afficher. la recherche du conteneur est limitee a cet extend !! /FIXME
	map.zoomToExtent(new OpenLayers.Bounds(-80,-80,80,80)); 
 
	// definit et ajoute une 1ere couche vector NOTE: le nom est identique dans le fichier de style
	var points = new OpenLayers.Layer.Vector("PointsWRI", {
		styleMap: stylewri,
		visibility: false,  // en attente d'infos de conteneur
		strategies: [new OpenLayers.Strategy.BBOX() ],
		protocol: new OpenLayers.Protocol.WFS({
			version : "1.1.0",   // il fait tout seul de la reprojection en 4326
			url: "http://yip.refuges.info/tinyows/tinyows.cgi",
			featureType: "pois",
			featureNS: "http://www.tinyows.org/",
		})
	});
	map.addLayer(points);
	
	// definit et ajoute une 2e couche vector
	var polys = new OpenLayers.Layer.Vector("PolygonesWRI", {
		styleMap: stylewri,
		visibility: false,
		strategies: [new OpenLayers.Strategy.BBOX()],
		protocol: new OpenLayers.Protocol.WFS({
			version : "1.1.0",
			url: "http://yip.refuges.info/tinyows/tinyows.cgi",
			featureType: "polys",
			featureNS: "http://www.tinyows.org/",
		})
	});	
	map.addLayer(polys);

	// definit et ajoute une 3e couche vector MASQUE de selection "FACULTATIF"
	// pour le dessin du masque, la creation ...
	var masque = new OpenLayers.Layer.Vector("Masque", {
				styleMap: stylewri });	
	map.addLayer(masque);

	// C'EST LA QUE CA COMMENCE, sans conteneur, point de salut
	init_conteneur();
	//================= FIN LAYERS ======================

	//===============  APPLIQUE  STYLE fichier SLD =====================
	var stylewri = new OpenLayers.StyleMap();
	// tous les styles icones et couleurs sont dans ce fichier XML :
	OpenLayers.Request.GET({
			url: "/tinyows/refuges-info-sld.xml",
			success: applique_styles   // fonction de traitement du fichier
	});

	//================  VECTORS CLIQUABLE (fixme) ================
	active_couche_cliquable() ;
}



//=================================================================
//=================  DEBUT FONCTIONS MAISONS ===========================
//==============================================================



//================= DEBUT FILTRAGE =================
// on essaie de construire les filtres, en fonction de l'URL 
//var poly_conteneur;
function init_conteneur( ) {
	var poly_id = document.URL.match(/nav2\/([0-9]+)/);
	if ( poly_id ) {  // il y a pas  parmaetre !
		poly_id = poly_id.pop();
	} else {
		poly_id = "352" ; // FIXME utiliser la variable globale de la zone par defaut
	}

	//======= Objectif: recuperer les infos du polygone conteneur ==========
	var polys = map.getLayersByName("PolygonesWRI")[0];
	//le filtre tout con qui fera la recherche sur l'ID du poly:
	var filtre_cql = new OpenLayers.Format.CQL() ; 
	polys.filter = filtre_cql.read( 'id_polygone = ' + poly_id) ;
	//console.log(polys.filter);
	// mise en place d'un listener qui dit quand la recherche est terminee
	function get_conteneur ( f ) {
			poly_conteneur = f.feature.clone() ; // le poly conteneur devient une var globale
			//masque_conteneur = inverse_polygone(poly_conteneur) ;
			
			// ajuste la bbox de la carte au conteneur
			map.zoomToExtent( poly_conteneur.geometry.getBounds() );
			//nettoyage
			this.events.un( { "featureadded" : get_conteneur } ); // pour ne pas boucler, on deactive le listener

			maj_carte(poly_conteneur); // le gros du boulot
	} 
	polys.events.register( "featureadded", polys , get_conteneur );

	polys.setVisibility(true); //genere la requete, qui ira chercher le conteneur
	polys.refresh({force: true});

}


function maj_carte ( ) {
	// MAJ des filtres avec le conteneur
	var filtre_cql = new OpenLayers.Format.CQL() ; 
	//console.log( poly_conteneur );

	var masque = map.getLayersByName('Masque')[0] ;
	masque.removeAllFeatures();

	// Le filtre conteneur s'applique a TOUS les layers
	var filtre_conteneur = conditions(masque) ;
	//console.log(filtre_conteneur);
	if ( filtre_conteneur ) {	// dessine le masque
		masque.addFeatures( inverse_polygone(poly_conteneur) );
		masque.refresh({force: true});
	}

	// parcours des layers pour definir leurs filtres specifiques (layer poly, layer point ...)
	var layers = map.getLayersByName(/WRI$/) ;
	for ( i in layers ) {
		var layer = layers[i];

		var filtre_layer = conditions(layer) ;
console.log(filtre_layer);
		//Si le filtre du layer existe, ET le filtre du conteneur aussi, faut faire un AND
		if( filtre_layer && filtre_conteneur) {
			var filtre_final = new OpenLayers.Filter.Logical({
							type: OpenLayers.Filter.Logical.AND,
							filters : [ filtre_conteneur,
										filtre_layer ]
							});
		} else { // seulement 1 des 2 filtres existe, ou ""
			var filtre_final = filtre_layer || filtre_conteneur || "" ; 
		}
		//enfin on colle le filtre au layer
		layer.filter = filtre_final ;
		
		layer.setVisibility (true) ; 
		layer.refresh({force: true});
	}
}

// retourne un filtre OL, adapte au layer en parametre, grace a des infos en DUR
// FIXME detecter si ca change ou pas
function conditions ( layer ) {

	switch( layer.name ) {
		case 'PointsWRI':
			var checkbox = "id_point_type[]" ; break;
		case 'PolygonesWRI':
			var checkbox = "id_polygone_type[]";
			var pre_filtre = "id_polygone <> " + poly_conteneur.attributes.id_polygone ; break;
		case 'Masque':
			var checkbox = "id_poly";
			if ( document.getElementsByName(checkbox) && document.getElementsByName(checkbox)[0].checked ) {
				var filtre_cql = new OpenLayers.Format.CQL() ; 
				return filtre_cql.read( 'INTERSECTS ( geom , ' + poly_conteneur.geometry + ')') ;
			}
		default:
			return false; break; // layer inconnu
	}

	var conditions = [];
	//FILTRE FORMAT CQL, plus intuitif
	var filtre_cql = new OpenLayers.Format.CQL();
	var filtre_wfs = new OpenLayers.Filter() ;
	var filtre_tab = [];   // tableau des conditions

	if ( document.getElementsByName(checkbox)) {
		var tabcases = document.getElementsByName(checkbox) ;

		// on recupere le nom de la property EN VIRANT LES 2 DERNIERS CARACTERE qui sont [] dans le cas des checkbox:
		var property = checkbox.slice(0,-2); // c'est crade, ca fait : id_polygones_type

		// si la case est checked, remplit le filtre avec la condition 
		for(var i=0;i<tabcases.length;i++) {
			if(tabcases[i].checked) {
				filtre_tab.push( property + ' = ' + tabcases[i].value);
			}
		}
		// FIXME, c'est tout crado
		// construit le filtre, seulement si il n'est pas vide
		if ( filtre_tab.length > 0 ) {
			if ( pre_filtre ) {
				var f = '(' + filtre_tab.join(' OR ') + ') AND ' + pre_filtre ;
			} else {
				var f = filtre_tab.join(' OR ') ; 
			}
			filtre_wfs = filtre_cql.read( f ); //le tableau est convertit en un gros OR
		} else {
			// le filtre est vide, il faut ne afficher rien du tout. normalement il devrait prendre EXCLUDE mais c'est pas trop grave
			filtre_wfs = filtre_cql.read( property + ' = 0' );
		}
		return filtre_wfs ;
	}
	
	// il n'y avait pas de checckbox. une carte vignette ou autre.
	return false;
}

//==================== DEBUT STYLE =================================
// style maison dans le fichier fait par Dominique refuges-info.sld (qq modifs apportees par yip)
function applique_styles(fichier_lu) {
	var format = new OpenLayers.Format.SLD();
    var sld = format.read(fichier_lu.responseXML || fichier_lu.responseText);
	for (var l in sld.namedLayers) { // 2 NamedLayer, "PointsWRI" et "PolysWRI"
		var styles = sld.namedLayers[l].userStyles, style; 
		console.log(sld); // styles= [ Default, hover, attribute=toto ] ...
		for (var i=0,j=styles.length; i<j; ++i) {
			style = styles[i];  // style = style par defaut, style = hover .....
			map.getLayersByName(l)[0].styleMap.styles[style.name] = style;
		}
	}
}

// fait un enorme poly avec un trou dedans de la taille du param
//FIXME, a l'arrach
function inverse_polygone ( mpoly ) {
	var terreentiere = new OpenLayers.Geometry.fromWKT('POLYGON((-100 -45, -100 70,100 70, 100 -45, -100 -45))');
//var terreentiere = new OpenLayers.Geometry.fromWKT('POLYGON((3 40, 3 48,7 48, 7 40, 3 40))');
//	console.log(poly);
	var t = new OpenLayers.Geometry.LinearRing(terreentiere.getVertices());
	var inners = [ t ] ;
	for (var c in mpoly.geometry.components) {
		inners.push( new OpenLayers.Geometry.LinearRing(mpoly.geometry.components[c].getVertices()) );
		//console.log(mpoly.geometry.components[c].getVertices);
	} 
	//console.log(inners);

	
	var polymasque = new OpenLayers.Geometry.Polygon(inners);
	var mpoly = new OpenLayers.Geometry.MultiPolygon(polymasque);
	//console.log(polymasque);
	var feat = new OpenLayers.Feature.Vector( mpoly );
//	console.log(feat);
	
	return feat;
}

// ================  DEBUT CLIC SOURIS ============================

function active_couche_cliquable() {

	// recupere TOUS les vectors pour leur attribuer des proprietes
	var vectors = map.getLayersByName(/WRI$/);

	// Seront clickable UNIQUEMENT les elements affiches les plus petits
	// FIXME sinon c'est le bordel . ou pas ?
	
	// ajout l'attribut hover highlight a tous les layers de type Vector (WFS)
	var featurehovered = new OpenLayers.Control.SelectFeature(vectors, {
							hover: true,
							highlightOnly: true,  // pour faire un hover SANS selectionner
//							overFeature: createPopup,
//							outFeature: destroyPopup
				}
            );
	map.addControl(featurehovered); featurehovered.activate();

	// ajout l'attribut clickable a tous les layers de type Vector (WFS), faut le faire apres l'Hover
	var featureclicked = new OpenLayers.Control.SelectFeature( vectors, {
						// ICI appel de la fonction qui reagit au click
						clickout: false,   // on garde les points deja cliques
						onSelect: function(feature){
										console.log(feature);
										if( feature.attributes.id_point ) {
											 //window.open(,"POI"); //FIXME 
											 alert("lien vers /point/" + feature.attributes.id_point + "/" + feature.attributes.nom);
										} else {
											// on continue a naviguer
											poly_conteneur = feature.clone() ; // stockage du conteneur
											map.zoomToExtent( poly_conteneur.geometry.getBounds() );
											maj_carte() ;
											// FIXME pas de retour arriere vers l'ancien conteneur
										}
								}
	});
	map.addControl(featureclicked); featureclicked.activate();
}
