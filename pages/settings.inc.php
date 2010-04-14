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

// PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$chapter = rex_request('chapter', 'string');
$func = rex_request('func', 'string');

$option1 = rex_request('option1', 'int');
$option2 = rex_request('option2', 'int');

// UPDATE/WRITE USER SETTINGS
////////////////////////////////////////////////////////////////////////////////
if ($func == "update") {
  $REX['ADDON'][$myself]['option1'] = $option1;
  $REX['ADDON'][$myself]['option2'] = $option2;

  $content = 
'$REX["ADDON"]["addon_template"]["option1"] = '.$option1.'; 
$REX["ADDON"]["addon_template"]["option2"] = '.$option2.';
';

  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  echo rex_info('Einstellungen wurden gespeichert.');
}

// OPTION1 SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$option1strings = array (
1=>'inaktiv',
2=>'foo..',
3=>'bar..'
);

$option1_select = '';
foreach($option1strings as $key => $string) {
  if($REX['ADDON'][$myself]['option1']!=$key) {
    $option1_select .= '<option value="'.$key.'">'.$string.'</option>';
  } else {
    $option1_select .= '<option value="'.$key.'" selected="selected">'.$string.'</option>';
  }
}

// OPTION2 SELECT BOX
////////////////////////////////////////////////////////////////////////////////
$option2strings = array (
1=>'Nein',
2=>'blah..',
3=>'fasel..'
);

$option2_select = '';
foreach($option2strings as $key => $string) {
  if($REX['ADDON'][$myself]['option2']!=$key) {
    $option2_select .= '<option value="'.$key.'">'.$string.'</option>';
  } else {
    $option2_select .= '<option value="'.$key.'" selected="selected">'.$string.'</option>';
  }
}

echo '
<div class="rex-addon-output">
  <div class="rex-form">

  <form action="index.php" method="get">
    <input type="hidden" name="page" value="'.$myself.'" />
    <input type="hidden" name="subpage" value="settings" />
    <input type="hidden" name="func" value="update" />

        <fieldset class="rex-form-col-1">
          <legend>Legend Option 1</legend>
          <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-select">
                <label for="option1">Label Option1</label>
                <select id="option1" name="option1">
                '.$option1_select.'
                </select>
              </p>
            </div>

          </div>
        </fieldset>

        <fieldset class="rex-form-col-1">
          <legend>Legend Option 2</legend>
          <div class="rex-form-wrapper">

          <div class="rex-form-row">
            <p class="rex-form-col-a rex-form-select">
              <label for="option2">Label Option 2</label>
              <select id="option2" name="option2">
              '.$option2_select.'
              </select>
            </p>
          </div>

          <div class="rex-form-row rex-form-element-v2">
            <p class="rex-form-submit">
              <input class="rex-form-submit" type="submit" id="sendit" name="sendit" value="Einstellungen speichern" />
            </p>
          </div>

          </div>
        </fieldset>

  </form>
  </div>
</div>
';
?>