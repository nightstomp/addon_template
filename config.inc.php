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
$REX['ADDON']['rxid'][$myself] = '0000';
$REX['ADDON']['page'][$myself] = $myself;
$REX['ADDON']['name'][$myself] = 'Addon Template';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself] = "rexdev.de";
$REX['ADDON']['supportpage'][$myself] = "forum.redaxo.de";
$REX['PERM'][] = $myself.'[]';

// CONTROL AUTOMATED INCLUDES
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['autoincludes'] = array(
'functions'  => true,
'classes'    => true
);

// DYNAMIC ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["addon_template"]["option1"] = 2; 
$REX["ADDON"]["addon_template"]["option2"] = 1;
// --- /DYN

// INCLUDES
////////////////////////////////////////////////////////////////////////////////
$staticfunctions = array(
  'function.rexdev_scandir.inc.php',
  'function.textile_parser.inc.php',
  'function.rex_addon_template_css_add.inc.php'
);

if ($REX['REDAXO']) {
  // STATIC
  foreach($staticfunctions as $include) {
    require_once $myroot.'/functions/'.$include;
  }
  
  // AUTO INCLUDE FUNCTIONS
  if($REX['ADDON'][$myself]['autoincludes']['functions']) {
    $autofunctions = rexdev_scandir($myroot.'/functions',1,$staticfunctions,array('function.*'));
    if($autofunctions) {
      foreach($autofunctions['files'] as $include) {
        require_once $myroot.'/functions/'.$include;
      }
    }
  }
  
  // AUTO INCLUDE CLASSES
  if($REX['ADDON'][$myself]['autoincludes']['classes']) {
    $autoclasses = rexdev_scandir($myroot.'/classes',1,array(),array('class.*'));
    if($autoclasses) {
      foreach($autoclasses['files'] as $include) {
        require_once $myroot.'/classes/'.$include;
      }
    }
    
  }
}

// BACKEND CSS
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO']) {
  require_once $REX['INCLUDE_PATH'].'/addons/'.$myself.'/functions/function.rex_'.$myself.'_css_add.inc.php';
  rex_register_extension('PAGE_HEADER', 'rex_'.$myself.'_css_add');
}


?>