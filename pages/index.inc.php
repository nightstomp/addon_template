<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4
* @version 1.0
* $Id$:
*/

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself  = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');

// REX BACKEND LAYOUT TOP
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/top.php';

// DEFINE SUBPAGES
////////////////////////////////////////////////////////////////////////////////
$subpages = array (
  array ('','Addon Einstellungen'),
  /*array ('settings_xform','XForm'),
  array ('database','Addon Daten'),*/
  array ('help','Hilfe')
);

// TITLE & SUBPAGE NAVIGATION
////////////////////////////////////////////////////////////////////////////////
rex_title($REX['ADDON']['name'][$myself].' <span class="addonversion">'.$REX['ADDON']['version'][$myself].'</span>', $subpages);

// DEFINE DEFAULT SUBPAGE, INCLUDE REQUESTED SUBPAGE
////////////////////////////////////////////////////////////////////////////////
if(!$subpage)
{
  $subpage = 'settings';  /* DEFAULT SUBPAGE */
}
require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';

// REX BACKEND LAYOUT BOTTOM
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/bottom.php';

?>