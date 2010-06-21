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

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself  = rex_request('page',    'string'); /* ADDON IDENTIFIER */
$subpage = rex_request('subpage', 'string');
$chapter = rex_request('chapter', 'string');
$func    = rex_request('func',    'string');

echo '<div class="rex-addon-output">
  <h2 class="rex-hl2" style="font-size:1em">Überschrift..</h2>
  <div class="rex-addon-content">
  <div class="addon-template">';


/* ---------------------------- ADDON PAYLOAD ------------------------------- */

echo '..was auch immer das Addon "'.$myself.'" tut und ausgibt..';

/* --------------------------- /ADDON PAYLOAD ------------------------------- */

echo '</div>
</div>
</div>';

?>