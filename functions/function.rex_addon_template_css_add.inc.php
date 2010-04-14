<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4.2
* @version 1.0
* $Id$: 
*/

function rex_addon_template_css_add($params) {
  $n ="\n";
  $params['subject'] .= $n.'<link rel="stylesheet" type="text/css" href="../files/addons/addon_template/rex_addon_template_backend.css" />'.$n;
  return $params['subject'];
}
?>