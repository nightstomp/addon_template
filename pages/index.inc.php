<?php
/**
* Addon_Template
*
* @author <a href="http://rexdev.de">rexdev.de</a>
*
* @package redaxo4
* @version 1.0
* $Id$: 
*/

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$chapter = rex_request('chapter', 'string');
$func = rex_request('func', 'string');

// REX BACKEND LAYOUT TOP
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/top.php';

// DEFINE SUBPAGES
////////////////////////////////////////////////////////////////////////////////
$subpages = array (
  array ('','Default Seite'),
  array ('settings','Einstellungen'),
  array ('help','Hilfe'),
  array ('scandir','Scandir Test')
);

// TITLE & SUBPAGE NAVIGATION
////////////////////////////////////////////////////////////////////////////////
$versionstring = implode('.', $REX['ADDON'][$myself]['VERSION']);
rex_title($REX['ADDON']['name'][$myself].' <span class="addonversion">'.$versionstring.'</span>', $subpages);

// DEFINE DEFAULT SUBPAGE, INCLUDE REQUESTED SUBPAGE
////////////////////////////////////////////////////////////////////////////////
if(!$subpage)
{
  $subpage = 'main';  /* DEFAULT SUBPAGE */
}
require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';

// REX BACKEND LAYOUT BOTTOM
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/bottom.php';

?>