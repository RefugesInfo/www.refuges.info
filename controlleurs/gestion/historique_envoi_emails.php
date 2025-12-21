<?php
/***
Indique les derniers emails revenus en erreur que le forum a envoyé : pas de présentation jolie ou complexe, on indique le contenu du mail tel que générer par postfix qui l'a retourné à l'utilisateur "existe-pas@refuges.info" qui est le from: des emails.
Cette adresse en externe n'existe pas et ne reçois rien (elle est juste utilisée en interne pour recevoir les bounces)

***/

require_once ('mise_en_forme_texte.php');

if (isset($_REQUEST['id_email_bounce']))
{
  $query_email_bouce_traite="update emails_bounce set a_traiter='f' where id_email_bounce=".$_REQUEST['id_email_bounce'];
  if (! ($res = $pdo->query($query_email_bouce_traite)))
    return erreur("Requête en erreur, impossible de marquer comme traité l'email de numéro ".$_REQUEST['id_email_bounce'],$query_email_bouce_traite);
}

$query_emails_erreur="select id_email_bounce, date::timestamp(0) as date_email, ".
  "REGEXP_REPLACE(contenu,'.*Reporting-MTA','Reporting-MTA') as contenu, ".
  "a_traiter from emails_bounce order by date desc LIMIT 50";

if (! ($res = $pdo->query($query_emails_erreur)))
  return erreur("Requête en erreur, impossible d'afficher l'historique des emails en erreur",$query_emails_erreur);

while ($email = $res->fetch())
  $vue->emails[]=$email;
