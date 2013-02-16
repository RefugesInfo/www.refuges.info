<?php
//vérification des autorisations
// 02/13 jmb  PDO
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{

?>
	<p>
	Ci jointe la liste des modèles existants pour les différents points de la base
	</p>
<?php
$query_modeles="SELECT * FROM points NATURAL JOIN point_type
			WHERE
				modele=1
			ORDER BY importance DESC";
print("<ul>");
//PDO-
//$r_users=mysql_query($query_modeles);
//while ($mod=mysql_fetch_object($r_users))
//PDO+
$r_users = $pdo->query($query_modeles);
while ($mod = $r_users->fetch())
{
	print("\t<li><a href=\"/point_formulaire_modification.php?id_point=$mod->id_point\"> $mod->nom_type</a>");
	print("</li>\n");
}
?>
</ul>
<?php
}
?>