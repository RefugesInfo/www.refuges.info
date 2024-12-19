<?php 


require   ('../../../includes/config.php');
// On est pas là pour les perfs, alors on inclus tout pour être tranquille !
require_once ("bdd.php");
require_once ("commentaire.php");
require_once ("point.php");
require_once ("utilisateur.php");
require_once ("polygone.php");
require_once ("meta_donnee.php");
require_once ("xml.class.php");
require_once ("nouvelle.php");
require_once ("mise_en_forme_texte.php");
require_once ("upload_max_filesize.php");

$csv_source='336,https://www.refuges.info/point/336,Bivouac des Périades,6.9599694,45.8745479,30.27222655,"http://www.mountainhuts.ch/map?hutid=REF,336&hut2id=OSM,node/4108317586&basemap=imagery"
5228,https://www.refuges.info/point/5228,Cabanes du Mont,6.5902944,44.0975171,31.39454889,"http://www.mountainhuts.ch/map?hutid=REF,5228&hut2id=OSM,way/196640896&basemap=imagery"
5063,https://www.refuges.info/point/5063,Cabane de Cayalatte,-0.6008418,42.8835319,31.51298939,"http://www.mountainhuts.ch/map?hutid=REF,5063&hut2id=OSM,way/847403993&basemap=imagery"
5129,https://www.refuges.info/point/5129,Cabanes de Beyrède,0.3113217,42.9613571,32.67281745,"http://www.mountainhuts.ch/map?hutid=REF,5129&hut2id=OSM,way/229164842&basemap=imagery"
7912,https://www.refuges.info/point/7912,Bivacco Giorgio Casalegno,6.9618004,44.855205,34.46058038,"http://www.mountainhuts.ch/map?hutid=REF,7912&hut2id=OSM,way/240342613&basemap=imagery"
5144,https://www.refuges.info/point/5144,Abri de la Crête de Martinat,6.5961187,44.6322017,35.1983778,"http://www.mountainhuts.ch/map?hutid=REF,5144&hut2id=OSM,way/169262197&basemap=imagery"
1418,https://www.refuges.info/point/1418,Cabane de Malentraz,6.0490666,44.8374874,35.42235452,"http://www.mountainhuts.ch/map?hutid=REF,1418&hut2id=OSM,way/71865182&basemap=imagery"
2827,https://www.refuges.info/point/2827,Bergerie des Ayes,5.5992523,44.7963214,35.56588956,"http://www.mountainhuts.ch/map?hutid=REF,2827&hut2id=OSM,way/422101694&basemap=imagery"
9827,https://www.refuges.info/point/9827,Cabane Allix,6.8086028,44.5595138,36.08078159,"http://www.mountainhuts.ch/map?hutid=REF,9827&hut2id=OSM,way/1302528020&basemap=imagery"
8,https://www.refuges.info/point/8,Abri forestier de Pré Long,5.9185361,45.204209,36.54917373,"http://www.mountainhuts.ch/map?hutid=REF,8&hut2id=OSM,way/63161276&basemap=imagery"
6948,https://www.refuges.info/point/6948,Baraque des Gardes,2.8200044,43.5453327,37.74289999,"http://www.mountainhuts.ch/map?hutid=REF,6948&hut2id=OSM,way/445551364&basemap=imagery"
8104,https://www.refuges.info/point/8104,Toue de Larribet,-0.2846398,42.865672,38.10722241,"http://www.mountainhuts.ch/map?hutid=REF,8104&hut2id=OSM,node/963811050&basemap=imagery"
5624,https://www.refuges.info/point/5624,Gite de Couflens Salau,1.1882977,42.7569525,39.06936652,"http://www.mountainhuts.ch/map?hutid=REF,5624&hut2id=OSM,node/7936150115&basemap=imagery"
8127,https://www.refuges.info/point/8127,Cabane d\'Ourrec,0.0534984,42.9454197,39.44092418,"http://www.mountainhuts.ch/map?hutid=REF,8127&hut2id=OSM,node/963810590&basemap=imagery"
5470,https://www.refuges.info/point/5470,Breslauer Hütte,10.8793002,46.8681837,40.0531809,"http://www.mountainhuts.ch/map?hutid=REF,5470&hut2id=OSM,way/86299919&basemap=imagery"
8730,https://www.refuges.info/point/8730,Jagdhütte Elenberg,7.9985349,47.536724,40.1813402,"http://www.mountainhuts.ch/map?hutid=REF,8730&hut2id=OSM,way/57826672&basemap=imagery"
78,https://www.refuges.info/point/78,Cabane de Ménil,5.4462007,44.7617302,40.29547493,"http://www.mountainhuts.ch/map?hutid=REF,78&hut2id=OSM,way/1012311223&basemap=imagery"
2210,https://www.refuges.info/point/2210,Rothornhütte,7.6972872,46.0481738,40.47595335,"http://www.mountainhuts.ch/map?hutid=REF,2210&hut2id=OSM,way/1294080584&basemap=imagery"
4755,https://www.refuges.info/point/4755,Bergerie de Galghello,9.0591839,42.4025014,41.40545495,"http://www.mountainhuts.ch/map?hutid=REF,4755&hut2id=OSM,way/671384037&basemap=imagery"
574,https://www.refuges.info/point/574,Baraque Forestière de Sous Courtet,5.807279,44.7625698,42.2081793,"http://www.mountainhuts.ch/map?hutid=REF,574&hut2id=OSM,way/538595626&basemap=imagery"
3765,https://www.refuges.info/point/3765,Gîte auberge de la vallée de l\'eau rousse,6.4551245,45.5221775,42.78977682,"http://www.mountainhuts.ch/map?hutid=REF,3765&hut2id=OSM,way/199827985&basemap=imagery"
7634,https://www.refuges.info/point/7634,Cabane de Mille,6.2506521,45.5386077,42.78991704,"http://www.mountainhuts.ch/map?hutid=REF,7634&hut2id=OSM,node/11123428710&basemap=imagery"
5407,https://www.refuges.info/point/5407,Cabane de Peyregrand,1.5699355,42.6714018,44.89671369,"http://www.mountainhuts.ch/map?hutid=REF,5407&hut2id=OSM,way/852336594&basemap=imagery"
3246,https://www.refuges.info/point/3246,Le Rocher Rond,5.8641215,44.691934,44.94421542,"http://www.mountainhuts.ch/map?hutid=REF,3246&hut2id=OSM,way/181917813&basemap=imagery"
2414,https://www.refuges.info/point/2414,Oberaarjochhütte,8.1730617,46.5260682,45.54471759,"http://www.mountainhuts.ch/map?hutid=REF,2414&hut2id=OSM,node/10101322757&basemap=imagery"
7263,https://www.refuges.info/point/7263,Cabane de Stor Aften,6.4015947,45.8830824,46.26444099,"http://www.mountainhuts.ch/map?hutid=REF,7263&hut2id=OSM,way/1199441459&basemap=imagery"
239,https://www.refuges.info/point/239,Refuge de Leschaux,6.9809674,45.8948564,46.65701662,"http://www.mountainhuts.ch/map?hutid=REF,239&hut2id=OSM,way/97321426&basemap=imagery"
1655,https://www.refuges.info/point/1655,Abri du Moucherotte,5.637664,45.1487586,47.23832766,"http://www.mountainhuts.ch/map?hutid=REF,1655&hut2id=OSM,way/134897427&basemap=imagery"
6939,https://www.refuges.info/point/6939,Cabane de la Vierge,0.0994473,42.7301291,47.29419626,"http://www.mountainhuts.ch/map?hutid=REF,6939&hut2id=OSM,way/179776895&basemap=imagery"
1435,https://www.refuges.info/point/1435,Refuge de la Vogealle,6.8376408,46.1125981,47.50455241,"http://www.mountainhuts.ch/map?hutid=REF,1435&hut2id=OSM,way/301152836&basemap=imagery"
5552,https://www.refuges.info/point/5552,Rifugio Fontana Mura,7.1871536,45.0181713,48.28174086,"http://www.mountainhuts.ch/map?hutid=REF,5552&hut2id=OSM,way/67398403&basemap=imagery"
5761,https://www.refuges.info/point/5761,Abri de Saint-Jean du Désert,6.7248237,43.9295326,51.74943961,"http://www.mountainhuts.ch/map?hutid=REF,5761&hut2id=OSM,node/8716701639&basemap=imagery"
1031,https://www.refuges.info/point/1031,Auberge de Combeau,5.5665312,44.765568,53.31542366,"http://www.mountainhuts.ch/map?hutid=REF,1031&hut2id=OSM,node/6767063263&basemap=imagery"
4771,https://www.refuges.info/point/4771,Abri de berger d\'Alfred Wills,6.8008285,45.9993544,54.67994239,"http://www.mountainhuts.ch/map?hutid=REF,4771&hut2id=OSM,way/586078026&basemap=imagery"
5678,https://www.refuges.info/point/5678,Refuge des Roncis,6.8645461,47.9597033,55.74553076,"http://www.mountainhuts.ch/map?hutid=REF,5678&hut2id=OSM,way/745384463&basemap=imagery"
3515,https://www.refuges.info/point/3515,Abri du Pla del Bouc,2.0600784,42.55537,56.27704328,"http://www.mountainhuts.ch/map?hutid=REF,3515&hut2id=OSM,way/864933562&basemap=imagery"
2404,https://www.refuges.info/point/2404,Refuge le Repoju,6.7020332,45.3479023,57.59544513,"http://www.mountainhuts.ch/map?hutid=REF,2404&hut2id=OSM,way/47801203&basemap=imagery"
4707,https://www.refuges.info/point/4707,Chalet de la Roulotte,6.6432788,47.9613948,61.12188479,"http://www.mountainhuts.ch/map?hutid=REF,4707&hut2id=OSM,way/865435232&basemap=imagery"
3216,https://www.refuges.info/point/3216,Refuge de Basse Rua,6.718049,44.6237332,61.14468415,"http://www.mountainhuts.ch/map?hutid=REF,3216&hut2id=OSM,way/57721313&basemap=imagery"
3943,https://www.refuges.info/point/3943,Refuge de l\'étang Fourcat,1.4897575,42.6650113,61.5306379,"http://www.mountainhuts.ch/map?hutid=REF,3943&hut2id=OSM,way/127287254&basemap=imagery"
4569,https://www.refuges.info/point/4569,Cabane du Plan du Vallon,6.7136278,44.753465,62.22329467,"http://www.mountainhuts.ch/map?hutid=REF,4569&hut2id=OSM,way/72558945&basemap=imagery"
1165,https://www.refuges.info/point/1165,Refuge de Vallonpierre,6.289182,44.7984912,62.75041354,"http://www.mountainhuts.ch/map?hutid=REF,1165&hut2id=OSM,way/403948036&basemap=imagery"
6231,https://www.refuges.info/point/6231,Grange du Leuzeu,4.8915436,47.2758789,64.24065457,"http://www.mountainhuts.ch/map?hutid=REF,6231&hut2id=OSM,way/183047614&basemap=imagery"
1293,https://www.refuges.info/point/1293,Cabane des Chalances,6.7412532,44.6160668,66.03729855,"http://www.mountainhuts.ch/map?hutid=REF,1293&hut2id=OSM,way/70575522&basemap=imagery"
5496,https://www.refuges.info/point/5496,Refuge de la Croix de Fresse,6.8425216,47.8904059,66.88433075,"http://www.mountainhuts.ch/map?hutid=REF,5496&hut2id=OSM,node/2145047655&basemap=imagery"
2980,https://www.refuges.info/point/2980,Wildstrubelhütte,7.4676662,46.3830189,69.04300471,"http://www.mountainhuts.ch/map?hutid=REF,2980&hut2id=OSM,node/1456288909&basemap=imagery"
4135,https://www.refuges.info/point/4135,Cabane des Trois Forestiers,7.3546142,48.6259229,72.18642878,"http://www.mountainhuts.ch/map?hutid=REF,4135&hut2id=OSM,node/2716070010&basemap=imagery"
5632,https://www.refuges.info/point/5632,Cabane de Chabaud,6.5563365,44.1950982,80.35393519,"http://www.mountainhuts.ch/map?hutid=REF,5632&hut2id=OSM,way/196579338&basemap=imagery"
5789,https://www.refuges.info/point/5789,Abri d\'Anelle,6.8912509,44.2735774,81.56111635,"http://www.mountainhuts.ch/map?hutid=REF,5789&hut2id=OSM,way/291271201&basemap=imagery"
3414,https://www.refuges.info/point/3414,Cabane des Bûcherons,6.266554,45.9467349,86.63221168,"http://www.mountainhuts.ch/map?hutid=REF,3414&hut2id=OSM,node/2660467618&basemap=imagery"
7,https://www.refuges.info/point/7,Cabane du Fourneau,5.9241594,45.1864803,87.6871969,"http://www.mountainhuts.ch/map?hutid=REF,7&hut2id=OSM,way/1040918352&basemap=imagery"
7207,https://www.refuges.info/point/7207,Cabane de la Coumeda,0.9351239,42.8113067,88.67548139,"http://www.mountainhuts.ch/map?hutid=REF,7207&hut2id=OSM,way/838264054&basemap=imagery"
96,https://www.refuges.info/point/96,Baraque des Carriers,5.9058154,45.1633907,93.07307076,"http://www.mountainhuts.ch/map?hutid=REF,96&hut2id=OSM,way/626263317&basemap=imagery"
3919,https://www.refuges.info/point/3919,Le Cassu,6.944034,44.8193844,97.35334406,"http://www.mountainhuts.ch/map?hutid=REF,3919&hut2id=OSM,way/99548528&basemap=imagery"
6107,https://www.refuges.info/point/6107,Cabane d\'Aygues-Mortes,-0.3425263,43.0135999,111.0626319,"http://www.mountainhuts.ch/map?hutid=REF,6107&hut2id=OSM,way/847557831&basemap=imagery"
5526,https://www.refuges.info/point/5526,Chalet de la Conche,6.8721783,47.8638079,114.2319264,"http://www.mountainhuts.ch/map?hutid=REF,5526&hut2id=OSM,node/6375297810&basemap=imagery"
5623,https://www.refuges.info/point/5623,Abri pastoral de Pouilh,1.1515107,42.7436254,116.7501456,"http://www.mountainhuts.ch/map?hutid=REF,5623&hut2id=OSM,way/850488170&basemap=imagery"
419,https://www.refuges.info/point/419,Refuge de Bise,6.7658932,46.3305532,138.4723972,"http://www.mountainhuts.ch/map?hutid=REF,419&hut2id=OSM,way/66914025&basemap=imagery"
2605,https://www.refuges.info/point/2605,Chalet des Trois Moineaux,5.6471128,45.202788,138.7721817,"http://www.mountainhuts.ch/map?hutid=REF,2605&hut2id=OSM,way/810695600&basemap=imagery"
6165,https://www.refuges.info/point/6165,Cabane de l\'Artigue de Sesques,-0.47935,42.9272179,190.4342514,"http://www.mountainhuts.ch/map?hutid=REF,6165&hut2id=OSM,way/446520385&basemap=imagery"
2463,https://www.refuges.info/point/2463,Cabane de Balavaux,7.2779515,46.1554647,357.9889431,"http://www.mountainhuts.ch/map?hutid=REF,2463&hut2id=OSM,node/11136343328&basemap=imagery"
5630,https://www.refuges.info/point/5630,Cabane de Cruzous,1.2424205,42.7360508,363.9531588,"http://www.mountainhuts.ch/map?hutid=REF,5630&hut2id=OSM,way/825885867&basemap=imagery"
';

