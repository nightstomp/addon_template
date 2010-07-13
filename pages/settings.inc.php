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

// echo '<pre>'.var_export($_REQUEST,true).'</pre>';}

// ADDON PARAMETER AUS URL HOLEN
////////////////////////////////////////////////////////////////////////////////
$myself    = rex_request('page'   , 'string');
$subpage   = rex_request('subpage', 'string');
$minorpage = rex_request('minorpage', 'string');
$func      = rex_request('func'   , 'string');

// ADDON RELEVANTES AUS $REX HOLEN
////////////////////////////////////////////////////////////////////////////////
$myREX = $REX['ADDON'][$myself];

// FORMULAR PARAMETER SPEICHERN
////////////////////////////////////////////////////////////////////////////////
if ($func == 'savesettings')
{
  $content = '';
  foreach($_GET as $key => $val)
  {
    if(!in_array($key,array('page','subpage','minorpage','func','submit','PHPSESSID')))
    {
      $myREX['settings'][$key] = $val;
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

// SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$tmp = new rex_select();                                   // rex_select Objekt initialisieren
$tmp->setSize(1);                                          // 1 Zeilen = normale Selectbox
$tmp->setName('select');
$tmp->addOption('inaktiv',0);                              // Beschreibung ['string'], Wert [int|'string']
$tmp->addOption('foo..',1);
$tmp->addOption('bar..',2);
$tmp->setSelected($myREX['settings']['select']);      // gespeicherte Werte einsetzen
$select = $tmp->get();                                // HTML in Variable speichern

// MULTISELECT BOX
////////////////////////////////////////////////////////////////////////////////
$tmp = new rex_select();                                   // rex_select Objekt initialisieren
$tmp->setSize(4);                                          // angezeigte Zeilen, Rest wird gescrollt
$tmp->setMultiple(true);
$tmp->setName('multiselect[]');                       // abschließendes [] wichtig!
$tmp->addOption('Nein',1);                                 // Beschreibung ['string'], Wert [int|'string']
$tmp->addOption('blah..',2);
$tmp->addOption('fasel..','fasel');
$tmp->setSelected($myREX['settings']['multiselect']); // gespeicherte Werte einsetzen
$multiselect = $tmp->get();                           // HTML in Variable speichern

// MEDIA BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // eindeutige Button ID
$mp = 7;                                                   // ID der auzurufenden Medienpool Kategorie
$tmp = rex_input::factory('mediabutton');                  // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setCategoryId($mp);                                  // Medienpool Kategorie ID
$tmp->setValue($myREX['settings']['MEDIA'][$id]);          // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'MEDIA['.$id.']');
$MediaButton1 = $tmp->getHtml();

// MEDIALIST BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // eindeutige Button ID
$mp = 4;                                                   // ID der auzurufenden Medienpool Kategorie
$tmp = rex_input::factory('medialistbutton');              // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setCategoryId($mp);                                  // Medienpool Kategorie ID
$tmp->setValue($myREX['settings']['MEDIALIST'][$id]);      // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'MEDIALIST['.$id.']');
$MediaList2 = $tmp->getHtml();

// LINK BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // eindeutige Button ID
$tmp = rex_input::factory('linkbutton');              // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setValue($myREX['settings']['LINK'][$id]);      // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'LINK['.$id.']');
$Link1 = $tmp->getHtml();

// LINK BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // eindeutige Button ID
$tmp = rex_input::factory('linklistbutton');              // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setValue($myREX['settings']['LINKLIST'][$id]);      // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'LINKLIST['.$id.']');
$Linklist1 = $tmp->getHtml();

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
                <input id="textinput1" class="rex-form-text" type="text" name="textinput1" value="'.stripslashes($myREX['settings']['textinput1']).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-textarea">
                <label for="textarea1">Eine Textarea</label>
                <textarea id="textarea1" cols="50" rows="6" class="rex-form-textarea" name="textarea1">'.stripslashes($myREX['settings']['textarea1']).'</textarea>
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
                '.$select.'
              </p>
            </div><!-- .rex-form-row -->

          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-select">
              <label for="demo_multiselect">Multi-Selectbox</label>
                '.$multiselect.'
            </p>
          </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Medienpool Dateien</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <div class="rex-form-col-a">
              <label for="REX_MEDIA_1">Mediabutton</label>
            '.$MediaButton1.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <div class="rex-form-col-a">
                <label for="REX_MEDIALIST_1">Medialist</label>
               '.$MediaList1.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Artikel links</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <div class="rex-form-col-a">
                <label for="REX_LINK_1">Linkbutton</label>
               '.$Link1.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <div class="rex-form-col-a">
                <label for="REX_LINKLIST_1">Linkbutton</label>
               '.$Linklist1.'
              </div><!-- .rex-form-col-a -->
            </div><!-- .rex-form-row -->

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