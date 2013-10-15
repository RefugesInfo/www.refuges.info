<?php
//**********************************************************************************************
//* Nom du module:         | news_gestion.php                                                  *
//* Date :                 |                                                                   *
//* Créateur :             |                                                                   *
//* Rôle du module :       | Ecran de gestion des news générales.                              *
//*                        | Droits: admin & supermodérateur.                                  *
//*                        | Accès par : "./gestion/?page=news_gestion"                        *
//*                        |                                                                   *
//*------------------------|-------------------------------------------------------------------*
//* Modifications(date Nom)| Elements modifiés, ajoutés ou supprimés                           *
//*------------------------|-------------------------------------------------------------------*
//* 21/03/06 rff           | correction bugs bloquants empêchant le bon fonctionnement:        *
//*                        | -table comment incorrecte, paramètres GET non pris en compte,     *
//*                        | -renvoi page d'index gestion non fait (prise en compte AUTH=1)    *
//*                        |                                                                   *
//* 16/02/13               |   jmb : PDO                                                       *
//**********************************************************************************************

require_once("commentaire.php");


//vérification des autorisations
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{
   if ($_GET['delete']==1)
   {
     echo "La news en page de garde est enlevée<br>";
     $commentaire=infos_commentaire($_GET['id_news']);
     if ($commentaire->erreur)
       print($commentaire->message);
     else
       suppression_commentaire($commentaire);
   }

   if ($_GET['ajout']==1)
   {
      echo "Ajout d'une news en page de garde :<br>";
      echo "<form method=\"post\" action='/gestion/?page=news_gestion'>";
      echo "texte :<input size=\"50\" type=\"text\" name=\"texte\"><br>";
      echo "<input type=\"submit\" name=\"faire_ajout\" value=\"ajouter\">";
   }

   if ($_POST['faire_ajout']=="ajouter")
   {
     $commentaire = new stdClass;
     $commentaire->texte=$_POST['texte'];
     $commentaire->id_point=$config['numero_commentaires_generaux'];
     modification_ajout_commentaire($commentaire);
     echo "News générale : \"".$_POST['texte']."\" ajoutée<br>";
   }
}
?>