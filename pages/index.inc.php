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
$myself   = rex_request('page', 'string');
$subpage  = rex_request('subpage', 'string');
$faceless = rex_request('faceless', 'string');

if($faceless != 1)
{
  // REX BACKEND LAYOUT TOP
  //////////////////////////////////////////////////////////////////////////////
  require $REX['INCLUDE_PATH'] . '/layout/top.php';

  // DEFINE SUBPAGES
  //////////////////////////////////////////////////////////////////////////////
  $subpages = array (
    //     subpage    ,label                         ,perm   ,params               ,attributes
    array (''         ,'Einstellungen'               ,''     ,''                   ,''),
    array ('database' ,'Datenbank'                   ,''     ,''                   ,''),
    array ('modul'    ,'Modul'                       ,''     ,''                   ,''),
    array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
    array ('connector','Connector (faceless subpage)',''     ,array('faceless'=>1) ,array('class'=>'jsopenwin'))
  );

  // TITLE & SUBPAGE NAVIGATION
  //////////////////////////////////////////////////////////////////////////////
  rex_title($REX['ADDON']['name'][$myself].' <span class="addonversion">'.$REX['ADDON']['version'][$myself].'</span>', $subpages);

  // INCLUDE REQUESTED SUBPAGE
  //////////////////////////////////////////////////////////////////////////////
  if(!$subpage)
  {
    $subpage = 'settings';  /* DEFAULT SUBPAGE */
  }
  require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';

  // JS SCRIPT FÜR LINKS IN NEUEN FENSTERN (per <a class="jsopenwin">)
  ////////////////////////////////////////////////////////////////////////////////
  echo '
  <script type="text/javascript">
  // onload
  window.onload = externalLinks;

  // http://www.sitepoint.com/article/standards-compliant-world
  function externalLinks()
  {
   if (!document.getElementsByTagName) return;
   var anchors = document.getElementsByTagName("a");
   for (var i=0; i<anchors.length; i++)
   {
     var anchor = anchors[i];
     if (anchor.getAttribute("href"))
     {
       if (anchor.getAttribute("class") == "jsopenwin")
       {
       anchor.target = "_blank";
       }
     }
   }
  }
  </script>
  ';

  // REX BACKEND LAYOUT BOTTOM
  //////////////////////////////////////////////////////////////////////////////
  require $REX['INCLUDE_PATH'] . '/layout/bottom.php';
}
else
{
  require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';
}
