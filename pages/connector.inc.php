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

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself  = rex_request('page',    'string');
$subpage = rex_request('subpage', 'string');
$func    = rex_request('func', 'string');

// MAIN
////////////////////////////////////////////////////////////////////////////////
$addonroot = $REX['INCLUDE_PATH']. '/addons/'.$myself.'/';

switch($func)
{
  case '':
    $html = rexdev_incparse($addonroot.'pages/','_connector_explanation.textile','textile',true);
    $html = str_replace('addon_template',$myself,$html);
    echo $html;
    break;

  case 'css':
    rexdev_incparse($addonroot.'files/','backend.css','raw');
    break;

}
?>