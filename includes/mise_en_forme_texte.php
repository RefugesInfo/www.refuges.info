<?php
/**********************************************************************************************
Fonctions en rapport avec la conversion des textes internes au format BBcode+syntaxe spéciale
de et vers HTML TXT
ça gère aussi des format d'url, des gestion UTF8/ISO
**********************************************************************************************/

require_once("point.php");


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
 Répétitivement, on a besoin de protéger une exportation vers du xml/html, cette fonction protège les
 caractères
 FIXME:sly: un autre nom ne serait pas de refus, c'est trop confus "protege" ça oblige à retourner voir la fonction 
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
FIXME sly 2019: quelle tristesse ce code difficile à maintenir alors que le forum phpBB dispose forcément d'une classe pour faire 95% du boulot, et maintenue à jour !
ça serait bien de l'utiliser, quitte à rajouter nos 4 ajouts ensuite (syntaxe lien point+anti email snif+anti balise img)
retourne : le code en HTML
21/03/08 sly création initiale de la fonction
26/05/08 jmb correction bug des multiples [b] (rajout d'un ? pour une regex ungreedy)
**********************************************************************************************/
function bbcode2html($texte_avec_bbcode,$autoriser_html=False,$autoriser_balise_img=True,$crypter_texte_sensible=True)
{
global $config_wri;
/** étape 1
nouvelle fonction qui permet de faire des liens internes entre les fiches :
[->457] créer un lien qui pointe vers la fiche du point d'id 457 et donne le nom du lien égal au nom du
point destination
**/

$occurences_trouvees=preg_match_all("/\[\-\>([0-9]*)\]/",$texte_avec_bbcode,$occurence);

if ($occurences_trouvees!=0)
{
      for ($x=0;$x<$occurences_trouvees;$x++)
  {	// Ici il y a une grosse bricole pour ne pas transformer les liens internes si l'on exporte en JSON
    // Mais comme le '>' est transformé en '$gt;' par la suite, nous l'enlevons et les liens internes deviennent [--XXXX]
    // Ensuite dans la vue JSON, on transforme ce lien interne en utilisant la bonne méthode
    $point=infos_point($occurence[1][$x]);
    $texte_avec_bbcode=str_replace($occurence[0][$x],"[url=".lien_point($point)."]$point->nom[/url]",$texte_avec_bbcode);
  }
}


// transformation automatique des chaine de caractère ressemblant à une url vers le BBcode des URLs
// le truc bizarre devant : ([ :\.;,\n]) c'est pour ne transformer que les urls isolées
// et éviter de retransformer celles contenant du bbcode
// exemple : coucouwww.coucou ne sera pas transformé
// il doit bien rester quelques cas à améliorer, mais pour l'instant ça à l'air déjà bien sly 25/03/2008
// au format http://truc ou https://bidule ou www.
$urlauto_pattern = "/(^|[> :\.;,\n\*\(\[])((www.|https?:\/\/)[\/\w\.\#\?&=~-]+\w+)([\S< :\/\.;,\n\*\)\]]|\r\n|$)/iu";
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
        "$1", // Sera codé plus loin
        "" // C
        )
);

$texte_avec_html = preg_replace($searcharray, $replacearray, $texte_avec_protection_anti_injection_html_ou_pas);


// Transformation des adresses mails de façon à ne pas qu'elles ne soient pompées par les robots
// 1/ Le code ascii de chaque caractère est transformé par la formule: 'x' => 135 - ascii('x')
// 2/ Les caractères sont envoyés et écrits de droite à gauche. Ils sont affichés dans le bon sens par la feuille style
// 3/ Ils sont relus et inversés lors du click pour envoi de mail
$occurences_trouvees=preg_match_all("([\w_\-.]+@[\w\-.]+)",$texte_avec_html,$occurence);
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
        if (!$crypter_texte_sensible)
            $texte_avec_html=str_replace($occurence[0][$x],"<a class=\"mail\" href=\"mailto:".$occurence[0][$x]."\">".$occurence[0][$x]."</a>",$texte_avec_html);
        else
            $texte_avec_html=str_replace($occurence[0][$x],"<a class=\"mail\" onclick=\"$onclick\">$script</a>",$texte_avec_html);
  }
}
// gestion des retours à la ligne et des espace ajouté volontairement pour la mise en forme
$texte_avec_html = nl2br($texte_avec_html,true);
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

