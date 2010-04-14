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

// ADDON IDENTIFIER
////////////////////////////////////////////////////////////////////////////////
$myself = "addon_template";

// INSTALL CONDITIONS
////////////////////////////////////////////////////////////////////////////////
$do_install = true;
$requiered_PHP = 5;
$requiered_addons = array('phpmailer','textile');

/* PHP CHECK */
if (intval(PHP_VERSION) < $requiered_PHP)
{
	$REX['ADDON']['installmsg'][$myself] = 'Dieses Addon ben&ouml;tigt mind. PHP '.$requiered_PHP.'!';
	$REX['ADDON']['install'][$myself] = 0;
	$do_install = false;
}

/* ADDONS CHECK */
foreach($requiered_addons as $a)
{
  if (!OOAddon::isInstalled($a))
  {
    $REX['ADDON']['installmsg'][$myself] = '<br />Addon "'.$a.'" ist nicht installiert.  >>> <a href="index.php?page=addon&addonname='.$a.'&install=1">jetzt installieren</a> <<<';
    $do_install = false;
  }
  else
  {
    if (!OOAddon::isAvailable($a))
    {
      $REX['ADDON']['installmsg'][$myself] = '<br />Addon "'.$a.'" ist nicht aktiviert.  >>> <a href="index.php?page=addon&addonname='.$a.'&activate=1">jetzt aktivieren</a> <<<';
      $do_install = false;
    }
    
  }
}

if ($do_install)
{ 
	$REX['ADDON']['install'][$myself] = 1;
}


?>