Utilitaire destiné à guider l'installation ou l'upgrade des fichiers du forum<br/>
ou l'upgrade de la base de donnée du forum de refuges.info<br/>
<u>Prérequis</u> :<br/>
Les fichiers spécifiques refuges.info du GIT doivent déjà être installés<br/>
Une version de la base de donnée incluant le forum doit déjà être installée<br/><br/>
<style>
p { /* Etape OK */
	margin: 0;
	color: green;
}
div { /* Action */
	font-weight: bold;
}
strong { /* Erreur */
	display: block;
	color: red;
}
</style>

<?php
//=======================
/* FABRICATION DES ZIPS
phpBB-3.2.9_to_3.3.0_FR.zip
	Enlever /doc
	Ajouter les upgrades de langues SP IT GE
	enlever _FR du nom du zip
*/

//==================
// Fichier .htaccess
if (!file_exists('../.htaccess')) {
	echo '<div>Initialisation du fichier .htaccess</div>';
	copy ('../htaccess.modele.txt', '../.htaccess');
} else
	echo '<p>Fichier .htaccess présent</p>';

//==========================
// Fichier config_privee.php
if (!file_exists('../config_privee.php')) {
	echo '<div>Initialisation du fichier config_privee.php</div>';
	if (file_exists('../../config_privee.php')) {
		// On peut mettre un config_privee.php perso dans le répertoire en dessous de la racine du site
		echo '<div>Initialisation du fichier config_privee.php perso</div>';
		copy ('../../config_privee.php', '../config_privee.php');
	} else {
		echo '<div>Initialisation du fichier config_privee.php par défaut</div>';
		copy ('../config_privee.php.modele', '../config_privee.php');
	}
}
	echo '<p>Fichier config_privee.php présent</p>';
?>

<!--====================================-->
<br/>Mot de passe config_wri pour continuer
<form action="."  method="post">
  <input type="password" name="password" value="<?=isset($_POST['password'])?$_POST['password']:''?>">
  <input type="submit">
<?php
include ('../includes/config.php');
$config_wri['debug'] = false;
if ($_POST['password'] != $config_wri['mot_de_passe_pgsql']) {
	echo '<strong>Mot de passe incorrect</strong>';
	exit;
}
echo '<br/><br/>';

//=========================
// Connexion au serveur SQL
include ('../includes/bdd.php');
if (@$pdo->errorCode() === null) {
	echo '<strong>Les paramètres de config_privee.php ne permettent pas de se connecter à la base</strong>';
	exit;
}
echo '<p>Connexion à PGSQL OK</p>';

//========================================
// Installation de fichiers phpBB demandés
if (isset ($_GET['f'])) {
	if (!file_exists ("phpBB-{$_GET['f']}.zip")) {
		echo "<strong>Fichier phpBB-{$_GET['f']}.zip manquant</strong>";
		exit;
	}
	echo "<div>Décompression de phpBB-{$_GET['f']}.zip dans ".str_replace('install','forum',__DIR__)."/</div>\n";
	// Un peu de ménage
	system ('rm -r ../forum/adm');
	system ('rm -r ../forum/assets');
	system ('rm -r ../forum/cache');
	system ('rm -r ../forum/config');
	system ('rm -r ../forum/includes');
	system ('rm -r ../forum/language');
	system ('rm -r ../forum/phpbb');
	system ('rm -r ../forum/styles');
	system ('rm -r ../forum/vendor');
	// On affiche où on en est pendant le dézip
	ob_flush (); flush ();
	system ("unzip -oqd ../forum/ phpBB-{$_GET['f']}.zip");
	system ('rm -r ../forum/install');
	echo "<p>Fin de décompression.</p>\n";
}

//========================
// Etat des fichiers phpBB
if (file_exists ('../forum/includes/constants.php')) {
	define('IN_PHPBB', true);
	include ('../forum/includes/constants.php');
	$phpbb_version_fichiers = PHPBB_VERSION;
	echo "<p>Fichiers phpBB installés version $phpbb_version_fichiers</p>\n";
} else {
	$phpbb_version_fichiers = null;
	echo '<strong>Pas de fichiers phpBB instalés</strong>';
}

//======================
// Etat de la base phpBB
if (file_exists('../forum/config.php')) {
	include ('../forum/config.php');
	$query="SELECT config_value FROM ".$table_prefix."config WHERE config_name = 'version'";
	$res = $pdo->query($query);
	if ($res)
		$phpbb_version_bdd = $res->fetch()->config_value;
	else {
		echo '<strong>Pas de base phpBB instalée</strong>';
		exit;
	}
}
echo "<p>Base phpBB version $phpbb_version_bdd</p>\n";

if ($phpbb_version_bdd != $phpbb_version_fichiers)
	echo '<strong>Les fichiers et la base du forum ne sont pas à la même version</strong>';

echo "<br/><div><u>VOUS POUVEZ :</u></div>\n";

//==============================
// Demande d'update des fichiers
foreach (glob ('phpBB*.zip') AS $fzip) {
	preg_match ('/-([0-9\.]+)\.zip/', $fzip, $match);
	if ($match[1] == $phpbb_version_fichiers ||
		$match[1] == $phpbb_version_bdd)
		echo "<div><b>Installer ou réinitialiser les fichiers phpBB en version {$match[1]} ? <input type='submit' formaction='.?f={$match[1]}'></b></div>\n";
	elseif ($match[1] > $phpbb_version_bdd)
		echo "<div><b>Upgrader les fichiers et la base phpBB en version {$match[1]} ? <input type='submit' formaction='.?f={$match[1]}'></b></div>\n";
}

//============================
// Update de la base de donnée
if ($phpbb_version_bdd < $phpbb_version_fichiers /*&& is_dir('../forum/install')*/) {
	echo "<div><b>Upgrader la base phpBB en version $phpbb_version_fichiers ? <input type='submit' formaction='../install/app.php/update'></b> puis \"Mise à jour\" puis \"Envoyer\"</div>\n".
	''.PHP_EOL;
}

//=============
// C'est fini !
if ($phpbb_version_bdd == $phpbb_version_fichiers /*&& is_dir('../forum/install')*/) {
	echo "</br><div>Purge des fichiers phpBB install & cache</div>\n";
	system ('rm -r ../forum/install');
	system ('rm -r ../forum/doc');
	system ('rm -r ../forum/cache/installer');
	system ('rm -r ../forum/cache/production');
	echo "<p><b>Votre installation est à jour</b></p>\n";
	echo "<div><a href='../'>SE CONNECTER</a></div>\n";
}
echo '</form>';
