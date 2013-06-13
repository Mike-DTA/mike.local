<?php $_ = OutlineRuntime::start(__FILE__, isset($this) ? $this : null); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $page_title ?> : <?= $site_title ?></title>
	<?= html::style('/css/base.css') ?>
</head>

<body>
	<?php if (isset($view_header)) { ?>
	<?php echo outline_function_include(array("view" => $view_header, "data" => get_defined_vars())); ?>   
	<?php } ?>

	<!-- start main view //-->
	<?php if (isset($view_main)) { ?>
	<?php echo outline_function_include(array("view" => $view_main, "data" => get_defined_vars())); ?>
	<?php } ?>
	<!-- end main view //-->	

	<?php if (isset($view_footer)) { ?>
	<?php echo outline_function_include(array("view" => $view_footer, "data" => get_defined_vars())); ?>   
	<?php } ?>

	<div id="kohana-profiler">
		<?= View::factory('profiler/stats') ?>
	</div>
</body>
</html><?php $_ = OutlineRuntime::finish(__FILE__); ?>