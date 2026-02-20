<?php
/**********************************************************************************************
Fonctions en rapport avec la conversion des textes internes au format BBcode+syntaxe spéciale
de et vers HTML TXT
ça gère aussi des format d'url, des gestion UTF8/ISO
**********************************************************************************************/

require_once("point.php");


/**
Fonction d'aide au référencement pour générer des chaines de caractères sans accents, sans espaces, sans caractères trop exotiques.
Facile à copier/coller, bien reconnues dans les emails ou sur le net.
L'usage principal est la génération d'url de ce genre :
https://www.refuges.info/point/2917/gite-d-etape/Bauges/Chalet-de-la-Servaz-dit-La-Sarve
Bon, en 2022 on devrait pouvoir avoir des accents dans les urls, mais après quelques essais, y'a toujours un logiciel dans le tas qui va vous l'urlencode, et ça fait moche et pas lisible.
Donc, en attendant le support UTF8 de partout et sans failles, on restera sans les accents.
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

function conversion_adresse_email_vers_mailto($texte)
{
    //Detect and create email
    $mail_pattern = "/([A-z0-9\._-]+\@[A-z0-9_-]+\.)([A-z0-9\_\-\.]{1,}[A-z])/";
    $str = preg_replace($mail_pattern, '<a href="mailto:$1$2">$1$2</a>', $texte);

    return $str;
}

/**********************************************************************************************
 Répétitivement, on a besoin de protéger une exportation vers du xml/html, cette fonction protège les
 caractères
 FIXME sly: un autre nom ne serait pas de refus, c'est trop confus "protege" ça oblige à retourner voir la fonction 
 trop souvent
**********************************************************************************************/

