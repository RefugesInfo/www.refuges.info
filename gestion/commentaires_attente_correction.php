<?php
//**********************************************************************************************
//* Nom du module:         | commentaires_attente_correction.php                               *
//* Date :                 |                                                                   *
//* Créateur :             |                                                                   *
//* Rôle du module :       | Visualition des commentaires comportant une demande de correction *
//*                        | Sur la fiche point             .                                  *
//*                        | Accès par : "./gestion/?page=commentaires_attente_correction"     *
//*                        | Droits: modérateurs                                               *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//* 24/03/08 sly           | création initiale                                                 *
//* 04/10/08 sly           | traitement également des commentaires dont un internaute pense    *
//*                        | pense qu'il est sans intérêt                                      *
//**********************************************************************************************

require_once ($config['chemin_modeles']."fonctions_affichage_points.php");

//vérification des autorisations
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{
   if ($_POST["corrections_faites"]!="")
   {
	foreach ($_POST['commentaires_corriges'] as $id_commentaire)
		$liste_commentaires_traites.="$id_commentaire,";
	$liste_commentaires_traites=trim($liste_commentaires_traites,",");
	$query_correction_faite="UPDATE commentaires set demande_correction=0,qualite_supposee=(qualite_supposee+4)
				WHERE id_commentaire IN ($liste_commentaires_traites)";
	mysql_query($query_correction_faite);
   }


$query="select *,commentaires.auteur as auteur_commentaire from commentaires,points 
		where points.id_point=commentaires.id_point 
		and (demande_correction!=0 OR qualite_supposee<0) ORDER BY demande_correction DESC";
$res=mysql_query($query);
?>
	<h4>Zone de modération des commentaires sur les fiches</h4>
<?php
if (mysql_num_rows($res)!=0)
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
	while($commentaires_attente_correction=mysql_fetch_object($res))
	{
		if ($commentaires_attente_correction->demande_correction==1)
			$cause="apporte peut-être de l'information";
		elseif ($commentaires_attente_correction->qualite_supposee<0)
		{
			$cause="n'a peut-être aucun intérêt selon un internaute (qualité supposée : $commentaires_attente_correction->qualite_supposee)";
			if ($premier)
				{$premier=FALSE;echo "<hr />";}
		}
		else
			$cause="";
		print("<a href=\"".lien_point_lent($commentaires_attente_correction->id_point)."#C$commentaires_attente_correction->id_commentaire\">
			Le commentaire de \"$commentaires_attente_correction->auteur_commentaire\" sur la fiche 
			$commentaires_attente_correction->nom</a> $cause
			<input type=\"checkbox\" name=\"commentaires_corriges[]\" value=\"$commentaires_attente_correction->id_commentaire\"><br />");
	}
	print("<input type=\"submit\" name=\"corrections_faites\" value=\"Retirer ceux que j'ai coché de la liste\">
		</form>");
}
else
	print("<strong>La liste des commentaires à vérifier est vide</strong>");
}
?>