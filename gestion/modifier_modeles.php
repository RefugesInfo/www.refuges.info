<?php
//vérification des autorisations
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{

?>
	<p>
	Ci jointe la liste des modèles existants pour les différents points de la base
	</p>
<?php
$query_modeles="SELECT * FROM points,point_type
			WHERE
			points.id_point_type=point_type.id_point_type
			AND
			modele=1
			ORDER BY importance DESC";
$r_users=mysql_query($query_modeles);
print("<ul>");
while ($mod=mysql_fetch_object($r_users))
{
print("\t<li><a href=\"/point_formulaire_modification.php?id_point=$mod->id_point\"> $mod->nom_type</a>");
print("</li>\n");

}
?>
</ul>
<?php
}
?>