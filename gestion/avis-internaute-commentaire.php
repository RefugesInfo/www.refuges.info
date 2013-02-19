<?php
/**********************************************************************************************
Permettre à n'importe qui d'indiquer qu'un commentaire à pas, peu, un peu, ou beaucoup d'intérêt, 
J'avais imaginé un système sophistiqué de scoring mais en fait c'est très peu utilisé, là ou
c'est utile, c'est que si un internaute trouve un commentaire inutile ça l'indique à un modérateur
**********************************************************************************************/
// 15/02/13 jmb : PDO


require_once ($config['chemin_modeles']."fonctions_autoconnexion.php");
require_once ($config['chemin_modeles']."fonctions_mode_emploi.php");
require_once ($config['chemin_modeles']."fonctions_bdd.php");

$modele->description = $description;
include ($config['chemin_vues']."_entete.html");

print('<div class="contenu">');

//PDO-
//$query_commentaire="SELECT * FROM commentaires WHERE id_commentaire=".$_GET['id_commentaire'];
//$res=mysql_query($query_commentaire);
//$commentaire=mysql_fetch_object($res);
//PDO+  ya une fonction prepared pour ca
$pdo->requetes->infos_comment->bindValues('comment', $_GET['id_commentaire'] , PDO::PARAM_INT );
$pdo->requetes->infos_comment->execute() or die ('comment inexistant:'.$_GET['id_commentaire']);
$commentaire = $pdo->requetes->infos_comment->fetch();

$point=infos_point($commentaire->id_point);

/**************************** l'action  ******************************/
if ($_POST['valider']!="")
{
if ($_POST['anti_robot']=="f")
{
if ($_POST['score']!="")
{
	if ($_POST['score']==2)
		$en_plus=",demande_correction=1";
	//PDO-
	//$query="UPDATE commentaires SET qualite_supposee=(qualite_supposee+($_POST[score]))$en_plus where id_commentaire=".$_GET['id_commentaire'];
	//mysql_query($query);
	//PDO+
	$pdo->exec($query) or die ('update comment echec pour id :'.$_GET['id_commentaire']);
	print('<p>
	Merci pour votre aide au classement
	</p>');
}
}
else
	print("<p>Ouups ? la lettre anti_robot n'est pas la bonne</p>");
print('
<p>
Vous pouvez retourner sur <a href="'.lien_point_fast($point).'">la fiche de '.$point->nom.'</a>
</p>

');
}
/**************************** le formulaire  ******************************/
else
{
print('<h4>Merci de nous aider dans notre tâche de classement des commentaires utiles ou pas utiles.</h4>
<p>
Que pensez vous du commentaire suivant : (votre avis sera étudié par un modérateur qui prendra sa décision)
</p>
<p>
'.bbcode2html("[quote]$commentaire->texte)[/quote]").'

</p>
<p>
	<form method="post" action="./avis-internaute-commentaire.php?id_commentaire='.$_GET['id_commentaire'].'">
	<ul>
		<li><input type="radio" name="score" value="2" />Très utile : ses informations devraient être rajoutées dans la fiche en haut !</li>
		<li><input type="radio" name="score" value="1" />Utile : Il est bien là où il est, ça rajoute quelque chose</li>
		<li><input type="radio" name="score" value="-1" />Peu utile : Il est subjectif du style "Il est bien, pas bien, etc." autant le mettre ailleurs ou il fait doublons avec un autre</li>
		<li><input type="radio" name="score" value="-2" />Pas utile du tout : Il n\'a rien a voir avec le point dont il parle (photos de fleurs, chamois, copains entre eux,...)</li>
		<li>Finalement, je n\'en pense rien, je retourne sur <a href="'.lien_point_fast($point).'">la fiche de '.$point->nom.'</a></li>
		<br />
		<li>Contre les robots merci d\'écrire la lettre f ici :<input type="text" name="anti_robot" /></li>
	</ul>
	<input type="submit" name="valider" value="Valider mon avis" />
	</form>
</p>
<p>
Vous pouvez aussi en savoir un peu plus sur <a href="'.lien_mode_emploi("que_mettre").'">que mettre ou ne pas mettre sur '.$config['nom_hote'].'</a>
</p>




');
}

print("
</div>");
include ($config['chemin_vues']."_pied.html");
?>
