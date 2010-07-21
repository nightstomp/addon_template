<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4.3
* @version 0.1
* $Id$:
*/

// ERROR_REPORTING
////////////////////////////////////////////////////////////////////////////////
@ ini_set('error_reporting', E_ALL);
@ ini_set('display_errors', On);

// ADDON IDENTIFIER AUS ORDNERNAMEN ABLEITEN
////////////////////////////////////////////////////////////////////////////////
$myself = explode('/redaxo/include/addons/',str_replace(DIRECTORY_SEPARATOR, '/' ,__FILE__));
$myself = explode('/',$myself[1]);
$myself = $myself[0];
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/';

// ADDON VERSION
////////////////////////////////////////////////////////////////////////////////
$Revision = '';
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 1,
'SUBVERSION'   => preg_replace('/[^0-9]/','',"$Revision$")
);

// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself] = '720';
$REX['ADDON']['page'][$myself] = $myself;
$REX['ADDON']['name'][$myself] = 'Addon Template';
$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself] = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['PERM'][] = $myself.'[]';

// ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
/* dynamisch: Werte kommen aus dem "Einstellungen" Formular */
// --- DYN
$REX["ADDON"]["addon_template"]["settings"]["TEXTINPUT"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["TEXTAREA"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["SELECT"] = array (
  1 => '0',
);
$REX["ADDON"]["addon_template"]["settings"]["MULTISELECT"] = array (
  1 =>
  array (
    0 => '0',
    1 => '1',
    2 => 'blau',
  ),
);
$REX["ADDON"]["addon_template"]["settings"]["MEDIA"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["MEDIALIST"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["LINK"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["LINK_NAME"] = array (
  1 => '',
);
$REX["ADDON"]["addon_template"]["settings"]["LINKLIST"] = array (
  1 => '',
);
// --- /DYN

// AUTO INCLUDE FUNCTIONS & CLASSES
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'])
{
  foreach (glob($myroot.'functions/function.*.inc.php') as $include)
  {
    require_once $include;
  }

  foreach (glob($myroot.'classes/class.*.inc.php') as $include)
  {
    require_once $include;
  }
}

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
$header = '  <link rel="stylesheet" type="text/css" href="../files/addons/'.$myself.'/backend.css" media="screen, projection, print" />';

if ($REX['REDAXO']) {
  rex_register_extension('PAGE_HEADER', 'rexdev_header_add',array($header));
}


?>