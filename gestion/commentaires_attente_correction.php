<?php
/**********************************************************************************************
Visualition des commentaires comportant une demande de correction sur la fiche point
Accès par : "./gestion/?page=commentaires_attente_correction"
**********************************************************************************************/

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
		$pdo->exec($query_correction_faite) or die ('erreur Update comment : '.$liste_commentaires_traites);
	}


	$query="SELECT *,commentaires.auteur AS auteur_commentaire 
			FROM commentaires NATURAL LEFT JOIN points 
			WHERE (demande_correction!=0 OR qualite_supposee<0)
			ORDER BY demande_correction DESC";
	$res = $pdo->query($query) ;

	?>
	<h4>Zone de modération des commentaires sur les fiches</h4>
<?php
if ( $commentaires_attente_correction = $res->fetch() )
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
	//PDO+ on fait un do while car le NUMROWS ne fonctionne pas en PDO ...
	do
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
	} while( $commentaires_attente_correction = $res->fetch() ) ;
	
	print("<input type=\"submit\" name=\"corrections_faites\" value=\"Retirer ceux que j'ai coché de la liste\">
		</form>");
}
else
	print("<strong>La liste des commentaires à vérifier est vide</strong>");
}
?>