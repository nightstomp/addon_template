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
$id        = rex_request('id', 'int');

// AUSGABE DER SEITE JE NACH $func
/////////////////////////////////////////////////////////////////////////////////
$AddonDBTable = 'rex_720_data';
$pagination = 20;

if($func == "")
{
  /* LISTE ------------------------------------------------------------------ */
   echo '<div class="rex-addon-output">
   <h2 class="rex-hl2">Übersicht <span style="color:silver;font-size:12px;">(DB Tabelle: '.$AddonDBTable.')</span></h2>';

  // alle Felder abfragen und anzeigen
  $query = 'SELECT * FROM '.$AddonDBTable;
  // einzelne Felder abfragen und anzeigen
  $query = 'SELECT `id`, `text`, `textarea`, `select`, `multiselect`, `checkbox`, `radiobutton`, `mediabutton`, `medialist`, `linkbutton`, `linklist` FROM '.$AddonDBTable;
  $list = new rex_list($query,$pagination,'data');

  // DEBUG SWITCH VIA REX/CONFIG
  $list->debug = false;

  $imgHeader = '<a href="'. $list->getUrl(array('func' => 'add')) .'"><img src="media/metainfo_plus.gif" alt="add" title="add" /></a>';

  $list->setColumnSortable('id');
  $list->setColumnSortable('text');
  $list->setColumnSortable('textarea');
  //$list->setColumnSortable('select');
  //$list->setColumnSortable('multiselect');
  $list->setColumnSortable('checkbox');
  $list->setColumnSortable('radiobutton');
  //$list->setColumnSortable('mediabutton');
  //$list->setColumnSortable('medialist');
  //$list->setColumnSortable('linkbutton');
  //$list->setColumnSortable('linklist');


  $list->addColumn($imgHeader,'<img src="media/metainfo.gif" alt="field" title="field" />',0,array('<th class="rex-icon">###VALUE###</th>','<td class="rex-icon">###VALUE###</td>'));
  $list->setColumnParams($imgHeader,array('func' => 'edit', 'id' => '###id###'));

  $list->setColumnLabel('id'          ,'ID');
  $list->setColumnLabel('text'        ,'Text');
  $list->setColumnLabel('textarea'    ,'Textarea');
  $list->setColumnLabel('select'      ,'Select');
  $list->setColumnLabel('multiselect' ,'Multiselect');
  $list->setColumnLabel('checkbox'    ,'Check');
  $list->setColumnLabel('radiobutton' ,'Radio');
  $list->setColumnLabel('mediabutton' ,'Mediabutton');
  $list->setColumnLabel('medialist'   ,'MediaList');
  $list->setColumnLabel('linkbutton'  ,'Link');
  $list->setColumnLabel('linklist'    ,'Linklist');


  //$list->setColumnParams('id'           ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('text'         ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('textarea'     ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('select'       ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('multiselect'  ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('checkbox'     ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('radiobutton'  ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('mediabutton'  ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('medialist'    ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('linkbutton'   ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('linklist'     ,array('func' => 'edit', 'id' => '###id###'));
  $list->show();

  echo '</div>';
}

elseif ($func == 'edit' || $func == 'add')
{
  /* ADD/EDIT FORMULAR ------------------------------------------------------ */

  echo '<div class="rex-addon-output">';

  // Pberschrift je nach Funktion ADD/EDIT
  if($func == 'edit')
  {
    echo '<h2 class="rex-hl2">Datensatz bearbeiten <span style="color:silver;font-size:12px;">(ID: '.$id.')</span></h2>';
  }
  else
  {
    echo '<h2 class="rex-hl2">Neuen Datensatz anlegen</h2>';
  }


  $form = new rex_form($AddonDBTable,'Texteingabe','id='.$id,'post',false);

  // Ein neues Fieldset
  $form->addFieldset('Texteingabe');

  // Textfeld
  $field = &$form->addTextField('text');
  $field->setLabel("Textfeld");

  // Textarea
  $field = &$form->addTextAreaField('textarea');
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
  $field =& $form->addSelectField('multiselect');
  $field->setAttribute('multiple','multiple');
  $field->setLabel("MultiSelectbox");
  $select =& $field->getSelect();
  $select->addOption('Beschreibung zu Wert "blah"','blah');
  $select->addOption('Beschreibung zu Wert "frzl"','frzl');

  // Checkbox
  $field = &$form->addCheckboxField('checkbox');
  $field->setLabel("Checkbox");
  $field->addOption('Ja',1);

  // Radiobutton
  $field = &$form->addRadioField('radiobutton');
  $field->setLabel("Radiobutton");
  $field->addOption('Ja',1);
  $field->addOption('Nein',0);
  $field->addOption('Evtl.',2);

  // Ein neues Fieldset
  $form->addFieldset('Dateien aus Medienpool');

  // Einzelne Mediapool Datei
  $field = &$form->addMediaField('mediabutton');
  $field->setLabel("Mediabutton");

  // Mehrere Mediapool Dateien
  $field = &$form->addMedialistField('medialist');
  $field->setLabel("Medialist");

  // Ein weitere neues Fieldset
  $form->addFieldset('Interne Links');

  // Einzelner link
  $field = &$form->addLinkmapField('linkbutton');
  $field->setLabel("Linkmap");

  // Mehrere links
  $field = &$form->addLinklistField('linklist');
  $field->setLabel("Linklist");

  // Falls vorhandener Datensatz editiert wird, braucht man dessen id
  if($func == 'edit')
  {
    $form->addParam('id', $id);
  }

  $form->show();

  echo '</div>';

}

?>