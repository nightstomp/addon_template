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

$REX['ADDON']['install'][$myself] = 0;

?>