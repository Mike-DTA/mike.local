<?php defined('SYSPATH') or die('No direct script access.');

class MMController extends Controller_Template {
	
	public $template = '_default';
	public $data = array();
	public $config;
	public $config_assets;
	
	public $loggedin = false;
    public $is_admin = false;
	public $session;
	public $me = array();
	
	public function before() {
		parent::before();
				
		$this->config = Kohana::$config->load('app');
		// $this->config_assets = Kohana::$config->load('assets');
		// if (!empty($this->config_assets)) {
		// 	$this->_loadAssets();
	 //    }
	    
		// default views
		$this->data['view_header'] = '_header';
		$this->data['view_footer'] = '_footer';
		
		// default titles
		$this->data['page_title'] = 'Voorpagina';
		$this->data['site_title'] = 'Mike.Local.Demo';

		$this->session = Session::instance();		
		
		// if($this->session->get('loggedin')) {
		// 	$this->loggedin = $this->session->get('loggedin');
			
		// 	$this->data['me'] = $this->session->get('me');
			
		// 	if($this->session->get('is_admin')) {
		// 		$this->is_admin = true;
		// 	} 
		// } 
		
		// $this->data['loggedin'] = $this->loggedin;
		// $this->data['is_admin'] = $this->is_admin;
		
	}
		
	public function after() {

		// $this->data['loggedin'] = $this->loggedin;
		// $this->data['is_admin'] = $this->is_admin;	
		// $this->data['config'] = $this->config;
		// $this->data['google_analytics_code'] = (isset($this->config['google']['analytics']) && !empty($this->config['google']['analytics'])) ? $this->config['google']['analytics'] : '' ;
		// $this->data['controller'] = get_class($this);
		// $this->data['js_runtime'] = array(
		//     'controller' => $this->data['controller']
		//     , 'page' => (isset($this->data['page'])) ? $this->data['page'] : '' 
		// 	, 'page_id' => (isset($this->data['page_id'])) ? $this->data['page_id'] : '' 
		// 	, 'parent_id' => (isset($this->data['parent_id'])) ? $this->data['parent_id'] : '' 
		// 	// , 'page_id' => (isset($this->data['page_id'])) ? $this->data['page_id'] : '' 
		//     , 'host' => $_SERVER['HTTP_HOST']
		//     , 'site_url' => SITE_URL
		//     , 'loggedin' => $this->loggedin
		//     , 'is_admin' => $this->is_admin	
		// 	, 'developer' => DEVELOPER
		// 	, 'me' => $this->session->get('me')
		// );
		
		// $this->data['scripts_custom'][] = '<script id="jsRuntime" type="text/javascript" charset="UTF-8"> mm.runtime='.json_encode($this->data['js_runtime']).'; </script>';
		
       if ($this->auto_render === TRUE) {
           if (isset(View::$use_outline) && View::$use_outline) {
               foreach($this->data as $key => $value) {
                   $this->template->__set($key, $value);
               }
           } 
           
           
           $this->response->body($this->template->render());            

       }
       // no parent::after because overwritten here !
   }




	public function _loadAssets() {
		
		if (isset($this->config_assets['assets']['styles']) && is_array($this->config_assets['assets']['styles'])) {
           	$this->data['styles'] = array();	        
	        foreach($this->config_assets['assets']['styles'] as $key => $style) {
	            if (strpos($style, 'http://') !== false || strpos($style, 'https://') !== false || strpos($style, '://') !== false) {
   	            	$this->data['styles'][] = $style;
   	        	} else {	            
   	            	$this->data['styles'][] = SITE_URL.$style.'?'.filemtime($style);
               }
           }
       	}
	    if (isset($this->config_assets['assets']['scripts']) && is_array($this->config_assets['assets']['scripts'])) {
           $this->data['scripts'] = array();	        
	        foreach($this->config_assets['assets']['scripts'] as $key => $script) {
	            if (strpos($script, 'http://') !== false || strpos($script, 'https://') !== false || strpos($script, '://') !== false) {
   	            $this->data['scripts'][] = $script;	                
	            } else {
   	            $this->data['scripts'][] = SITE_URL.$script.'?'.filemtime($script);	                
	            }
           }
       }
	    if (isset($this->config_assets['assets']['scripts_head']) && is_array($this->config_assets['assets']['scripts_head'])) {
           $this->data['scripts_head'] = array();	        
	        foreach($this->config['assets']['scripts_head'] as $key => $script) {
	            if (strpos($script, 'http://') !== false || strpos($script, 'https://') !== false || strpos($script, '://') !== false) {
   	            $this->data['scripts_head'][] = $script;	                
	            } else {
   	            $this->data['scripts_head'][] = SITE_URL.$script.'?'.filemtime($script);	                	                
	            }
           }
       }                
   }

   public function _loadMetatags() {
       if (isset($this->config_assets['metatags']) && is_array($this->config_assets['metatags']) && !empty($this->config_assets['metatags'])) {
           $this->data['metatags'] = $this->config_assets['metatags'];
       }
   }
   
   public function _loadFavicons() {
       if (isset($this->config_assets['favicons']) && is_array($this->config_assets['favicons']) && !empty($this->config_assets['favicons'])) {
           $this->data['favicons'] = $this->config_assets['favicons'];
       }
   }

}
