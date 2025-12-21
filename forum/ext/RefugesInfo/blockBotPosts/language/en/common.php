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
  'ACCOUNT_REJECTED' => 'Your account has been rejected by BlockBotPosts as you are a robot.',
  'MESSAGE_REJECTED' => 'Your message has been rejected by BlockBotPosts as you are a robot.',
]);
