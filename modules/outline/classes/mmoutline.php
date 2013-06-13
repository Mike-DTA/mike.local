<?php defined('SYSPATH') or die('No direct script access.');

// custom outline include function 
// usage in tpl :
// {include view='mydir/errors' data=get_defined_vars()}  <= get_defined_vars() gets all defined vars at that moment and notice no extension on the view filename !
function outline_function_include($args) {
    $data = (isset($args['data']) && !empty($args['data'])) ? $args['data'] : $GLOBALS ;
    $o = new MMOutline($args['view'], $data);
    $o->render();
}

function outline_function_victor() {
	echo 'victor';
}

class MMOutline {
  
  /*
  A tiny "template engine" for testing purposes.
  */
  
  protected static $engine;
  
  protected $template_path;
  protected $compiled_path;
  
  public $views_path;   //mmweb
  public $data = array();
  
  public function __construct($tpl, $data = array()) {
// echo 'tpl = '.$tpl;      
    // $this->template_path = dirname(__FILE__).'/templates/'.$tpl.'.php';
    // $this->compiled_path = dirname(__FILE__).'/compiled/'.$tpl.'.tpl.php';

        // $this->data = $data;
        // $finfo = pathinfo($tpl);
        // $this->template_path = $tpl;
        // $this->compiled_path = $finfo['dirname'].'/_compiled/'.$finfo['filename'].'.tpl.php';     
        
        if (!isset($engine)) {
            MMOutline::init();
        }

        $this->data = $data;
        // first check for regular Kohana view capture :
        if (substr($tpl,0,1) == '/' && file_exists($tpl)) {
            $file = $tpl;
        } else {
            // might be an custom outline_function_include:
            // tpl would be: 'myview' || 'myDirSomewhereInKohanaViews/myview'
            $file = Kohana::find_file('views', $tpl);
        }
        // $finfo = pathinfo($tpl.'.php');
        // $this->template_path = $tpl.'.php';
        // // must be full path on system:        
        // $this->compiled_path = SITE_DIR.$finfo['dirname'].'/_compiled/'.$finfo['filename'].'.tpl.php';           
// echo $file;
// echo file_exists($file);        
        if (file_exists($file)) {
            $finfo = pathinfo($file);
            $this->template_path = $file;
    // print_r($finfo);        
            $this->compiled_path = $finfo['dirname'].'/_compiled/'.$finfo['filename'].'.tpl.php';     
        } 
  }
  
  public function getTest() {
    return "this message comes from the OutlineTest test class";
  }
  
  public function render($return = null) {
	
    if (defined('RECOMPILE')) self::$engine->compile(
      $this->template_path,
      $this->compiled_path,
      true // force recompile
    );		
    extract($this->data);
	if ($return) {		
		ob_start();
	    require self::$engine->load($this->compiled_path);				
		$output = ob_get_contents();
		@ob_end_clean();
		return $output;
	} else {
	    require self::$engine->load($this->compiled_path);		
	}
  }  
    
  public static function trace($msg) {
    echo "<div style=\"color:#f00\"><strong>Outline</strong>: $msg</div>";
  }
  
  public static function init() {
    // self::$engine = new Outline(array(
    //   'trace_callback' => array(__CLASS__, 'trace')
    // ));
    self::$engine = new Outline(array(
        'quiet' => true, 'plugins' => array('system', 'custom')
    ));
  }
  
}