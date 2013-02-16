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



//vérification des autorisations
if ( (AUTH ==1) AND ($_SESSION['niveau_moderation']>=1) )
{

   //rff 21/03/06 : lecture du paramètre
   if (isset($_GET["page"]))
      $page = $_GET["page"] ;

   //rff 21/03/06 : lecture du paramètre
   if (isset($_GET["ajout"]))
      $ajout = $_GET["ajout"] ;

   //rff 21/03/06 : lecture du paramètre
   if (isset($_GET["faire_ajout"]))
      $faire_ajout = $_GET["faire_ajout"] ;

   //rff 21/03/06 : lecture du paramètre
   if (isset($_GET["texte"]))
      $texte = $_GET["texte"] ;
   else $texte = "";

   if ($delete==1)
   {
     echo "La news en page de garde est enlevée<br>";
     $query_delete="DELETE FROM comment WHERE id=$id_news";
	 //PDO-  mysql_query($query_delete);
	 //PDO+
	 $pdo->exec($query_delete);
   }

   if ($ajout==1)
   {
      echo "Ajout d'une news en page de garde :<br>";
//    echo "<form method=\"post\" action=\"news_gestion.php\">";  rff 21/03/06 : renvoyer à la page gestion
// pour ravoir les droits AUTH=1
      echo "<form method=\"get\" action='/gestion/'>";  //rff 21/03/06 : changer post en get
      echo "texte :<input size=\"50\" type=\"text\" name=\"texte\"><br>";
      echo "<input type=\"submit\" name=\"faire_ajout\" value=\"ajouter\">";
      echo "<input type=\"hidden\" name=\"page\" value=\"$page\">";
   }

   if ($faire_ajout=="ajouter")
   {

     //rff 21/03/06 : table 'comment' évoluée en 'commentaires'
     $sql_query_ajout="INSERT INTO commentaires(id_point,texte,date) VALUES (".$config['numero_commentaires_generaux'].",\"".$texte."\",NOW())";
     //PDO- mysql_query($sql_query_ajout)or die("insert_commentaires est mauvais");
	 //PDO+
	 $pdo->exec($sql_query_ajout)or die("insert_commentaires est mauvais");
     echo "News générale : \"".texte."\" ajoutée<br>";
   }
}
?>