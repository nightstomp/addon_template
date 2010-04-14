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

// SUBNAVIGATION ITEMS
////////////////////////////////////////////////////////////////////////////////
$chapterpages = array (
''           => array('Readme','_readme.txt','textile'),
'changelog'  => array('Changelog','_changelog.txt','textile'),
'iframelink' => array('Externer link (iframe)','http://rexdev.de','iframe'),
'newwinlink' => array('Externer link (neues Fenster)','http://rexdev.de','jsopenwin'),
'php'        => array('PHP include','pages/php_include_examle.php','php')
);

// BUILD CHAPTER NAVIGATION
////////////////////////////////////////////////////////////////////////////////
$chapternav = '';
foreach ($chapterpages as $chapterparam => $chapterprops)
{
  if ($chapter != $chapterparam) {
    $chapternav .= ' | <a href="?page='.$myself.'&subpage=help&chapter='.$chapterparam.'">'.$chapterprops[0].'</a>';
  } else {
    $chapternav .= ' | '.$chapterprops[0];
  }
}
$chapternav = ltrim($chapternav, " | ");

// SWITCH PARSEMODES & BUILD OUTPUT
////////////////////////////////////////////////////////////////////////////////
$addonroot = $REX['INCLUDE_PATH']. '/addons/'.$myself.'/';
$source    = $chapterpages[$chapter][1];
$parse     = $chapterpages[$chapter][2];

function get_include_contents($filename) {
  if (is_file($filename)) {
    ob_start();
    include $filename;
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }
  return false;
}

switch ($parse)
{
  case 'textile':
  $source = $addonroot.$source;
  $content = file_get_contents($source);
  $html = textile_parser($content);
  break;
  
  case 'txt':
  $source = $addonroot.$source;
  $content = file_get_contents($source);
  $html =  '<pre class="plain">'.$content.'</pre>';
  break;
  
  case 'raw':
  $source = $addonroot.$source;
  $content = file_get_contents($source);
  $html = $content;
  break;
  
  case 'php':
  $source = $addonroot.$source;
  $html =  get_include_contents($source);
  break;
  
  case 'iframe':
  $html = '<iframe src="'.$source.'" width="99%" height="600px"></iframe>';
  break;
  
  case 'jsopenwin':
  $html = 'Externer link: <a href="'.$source.'">'.$source.'</a>
  <script language="JavaScript">
  <!--
  window.open(\''.$source.'\',\''.$chapterpages[$chapter][1].'\');
  //-->
  </script>';
  break;
}

// ADDON OUTPUT
////////////////////////////////////////////////////////////////////////////////
echo '
<div class="rex-addon-output">
  <h2 class="rex-hl2" style="font-size:1em">'.$chapternav.'</h2>
  <div class="rex-addon-content">
    <div class= "rexdev">
    '.$html.'
    </div>
  </div>
</div>';

?>