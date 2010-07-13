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

  /* Diese Parameter gehören nicht zum Formular */
  $ignores = array('page','subpage','minorpage','func','sendit','PHPSESSID');

  /* Alle Parameter abfragen und durchlaufen.. */
  foreach($_REQUEST as $k => $v)
  {
    /* ..Liste abziehen, Rest: zu speichernde Parameter aus Formular */
    if(!in_array($k,$ignores))
    {
      $REX['ADDON'][$myself][$k] = $v;
      $content .= '$REX["ADDON"]["addon_template"]["'.$k.'"] = \''.$v.'\';'."\n";
    }
  }

  /* Daten in config.inc.php speichern */
  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  echo rex_info('Einstellungen wurden gespeichert.');
}
if($REX["ADDON"]["addon_template"]["settings"]["debug"])
{
  echo '<pre>'.var_export($_REQUEST,true).'</pre>';
}

// FORMULAR PER REX_FORM DEFINIEREN
////////////////////////////////////////////////////////////////////////////////
echo '<div class="rex-addon-output">';

$form = new rex_form('rex_template','Texteingabe','id=1',"post",$REX["ADDON"]["addon_template"]["settings"]["debug"]);
$form->sql = 'SELECT * from rex_template where 1=1';
// DEBUG SWITCH VIA REX/CONFIG
//$form->debug = false;

// Textfeld
$field = &$form->addTextField('textfield');
$field->setLabel("Textfeld");

// Textarea
$field = &$form->addTextAreaField('textareafield');
$field->setLabel("Textarea");

// Ein neues Fieldset
$form->addFieldset('Auswahlfelder');

// Starndard Selectbox
$field =& $form->addSelectField('select');
$field->setLabel("Selectbox");
$select =& $field->getSelect();
$select->setSize(1); /* 1 = eine Zeile = "normale Selectbox" */
$select->addOption('Beschreibung zu Wert "foo"','foo');
$select->addOption('Beschreibung zu Wert "bar"','bar');

// Multi Selectbox
$field =& $form->addSelectField('multisselect');
$field->setLabel("MultiSelectbox");
$select =& $field->getSelect();
$select->addOption('Beschreibung zu Wert "blah"','blah');
$select->addOption('Beschreibung zu Wert "frzl"','frzl');

// Radiobutton
$field = &$form->addRadioField('radiofield');
$field->setLabel("Radiobutton");
$field->addOption('Ja',1);
$field->addOption('Nein',0);
$field->addOption('Evtl.',2);

// Checkbox
$field = &$form->addCheckboxField('checkboxfield');
$field->setLabel("Checkbox");
$field->addOption('Ja',1);

// Ein neues Fieldset
$form->addFieldset('Dateien aus Medienpool');

// Einzelne Mediapool Datei
$field = &$form->addMediaField('mediafield');
$field->setLabel("Mediabutton");

// Mehrere Mediapool Dateien
$field = &$form->addMedialistField('medialistfield');
$field->setLabel("Medialist");

// Ein weitere neues Fieldset
$form->addFieldset('Interne Links');

// Einzelner link
$field = &$form->addLinkmapField('linkmapfield');
$field->setLabel("Linkmap");

// Mehrere links
$field = &$form->addLinklistField('linklistfield');
$field->setLabel("Linklist");

$form->show();

echo '</div>';

?>