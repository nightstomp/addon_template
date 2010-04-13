<?php

$myself = rex_request('page', 'string');
$path = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/libs/FirePHPCore-0.3.1/lib/FirePHPCore/';

echo '<div class="rex-addon-output">
  <h2 class="rex-hl2" style="font-size:1em">scandir func tests</h2>
  <div class="rex-addon-content">
	<div class= "firephp">';


/* ----------------------------- SCANDIR TEST ------------------------------- */
echo '<fieldset>
<label class="rex-hl2">http://camendesign.com/code/php_directory_sorting</label> ';

//warning: `is_dir` will need you to change to the parent directory of what you are testing
//see <uk3.php.net/manual/en/function.is-dir.php#70005> for details
chdir ($path);

//get a directory listing
$dir = array_diff (scandir ('.'),
	//folders / files to ignore
	array ('.', '..', '.DS_Store', 'Thumbs.db', '.svn')
);

//sort folders first, then by type, then alphabetically
usort ($dir, create_function ('$a,$b', '
	return	is_dir ($a)
		? (is_dir ($b) ? strnatcasecmp ($a, $b) : -1)
		: (is_dir ($b) ? 1 : (
			strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION)) == 0
			? strnatcasecmp ($a, $b)
			: strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION))
		))
	;
'));

fb($dir,'$dir');

echo '</fieldset>' ;

/* ----------------------------- SCANDIR TEST ------------------------------- */
echo '<fieldset>
<label class="rex-hl2">http://www.dreamincode.net/forums/topic/83008-simple-directory-traverser/</label>';

function BuildFileList($folder) {
        if($contents = @ scandir($folder)) {
                $found = array();
                $extension = array('doc','pdf','txt','docx','rtf','gIf','jpeg','jpg','png','avi','zip','mpeg','xml','bmp','php');
                foreach($contents as $temp) {
                        $info = pathinfo($temp);
                        if(array_key_exists('extension', $info) && in_array($info['extension'],$extension)) {
                                $found[] = $temp;
                        }
                }
                if($found) {
                        natcasesort($found);
                        foreach($found as $filename) {
                                echo $filename . "<br />";
                        }
                }
        }
}

fb(BuildFileList($path),'BuildFileList($dir)');

echo '</fieldset>' ;

/* ----------------------------- SCANDIR TEST ------------------------------- */
echo '<fieldset>
<label class="rex-hl2">http://forums.thewickedflea.com/showthread.php?tid=26</label>';