// Cette fonction permet de convertir du bbcode en markdown (pour les balises connues)

function bbcode2markdown($texte,$autoriser_html=FALSE,$autoriser_texte_sensible=TRUE)
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
        $texte=str_replace($occurence[0][$x],"[url=".lien_point($point)."]$point->nom[/url]",$texte);
      }
    }

    /** étape 2
    on évite qu'un petit malin injecte du HTML ( style javascript pas sympa )
    sauf si on veut expréssément autoriser une entrée en HTML (cas du wiki sous contrôle des modérateurs en qui on a confiance ! Et qui ont besoin d'une totale liberté)
    **/
    if (!$autoriser_html)
  $html=protege($texte);
    else
  $html=$texte;

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
      "/\[t\]/",
      "/\[email\](.+?)\[\/email\]/",
      "/(0[0-9]([-. ]?[0-9]{2}){4})/" // Pour les numéros de téléphone
      );
    $replacearray =
      array(
      "[$1]($2)",
      "[$1]($1)",
      "[$3]($2)",
      "[$1]($2)",
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
      "    ",
      "<sensible>$1</sensible>", // Sera codé plus loin
      "<sensible>$1</sensible>" // Sera codé plus loin
      );
    $html = preg_replace($searcharray, $replacearray, $html);

    // transformation automatique des url

    // au format http://truc
    $urlauto_pattern = "/([ :\.;,\n])(http:\/\/\w\S*)/i";
    $urlauto_replace = "$1[$2]($2)";
    $html = preg_replace($urlauto_pattern,$urlauto_replace,$html);

    // au format www.
    $urlauto_pattern = "/([ :\.;,\n])(www.\w\S*)/i";
    $urlauto_replace = "$1[$2](http://$2)";
    $html = preg_replace($urlauto_pattern,$urlauto_replace,$html);

    // Gestion du texte sensible
    if($autoriser_texte_sensible) {
  $html = preg_replace("/<sensible>(.*)<\/sensible>/","$1",$html);
    }
    else {
  $html = preg_replace("/<sensible>(.*)<\/sensible>/","",$html);
    }

    // Gestion des codes en bloc
    $occurences_trouvees=preg_match_all("/<code>.*<\/code>/s",$texte,$occurence);
    if ($occurences_trouvees!=0)
    {
  for ($x=0;$x<$occurences_trouvees;$x++)
  {
      $occurence_temp=$occurence[0][$x];
      $occurence_temp=preg_replace("/^<code>/","\n    ",$occurence_temp);
      $occurence_temp=preg_replace("/<\/code>$/","\n",$occurence_temp);
      $occurence_temp=preg_replace("/\n/","\n    ",$occurence_temp);
      $html=str_replace($occurence[0][$x],$occurence_temp,$html);
  }
    }

    // Gestion des citations en bloc
    $occurences_trouvees=preg_match_all("/<blockquote>.*<\/blockquote>/s",$texte,$occurence);
    if ($occurences_trouvees!=0)
    {
  for ($x=0;$x<$occurences_trouvees;$x++)
  {
      $occurence_temp=$occurence[0][$x];
      $occurence_temp=preg_replace("/^<blockquote>/","\n> ",$occurence_temp);
      $occurence_temp=preg_replace("/<\/blockquote>$/","\n",$occurence_temp);
      $occurence_temp=preg_replace("/\n/","\n> ",$occurence_temp);
      $html=str_replace($occurence[0][$x],$occurence_temp,$html);
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

/* ucfirst( ) does not work well with UTF-8 this is it's multibyte replacement */
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
?>
