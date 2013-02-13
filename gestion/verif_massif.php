<?php
/**********************************************************************************************
Ne marche plus depuis bien longtemps
**********************************************************************************************/

die("Cette fonction ne marche plus, à réparer... éventuellement");
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{
 include("../modeles/fonctions_polygones.php");


 $err = false;

 $query_massifs="SELECT *
        FROM polygone_type,polygones
        WHERE polygone_type.poly_ouvert=0
	AND polygone_type.id_polygone_type=polygones.id_polygone_type
        AND polygones.id_polygone!='1'
	AND polygones.id_polygone_type=".$config['id_massif'];
//$query_massifs="SELECT * fROM polygones where id_polygone=4";
 $resultat_liste_massifs=mysql_query($query_massifs);

 $nb_massifs=mysql_num_rows($resultat_liste_massifs);

 print("<p>Vérification de la cohérence des massifs : $nb_massifs massifs à considérer</p>");
print("<p>On cherche les points des sommets de massif qui serait inclus dans un autre massif, 
ce qui veut dire qu'il y a incertitude si un point se trouvait dans la surface d'intersection des deux.
Désormais, un sommet de polygone peut être commun à plusieurs polygones</p>");
$nb_erreur=0;
 while($massif=mysql_fetch_object($resultat_liste_massifs))
 {  //boucle sur chaque massif
    $resultat_test=tableau_polygone($massif->id_polygone);

    if ($resultat_test==NULL)
        print("<strong>Erreur : le Massif  ($massif->id_polygone) $massif->article_partitif $massif->nom_polygone a un nombre impaire de coordonnées ou sans coordonnées</strong>");
    else 
    {

        $query_autres_massifs="SELECT *
        FROM polygone_type LEFT JOIN polygones
        ON polygone_type.id_polygone_type=polygones.id_polygone_type
        WHERE polygones.id_polygone!=$massif->id_polygone
        AND polygone_type.id_polygone_type=".$config['id_massif'];

        $res=mysql_query($query_autres_massifs);
        while($massif_autre=mysql_fetch_object($res))
	{//balayer l'ensemble des massifs sauf le massif courant
         $resultat_autre_massif=tableau_polygone($massif_autre->id_polygone);
		if ($resultat_autre_massif!=NULL)
		{
		foreach($resultat_test as $point)
		{
			// Nouvelle fonctionnalité qui évite de donner une alerte si le point à l'étude
			// est confondu avec un des sommets du massif à l'étude 
			$point_confondu=FALSE;
			foreach ( $resultat_autre_massif as $point_massif )
			{

				if ($point_massif->x==$point->x AND $point_massif->y==$point->y)
					$point_confondu=TRUE;

			}
		if (!$point_confondu)
		{
			if (is_point_dans_massif($point->x,$point->y,$resultat_autre_massif))
			{
				print("<strong>le point ($point->x,$point->y) de '$massif->nom_polygone' est inclus dans le massif : '$massif_autre->nom_polygone'</strong><br />");
				$err=TRUE;
				$nb_erreur++;
			}
		}
		}
		}
	}//end while

        mysql_free_result($res );

    }//end else
 }//end while

 mysql_free_result($resultat_liste_massifs );

 print("<br>Fin des tests : $nb_erreur erreurs trouvées.<br>");
}
?>