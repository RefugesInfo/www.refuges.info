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
  'RI_NO_BOOKING' => '<strong>Es ist verboten, eine frei zugängliche Hütte zu reservieren
      oder anderen mitzuteilen, dass Sie dort sein werden</strong>,
      denn diese Praxis widerspricht dem Geist, in dem diese Website geschaffen wurde.<br />
      Jeder Beitrag dieser Art wird von den Moderatoren gelöscht.<br />
      Siehe <a href="viewtopic.php?t=37">die Diskussion dazu im Forum.</a>',
  'RI_NO_MANAGER_MESSAGE' => '<strong>Refuges.info hat keinerlei Verbindung zu den Betreibern.</strong>
      <br />
      Hinterlassen Sie ihnen hier keine Nachricht (Information, Reservierung, ...):
      Sie können sie nicht lesen!<br />
      Sie müssen sie direkt kontaktieren (die Kontaktdaten stehen auf der Seite).',
]);
