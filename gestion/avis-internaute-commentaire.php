<?php
/**********************************************************************************************
Permettre à n'importe qui d'indiquer qu'un commentaire à pas, peu, un peu, ou beaucoup d'intérêt, 
J'avais imaginé un système sophistiqué de scoring mais en fait c'est très peu utilisé, là ou
c'est utile, c'est que si un internaute trouve un commentaire inutile ça l'indique à un modérateur
**********************************************************************************************/
// FIXME : à passer en MVC
require_once ("../modeles/config.php");
require_once ("fonctions_autoconnexion.php");
require_once ("fonctions_mode_emploi.php");
require_once ("fonctions_bdd.php");

$modele = new stdclass;
$modele->description = $description;
include ($config['chemin_vues']."_entete.html");

print('<div class="contenu">');

$commentaire=infos_commentaire($_GET['id_commentaire']);

/**************************** l'action  ******************************/
if ($_POST['valider']!="")
{
  if ($_POST['anti_robot']=="f")
  {
    $commentaire->qualite_supposee+=$_POST['score'];
    if ($_POST['score']>1)
      $commentaire->demande_correction=1;
    modification_ajout_commentaire($commentaire);
    print('<p>
    Merci pour votre aide au classement
    </p>');
  }
else
	print("<p>Ouups ? la lettre anti_robot n'est pas la bonne</p>");
print('
<p>
Vous pouvez retourner sur <a href="'.lien_point_fast($commentaire).'">la fiche de '.$commentaire->nom.'</a>
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
		<li>Finalement, je n\'en pense rien, je retourne sur <a href="'.lien_point_fast($commentaire).'">la fiche de '.$commentaire->nom.'</a></li>
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
