<?php
// Script lié à la page d'acceuil
// Ce fichier ne doit contenir que du code javascript destiné à être inclus dans la page
// $vue contient les données passées par le fichier PHP

?>

// Crée la carte dés que la page est chargée
window.onload = function () {
    var map = new OpenLayers.Map ('accueil', {
        displayProjection: new OpenLayers.Projection ('EPSG:4326'), // Données en °
        controls: [
            new OpenLayers.Control.Navigation(),
            new OpenLayers.Control.Attribution()
        ],
        layers: [
            new OpenLayers.Layer.MRI ('Maps.Refuges.info')
        ]
    });
    
    // Positionne la carte sur la zone donnée par le .PHP
    var bornes = new OpenLayers.Bounds ( <?=$vue->bbox?> ) 
                .transform (map.displayProjection, map.getProjectionObject());

    map.setCenter (
        bornes.getCenterLonLat (),
        map.getZoomForExtent (bornes)
    );

    // Ajoute les couches vectorielles avec controle
    map.addLayers ([
        new OpenLayers.Layer.GMLSLD ('Massifs', {    
            urlGML: '/exportations/massifs-gml.php',
            projection: 'EPSG:4326', // Le GML est fourni en degminsec
            urlSLD: OpenLayers._getScriptLocation() + 'refuges-info-sld.xml',
            styleName: 'Massifs'
        })
    ]);
}
