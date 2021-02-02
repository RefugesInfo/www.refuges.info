<?php
/***
Fonctions d'état de connexion et de droit des utilisateurs.
Plutôt que de tester par de multiple if les droits utilisateurs, j'en fais des fonctions plus rapide à écrire

Seront testé :
$_SESSION['login_utilisateur']
$_SESSION['id_utilisateur'] ( celui de la table phpbb_users, attention, l'id 1 c'est le compte anonmyme qui, quand la session est démarré, et qu'on est passé sur le forum existe et vaut 1 )
$_SESSION['niveau_moderation'] ayant pour signification
Il n'y a que 2 niveaux dans WRI aujourd'hui 01/02/2021: 0 = rien, >= 1 = tout

***/
require_once ("config.php");
require_once ("bdd.php");

function est_moderateur()
{
if (isset($_SESSION))
  if (isset($_SESSION['niveau_moderation']))
    if ($_SESSION['niveau_moderation']>=1)
      return true;

return false;
}

function est_autorise($id_utilisateur)
{
if (isset($_SESSION))
{
  if (isset($_SESSION['niveau_moderation']))
    if ($_SESSION['niveau_moderation']>=1)
      return true;
  if (isset($_SESSION['id_utilisateur']))
    if ($_SESSION['id_utilisateur']==$id_utilisateur) 
      return true;
}
else
  return false;

}

function login_connecte()
{

}
