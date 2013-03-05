<?php
/**********************************************************************************************
Visualition des commentaires comportant une demande de correction sur la fiche point
Accès par : "./gestion/?page=commentaires_attente_correction"
**********************************************************************************************/
require_once("fonctions_commentaires.php");

$conditions = new stdclass;
$conditions_attente_correction = new stdclass;

//vérification des autorisations
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{
  if ($_POST["corrections_faites"]!="")
  {
    foreach ($_POST['commentaires_corriges'] as $id_commentaire)
    {
      $commentaire=infos_commentaire($id_commentaire);
      $commentaire->demande_correction=0;
      $commentaire->qualite_supposee+=4;
      modification_ajout_commentaire($commentaire);
    }
  }
  
  $conditions_attente_correction->demande_correction=True;
  $conditions_attente_correction->avec_infos_point=True;
  $commentaires_attente_correction=infos_commentaires($conditions_attente_correction);
?>
	<h4>Zone de modération des commentaires sur les fiches</h4>
<?php
if ( count($commentaires_attente_correction)!=0 )
{
	print("
	<p>
	Cette liste donne les commentaires qui sont susceptibles d'apporter de l'information à la fiche selon un internaute ou qui sont peu ou pas intéressantes selon un internaute.
	</p>
	<p>
	<strong>
	Modérateurs, rappelez vous qu'il ne s'agit là que de l'avis d'internautes de passage, il est tout à fait possible qu'aucune modification ne soit nécessaire. 
	Et je constate bien souvent que les commentaires jugés \"non utiles\" sont en fait des commentaires qui ne plaisent pas à certains mais dont l'intérêt peut être réél
	</strong>
	</p>
<h4>Liste : (Cochez la case à droite retire le commentaire de la liste sans rien faire)</h4>
<p>Plus la \"qualité supposée\" est basse plus cela veut dire que d'internautes ont jugés le commentaire inutile
</p>
<p>
<strong>Pensez à bien les retirer de la liste une fois la correction faite</strong> 
</p>
");
print("<form method=\"post\" action=\"./?page=commentaires_attente_correction\">");
$premier=TRUE;
foreach ($commentaires_attente_correction as $commentaire_attente_correction)
{
  if ($commentaire_attente_correction->demande_correction==1)
  $cause="apporte peut-être de l'information";
  elseif ($commentaire_attente_correction->qualite_supposee<0)
  {
    $cause="n'a peut-être aucun intérêt selon un internaute (qualité supposée : $commentaire_attente_correction->qualite_supposee)";
    if ($premier)
    {
      $premier=FALSE;
      echo "<hr />";
    }
  }
  else
    $cause="";
  print("<a href=\"".lien_point_lent($commentaire_attente_correction->id_point)."#C$commentaire_attente_correction->id_commentaire\">
  Le commentaire de \"".bbcode2html($commentaire_attente_correction->auteur)."\" sur la fiche 
  $commentaire_attente_correction->nom</a> $cause
  <input type=\"checkbox\" name=\"commentaires_corriges[]\" value=\"$commentaire_attente_correction->id_commentaire\"><br />");
}

print("<input type=\"submit\" name=\"corrections_faites\" value=\"Retirer ceux que j'ai coché de la liste\">
</form>");
}
else
	print("<strong>La liste des commentaires à vérifier est vide</strong>");
}
?>