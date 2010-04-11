<?php
/**
* Addon_Template
*
* @author <a href="http://rexdev.de">rexdev.de</a>
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