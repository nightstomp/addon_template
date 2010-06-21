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

// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'addon_template';
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself;

// ADDON VERSION
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['VERSION'] = array(
'VERSION'      => 0,
'MINORVERSION' => 5,
'SUBVERSION'   => 0
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

// DYNAMIC ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["addon_template"]["option1"] = 2;
$REX["ADDON"]["addon_template"]["option2"] = 1;
// --- /DYN

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