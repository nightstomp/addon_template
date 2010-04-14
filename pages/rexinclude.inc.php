<?php

/* -------------------------- REXINCLUDE TEST ------------------------------- */


$functions = rexdev_scandir($myroot.'/functions',1,array(),array('function.*'));


 echo '<div class="rex-addon-output">
<h2 class="rex-hl2">Funktionen</h2>';

$form = new rex_form('','','','get',false);

foreach($functions['files'] as $inc)
{
  $htmlinc = str_replace('.', '-', $inc);
  $field = &$form->addRadioField($inc);
  $field->setLabel($inc);
  //if ($field->getValue() == '') {$field->setValue('nein');}
  $field->addOption('Ja','ja');
  $field->addOption('Nein','nein');
}


$form->show();

echo '</div>';

?>