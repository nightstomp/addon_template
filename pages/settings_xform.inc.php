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
/*if ($func == 'savesettings')
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
}*/

// XFORM FORMULAR
////////////////////////////////////////////////////////////////////////////////
$form_data = 'fieldset|Textfelder|textfelder

text|text!|Textfeld||

textarea|textarea1|Textarea||

fieldset|Auswahlfelder|auswahlfelder

select|select1|Selectbox|Frau=w;Herr=m|[no_db]|defaultwert|0

select|multiselect|MultiSelectbox|Frau=w;Herr=m|[no_db]|defaultwert|1

radio|radiobutton|Radiobutton|Frau=w;Herr=m|[no_db]|defaultwert

checkbox|checkbox|Checkbox|Value|1/0|[no_db]

fieldset|Dateien aus Medienpool|medienpool

mediafile|label|Bezeichnung|groesseinkb|endungenmitpunktmitkommasepariert|pflicht=1|Fehlermeldung|[no_db]|mediacatid

mediapool|label|Bezeichnung|kategorieid|100|jpg,gif,png

hidden|page|'.$myself.'|REQUEST|[no_db]
hidden|subpage|'.$subpage.'|REQUEST|[no_db]
submit|submit|Speichern|no_db
';

$form = new rex_xform();
$form->setDebug(true);
$form->setFormData($form_data);
//$form->setObjectparams('form_action','index.php?page='.$myself.'&subpage='.$subpage,true);
//$form->setObjectparams('enc_type',false,true);
//$form->objparams['form_action'] = 'index.php?page='.$myself.'&subpage='.$subpage;
$form->objparams['form_method'] = 'get';



if($db){echo '<pre>'.var_export($_REQUEST,true).'</pre>';}

echo '
<div class="rex-addon-output">
  '.$form->getForm().'
</div><!-- .rex-addon-output -->
';
unset($form);
?>