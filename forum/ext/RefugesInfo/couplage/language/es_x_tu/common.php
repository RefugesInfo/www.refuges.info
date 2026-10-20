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
  'RI_NO_BOOKING' => '<strong>Está prohibido reservar una cabaña de acceso libre
      o avisar a los demás de que estarás allí</strong>,
      porque esta práctica es contraria al espíritu con el que se creó este sitio.<br />
      Cualquier aportación de este tipo será eliminada por los moderadores.<br />
      Consulta <a href="viewtopic.php?t=37">la discusión sobre este tema en el foro.</a>',
  'RI_NO_MANAGER_MESSAGE' => '<strong>Refuges.info no tiene ninguna relación con los gestores.</strong>
      <br />
      No les dejes aquí ningún mensaje (información, reserva, ...):
      ¡no podrán leerlo!<br />
      Debes contactar con ellos directamente (los datos están en la ficha).',
]);
