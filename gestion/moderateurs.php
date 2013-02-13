<?php
//vérification des autorisations
if ( (AUTH ==1) )
{

// changement du niveau d'un utilisateur
if ($_POST['change']!="" AND ($_SESSION['niveau_moderation']>=3))
{
// on donne son droit à l'utilisateur
$query_update="update phpbb_users 
		set user_level=".$_POST["user_level"]." 
		WHERE user_id=".$_POST['id_user_phpbb'];
mysql_query($query_update);

// on l'ajoute au groupe 196, groupe des modérateurs
$query_deja="SELECT * FROM phpbb_user_group WHERE group_id=196 AND user_id=".$_POST['id_user_phpbb'];
$res=mysql_query($query_deja);
if (mysql_num_rows($res)==0 && $_POST["user_level"]==2)
	mysql_query("INSERT into phpbb_user_group set user_pending=0,group_id=196,user_id=".$_POST['id_user_phpbb']);

if (mysql_num_rows($res)==1 && $_POST["user_level"]==0)
	mysql_query("DELETE FROM phpbb_user_group WHERE group_id=196 AND user_id=".$_POST['id_user_phpbb']);

}
if ($_SESSION['niveau_moderation']>=3)
{
?>
	<p>
	Ce formulaire permet de changer les droits de modération d'un utilisateur du forum.
	</p>
	<p>Au choix :
		<ul>
			<li>Utilisateur normal = il redevient un utilisateur normal</li>
			<li>Modérateur = il peut modérer les commentaires/les fiches points/le forum</li>
			<li>Admin = pareil que modérateur + ce menu + accès admin du forum</li>
		</ul>
	</p>
	<form action="./?page=moderateurs" method="post">
	Transfomer cet utilisateur :
	<select name="id_user_phpbb">
		<?php
		$query_users="SELECT user_id,username FROM phpbb_users ORDER BY username";
		$r_users=mysql_query($query_users);
		while ($usersphpbb=mysql_fetch_object($r_users))
		{
		print("\t<option value=\"$usersphpbb->user_id\">$usersphpbb->username (id=$usersphpbb->user_id)</option>\n");
		}
		?>
		</select>
	en :
	<select name="user_level">
		<option value="0">Utilisateur normal</option>
		<option value="2">Modérateur</option>	
		<option value="1">Admin</option>	
	</select>
	<input type="submit" name="change" value="Go !!" />
	</form>

<?php } ?>
<h3>Liste des utilisateurs étant mieux que "normaux": (<a href="http://www.refuges.info/forum/groupcp.php?g=196">même liste que ici</a>)</h3>
<ul>
<?php
$query_users="SELECT user_level,username,user_id
			FROM phpbb_users
			WHERE
			user_level!=0
			ORDER BY user_level";
$r_users=mysql_query($query_users);
while ($moderateur=mysql_fetch_object($r_users))
{
print("\t<li>$moderateur->username -- ");

switch ($moderateur->user_level)
{
	case "2":print(" (Modérateur) ");break;
	case "1":print(" (Admin) ");break;
}
print("</li>\n");
}
?>
</ul>
<?php
}
?>