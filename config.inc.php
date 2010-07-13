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
'MINORVERSION' => 1,
'SUBVERSION'   => 0
);

// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself] = '720';
$REX['ADDON']['page'][$myself] = $myself;
$REX['ADDON']['name'][$myself] = 'Addon Template';
$REX['ADDON'][$myself]['revision'] = ereg_replace('[^0-9]','',"$Revision$");
$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']).' SVN #'.$REX['ADDON'][$myself]['revision'];
$REX['ADDON']['author'][$myself] = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself] = $myself.'[]';
$REX['PERM'][] = $myself.'[]';

// ADDON SETTINGS
////////////////////////////////////////////////////////////////////////////////
/* dynamisch: Werte kommen aus dem "Einstellungen" Formular */
// --- DYN
$REX["ADDON"]["addon_template"]["settings"]["textinput1"] = '$irgendwas..';
$REX["ADDON"]["addon_template"]["settings"]["textarea1"] = 'fasel \"blub\" \'bäh\' isoleé';
$REX["ADDON"]["addon_template"]["settings"]["demo_select"] = '1';
$REX["ADDON"]["addon_template"]["settings"]["demo_multiselect"] = array (
  0 => '2',
  1 => 'fasel',
);
$REX["ADDON"]["addon_template"]["settings"]["MEDIA"] = array (
  1 => 'screenshot_content_edit.png',
);
$REX["ADDON"]["addon_template"]["settings"]["MEDIALIST"] = array (
  1 => 'button.gif,redaxo_logo_klein.gif,linie_start_block.gif',
);
$REX["ADDON"]["addon_template"]["settings"]["rex-component-rss-reader_state"] = 'minimized';
$REX["ADDON"]["addon_template"]["settings"]["rex-component-notifications_state"] = 'minimized';
$REX["ADDON"]["addon_template"]["settings"]["rex-component-userinfo-media_state"] = 'maximized';
$REX["ADDON"]["addon_template"]["settings"]["rex-component-userinfo-articles_state"] = 'maximized';
// --- /DYN

/* fixe Einstellungen */
$REX["ADDON"]["addon_template"]["settings"]["debug"] = true;

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