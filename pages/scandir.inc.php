<?php

$myself = rex_request('page', 'string');
$root = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/';

echo '<div class="rex-addon-output">
  <h2 class="rex-hl2" style="font-size:1em">rexdev_scandir() Tests</h2>
  <div class="rex-addon-content">
  <div class="addon-template">';

/* ----------------------------- SCANDIR TEST ------------------------------- */

echo '<pre>';
echo '// Funktion blah("frzlbrmpft"):'."\n";
blah('frzlbrmpft');
echo '</pre>';

echo '<pre>';
echo $root."\n";
echo '</pre>';

echo '<pre>';
highlight_string(
"<?php\n\n// rexdev_scandir(\$myroot.'/functions',1,array('function.rex_addon_template_css_add.inc.php','function.textile_parser.inc.php','function.rexdev_scandir.inc.php'),array('function.*'))) \n\n".
print_r(rexdev_scandir($myroot.'/functions',1,array('function.rex_addon_template_css_add.inc.php','function.textile_parser.inc.php','function.rexdev_scandir.inc.php'),array('function.*')),true).
"\n?>\n"
);
echo '</pre>';

echo '<pre>';
highlight_string(
"<?php\n\n// rexdev_scandir(\$root)) \n\n".
print_r(rexdev_scandir($root),true).
"\n?>\n"
);
echo '</pre>';

fb(rexdev_scandir($root,0,array('_*'),array('_*','*.php')));

//fb(rexdev_scandir($root,0,array('.DS_Store')),'$root,NULL,array(\'.DS_Store\')');
//fb(rexdev_scandir($root,1),'rexdev_scandir($root,1)');
//fb(rexdev_scandir($root,2),'rexdev_scandir($root,2)');
//fb(rexdev_scandir($root,3),'rexdev_scandir($root,3)');


/* ----------------------------- SCANDIR TEST ------------------------------- */
echo '</div>
</div>
</div>';

?>