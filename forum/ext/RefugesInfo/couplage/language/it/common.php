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
  'RI_NO_BOOKING' => '<strong>È vietato prenotare una capanna ad accesso libero
      o segnalare agli altri che ci sarai</strong>,
      perché questa pratica è contraria allo spirito con cui è stato creato questo sito.<br />
      Qualsiasi contributo di questo tipo sarà cancellato dai moderatori.<br />
      Vedi <a href="viewtopic.php?t=37">la discussione in proposito sul forum.</a>',
  'RI_NO_MANAGER_MESSAGE' => '<strong>Refuges.info non ha alcun legame con i gestori.</strong>
      <br />
      Non lasciare loro qui alcun messaggio (informazioni, prenotazione, ...):
      non potranno leggerlo!<br />
      Devi contattarli direttamente (i recapiti sono nella scheda).',
]);
