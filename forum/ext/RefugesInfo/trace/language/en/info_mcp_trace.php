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
  'MCP_TRACE' => 'Traces',
  'MCP_TRACE_TITLE' => 'History of traces',
]);
