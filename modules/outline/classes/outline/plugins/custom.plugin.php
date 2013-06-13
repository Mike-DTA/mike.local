<?php

class OutlinePlugin_custom extends OutlinePlugin {

	public function require_tag($args) {
		$this->compiler->code("require_once '$args';");
	}

    // --- Plugin registration:
    public static function register(&$compiler) {
        $compiler->registerTag('require', 'require_tag');
        // $compiler->registerTag('include', 'include_tag');
    }
	
}