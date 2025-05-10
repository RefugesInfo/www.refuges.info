<?php
/***
Le controlleur qui va nous chercher toutes les pages du wiki
***/

require_once ('wiki.php');

$vue->pages_wiki=liste_pages_wiki();

