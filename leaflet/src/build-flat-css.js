/*
 * Copyright (c) 2016 Dominique Cavailhez
 * Fixe un bug de reconnaissance de path si les images de leaflet.css sont regroupées
 * (cas du répertoire dist/...)
 */

L.Icon.Default.imagePath=L.Icon.Default.imagePath.replace(/(dist\/src|dist|src)/g,"github.com/Leaflet/Leaflet/dist");