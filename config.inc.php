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
$mypage = explode('/redaxo/include/addons/',str_replace(DIRECTORY_SEPARATOR, '/' ,__FILE__));
$mypage = explode('/',$mypage[1]);
$mypage = $mypage[0];
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/';


// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$mypage] = '720';
$REX['ADDON']['page'][$mypage] = $mypage;
$REX['ADDON']['name'][$mypage] = $mypage;
$Revision = '';
$REX['ADDON'][$mypage]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 1,
'SUBVERSION'   => preg_replace('/[^0-9]/','',"$Revision$")
);
$REX['ADDON']['version'][$mypage]     = implode('.', $REX['ADDON'][$mypage]['VERSION']);
$REX['ADDON']['author'][$mypage]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$mypage]        = $mypage.'[]';
$REX['PERM'][]                        = $mypage.'[]';


// STATIC ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$mypage]['rex_list_pagination'] = 20;
$REX['ADDON'][$mypage]['params_cast'] = array (
  'page'        => 'unset',
  'subpage'     => 'unset',
  'minorpage'   => 'unset',
  'func'        => 'unset',
  'submit'      => 'unset',
  'sendit'      => 'unset',
  'PHPSESSID'   => 'unset',
  );

// DYNAMISCHE SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["addon_template"]["settings"] = array (
  'TEXTINPUT' => 
  array (
    1 => 'Textfeld 1',
  ),
  'TEXTAREA' => 
  array (
    1 => 'Textarea 1',
  ),
  'SELECT' => 
  array (
    1 => '1',
  ),
  'MULTISELECT' => 
  array (
    1 => 
    array (
      0 => '1',
    ),
  ),
  'MEDIA' => 
  array (
    1 => '',
  ),
  'MEDIALIST' => 
  array (
    1 => '',
  ),
  'LINK' => 
  array (
    1 => '',
  ),
  'LINK_NAME' => 
  array (
    1 => '',
  ),
  'LINKLIST' => 
  array (
    1 => '',
  ),
);
// --- /DYN


// AUTO INCLUDE FUNCTIONS & CLASSES
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'])
{
  $pattern = $myroot.'functions/function.*.inc.php';
  $include_files = glob($pattern);
  if(is_array($include_files) && count($include_files) > 0){
     foreach ($include_files as $include)
     {
       require_once $include;
     }
  }
  
  $pattern = $myroot.'classes/class.*.inc.php';
  $include_files = glob($pattern);
  
  if(is_array($include_files) && count($include_files) > 0){
     foreach ($include_files as $include)
     {
       require_once $include;
     }
  }
}

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
$header = '  <link rel="stylesheet" type="text/css" href="../files/addons/'.$mypage.'/backend.css" media="screen, projection, print" />';

if ($REX['REDAXO']) {
  rex_register_extension('PAGE_HEADER', 'rexdev_header_add',array($header));
}

// SUBPAGES
//////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$mypage]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Einstellungen'               ,''     ,''                   ,''),
  array ('database' ,'Datenbank'                   ,''     ,''                   ,''),
  array ('modul'    ,'Modul'                       ,''     ,''                   ,''),
  array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
  array ('connector','Connector (faceless subpage)',''     ,array('faceless'=>1) ,array('class'=>'jsopenwin'))
);
