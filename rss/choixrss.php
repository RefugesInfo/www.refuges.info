<?php
/**********************************************************************************************
Page de choix du flux rss
06/12/2012 ça ne marche plus ;-(
**********************************************************************************************/

require_once ('../modeles/config.php');
require_once ($config['chemin_modeles']."fonctions_bdd.php");
require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
$modele->titre="Formulaire de choix du flux rss de refuges.info";
$modele->description = $description;
include ($config['chemin_vues']."_entete.html");
?>

<form id='urss' method='get' action='rss.php'>

<script type='text/javascript'>
var urssform = document.getElementById('urss');
</script>

 <fieldset>
  <legend>Objets concernés</legend>
   <button type='button' onclick='
	for ( var i = 0; i<urssform.listeobjets_cb.length ; i++ )
	{
		urssform.listeobjets_cb[i].checked = true;
	}
   '>Tout cocher</button>
   <button type='button' onclick='
	for ( var i = 0; i < urssform.listeobjets_cb.length ; i++ )
	{
		urssform.listeobjets_cb[i].checked = false;
	}
   '>Tout décocher</button>
   <br />
   <?php
   	$q = "SELECT id_point_type, nom_type
		FROM point_type
		WHERE id_point_type>1
		ORDER BY id_point_type";
	$r = mysql_query($q) or die("erreur dans $q");
	
	print("\n<ul>");
	while ($ptype = mysql_fetch_array($r))
		print("\n  <li style='display: inline; display: inline-block; width: 13em; white-space: nowrap;'><label><input type='checkbox' name='listeobjets_cb' value='".$ptype['id_point_type']."' checked='checked' />".$ptype['nom_type']." &nbsp;</label></li>");
	print("\n</ul>");
   ?>
 </fieldset>

 <fieldset>
  <legend>Massifs concernés</legend>
   <button type='button' onclick='
	for ( var i = 0; i < urssform.listemassifs_cb.length ; i++ )
	{
		urssform.listemassifs_cb[i].checked = true;
	}
   '>Tout cocher</button>
   <button type='button' onclick='
	for ( var i = 0; i < urssform.listemassifs_cb.length ; i++ )
	{
		urssform.listemassifs_cb[i].checked = false;
	}
   '>Tout décocher</button>
   <br />
   <?php
   	$q = "SELECT id_polygone, nom_polygone
		FROM polygones
		WHERE id_polygone_type=1 order by nom_polygone";
	$r = mysql_query($q) or die("erreur dans $q");

	print("\n<ul>");
	while ($massif = mysql_fetch_array($r))
		print("\n  <li style='display: inline; display: inline-block; width: 13em; white-space: nowrap;'><label><input type='checkbox' name='listemassifs_cb' value='".$massif["id_polygone"]."' checked='checked' />".$massif["nom_polygone"]." &nbsp;</label></li>");
	print("\n</ul>");
   ?>
 </fieldset>

 <fieldset>
  <legend>Nombre de jours</legend>
   <label><input type='radio' name='jours' value='2' />2&nbsp;&nbsp;&nbsp;</label>
   <label><input type='radio' name='jours' value='5' checked='checked' />5&nbsp;&nbsp;&nbsp;</label>
   <label><input type='radio' name='jours' value='10' />10&nbsp;&nbsp;&nbsp;</label>
 </fieldset>

<fieldset><legend>Obtenir le lien</legend>
 <input type='hidden' name='listeobjets' value='' />
 <input type='hidden' name='listemassifs' value='' />
 <input type='submit' value='Creer mon flux RSS' onclick="
	urssform.listeobjets.value = '0' ;
	urssform.listemassifs.value = '0' ;
	for ( var i = 0; i < urssform.listeobjets_cb.length ; i++ )
	{
		if (urssform.listeobjets_cb[i].checked == true) {
			urssform.listeobjets.value += '-' ;
			urssform.listeobjets.value += urssform.listeobjets_cb[i].value ;
		}
		urssform.listeobjets_cb[i].checked = false;
	}
	for ( var i = 0; i < urssform.listemassifs_cb.length ; i++ )
	{
		if (urssform.listemassifs_cb[i].checked == true) {
			urssform.listemassifs.value += '-' ;
			urssform.listemassifs.value += urssform.listemassifs_cb[i].value ;
		}
		urssform.listemassifs_cb[i].checked = false;
	}
 " />
</fieldset>
</form>

<?php
include ($config['chemin_vues']."_pied.html");
?>
