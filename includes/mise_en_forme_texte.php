<?php
/**********************************************************************************************
Fonctions en rapport avec la conversion des textes internes au format BBcode+syntaxe spéciale
de et vers HTML TXT
ça gère aussi des format d'url, des gestion UTF8/ISO
**********************************************************************************************/

require_once("point.php");

//lcfirst n'existe pas avant php 5.3, si n'existe pas, on la créé
//FIXME, je doute quand même que quelqu'un souhaite faire tourner wri sur une ancienne version comme ça, en plus, sauf erreur, je crois que plusieurs morceaux de code
// par ailleurs ont besoin de 5.3, alors de toute façon... on la vire ?
if ( false === function_exists('lcfirst') ):
function lcfirst( $str )
{ 
	return (string)(strtolower(substr($str,0,1)).substr($str,1));
}
endif; 

/**
Fonction d'aide au référencement mais aussi de simplification pour que les internautes puisse se passer des urls d'accès direct aux points (par exemple)
qui soit d'elle même significative (plus que http://wri/point/456)
**/
function replace_url($str)
{
    $str = retrait_accents($str);
    $str = preg_replace('/[^A-Za-z0-9_\s\'\"\-]/','',trim($str));
    $str = preg_replace('/[_\s\'\"]+/','-',$str);
    return $str;
}

/**
Fonction de suppression des accents
**/
function retrait_accents($str)
{
$normalizeChars = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', 'œ' => "oe"
);

return strtr($str, $normalizeChars);
}
/**********************************************************************************************
Afin d'éviter le cross site scripting et permettre de mettre un peu de mise en page 
un peu partour sur le site (forum, points commentaire,s mode d'emploi, cette fonction convertit
du format bbcode interne vers html
$texte en bbcode + syntaxe interne
retourne : le code en HTML
21/03/08 sly création initiale de la fonction
26/05/08 jmb correction bug des multiples [b] (rajout d'un ? pour une regex ungreedy)
**********************************************************************************************/
function bbcode2html($texte,$autoriser_html=FALSE)
{

/** étape 1 
nouvelle fonction qui permet de faire des liens internes entre les fiches :
[->457] créer un lien qui pointe vers la fiche du point d'id 457 et donne le nom du lien égal au nom du
point destination
**/

$occurences_trouvees=preg_match_all("/\[\-\>([0-9]*)\]/",$texte,$occurence);

if ($occurences_trouvees!=0)
{
	for ($x=0;$x<$occurences_trouvees;$x++)
	{	
		$point=infos_point($occurence[1][$x]);
		$texte=str_replace($occurence[0][$x],"[url=".lien_point($point)."]$point->nom[/url]",$texte);
	}
}

/** étape 2 
on évite qu'un petit malin injecte du HTML ( style javascript pas sympa )
sauf si on veut expréssément autoriser une entrée en HTML 
**/
if (!$autoriser_html)
	$html=htmlspecialchars($texte,0,"UTF-8");
else
	$html=$texte;

// gestion de la majorité des tag bbcode
$searcharray = array(
		"/\[img:(.*)\](.+?)\[\/img:(.*)\]/s",
		"/\[img\](.+?)\[\/img\]/s",
		"/\[url:(.*)\](.+?)\[\/url:(.*)\]/s",
		"/\[url\](.+?)\[\/url\]/s",
		"/\[url=(.+?):(.*)\](.+?)\[\/url:(.*)\]/s",
		"/\[url=(.+?)\](.+?)\[\/url\]/s",
		"/\[b:(.*)\](.+?)\[\/b:(.*)\]/s",
		"/\[b\](.*?)\[\/b\]/s",
		"/\[i:(.*)\](.+?)\[\/i:(.*)\]/s",
		"/\[i\](.+?)\[\/i\]/s",
		"/\[u:(.*)\](.+?)\[\/u:(.*)\]/s",
		"/\[u\](.+?)\[\/u\]/s",
		"/\[code:([^\].]*)\](.+?)\[\/code:([^\].]*)\]/s",
		"/\[code\](.+?)\[\/code\]/s",
		"/\[quote:([^\].]*)\](.+?)\[\/quote:([^\].]*)\]/s",
		"/\[quote\](.+?)\[\/quote\]/s",
		"/\[quote=(.+?):(.*)\](.+?)\[\/quote:(.*)\]/s",
		"/\[quote=(.+?)\](.+?)\[\/quote\]/s",
		"/\[color=(.+?):(.*)\](.+?)\[\/color:(.*)\]/s",
		"/\[color=(.+?)\](.+?)\[\/color\]/s",
		"/:([a-z]+):/",
		"/\[t\]/",
		"/\[email\](.+?)\[\/email\]/"
	);
	$replacearray = array(
		"<img src=\"$2\" alt=\"image\" />",
		"<img src=\"$1\" alt=\"image\" />",
		"<a href=\"$2\">$2</a>",
		"<a href=\"$1\">$1</a>",
		"<a href=\"$2\">$3</a>",
		"<a href=\"$1\">$2</a>",
		"<em>$2</em>",
		"<em>$1</em>",
		"<i>$2</i>",
		"<i>$1</i>",
		"<u>$2</u>",
		"<u>$1</u>",
		"<code>$2</code>",
		"<code>$1</code>",
		"<blockquote><p>$2</p></blockquote>",
		"<blockquote><p>$1</p></blockquote>",
		"<blockquote><p>$2</p></blockquote>",
		"<blockquote><p>$1</p></blockquote>",
		"<span style=\"color: $1\">$3</span>",
		"<span style=\"color: $1\">$2</span>",
		" - ",
		"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
		"$1" // Sera codé plus loin
	);
	$html = preg_replace($searcharray, $replacearray, $html); 

// transformation automatique des url
// le truc bizarre devant : ([ :\.;,\n]) c'est pour ne transformer que les urls isolées
// et éviter de retransformer celles contenant du bbcode
// exemple : coucouwww.coucou ne sera pas transformé
// [url=http://www ne le sera pas non plus
// il doit bien rester quelques cas à améliorer, mais pour l'instant ça à l'air déjà bien sly 25/03/2008
// peut-être faudrait il en fait faire une négation comme : tout SAUF quand le caractère précédent est une lettre ou un "=" ? sly 26/03/2008

// FIXME Je pense qu'il ne faudrait pas passer ça en HTML directement, mais en bbcode et laisser faire la routine
// si dessus sly 27/06/2008

// au format http://truc 
$urlauto_pattern = "/([ :\.;,\n])(http:\/\/\w\S*)/i";
$urlauto_replace = "$1<a href=\"$2\">$2</a>";
$html = preg_replace($urlauto_pattern,$urlauto_replace,$html);

// au format www.
$urlauto_pattern = "/([ :\.;,\n])(www.\w\S*)/i";
$urlauto_replace = "$1<a href=\"http://$2\">$2</a>";
$html = preg_replace($urlauto_pattern,$urlauto_replace,$html);

// Transformation des adresses mails de façon à ne pas qu'elles ne soient pompées par les robots
// 1/ Le code ascii de chaque caractère est transformé par la formule: 'x' => 135 - ascii('x')
// 2/ Les caractères sont envoyés et écrits de droite à gauche. Ils sont affichés dans le bon sens par la feuille style
// 3/ Ils sont relus et inversés lors du click pour envoi de mail
$occurences_trouvees=preg_match_all("([\w_\-.]+@[\w\-.]+)",$html,$occurence);
if ($occurences_trouvees!=0)
{
	for ($x=0;$x<$occurences_trouvees;$x++)
	{	
        $c = strlen ($occurence[0][$x]);
        $l = 2 * $c + 1;
        $code = '';
        while ($c-- >= 0)
            $code .= 135 - ord ($occurence[0][$x] [$c]); // Génération de la chaine codée
        // Code JS de décodage
        $script = "<script>for(c='$code',i=0;a=135-c[i++]*10-c[i++],i<$l;)document.write('&#'+a+';')</script>";
        // Code JS de récupération et inversion de l'adresse pour envoi du mail
        $onclick = "location.href='m&#97;il&#84;o:'+this.innerHTML.toLowerCase().split('</script>')[1].split('').reverse().join('')";
        // Génération du tag complet
		$html=str_replace($occurence[0][$x],"<a class=\"mail\" onclick=\"$onclick\">$script</a>",$html);
	}
}

// gestion des retours à la ligne et des espace ajouté volontairement pour la mise en forme
if (!$autoriser_html)
{
	$html = str_replace("\r\n", "<br />", $html);
	$html = str_replace("\n", "<br />", $html);
	$html = str_replace("\r", "<br />", $html);
	$html = str_replace("  ", " &nbsp;", $html);
}
return $html;
}

