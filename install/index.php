<style>
h3 { /* Titre */
	margin: 0;
	text-decoration: underline;
}
p { /* Texte */
	margin: 0;
}
div { /* Vérification OK */
	color: green;
}
label { /* Action à faire */
	display: block;
	font-weight: bold;
}
section { /* Action OK */
	display: block;
	font-weight: bold;
	color: green;
}
strong { /* Erreur */
	display: block;
	color: red;
}
</style>

<h3>Installation de refuges.info</h3>
<p>Cet utilitaire gére l'installation ou l'upgrade d'un site refuges.info</p>
<p>à l'exception des tables spécifiques refuges.info</p>
<p>qui doivent être récupérées d'une base existante.</p>
<br/>

<?php
//=======================
/* FABRICATION DES ZIPS
phpBB-3.3.0_FR.zip
	Supprimer _FR du nom du zip
	Supprimer /doc config.php
	Ajouter ext/CleanTalk
	Ajouter les upgrades de langues SP IT GE
*/

//==========================
// Fichier config_privee.php
if (file_exists ('../config_privee.php')) {
	include ('../config_privee.php');
	if (!isset ($config_wri) || !isset ($config_wri['debug']) || !$config_wri['debug']) {
		echo '<strong>Cet utilitaire ne peut fonctionner que si $config_wri ["debug"] = true;</strong>';
		exit;
	}
	echo "<div>Fichier config_privee.php OK</div>\n";
} else {
	if (file_exists ('../../config_privee.php')) {
		// On peut mettre un config_privee.php perso dans le répertoire en dessous de la racine du site
		echo "<section>Copie du fichier config_privee.php perso</section>\n";
		copy ('../../config_privee.php', '../config_privee.php');
	} elseif (file_exists ('../config_privee.php.modele')) {
		echo "<section>Copie du fichier config_privee.php modele</section>\n";
		copy ('../config_privee.php.modele', '../config_privee.php');
	} else {
		echo "<strong>Fichier config_privee.php.modele manquant</strong>\n".
			"<strong>Vous devez installer les fichiers de ".
			"<a href='https://github.com/RefugesInfo/www.refuges.info'>".
			"https://github.com/RefugesInfo/www.refuges.info</a></strong>";
		exit;
	}
}

//==================
// Fichier .htaccess
if (file_exists ('../.htaccess'))
	echo "<div>Fichier .htaccess OK</div>\n";
elseif (file_exists ('../htaccess.modele.txt')) {
	echo "<section>Copie du fichier .htaccess modele</section>\n";
	copy ('../htaccess.modele.txt', '../.htaccess');
} else {
	echo "<strong>Fichier htaccess.modele.txt manquant</strong>\n".
		"<strong>Vous devez installer les fichiers de ".
		"<a href='https://github.com/RefugesInfo/www.refuges.info'>".
		"https://github.com/RefugesInfo/www.refuges.info</a></strong>";
	exit;
}

//=========================
// Connexion au serveur SQL
include ('../includes/bdd.php');
if (@$pdo->errorCode() === null) {
	echo "<strong>Les paramètres de config_privee.php ne permettent pas de se connecter à la base</strong>";
	//exit;
}
echo "<div>Connexion à PGSQL OK</div>\n";

//=====================================================================
// Installation des fichiers phpBB demandés par le paramètre ?f=version
if (isset ($_GET['f'])) {
	if (!file_exists ("phpBB-{$_GET['f']}.zip")) {
		echo "<strong>Fichier phpBB-{$_GET['f']}.zip manquant</strong>";
		exit;
	}
	echo "<section>Décompression de phpBB-{$_GET['f']}.zip dans ".str_replace('install','forum',__DIR__)."/</section>\n";
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
	// On affiche où on en est avant de commencer le dézip
	ob_flush (); flush ();
	system ("unzip -oqd ../forum/ phpBB-{$_GET['f']}.zip");
	echo "<section>Fin de décompression.</section>\n";
}

//========================
// Etat des fichiers phpBB
if (file_exists ('../forum/includes/constants.php')) {
	define ('IN_PHPBB', true);
	include ('../forum/includes/constants.php');
	$phpbb_version_fichiers = PHPBB_VERSION;
	echo "<div>Fichiers phpBB installés version $phpbb_version_fichiers</div>\n";
} else {
	$phpbb_version_fichiers = null;
	echo "<strong>Pas de fichiers phpBB instalés</strong>\n";
}

//======================
// Etat de la base phpBB
if (file_exists ('../forum/config.php')) {
	include ('../forum/config.php');
	$query = "SELECT config_value FROM {$table_prefix}config WHERE config_name = 'version'";
	$res = $pdo->query($query);
	if ($res) {
		$phpbb_version_bdd = $res->fetch()->config_value;
		echo "<div>Base phpBB version $phpbb_version_bdd</div>\n";
	} else {
		$phpbb_version_bdd = null;
		echo "<strong>Pas de base phpBB instalée</strong>";
	}
}

if ($phpbb_version_fichiers && $phpbb_version_bdd && $phpbb_version_fichiers != $phpbb_version_bdd)
	echo "<strong>Les fichiers et la base du forum ne sont pas à la même version</strong>\n";

//===================================
echo "<br/><h3>Vous pouvez :</h3>\n".
	"<form method='post'>\n";

//==================================================
// Installation ou update de la base de donnée phpBB
if ($phpbb_version_bdd != $phpbb_version_fichiers) {
	if (is_dir('../forum/install') && !$phpbb_version_bdd)
		echo "<label>Installer la base phpBB en version $phpbb_version_fichiers ? ".
			"<input type='submit' formaction='../forum/install'> puis \"Mise à jour\" puis \"Envoyer\"</label>\n";
	elseif (is_dir('../forum/install'))
		echo "<label>Upgrader la base phpBB en version $phpbb_version_fichiers ? ".
			"<input type='submit' formaction='../forum/install/app.php/update'> puis \"Mise à jour\" puis \"Envoyer\"</label>\n";
	elseif ($phpbb_version_fichiers)
		echo "<label>Installer l'utilitaire d'upgrade de la base phpBB en version $phpbb_version_fichiers ? ".
			"<input type='submit' formaction='.?f=$phpbb_version_fichiers' /></label>\n";
}

//==============================
// Demande d'update des fichiers
foreach (glob ('phpBB*.zip') AS $fzip) {
	preg_match ('/-([0-9\.]+)\.zip/', $fzip, $match);
	echo "<label>".($match[1] == $phpbb_version_fichiers ? "Réinitialiser" :
			($phpbb_version_fichiers ? "Passer" : "Installer")).
		" les fichiers phpBB en version {$match[1]} ? ".
		"<input type='submit' formaction='.?f={$match[1]}' /></label>\n";
}

//=================================
// Tables refuges.info dans la base
if (!$pdo->query('SELECT id_point FROM points limit 1')) {
	echo "<strong>Données refuges.info non présentes dans la base</strong>\n".
		"<p>Cet utilitaire ne gère pas l'initialisation de la base de données refuges.info,</p>\n".
		"<p>vous devez récupérer une base existante</p>";
	exit;
}

//=============
// C'est fini !
if ($phpbb_version_bdd == $phpbb_version_fichiers) {
	echo "</br><div>Fichiers phpBB install & cache purgés</div>\n";
	system ('rm -r ../forum/install');
	system ('rm -r ../forum/doc');
	system ('rm -r ../forum/cache/installer');
	system ('rm -r ../forum/cache/production');
	echo "<br/><h3>Votre installation est à jour</h3>".
		"<label><a style='color:green' href='../'>Voir le site</a></label>";
}
?>
</form>
