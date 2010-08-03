<?php
/**
* Addon_Template
*
* @author http://rexdev.de
* @link   http://www.redaxo.de/180-0-addon-details.html?addon_id=720
*
* @package redaxo4.3
* @version 0.1
* $MID: settings.inc.php 30 2010-06-21 02:58:00Z jeffe $:
*/

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
        if(is_numeric($val))
        {
          $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = '.$val.';'."\n";
        }
        else
        {
          $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = \''.$val.'\';'."\n";
        }
      }
    }
  }

  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  echo rex_info('Einstellungen wurden gespeichert.');
}

// SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                      // ID dieser Select Box
$tmp = new rex_select();                                      // rex_select Objekt initialisieren
$tmp->setSize(1);                                             // 1 Zeilen = normale Selectbox
$tmp->setName('SELECT['.$id.']');
$tmp->addOption('nein',0);                                    // Beschreibung ['string'], Wert [int|'string']
$tmp->addOption('ja',1);
$tmp->addOption('eventuell','evtl');
$tmp->setSelected($myREX['settings']['SELECT'][$id]);         // gespeicherte Werte einsetzen
$select = $tmp->get();                                        // HTML in Variable speichern

// MULTISELECT BOX
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                      // ID dieser MultiSelect Box
$tmp = new rex_select();                                      // rex_select Objekt initialisieren
$tmp->setSize(4);                                             // angezeigte Zeilen, Rest wird gescrollt
$tmp->setMultiple(true);
$tmp->setName('MULTISELECT['.$id.'][]');                      // abschließendes [] wichtig!
$tmp->addOption('rot',0);                                     // Beschreibung ['string'], Wert [int|'string']
$tmp->addOption('grün',1);
$tmp->addOption('blau','blau');
if(isset($myREX['settings']['MULTISELECT'][$id]))             // evtl. keine Werte -> prüfen ob was gespeichert
{
  $tmp->setSelected($myREX['settings']['MULTISELECT'][$id]);  // gespeicherte Werte einsetzen
}
$multiselect = $tmp->get();                                   // HTML in Variable speichern

// CHECKBOX
////////////////////////////////////////////////////////////////////////////////
/* todo */

// RADIOBUTTON
////////////////////////////////////////////////////////////////////////////////
/* todo */

// MEDIA BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // ID dieses Mediabuttons
$mp = 7;                                                   // ID der auzurufenden Medienpool Kategorie
$tmp = rex_input::factory('mediabutton');                  // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setCategoryId($mp);                                  // Medienpool Kategorie ID
$tmp->setValue($myREX['settings']['MEDIA'][$id]);          // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'MEDIA['.$id.']');
$MediaButton1 = $tmp->getHtml();

// MEDIALIST BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // ID dieses MediaListbuttons
$mp = 4;                                                   // ID der auzurufenden Medienpool Kategorie
$tmp = rex_input::factory('medialistbutton');              // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setCategoryId($mp);                                  // Medienpool Kategorie ID
$tmp->setValue($myREX['settings']['MEDIALIST'][$id]);      // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'MEDIALIST['.$id.']');
$MediaList1 = $tmp->getHtml();

// LINK BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // ID dieses Linkbuttons
$tmp = rex_input::factory('linkbutton');                   // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setValue($myREX['settings']['LINK'][$id]);           // gespeicherte Werte einsetzen
$tmp->setAttribute('name', 'LINK['.$id.']');
$Link1 = $tmp->getHtml();

// LINKLIST BUTTON
////////////////////////////////////////////////////////////////////////////////
$id = 1;                                                   // ID dieses LinkListbuttons
$tmp = rex_input::factory('linklistbutton');               // Objekt initialisieren
$tmp->setButtonId($id);                                    // Button ID
$tmp->setValue($myREX['settings']['LINKLIST'][$id]);       // gespeicherte Werte einsetzen
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
                <input id="textinput1" class="rex-form-text" type="text" name="TEXTINPUT[1]" value="'.stripslashes($myREX['settings']['TEXTINPUT'][1]).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-textarea">
                <label for="textarea1">Eine Textarea</label>
                <textarea id="textarea1" cols="50" rows="6" class="rex-form-textarea" name="TEXTAREA[1]">'.stripslashes($myREX['settings']['TEXTAREA'][1]).'</textarea>
              </p>
            </div><!-- .rex-form-row -->

          </div><!-- .rex-form-wrapper -->
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Auswahl von Werten</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-select">
                <label for="select">Selectbox</label>
                '.$select.'
              </p>
            </div><!-- .rex-form-row -->


          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-select">
              <label for="multiselect">Multi-Selectbox</label>
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
