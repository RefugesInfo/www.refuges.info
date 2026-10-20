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
  'RI_NO_BOOKING' => 'It is <strong>forbidden to book an open-access wilderness hut
      or to tell others that you will be there</strong>,
      as this practice goes against the spirit in which this site was created.<br />
      Any contribution of this kind will be removed by the moderators.<br />
      See <a href="viewtopic.php?t=37">the discussion about this on the forum.</a>',
  'RI_NO_MANAGER_MESSAGE' => '<strong>Refuges.info has no connection with the managers.</strong>
      <br />
      Do not leave them a message (information, booking, ...) here,
      they will not be able to read it!<br />
      You must contact them directly (details are in the sheet).',
]);
