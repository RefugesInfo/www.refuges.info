<?php
if(!defined('IN_PHPBB'))
{
  exit;
}

if(empty($lang) || !is_array($lang))
{
  $lang = [];
}

$lang = array_merge($lang, [
  'RI_NO_BOOKING' => 'Il est <strong>interdit de faire une réservation d\'une cabane en accès libre
      ou de signaler aux autres que vous y serez</strong>
      car cette pratique est contraire à l\'esprit dans lequel ce site à été créé.<br />
      Toute contribution dans ce sens sera supprimé par les modérateurs.<br />
      Voir <a href="viewtopic.php?t=37"> la discussion à ce sujet sur le forum.</a>',
  'RI_NO_MANAGER_MESSAGE' => '<strong>Refuges.info n\'a aucun lien avec les gestionnaires.</strong>
      <br />
      Ne leur laissez pas de message (renseignement, réservation, ...) ici,
      ils ne pourront pas le lire !<br />
      Vous devez les contacter directement (références dans la fiche).',
]);
