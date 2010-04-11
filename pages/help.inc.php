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

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself  = rex_request('page',    'string'); /* ADDON IDENTIFIER */
$subpage = rex_request('subpage', 'string');
$chapter = rex_request('chapter', 'string');
$func    = rex_request('func',    'string');

// SUBNAVIGATION ITEMS
////////////////////////////////////////////////////////////////////////////////
$chapterpages = array (
''             => 'Addon Hilfe', 
'changelog'    => 'Addon Changelog', 
'libchangelog' => 'FirePHP Changelog',
'libreadme'    => 'FirePHP Readme',
'liblicense'   => 'FirePHP License',
'libcredits'   => 'FirePHP Credits'
);

// BUILD HELP SUBNAVIGATION
////////////////////////////////////////////////////////////////////////////////
$chapternav = '';
foreach ($chapterpages as $thischapter => $chaptertitle)
{
  if ($chapter != $thischapter)
  {
  $chapternav .= ' | <a href="?page='.$myself.'&subpage=help&chapter='.$thischapter.'">'.$chaptertitle.'</a>';
  }
  else
  {
  $chapternav .= ' | '.$chaptertitle;
  }
}
$chapternav = ltrim($chapternav, " | ")

// ASSIGN INCLUDE FILES
////////////////////////////////////////////////////////////////////////////////
switch ($chapter)
{
  case 'changelog':
    $file = '_changelog.txt';
    $parse = true;
    break;
  case 'libchangelog':
    $file = $active_lib.'/CHANGELOG';
    $parse = false;
    break;
  case 'liblicense':
    $file = $active_lib.'/lib/FirePHPCore/LICENSE';
    $parse = false;
    break;
  case 'libreadme':
    $file = $active_lib.'/README';
    $parse = false;
    break;
  case 'libcredits':
    $file = $active_lib.'/CREDITS';
    $parse = false;
    break;
    
  default:
    $file = '_readme.txt';
    $parse = true;
}

echo '<div class="rex-addon-output">
  <h2 class="rex-hl2" style="font-size:1em">'.$chapternav.'</h2>
  <div class="rex-addon-content">
  <div class= "firephp">';

$file = $REX['INCLUDE_PATH']. '/addons/'.$myself.'/'.$file;
$fh = fopen($file, 'r');
$content = fread($fh, filesize($file));
if ($parse == true)
{
$textile = htmlspecialchars_decode($content);
$textile = str_replace("<br />","",$textile);
$textile = str_replace("&#039;","'",$textile);
if (strpos($REX['LANG'],'utf'))
{
  echo rex_a79_textile($textile);
}
else
{
  echo utf8_decode(rex_a79_textile($textile));
}
}
else
{
  echo '<pre class="plain">'.$content.'</pre>';
}

echo '</div>
</div>
</div>';


?>