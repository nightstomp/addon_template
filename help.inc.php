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

// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = rex_request('addonname','string');
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/';

// LOCAL INCLUDES
////////////////////////////////////////////////////////////////////////////////
require_once $myroot.'/functions/function.rexdev_incparse.inc.php';

// HELP CONTENT
////////////////////////////////////////////////////////////////////////////////
$help_includes = array
(
  'Hilfe'     => array('_readme.txt','textile'),
  'Changelog' => array('_changelog.txt','textile')
);

// MAIN
////////////////////////////////////////////////////////////////////////////////
foreach($help_includes as $k => $v)
{
  if(file_exists($myroot.$v[0]))
  {
    echo '
    <div class="rex-addon-output" style="overflow:auto">
      <h2 class="rex-hl2" style="font-size:1em">'.$k.' <span style="color: gray; font-style: normal; font-weight: normal;">( '.$v[0].' )</span></h2>
      <div class="rex-addon-content">
        <div class="'.$myself.'">
          '.rexdev_incparse($myroot,$v[0],$v[1],true).'
        </div>
      </div>
    </div>';
  }
}


?>