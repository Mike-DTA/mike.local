<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $page_title ?> : <?= $site_title ?></title>
	<?= html::style('/css/base.css') ?>
</head>

<body>
	{if isset($view_header)}
	{include view=$view_header data=get_defined_vars()}   
	{/if}

	<!-- start main view //-->
	{if isset($view_main)}
	{include view=$view_main data=get_defined_vars()}
	{/if}
	<!-- end main view //-->	

	{if isset($view_footer)}
	{include view=$view_footer data=get_defined_vars()}   
	{/if}

</body>
</html>