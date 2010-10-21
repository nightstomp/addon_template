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
/*ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'On');*/

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
$REX['ADDON']['name'][$myself] = $myself;
$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself] = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['PERM'][] = $myself.'[]';

// DYNAMISCHE SETTINGS
////////////////////////////////////////////////////////////////////////////////
/* dynamisch: Werte kommen aus dem "Einstellungen" Formular */
// --- DYN
$REX["ADDON"][$myself]["settings"]["TEXTINPUT"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["TEXTAREA"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["SELECT"] = array (
  1 => '0',
);
$REX["ADDON"][$myself]["settings"]["MULTISELECT"] = array (
  1 =>
  array (
    0 => '0',
    1 => '1',
    2 => 'blau',
  ),
);
$REX["ADDON"][$myself]["settings"]["MEDIA"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["MEDIALIST"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["LINK"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["LINK_NAME"] = array (
  1 => '',
);
$REX["ADDON"][$myself]["settings"]["LINKLIST"] = array (
  1 => '',
);
// --- /DYN

// HIDDEN SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['settings']['rex_list_pagination'] = 20;

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

// SUBPAGES
//////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Einstellungen'               ,''     ,''                   ,''),
  array ('database' ,'Datenbank'                   ,''     ,''                   ,''),
  array ('modul'    ,'Modul'                       ,''     ,''                   ,''),
  array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
  array ('connector','Connector (faceless subpage)',''     ,array('faceless'=>1) ,array('class'=>'jsopenwin'))
);