// juste pour tester sur une seule ligne :
//$csv_source='336,https://www.refuges.info/point/336,Bivouac des Périades,6.9599694,45.8745479,30.27222655,"http://www.mountainhuts.ch/map?hutid=REF,336&hut2id=OSM,node/4108317586&basemap=imagery"';

$stream = fopen('php://memory', 'r+');
fwrite($stream, $csv_source);
rewind($stream);

while (($infos_point_a_modifier = fgetcsv($stream, 1000, ",")) !== FALSE)
{
  //print($infos_point_a_modifier[0].$infos_point_a_modifier[4].$infos_point_a_modifier[5]."<br>");
  $nouveau_point=infos_point($infos_point_a_modifier[0]);
  if (isset($nouveau_point->erreur))
    print("Erreur pour mettre à jour le point numéro ".$infos_point_a_modifier[0].". Impossible de le récupérer et l'erreur retournée est :  ".$nouveau_point->message."<br>");
  else
  {
    $nouveau_point->geojson='{"type":"Point","coordinates":['.$infos_point_a_modifier[3].','.$infos_point_a_modifier[4].']}';
    
    $erreur=modification_ajout_point($nouveau_point,3);
    if (isset($erreur->erreur))
      print("Erreur pour mettre à jour le point numéro ".$infos_point_a_modifier[0].". Rien a été fait, car l'erreur retournée est :  ".$erreur->message."<br>");
    else
      print("Coordonnées du point ".$infos_point_a_modifier[0]." mise à jour pour ".$nouveau_point->geojson."<br>");
  }
}