//**********************************************************************************************
// Fonction permettant de retirer les tags bbcode de notre base pour certains export qui ne saurait quoi en faire
// FIXME : fusion avec bbcode2txt($string) ?
function stripBBCode($text_to_search) 
{
 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
 $replace = '';
 return preg_replace($pattern, $replace, $text_to_search);
}

//**********************************************************************************************
// fonction qui retire le bbcode et converti les caractères non compatible xml en entités xml 
function c($contenu)
{
  return htmlspecialchars(stripBBCode($contenu),0,"UTF-8");
}

// cela retire toute les balises BBcode pour faire quelque chose le plus lisible possible en mode texte pur
function bbcode2txt($string)
{
  global $settings;
  $string = preg_replace("#\[b\](.+?)\[/b\]#is", "*\\1*", $string);
  $string = preg_replace("#\[i\](.+?)\[/i\]#is", "\\1", $string);
  $string = preg_replace("#\[u\](.+?)\[/u\]#is", "\\1", $string);
  $string = preg_replace("#\[link\]www\.(.+?)\[/link\]#is", "http://www.\\1", $string);
  $string = preg_replace("#\[link\](.+?)\[/link\]#is", "\\1", $string);
  $string = preg_replace("#\[link=(.+?)\](.+?)\[/link\]#is", "\\2 --> \\1", $string);
  $string = preg_replace("#\[url\]www\.(.+?)\[/url\]#is", "http://www.\\1", $string);
  $string = preg_replace("#\[url\](.+?)\[/url\]#is", "\\1", $string);
  $string = preg_replace("#\[url=(.+?)\](.+?)\[/url\]#is", "\\2 --> \\1", $string);
  $string = preg_replace("#\[code\](.+?)\[/code\]#is", "\\1", $string);
  $string = preg_replace("#\[msg\](.+?)\[/msg\]#is", "\\1", $string);
  $string = preg_replace("#\[msg=(.+?)\](.+?)\[/msg\]#is", "\\2 --> \\1", $string);
  if (isset($bbcode_img) && $settings['bbcode_img'] == 1)
  {
    $string = preg_replace("#\[img\](.+?)\[/img\]#is", "\\1", $string);
    $string = preg_replace("#\[img\|left\](.+?)\[/img\]#is", "\\1", $string);
    $string = preg_replace("#\[img\|right\](.+?)\[/img\]#is", "\\1", $string);
  }
  return $string;
}
?>