function protege($texte)
{
    global $config_wri;
    return htmlspecialchars($texte,ENT_QUOTES,$config_wri['encodage_des_contenu_web']);
}
/**********************************************************************************************
Afin d'éviter le cross site scripting et permettre de mettre un peu de mise en page
un peu partour sur le site (forum, points commentaire,s mode d'emploi, cette fonction convertit
du format bbcode interne vers html
$texte en bbcode + syntaxe interne
21/03/08 sly création initiale de la fonction
26/05/08 jmb correction bug des multiples [b] (rajout d'un ? pour une regex ungreedy)
FIXME sly 2019: quelle tristesse ce code difficile à maintenir alors que le forum phpBB dispose forcément d'une classe pour faire 95% du boulot, et maintenue à jour !
ça serait bien de l'utiliser, quitte à rajouter nos 4 ajouts ensuite (syntaxe lien point+anti balise img)
retourne : le code en HTML
**********************************************************************************************/
function bbcode2html($texte_avec_bbcode,$autoriser_html=False,$autoriser_balise_img=True)
{
global $config_wri;

$texte_avec_bbcode=lien_inter_fiches($texte_avec_bbcode,"bbcode");
/*
 transformation automatique des chaine de caractère ressemblant à une url http(s) vers le BBcode des URLs
 le truc bizarre devant : ([ :\.;,\n]) c'est pour ne transformer que les urls isolées
 et éviter de retransformer celles contenant du bbcode
 exemple : coucouwww.coucou ne sera pas transformé
 il doit bien rester quelques cas à améliorer, mais pour l'instant ça à l'air déjà bien sly 25/03/2008
 2022: plein de caractères supportés ont été ajouté, vu qu'on met presque tout dans une url maintenant
 On devrait supporter les formats 
 - http://truc.much.bidule/machin-chose-çé?q=123&t=ou!|s$d!f#encre
 - www.truc.machin/
 
 Ne sont pas supportés :
 google.com/toto
 
 FIXME 2022: seul caractère non supporté alors qu'il devrait l'être, le @
 Car il rentre en conflit avec le transformateur de lien mailto:
 Exemple, que comprendre de : Contactez nous à www.refuges.info/contact@refuges.info
 Est-ce qu'on peut contacter soit à l'adresse suivante, soit par email (auquel cas il faudrait un lien http et un lien mailto, où est-ce un sous dossier de l'url ?
 Vu que je ne peux trancher, et que la gestion des emails en @ deviendrait sioux, je vire la gestion du @ dans les urls, si vraiment y'a besoin, la syntaxe bbcode peut venir à la rescousse 
*/
$urlauto_pattern = "/(^|[<> :\.;,\n\*\(\[])((www.|https?:\/\/)[\w\/\.\#\%\:\?\|\$\_\;\!&+=~-]+[\w\/\%\:\?\$\_&+=~-])/iu";
$urlauto_replace = "$1[url=$2]$2[/url]$4";
$texte_avec_bbcode_apres_detection_urls = preg_replace($urlauto_pattern,$urlauto_replace,$texte_avec_bbcode);

// gestion des liens vers notre wiki au format [url=##page]c'est là que ça se passe[/url] on le repasse d'abord en bbcode plus classique avec url locale (qui tient compte de l'éventuel sous-dossier dans lequel on est installé
$texte_avec_bbcode_apres_detection_urls=str_replace("url=##","url=".$config_wri['base_wiki'],$texte_avec_bbcode_apres_detection_urls);

/**
 on évite qu'un petit malin injecte du HTML ( style javascript pas sympa )
 sauf si on veut expréssément autoriser une entrée en HTML (cas du wiki sous contrôle des modérateurs en qui on a confiance ! Et qui ont besoin d'une totale liberté)
 **/
if (!$autoriser_html)
    $texte_avec_protection_anti_injection_html_ou_pas=protege($texte_avec_bbcode_apres_detection_urls);
else
    $texte_avec_protection_anti_injection_html_ou_pas=$texte_avec_bbcode_apres_detection_urls;

//Voir : http://www.refuges.info/forum/viewtopic.php?t=6174 expliquant pourquoi, dans certains cas, nous ne voulons pas supporter la balise img
if ($autoriser_balise_img)
{
    $search_img=array(
        "/\[img:(.*)\](.+?)\[\/img:(.*)\]/s",
        "/\[img\](.+?)\[\/img\]/s");
        $replace_img=array(
            "<img src=\"$2\" alt=\"image\" />",
            "<img src=\"$1\" alt=\"image\" />");
}
else
{
    $search_img=array();
    $replace_img=array();
}
// gestion de la majorité des tag bbcode
$searcharray =
array_merge($search_img,
        array(
        "/\[url=\/(.+?)\](.+?)\[\/url\]/s", // Cas spécial des urls relatives à la racine genre [url=/forum]form[/forum] qui doivent pointer vers /sous-dossier/forum : A
        "/\[url\](http[s]?:\/\/.+?)\[\/url\]/i",
        "/\[url=(http[s]?:\/\/.+?)\](.+?)\[\/url\]/i",
        "/\[url\](.+?)\[\/url\]/s",
        "/\[url=(.+?)\](.+?)\[\/url\]/s",
        "/\[b:(.*)\](.+?)\[\/b:(.*)\]/",
        "/\[b\](.*?)\[\/b\]/s",
        "/\[i:(.*)\](.+?)\[\/i:(.*)\]/",
        "/\[i\](.+?)\[\/i\]/s",
        "/\[u:(.*)\](.+?)\[\/u:(.*)\]/",
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
        "/\[email\](.+?)\[\/email\]/",
        "/\[c\](.+?)\[\/c\]/s" // Inventé par sly pour placer un commentaire (ce qui se situe entre [c] et [/c] ne sera pas converti en html : C
        )
);
$replacearray =
array_merge($replace_img,
        array(
        "<a href=\"/$1\">$2</a>", // A
        "<a href=\"$1\">$1</a>",
        "<a href=\"$1\">$2</a>",
        "<a href=\"http://$1\">$1</a>",
        "<a href=\"http://$1\">$2</a>",
        "<b>$2</b>",
        "<b>$1</b>",
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
        "$1", // Sera codé plus loin
        "" // C
        )
);

$texte_avec_html = preg_replace($searcharray, $replacearray, $texte_avec_protection_anti_injection_html_ou_pas);

// Transformation des adresses mails repérées dans le texte en mailto:<email> clicable
$texte_avec_html=conversion_adresse_email_vers_mailto($texte_avec_html);

// gestion des retours à la ligne et des espace ajouté volontairement pour la mise en forme
$texte_avec_html = nl2br($texte_avec_html,false);
$texte_avec_html = str_replace("  ", " &nbsp;", $texte_avec_html);

return $texte_avec_html;
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
// le nom ultra court s'explique par le fait que tout particulièrement dans les exports cette fonction est utilisé
// sly 2014 : pour une myriade de variable, question de lisibilité, c($titre) est plus lisible mais moins compréhensible
function c($contenu)
{
  return protege(stripBBCode($contenu));
}

// cela retire toute les balises BBcode pour faire quelque chose le plus lisible possible en mode texte pur
function bbcode2txt($string)
{
  global $settings;
  $string=lien_inter_fiches($string,"txt");
  
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

/** 
nouvelle fonction qui permet de faire des liens internes entre les fiches :
la syntaxe, inspirée de spip au format [->457] créer un lien qui pointe vers la fiche du point d'id 457 et donne le nom du lien égal au nom du
point destination.
On peut lui passer soit bbcode (le lien sera au format bbcode), soit txt et il n'y aura pas de lien, juste le nom du point indiqué
**/

function lien_inter_fiches($texte,$format_sortie="bbcode")
{
  $occurences_trouvees=preg_match_all("/\[\-\>([0-9]*)\]/",$texte,$occurence);

  if ($occurences_trouvees!=0)
    for ($x=0;$x<$occurences_trouvees;$x++)
    { 
      // Ici il y a une grosse bricole pour ne pas transformer les liens internes si l'on exporte en JSON
      // Mais comme le '>' est transformé en '$gt;' par la suite, nous l'enlevons et les liens internes deviennent [--XXXX]
      // Ensuite dans la vue JSON, on transforme ce lien interne en utilisant la bonne méthode
      $point=infos_point($occurence[1][$x]);
      if (empty($point->erreur)) // C'est bon, un point avec ce numéro a bien été trouvé
      {
        if ($format_sortie=="bbcode")
          $texte=str_replace($occurence[0][$x],"[url=".lien_point($point)."]$point->nom[/url]",$texte);
        else
          $texte=str_replace($occurence[0][$x],$point->nom,$texte);
      }
      else        
        $texte=str_replace($occurence[0][$x],'(Lien impossible car le point n°'.$occurence[1][$x].' est introuvable)',$texte);
    }
    return $texte;
}
  
// Cette fonction permet de convertir du bbcode en markdown (pour les balises connues)
function bbcode2markdown($texte)
{
   
   $markdown=$texte=lien_inter_fiches($texte);

    // gestion de la majorité des tag bbcode
    $searcharray =
      array(
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
      "/\[img:(.*)\](.+?)\[\/img:(.*)\]/s",
      "/\[img\](.+?)\[\/img\]/s",
      "/\[code:([^\].]*)\](.+?)\[\/code:([^\].]*)\]/s",
      "/\[code\](.+?)\[\/code\]/s",
      "/\[quote:([^\].]*)\](.+?)\[\/quote:([^\].]*)\]/s",
      "/\[quote\](.+?)\[\/quote\]/s",
      "/\[quote=(.+?):(.*)\](.+?)\[\/quote:(.*)\]/s",
      "/\[quote=(.+?)\](.+?)\[\/quote\]/s",
      "/\[color=(.+?):(.*)\](.+?)\[\/color:(.*)\]/s",
      "/\[color=(.+?)\](.+?)\[\/color\]/s",
      "/:([a-z]+):/",
      "/\[t\]/"
      );
    $replacearray =
      array(
      "[$2]($1)",
      "<$1>",
      "[$2]($3)",
      "[$2]($1)",
      "**$2**",
      "**$1**",
      "*$2*",
      "*$1*",
      "$2",
      "$1",
      "![image]($2)",
      "![image]($1)",
      "<code>$2</code>",
      "<code>$1</code>",
      "<blockquote>$2</blockquote>",
      "<blockquote>$1</blockquote>",
      "<blockquote>$2</blockquote>",
      "<blockquote>$1</blockquote>",
      "$3",
      "$2",
      " - ",
      "    "
      );
    $markdown = preg_replace($searcharray, $replacearray, $markdown);

    // transformation automatique des url

    // au format http://truc
    $urlauto_pattern = "/([ :\.;,\n])(http:\/\/\w\S*)/i";
    $urlauto_replace = "$1<$2>";
    $markdown = preg_replace($urlauto_pattern,$urlauto_replace,$markdown);

    // au format www.
    $urlauto_pattern = "/([ :\.;,\n])(www.\w\S*)/i";
    $urlauto_replace = "$1<http://$2>";
    $markdown = preg_replace($urlauto_pattern,$urlauto_replace,$markdown);

    // Gestion des codes en bloc
    $occurences_trouvees=preg_match_all("/<code>.*<\/code>/s",$texte,$occurence);
    if ($occurences_trouvees!=0)
      for ($x=0;$x<$occurences_trouvees;$x++)
      {
          $occurence_temp=$occurence[0][$x];
          $occurence_temp=preg_replace("/^<code>/","\n    ",$occurence_temp);
          $occurence_temp=preg_replace("/<\/code>$/","\n",$occurence_temp);
          $occurence_temp=preg_replace("/\n/","\n    ",$occurence_temp);
          $markdown=str_replace($occurence[0][$x],$occurence_temp,$markdown);
      }

    // Gestion des citations en bloc
    $occurences_trouvees=preg_match_all("/<blockquote>.*<\/blockquote>/s",$texte,$occurence);
    if ($occurences_trouvees!=0)
      for ($x=0;$x<$occurences_trouvees;$x++)
      {
          $occurence_temp=$occurence[0][$x];
          $occurence_temp=preg_replace("/^<blockquote>/","\n> ",$occurence_temp);
          $occurence_temp=preg_replace("/<\/blockquote>$/","\n",$occurence_temp);
          $occurence_temp=preg_replace("/\n/","\n> ",$occurence_temp);
          $markdown=str_replace($occurence[0][$x],$occurence_temp,$markdown);
      }

    return $markdown;
}

/* ucfirst( ) ne fonctionne pas avec UTF-8, voici une version qui fonctionne en UTF-8
 Depuis php 8.4, cette fonction existe nativement (le même nom !) alors je ne la déinie que si elle n'existe pas, afin que cela puisse marcher sur des versions antérieurs de php
*/
if (!function_exists('mb_ucfirst')) {
  function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false)
  {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = "";
        if ($lower_str_end) {
    $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        }
        else {
    $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $str = $first_letter . $str_end;
        return $str;
  }
}
/* Purge les balises et autres dans le forum phpbb3.post_text */
function purge_phpbb_post_text($s)
{
    $s = preg_replace ('/\<[^\>]*\>/i', ' ', $s); // Enlève les balises <>
    $s = preg_replace ('/\[url=([^\]]*)\]/i', ' $1 ', $s); // Conserve l'url de [url=...]
    $s = preg_replace ('/\[quote\][^\[]*/i', '', $s); // Supprime les [quote]...
    $s = preg_replace ('/[^\]]*\[\/quote\]/i', '', $s); // Supprime les ...[/quote]
    $s = preg_replace ('/\[[^\]]*\]/i', '', $s); // Enlève les balises []
    $s = preg_replace ('/&nbsp;/i', ' ', $s); // Purge les espaces multiples
    $s = preg_replace ('/\s+/i', ' ', $s); // Purge les espaces multiples
    $s = preg_replace ('/^\s*$/i', '', $s); // Purge les posts sans texte
	return $s;
}

function date_format_francais($unix_ts)
{
  global $config_wri;
  $fmt = new IntlDateFormatter($config_wri['langue'], IntlDateFormatter::FULL, IntlDateFormatter::FULL, $config_wri['timezone']);
  $fmt->setPattern("EEEE d LLLL yyyy à HH'h'mm");

  return mb_ucfirst($fmt->format($unix_ts));
} 

// Utilisés par l'API
// Ça permet de mettre convertir tout un objet
function updatebbcode2html(&$html, $key) {
    if (is_string($html) && $key != 'url') 
        $html=bbcode2html($html,0,1,0); 
}
function updatebbcode2markdown(&$html, $key) {
    if (is_string($html) && $key != 'url') 
        $html=bbcode2markdown($html);
}
function updatebbcode2txt(&$html, $key) {
    if (is_string($html) && $key != 'url') 
        $html=bbcode2txt($html);
}
function updatebool2char(&$html) { 
    if($html===FALSE) 
        $html='0';  
    elseif($html===TRUE) 
        $html='1'; 
}
