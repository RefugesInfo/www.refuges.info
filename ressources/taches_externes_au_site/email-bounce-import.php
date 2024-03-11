#!/usr/bin/php
<?php
/*

2024-03-10 : sly
Cet outil est appelé en externe par le MTA local afin de stocker dans la base les emails envoyé du forum qui sont "bounced" et refusés par les serveurs distants.

Il est supposé que le mail est passé en STDIN du genre :
cat $email | php email-bounce-import.php

Soit on peut appelé ce script depuis le .procmailrc du user avec la syntaxe :
:0
| php -f email-bounce-import.php

Soit depuis la config de postfix ou du MTA

*/

// Ces variables n'exitent pas en ligne de commande, mais comme je ne m'en sers pas, je les vide pour éviter une NOTICE
$_SERVER['DOCUMENT_ROOT']="";
$_SERVER['HTTP_HOST']="";


require_once ( dirname(__FILE__) . '/../../includes/config.php');
require_once ("bdd.php");
require_once ('mise_en_forme_texte.php');

$input_data = $pdo->quote(stream_get_contents(STDIN));

$query_email_bounce="INSERT INTO emails_bounce (date, contenu)
                          VALUES (now(), $input_data);";
if (! ($res = $pdo->query($query_email_bounce)))
    return erreur("Requête en erreur, impossible d'ajouter cet email à la base",$query_email_bounce);

