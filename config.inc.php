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

// ADDON IDENTIFIER
////////////////////////////////////////////////////////////////////////////////
$myself = "addon_template";

// ADDON VERSION
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['VERSION'] = array(
'VERSION'      => 1,
'MINORVERSION' => 0,
'SUBVERSION'   => 0,
'REVISION'     => intval(ereg_replace('[^0-9]',"","$Revision$"))
);

$commonversion = $REX['ADDON'][$myself]['VERSION'];
array_pop($commonversion);
$commonversion = implode('.', $commonversion);

// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself] = '0000';
$REX['ADDON']['page'][$myself] = $myself;
$REX['ADDON']['name'][$myself] = 'Addon Template';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['ADDON']['version'][$myself] = $commonversion;
$REX['ADDON']['author'][$myself] = "rexdev.de";
$REX['ADDON']['supportpage'][$myself] = "forum.redaxo.de";
$REX['PERM'][] = $myself.'[]';

// DYNAMIC ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX['ADDON']['addon_template']['foo'] = 2; 
$REX['ADDON']['addon_template']['bar'] = 1;
// --- /DYN

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO']) {
  require_once $REX['INCLUDE_PATH'].'/addons/'.$myself.'/functions/function.rex_'.$myself.'_css_add.inc.php';
  rex_register_extension('PAGE_HEADER', 'rex_'.$myself.'_css_add');
}


?>