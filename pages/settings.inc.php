<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4
* @version 1.0
* $MID: settings.inc.php 30 2010-06-21 02:58:00Z jeffe $:
*/

// DEBUG MODE
////////////////////////////////////////////////////////////////////////////////
$db = $REX['ADDON']['addon_template']['settings']['debug'];

// ADDON PARAMETER AUS URL HOLEN
////////////////////////////////////////////////////////////////////////////////
$myself    = rex_request('page'   , 'string');
$subpage   = rex_request('subpage', 'string');
$minorpage = rex_request('minorpage', 'string');
$func      = rex_request('func'   , 'string');

// FORMULAR PARAMETER SPEICHERN
////////////////////////////////////////////////////////////////////////////////
if ($func == 'savesettings')
{
  $content = '';
  foreach($_REQUEST as $key => $val)
  {
    if(!in_array($key,array('page','subpage','minorpage','func','submit','PHPSESSID')))
    {
      $REX['ADDON'][$myself]['settings'][$key] = $val;
      if(is_array($val))
      {
        $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = '.var_export($val,true).';'."\n";
      }
      else
      {
        $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = \''.$val.'\';'."\n";
      }
    }
  }
  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  echo rex_info('Einstellungen wurden gespeichert.');
}

// EINFACHE SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$demo_select = new rex_select();
$demo_select->setSize(1);
$demo_select->setName('demo_select');
$demo_select->addOption('inaktiv',0);
$demo_select->addOption('foo..',1);
$demo_select->addOption('bar..',2);
$demo_select->setSelected($REX['ADDON']['addon_template']['settings']['demo_select']);

// MULTI SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$demo_multiselect = new rex_select();
$demo_multiselect->setSize(4);
$demo_multiselect->setMultiple(true);
$demo_multiselect->setName('demo_multiselect');
$demo_multiselect->addOption('Nein',1);
$demo_multiselect->addOption('blah..',2);
$demo_multiselect->addOption('fasel..','fasel');
$demo_multiselect->setSelected($REX['ADDON']['addon_template']['settings']['demo_multiselect']);

// MEDIA BUTTON
////////////////////////////////////////////////////////////////////////////////
/*works*/
$MediaButton1 = rex_input::factory('mediabutton');
$MediaButton1->setButtonId(1);
$MediaButton1->setCategoryId(1);
$MediaButton1->setValue($REX["ADDON"]["addon_template"]["settings"]["MEDIA"][1]);
$MediaButton1->setAttribute('name', 'MEDIA[1]');
$MediaButton1 = $MediaButton1->getHtml();

/* WORKS */
$MediaButton2 = rex_var_media::getMediaButton(2,1);
$MediaButton2 = str_replace('REX_MEDIA[2]',$REX["ADDON"]["addon_template"]["settings"]["MEDIA"][2],$MediaButton2);

/* NOT */
$MediaButton3 = new rex_input_mediabutton();
$MediaButton3->setButtonId(3);
$MediaButton3->setCategoryId(1);
$MediaButton3->setValue($REX["ADDON"]["addon_template"]["settings"]["MEDIA"][3]);
$MediaButton3->setTypes('name', 'MEDIA[3]');
$MediaButton3 = $MediaButton3->getHtml();


/*if($db){echo '<pre>'.var_export($_REQUEST,true).'</pre>';}
    // rexTinyMCEEditor-Klasse
    include_once $REX['INCLUDE_PATH'] . '/addons/tinymce/classes/class.tinymce.inc.php';
    // Funktionen für TinyMCE
    include_once $REX['INCLUDE_PATH'] . '/addons/tinymce/functions/function_rex_tinymce.inc.php';

    // Kompatibilitäts-Funktionen
    include_once $REX['INCLUDE_PATH'] . '/addons/tinymce/functions/function_rex_compat.inc.php';*/

echo '
<div class="rex-addon-output">
  <div class="rex-form">

  <form action="index.php" method="get" id="settings">
    <input type="hidden" name="page" value="'.$myself.'" />
    <input type="hidden" name="subpage" value="'.$subpage.'" />
    <input type="hidden" name="func" value="savesettings" />

        <fieldset class="rex-form-col-1">
          <legend>Texteingabe</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="textinput1">Ein Textfeld</label>
                <input id="textinput1" class="rex-form-text" type="text" name="textinput1" value="'.stripslashes($REX['ADDON'][$myself]['settings']['textinput1']).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-textarea">
                <label for="textarea1">Eine Textarea</label>
                <textarea id="textarea1" cols="50" rows="6" class="rex-form-textarea" name="textarea1">'.stripslashes($REX['ADDON'][$myself]['settings']['textarea1']).'</textarea>
              </p>
            </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Selectboxen</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-select">
                <label for="demo_select">Selectbox</label>
                '.$demo_select->get().'
              </p>
            </div><!-- .rex-form-row -->

          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-select">
              <label for="demo_multiselect">Multi-Selectbox</label>
                '.$demo_multiselect->get().'
            </p>
          </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Medienpool Dateien</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <div class="rex-form-col-a">
              <label for="REX_MEDIA_1">Mediabutton 1</label>
            '.$MediaButton1.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <div class="rex-form-col-a">
              <label for="REX_MEDIA_2">Mediabutton 2</label>
            '.$MediaButton2.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <div class="rex-form-col-a">
              <label for="REX_MEDIA_'.$MID.'">Mediabutton</label>
'
//.rex_input_mediabutton(1,1,'blah.gif')
//.$MEDIA->getHtml()
.$MediaButton3
//.rex_var_media::getMediaButton(1,1,array('blah.gif'))
.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <div class="rex-form-col-a">
                <label for="REX_MEDIALIST_1">Medialist</label>
'.rex_var_media::getMediaListButton(1,$REX['ADDON'][$myself]['settings']['MEDIALIST'][1]).'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Artikel links</legend>
          <div class="rex-form-wrapper">

          <div class="rex-form-row rex-form-element-v2">
            <p class="rex-form-submit">
              <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Einstellungen speichern" />
            </p>
          </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

  </form>

  </div><!-- .rex-form -->
</div><!-- .rex-addon-output -->
';
?>