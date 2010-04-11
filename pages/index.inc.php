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

// DEFINE SUBPAGES
////////////////////////////////////////////////////////////////////////////////
$subpages = array (
  array ('','Hauptseite'),
  array ('settings','Einstellungen'),
  array ('help','Hilfe')
);

// REX BACKEND LAYOUT TOP
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/top.php';

// TITLE & SUBPAGE NAVIGATION
////////////////////////////////////////////////////////////////////////////////
$versionstring = $REX['ADDON'][$myself]['VERSION'];
array_pop($versionstring);
$versionstring = implode('.', $versionstring);
rex_title($REX['ADDON']['name'][$myself].' <span class="addonversion">'.$versionstring.'</span>', $subpages);

// INCLUDE SUBPAGE
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