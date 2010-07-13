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

// ADDON IDENTIFIER AUS ORDNERNAMEN ABLEITEN
////////////////////////////////////////////////////////////////////////////////
$myself = explode('/redaxo/include/addons/',__FILE__);
$myself = explode('/',$myself[1]);
$myself = $myself[0];
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself;

// ADDON VERSION
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 0,
'SUBVERSION'   => 1
);

// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself] = '720';
$REX['ADDON']['page'][$myself] = $myself;
$REX['ADDON']['name'][$myself] = 'Addon Template';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself] = "rexdev.de";
$REX['ADDON']['supportpage'][$myself] = "forum.redaxo.de";
$REX['PERM'][] = $myself.'[]';

// ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
/* dynamisch: Werte kommen aus dem "Einstellungen" Formular */
// --- DYN
$REX["ADDON"]["addon_template"]["settings"]["textinput1"] = '$irgendwas..';
$REX["ADDON"]["addon_template"]["settings"]["textarea1"] = 'fasel \"blub\" \'bäh\' isoleé';
$REX["ADDON"]["addon_template"]["settings"]["demo_select"] = '0';
$REX["ADDON"]["addon_template"]["settings"]["demo_multiselect"] = '1';
$REX["ADDON"]["addon_template"]["settings"]["MEDIA"] = array (
  1 => 'navigation.css',
  2 => 'main.css',
);
$REX["ADDON"]["addon_template"]["settings"]["MEDIALIST"] = array (
  1 => '',
);
// --- /DYN

/* fixe Einstellungen */
$REX["ADDON"]["addon_template"]["settings"]["debug"] = false;

// AUTO INCLUDES
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'])
{
  // AUTO INCLUDE FUNCTIONS
  foreach (glob($myroot.'/functions/function.*.inc.php') as $include)
  {
    require_once $include;
  }

  // AUTO INCLUDE CLASSES
  foreach (glob($myroot.'/classes/class.*.inc.php') as $include)
  {
    require_once $include;
  }
}

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
$header = array(
'  <link rel="stylesheet" type="text/css" href="../files/addons/'.$myself.'/backend.css" media="screen, projection, print" />'
);

if ($REX['REDAXO']) {
  rex_register_extension('PAGE_HEADER', 'rexdev_header_add',$header);
}



?>