// This is how you start a class.  You can say class x extends y, but we're not doing that yet.
  class RecursiveSearch {
  
    // Now, you can declare your variables here, but it is not good form to initialize them here.
    // The reason for this is that functions outside a child function (for initialization) aren't
    // called.  That's right.  So if I wrote:
    //  var $abc = dirname(__FILE__);
    // It would not get initialized properly.  Let us begin in earnest.

    // This is the root directory of our search, it should always be an absolute path, and not a relative path.
    var $basedir = '';
    // This will be an array, when our object is created, of all results in a path relative to the base dir.
    var $files;
    // This is an array of our directories, just in case someone happens to want those sometime. ;-)
    var $folders;
    var $count; // Just for kicks.

    // Now, this is different.  I use a double underscore for internal variables and this is a callback
    // function for any action the user may want to execute on a per-file basis.
    // The function will be called like this: call_user_func_array($__filefunc, $file)
    // A function prototype should be: find_file($file){}
    var $__filefunc;

    // This is our framework constructor.  All we need passed to it is the root directory to search, and an optional
    // per-file callback.  Because we don't want to supply the latter every time we'll make it default to ''.
    function RecursiveSearch($root,$callback = '')
    {
      $this->__filefunc = $callback; // We want this assigned even if blank.  More later!
      $this->basedir    = $root;
      $this->files      = array();
      $this->folders    = array();
      
      $this->__search(); // This is how hard it is to initialize the object.  Wow huh?  In fact, more on this later.
      // The following line is not executed until after the entire search is finished.
      $this->count = count($this->files)+count($this->folders);
    }
    
    // This is our prototype internal search function.  You shouldn't call this on your own.  The dir string that gets
    // passed is what lets us go recursive in our search.  Only there are two problems which I will outline later.
    function __search($dir = '')
    {
      // This is the same as if($dir == '') do ? ... : else do : ... ;  This tutorial is to explain
      // classes in a basic sense, and how to do a recursive search in a stable one. ;) Not elementary
      // PHP coding.
      $path = $dir == '' ? $this->basedir : "{$this->basedir}/$dir";
      
      foreach(scandir($path) as $found)
      {
        // Now, this is extremely critical, as the __isdot call must be before everything else, or it *will*
        // register as a valid directory to be searched!
        if(!$this->__isignored($found))
        {
          $absolute = "$path/$found";
          $relative = $dir == '' ? $found : "$dir/$found";
          // We prioritize folders first, as this script dives to the deepest depth and then works outwards.  It's an
          // effective mechanism to ensure that you do end up getting the results in a rather efficient manner.
          if(is_dir($absolute))
          {
            $this->folders[] = $relative; // Store the result... again, with relative pathing.

            // And this is how you search recursively. :D Just call it with the relative path, and you're good to go!
            $this->__search($relative);
          }elseif(is_file($absolute) && $this->__hasextension($found)){
            $this->files[] = $relative;

            // And this is how we add a callback hook, so that if there is a function to call whenever a file is found
            // this is it!  Pretty effective and very easy to handle I must say.
            if($this->__filefunc != '')
              call_user_func_array($this->__filefunc, $relative);
          }
        }
      }
    }
    
    function __isignored($s)
    {
      $ignores = array ('.', '..', '.DS_Store', 'Thumbs.db', '.svn');
      foreach($ignores as $i){
        if ($i == $s)
        {
          return true;
        }
      }
    }
    
    function __hasextension($s)
    {
      $whitelist = array ('.php4', '.php');
      foreach($whitelist as $w){
        fb(strrchr($s, '.'),'strrchr($s, ".")');
        if (strrchr($s, '.') == $w)
        {
          return true;
        }
        else
        {
          return false;
        }
      }
    }
  }
  
  $path = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/libs/';
  $foo = new RecursiveSearch($path);
  
  fb($foo,'$foo');

  /*
  
    The following is a test script; be careful with how you mangle it. :P

  */

  echo "<b>Files:</b>\n<ul>\n";
  $search = new RecursiveSearch(dirname(__FILE__),create_function('$found','echo "<li>$found</li>\n";'));
  echo "</ul>\n",
       "<table border='0'>\n",
       "<tr><td><i>Number of Files:</i></td><td>".count($search->files)."</td></tr>\n",
       "<tr><td><i>Total Results:</i></td><td>{$search->count}</td></tr>\n",
       "</table>";
       
  class KeywordSearch extends RecursiveSearch {
    var $keyword;

    function KeywordSearch($root,$keyword,$callback = '')
    {
      $this->keyword = $keyword;
      // Call our parent constructor:
      parent::RecursiveSearch($root,$callback);
    }
    
    function __search($dir = '')
    {
      $path = $dir == '' ? $this->basedir : "{$this->basedir}/$dir";
      
      foreach(scandir($path) as $found)
      {
        if(!$this->__isignored($found))
        {
          $absolute = "$path/$found";
          $relative = $dir == '' ? $found : "$dir/$found";
          if(is_dir($absolute))
          {
            $this->folders[] = $relative; // Store the result... again, with relative pathing.

            $this->__search($relative);
          // We want to ensure that not only is our given item is a file, but
          // that it contains the keyword as well.  Strstr works well for this.
          }elseif(is_file($absolute) && (strstr($absolute, $this->keyword) != false)){
            $this->files[] = $relative;

            if($this->__filefunc != '')
              call_user_func_array($this->__filefunc, $relative);
          }
        }
      }
    }
  }

echo '</fieldset>' ;

/* ----------------------------- SCANDIR TEST ------------------------------- */

echo '</div>
</div>
</div>';

?>