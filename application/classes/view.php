<?php defined('SYSPATH') or die('No direct script access.');

class View extends Kohana_View {
     
    public static $use_outline = true;
	/**
	 * Captures the output that is generated when a view is included.
	 * The view data will be extracted to make local variables. This method
	 * is static to prevent object scope resolution.
	 *
	 * @param   string  filename
	 * @param   array   variables
	 * @return  string
	 */
	protected static function capture($template, array $data) {
		if ($template == '') return;

		if (self::$use_outline) {
            // the magic trick to automatically globalize all view vars
            $data = array_merge(self::$_global_data, $data);
            self::$_global_data = $data;    // setting global data to merged data
            
            $template_file = $template;
            $outline = new MMOutline($template_file, $data);
            $output = $outline->render();
		}  else {
			$output = parent::capture($template, $data);			
		}		
		return $output;
	}
}